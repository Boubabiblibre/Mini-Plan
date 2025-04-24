<?php

namespace App\Controller;

use App\Entity\Space;
use App\Repository\SpaceRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use OpenApi\Annotations as OA;

#[Route('/api/space')]
/**
 * @OA\Tag(name="Space")
 */
class SpaceController extends AbstractController
{
    /**
     * @OA\Post(
     *     path="/api/space/create",
     *     summary="Créer un nouvel espace",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"name", "visibility"},
     *             @OA\Property(property="name", type="string", example="Espace Famille"),
     *             @OA\Property(property="visibility", type="string", example="private"),
     *             @OA\Property(property="description", type="string", example="Un espace privé"),
     *             @OA\Property(property="logo", type="string", example="logo.png")
     *         )
     *     ),
     *     @OA\Response(response=201, description="Espace créé"),
     *     @OA\Response(response=400, description="Requête invalide")
     * )
     */
    #[IsGranted('IS_AUTHENTICATED_FULLY')]
    #[Route('/create', name: 'create_space', methods: ['POST'])]
    public function createSpace(
        Request $request,
        EntityManagerInterface $entityManager,
        ValidatorInterface $validator
    ): JsonResponse {
        $content = $request->getContent();

        if (empty($content)) {
            return $this->json(['error' => 'Le corps de la requête est vide'], Response::HTTP_BAD_REQUEST);
        }

        $data = json_decode($content, true);
        if (json_last_error() !== JSON_ERROR_NONE) {
            return $this->json(['error' => 'Le format JSON est invalide'], Response::HTTP_BAD_REQUEST);
        }

        if (empty($data['name']) || empty($data['visibility'])) {
            return $this->json(['error' => 'Le nom et la visibilité sont requis'], Response::HTTP_BAD_REQUEST);
        }

        $space = new Space();
        $space->setName($data['name']);
        $space->setVisibility($data['visibility']);
        $space->setDescription($data['description'] ?? null);
        $space->setLogo($data['logo'] ?? 'default.png');
        $space->setCreatedBy($this->getUser());

        $errors = $validator->validate($space);
        if (count($errors) > 0) {
            return $this->json(['error' => (string) $errors], Response::HTTP_BAD_REQUEST);
        }

        $entityManager->persist($space);
        $entityManager->flush();

        return $this->json([
            'message' => 'Espace créé avec succès',
            'space' => [
                'id' => $space->getId(),
                'name' => $space->getName(),
                'visibility' => $space->getVisibility(),
                'description' => $space->getDescription(),
                'logo' => $space->getLogo(),
                'created_at' => $space->getCreatedAt()?->format('Y-m-d\TH:i:sP'),
                'created_by' => [
                    'id' => $space->getCreatedBy()?->getId(),
                    'email' => $space->getCreatedBy()?->getEmail(),
                    'full_name' => $space->getCreatedBy()?->getFullName()
                ]
            ]
        ], Response::HTTP_CREATED);
    }

    /**
     * @OA\Get(path="/api/space/all", summary="Lister tous les espaces")
     */
    #[Route('/all', name: 'get_all_spaces', methods: ['GET'])]
    public function getAllSpaces(SpaceRepository $spaceRepository): JsonResponse
    {
        $spaces = $spaceRepository->findAll();

        $data = array_map(fn($space) => [
            'id' => $space->getId(),
            'name' => $space->getName(),
            'visibility' => $space->getVisibility(),
            'description' => $space->getDescription(),
            'logo' => $space->getLogo(),
            'created_at' => $space->getCreatedAt()?->format('Y-m-d\TH:i:sP'),
            'created_by' => [
                'id' => $space->getCreatedBy()?->getId(),
                'email' => $space->getCreatedBy()?->getEmail(),
                'full_name' => $space->getCreatedBy()?->getFullName()
            ]
        ], $spaces);

        return $this->json($data);
    }

    /**
     * @OA\Get(path="/api/space/{id}", summary="Récupérer un espace par son ID")
     */
    #[Route('/{id}', name: 'get_space_by_id', methods: ['GET'])]
    public function getSpaceById(string $id, SpaceRepository $spaceRepository): JsonResponse
    {
        $space = $spaceRepository->find($id);
        if (!$space) {
            return $this->json(['error' => 'Espace non trouvé'], Response::HTTP_NOT_FOUND);
        }

        return $this->json([
            'id' => $space->getId(),
            'name' => $space->getName(),
            'visibility' => $space->getVisibility(),
            'description' => $space->getDescription(),
            'logo' => $space->getLogo(),
            'created_at' => $space->getCreatedAt()?->format('Y-m-d\TH:i:sP'),
            'created_by' => [
                'id' => $space->getCreatedBy()?->getId(),
                'email' => $space->getCreatedBy()?->getEmail(),
                'full_name' => $space->getCreatedBy()?->getFullName()
            ]
        ]);
    }

    /**
     * @OA\Patch(path="/api/space/archive/{id}", summary="Archiver un espace")
     */
    #[IsGranted('IS_AUTHENTICATED_FULLY')]
    #[Route('/archive/{id}', name: 'archive_space', methods: ['PATCH'])]
    public function archiveSpace(string $id, EntityManagerInterface $entityManager, SpaceRepository $spaceRepository): JsonResponse
    {
        $space = $spaceRepository->find($id);
        if (!$space) {
            return $this->json(['error' => 'Espace non trouvé'], Response::HTTP_NOT_FOUND);
        }

        $space->archiveSpace();
        $entityManager->flush();

        return $this->json(['message' => 'Espace archivé avec succès']);
    }

    /**
     * @OA\Delete(path="/api/space/delete/{id}", summary="Supprimer un espace")
     */
    #[IsGranted('ROLE_ADMIN')]
    #[Route('/delete/{id}', name: 'delete_space', methods: ['DELETE'])]
    public function deleteSpace(string $id, EntityManagerInterface $entityManager, SpaceRepository $spaceRepository): JsonResponse
    {
        $space = $spaceRepository->find($id);
        if (!$space) {
            return $this->json(['error' => 'Espace non trouvé'], Response::HTTP_NOT_FOUND);
        }

        $entityManager->remove($space);
        $entityManager->flush();

        return $this->json(['message' => 'Espace supprimé avec succès']);
    }
}
