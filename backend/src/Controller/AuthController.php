<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTTokenManagerInterface;
use App\Repository\UserRepository;
use App\Entity\User;
use Psr\Log\LoggerInterface;
use OpenApi\Annotations as OA;

#[Route('/api/auth')]
/**
 * @OA\Tag(name="Authentication")
 */
class AuthController extends AbstractController
{
    /**
     * @OA\Post(
     *     path="/api/auth/login",
     *     summary="Connexion de l'utilisateur",
     *     description="Permet à un utilisateur de se connecter avec son email et mot de passe et de recevoir un token JWT.",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"email", "password"},
     *             @OA\Property(property="email", type="string", format="email", example="user@example.com"),
     *             @OA\Property(property="password", type="string", example="SecurePassword123")
     *         )
     *     ),
     *     @OA\Response(response=200, description="Connexion réussie, retourne un token JWT."),
     *     @OA\Response(response=400, description="Email et mot de passe requis."),
     *     @OA\Response(response=401, description="Identifiants incorrects."),
     *     @OA\Response(response=403, description="Compte inactif.")
     * )
     */
    #[Route('/login', name: 'app_login', methods: ['POST'])]
    public function login(
        Request $request,
        UserRepository $userRepository,
        UserPasswordHasherInterface $passwordHasher,
        JWTTokenManagerInterface $jwtManager,
        LoggerInterface $logger
    ): JsonResponse {
        try {
            $payload = json_decode($request->getContent(), true);

            // Vérification des données entrantes
            $email = $payload['email'] ?? null;
            $password = $payload['password'] ?? null;

            if (!$email || !$password) {
                return $this->json(['success' => false, 'message' => 'Email et mot de passe requis'], Response::HTTP_BAD_REQUEST);
            }

            // Recherche de l'utilisateur
            $user = $userRepository->findOneBy(['email' => $email]);

            // Vérification de l'authentification
            if (!$user instanceof User || !$passwordHasher->isPasswordValid($user, $password)) {
                return $this->json(['success' => false, 'message' => 'Identifiants incorrects'], Response::HTTP_UNAUTHORIZED);
            }

            // Vérification si le compte est actif
            if (!$user->isActive()) {
                return $this->json(['success' => false, 'message' => 'Compte inactif. Veuillez contacter l\'administrateur.'], Response::HTTP_FORBIDDEN);
            }

            // Génération du token JWT
            $token = $jwtManager->create($user);

            return $this->json([
                'success' => true,
                'token' => $token,
                'user' => [
                    'id' => $user->getId(),
                    'firstname' => $user->getFirstname(),
                    'lastname' => $user->getLastname(),
                    'email' => $user->getEmail(),
                    'phone_number' => $user->getPhoneNumber(),
                    'age' => $user->getAge(),
                    'avatar' => $user->getAvatar(),
                    'is_active' => $user->isActive(),
                    'created_at' => $user->getCreatedAt()->format('Y-m-d\TH:i:sP'),
                    'updated_at' => $user->getUpdatedAt()->format('Y-m-d\TH:i:sP')
                ]
            ]);
        } catch (\Exception $e) {
            $logger->error("Erreur de connexion : " . $e->getMessage());
            return $this->json(['success' => false, 'message' => 'Erreur serveur'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
