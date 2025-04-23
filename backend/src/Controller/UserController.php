<?php

namespace App\Controller;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Component\HttpFoundation\Response;
use OpenApi\Annotations as OA;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[Route('/api/user')]
/**
 * @OA\Tag(name="User")
 * Contrôleur pour gérer les utilisateurs et administrateurs.
 */
class UserController extends AbstractController
{
    #[Route('/create', name: 'create_user', methods: ['POST'])]
    /**
     * @OA\Post(
     *     path="/api/user/create",
     *     summary="Créer un utilisateur",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"firstname", "lastname", "email", "password"},
     *             @OA\Property(property="firstname", type="string", example="John"),
     *             @OA\Property(property="lastname", type="string", example="Doe"),
     *             @OA\Property(property="email", type="string", example="john@example.com"),
     *             @OA\Property(property="password", type="string", example="password123"),
     *             @OA\Property(property="phone_number", type="string", example="0123456789"),
     *             @OA\Property(property="avatar", type="string", example="avatar.png"),
     *             @OA\Property(property="roles", type="array", @OA\Items(type="string"), example={"ROLE_ADMIN"})
     *         )
     *     ),
     *     @OA\Response(response=201, description="Utilisateur créé avec succès"),
     *     @OA\Response(response=400, description="Données invalides"),
     *     @OA\Response(response=409, description="Utilisateur déjà existant")
     * )
     */
    public function createUser(
        Request $request,
        EntityManagerInterface $entityManager,
        UserPasswordHasherInterface $passwordHasher,
        ValidatorInterface $validator,
        LoggerInterface $logger
    ): JsonResponse {
        try {
            $data = json_decode($request->getContent(), true);

            if (empty($data['firstname']) || empty($data['lastname']) || empty($data['email']) || empty($data['password'])) {
                return $this->json(['error' => 'Tous les champs requis doivent être renseignés'], Response::HTTP_BAD_REQUEST);
            }

            if ($entityManager->getRepository(User::class)->findOneBy(['email' => $data['email']])) {
                return $this->json(['error' => 'Cet utilisateur existe déjà'], Response::HTTP_CONFLICT);
            }

            $user = new User();
            $user->setFirstname($data['firstname']);
            $user->setLastname($data['lastname']);
            $user->setEmail($data['email']);
            $user->setPhoneNumber($data['phone_number'] ?? null);
            $user->setAvatar($data['avatar'] ?? 'default.png');
            $user->setIsActive(true);

            // ✅ Rôle dynamique avec validation basique
            $availableRoles = ['ROLE_USER', 'ROLE_ADMIN'];
            $roles = isset($data['roles']) && is_array($data['roles']) ? array_intersect($data['roles'], $availableRoles) : ['ROLE_USER'];
            $user->setRoles($roles);

            $hashedPassword = $passwordHasher->hashPassword($user, $data['password']);
            $user->setPassword($hashedPassword);

            $errors = $validator->validate($user);
            if (count($errors) > 0) {
                $validationErrors = [];
                foreach ($errors as $error) {
                    $validationErrors[$error->getPropertyPath()] = $error->getMessage();
                }
                return $this->json(['errors' => $validationErrors], Response::HTTP_BAD_REQUEST);
            }

            $entityManager->persist($user);
            $entityManager->flush();

            return $this->json([
                'message' => 'Utilisateur créé avec succès',
                'user' => [
                    'id' => $user->getId(),
                    'firstname' => $user->getFirstname(),
                    'lastname' => $user->getLastname(),
                    'email' => $user->getEmail(),
                    'phone_number' => $user->getPhoneNumber(),
                    'avatar' => $user->getAvatar(),
                    'roles' => $user->getRoles(),
                    'is_active' => $user->isActive(),
                    'created_at' => $user->getCreatedAt()?->format('Y-m-d\TH:i:sP'),
                    'updated_at' => $user->getUpdatedAt()?->format('Y-m-d\TH:i:sP')
                ]
            ], Response::HTTP_CREATED);
        } catch (\Exception $e) {
            $logger->error("Erreur lors de la création de l'utilisateur : " . $e->getMessage());
            return $this->json(['error' => 'Erreur serveur'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * @OA\Get(
     *     path="/api/user/all",
     *     summary="Liste de tous les utilisateurs",
     *     security={{"bearerAuth": {}}},
     *     @OA\Response(response=200, description="Liste retournée avec succès"),
     *     @OA\Response(response=403, description="Accès interdit")
     * )
     */
    #[Route('/all', name: 'get_all_users', methods: ['GET'])]
    #[IsGranted('ROLE_ADMIN')]
    public function getAllUsers(EntityManagerInterface $entityManager): JsonResponse
    {
        $users = $entityManager->getRepository(User::class)->findAll();

        $response = array_map(fn($user) => [
            'id' => $user->getId(),
            'firstname' => $user->getFirstname(),
            'lastname' => $user->getLastname(),
            'email' => $user->getEmail(),
            'phone_number' => $user->getPhoneNumber(),
            'avatar' => $user->getAvatar(),
            'is_active' => $user->isActive(),
            'created_at' => $user->getCreatedAt()?->format('Y-m-d\TH:i:sP'),
            'updated_at' => $user->getUpdatedAt()?->format('Y-m-d\TH:i:sP'),
        ], $users);

        return $this->json($response, Response::HTTP_OK);
    }
    /**
     * @OA\Get(
     *     path="/api/user/{id}",
     *     summary="Détails d'un utilisateur",
     *     security={{"bearerAuth": {}}},
     *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="string")),
     *     @OA\Response(response=200, description="Utilisateur trouvé"),
     *     @OA\Response(response=404, description="Utilisateur non trouvé")
     * )
     */
    #[Route('/{id}', name: 'get_user_by_id', methods: ['GET'])]
    #[IsGranted('IS_AUTHENTICATED_FULLY')]
    public function getUserById(string $id, EntityManagerInterface $entityManager): JsonResponse
    {
        $user = $entityManager->getRepository(User::class)->find($id);

        if (!$user) {
            return $this->json(['error' => 'Utilisateur non trouvé'], Response::HTTP_NOT_FOUND);
        }

        return $this->json([
            'id' => $user->getId(),
            'firstname' => $user->getFirstname(),
            'lastname' => $user->getLastname(),
            'email' => $user->getEmail(),
            'phone_number' => $user->getPhoneNumber(),
            'avatar' => $user->getAvatar(),
            'is_active' => $user->isActive(),
            'created_at' => $user->getCreatedAt()?->format('Y-m-d\TH:i:sP'),
            'updated_at' => $user->getUpdatedAt()?->format('Y-m-d\TH:i:sP'),
        ]);
    }
    /**
     * @OA\Put(
     *     path="/api/user/{id}",
     *     summary="Mettre à jour un utilisateur",
     *     security={{"bearerAuth": {}}},
     *     @OA\RequestBody(
     *         @OA\JsonContent(
     *             @OA\Property(property="firstname", type="string"),
     *             @OA\Property(property="lastname", type="string"),
     *             @OA\Property(property="phone_number", type="string"),
     *             @OA\Property(property="avatar", type="string"),
     *             @OA\Property(property="password", type="string")
     *         )
     *     ),
     *     @OA\Response(response=200, description="Mise à jour réussie"),
     *     @OA\Response(response=400, description="Validation échouée"),
     *     @OA\Response(response=404, description="Utilisateur non trouvé")
     * )
     */
    #[Route('/{id}', name: 'update_user', methods: ['PUT'])]
    #[IsGranted('IS_AUTHENTICATED_FULLY')]
    public function updateUser(
        string $id,
        Request $request,
        EntityManagerInterface $entityManager,
        ValidatorInterface $validator,
        UserPasswordHasherInterface $passwordHasher
    ): JsonResponse {
        $user = $entityManager->getRepository(User::class)->find($id);

        if (!$user) {
            return $this->json(['error' => 'Utilisateur non trouvé'], Response::HTTP_NOT_FOUND);
        }

        $data = json_decode($request->getContent(), true);
        if (isset($data['firstname'])) $user->setFirstname($data['firstname']);
        if (isset($data['lastname'])) $user->setLastname($data['lastname']);
        if (isset($data['phone_number'])) $user->setPhoneNumber($data['phone_number']);
        if (isset($data['avatar'])) $user->setAvatar($data['avatar']);
        if (isset($data['password'])) {
            $hashed = $passwordHasher->hashPassword($user, $data['password']);
            $user->setPassword($hashed);
        }

        $errors = $validator->validate($user);
        if (count($errors) > 0) {
            $errs = [];
            foreach ($errors as $error) {
                $errs[$error->getPropertyPath()] = $error->getMessage();
            }
            return $this->json(['errors' => $errs], Response::HTTP_BAD_REQUEST);
        }

        $entityManager->flush();
        return $this->json(['message' => 'Utilisateur mis à jour avec succès']);
    }
    /**
     * @OA\Delete(
     *     path="/api/user/delete/{id}",
     *     summary="Supprimer un utilisateur",
     *     security={{"bearerAuth": {}}},
     *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="string")),
     *     @OA\Response(response=200, description="Utilisateur supprimé"),
     *     @OA\Response(response=403, description="Action interdite"),
     *     @OA\Response(response=404, description="Utilisateur non trouvé")
     * )
     */
    #[Route('/delete/{id}', name: 'delete_user', methods: ['DELETE'])]
    #[IsGranted('ROLE_ADMIN')]
    public function deleteUser(string $id, EntityManagerInterface $entityManager, LoggerInterface $logger): JsonResponse
    {
        try {
            $user = $entityManager->getRepository(User::class)->find($id);

            if (!$user) {
                return $this->json(['error' => 'Utilisateur non trouvé'], Response::HTTP_NOT_FOUND);
            }

            $currentUser = $this->getUser();

            if (!$currentUser) {
                return $this->json(['error' => 'Utilisateur non authentifié'], Response::HTTP_UNAUTHORIZED);
            }

            if ($currentUser instanceof User && $user->getId() === $currentUser->getId()) {
                return $this->json(['error' => 'Vous ne pouvez pas vous supprimer vous-même'], Response::HTTP_FORBIDDEN);
            }

            $entityManager->remove($user);
            $entityManager->flush();

            return $this->json(['message' => 'Utilisateur supprimé avec succès'], Response::HTTP_OK);
        } catch (\Exception $e) {
            $logger->error("Erreur lors de la suppression de l'utilisateur : " . $e->getMessage());
            return $this->json(['error' => 'Erreur serveur'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
    /**
     * @OA\Patch(
     *     path="/api/user/{id}/promote",
     *     summary="Promouvoir un utilisateur en admin",
     *     security={{"bearerAuth": {}}},
     *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="string")),
     *     @OA\Response(response=200, description="Utilisateur promu"),
     *     @OA\Response(response=404, description="Utilisateur non trouvé")
     * )
     */
    #[Route('/{id}/promote', name: 'promote_user', methods: ['PATCH'])]
    #[IsGranted('ROLE_ADMIN')]
    public function promoteToAdmin(string $id, EntityManagerInterface $em): JsonResponse
    {
        $user = $em->getRepository(User::class)->find($id);
        if (!$user) {
            return $this->json(['error' => 'Utilisateur non trouvé'], Response::HTTP_NOT_FOUND);
        }

        $user->setRoles(['ROLE_ADMIN']);
        $em->flush();

        return $this->json([
            'message' => 'Utilisateur promu avec succès',
            'user' => ['id' => $user->getId(), 'email' => $user->getEmail(), 'roles' => $user->getRoles()]
        ]);
    }

    /**
     * @OA\Patch(
     *     path="/api/user/{id}/demote",
     *     summary="Rétrograder un admin en utilisateur",
     *     security={{"bearerAuth": {}}},
     *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="string")),
     *     @OA\Response(response=200, description="Utilisateur rétrogradé"),
     *     @OA\Response(response=404, description="Utilisateur non trouvé")
     * )
     */
    #[Route('/{id}/demote', name: 'demote_user', methods: ['PATCH'])]
    #[IsGranted('ROLE_ADMIN')]
    public function demoteFromAdmin(string $id, EntityManagerInterface $em): JsonResponse
    {
        $user = $em->getRepository(User::class)->find($id);
        if (!$user) {
            return $this->json(['error' => 'Utilisateur non trouvé'], Response::HTTP_NOT_FOUND);
        }

        $user->setRoles(['ROLE_USER']);
        $em->flush();

        return $this->json([
            'message' => 'Utilisateur rétrogradé avec succès',
            'user' => ['id' => $user->getId(), 'email' => $user->getEmail(), 'roles' => $user->getRoles()]
        ]);
    }
}
