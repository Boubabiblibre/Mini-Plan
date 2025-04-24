<?php

namespace App\Controller;

use App\Entity\Member;
use App\Repository\MemberRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Component\HttpFoundation\Response;
use OpenApi\Annotations as OA;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[Route('/api/member')]
/**
 * @OA\Tag(name="Member")
 * Contrôleur pour gérer les membres.
 */
class MemberController extends AbstractController
{
    /**
     * @OA\Post(
     *     path="/api/member/create",
     *     summary="Créer un nouveau membre",
     *     description="Ajoute un membre à un espace.",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"name", "space_id", "relationship"},
     *             @OA\Property(property="name", type="string", example="Alice"),
     *             @OA\Property(property="relationship", type="string", example="child"),
     *             @OA\Property(property="date_of_birth", type="string", format="date", example="2015-06-12"),
     *             @OA\Property(property="space_id", type="string", example="uuid-space")
     *         )
     *     ),
     *     @OA\Response(response=201, description="Membre créé avec succès"),
     *     @OA\Response(response=400, description="Données invalides"),
     *     @OA\Response(response=404, description="Espace non trouvé")
     * )
     */
    #[Route('/create', name: 'create_member', methods: ['POST'])]
    public function createMember(
        Request $request,
        EntityManagerInterface $entityManager,
        ValidatorInterface $validator
    ): JsonResponse {
        $data = json_decode($request->getContent(), true);

        if (!isset($data['name'], $data['relationship'], $data['space_id'])) {
            return $this->json(['error' => 'Nom, relation et espace requis'], Response::HTTP_BAD_REQUEST);
        }

        $space = $entityManager->getRepository(\App\Entity\Space::class)->find($data['space_id']);
        if (!$space) {
            return $this->json(['error' => 'Espace non trouvé'], Response::HTTP_NOT_FOUND);
        }

        $member = new Member();
        $member->setName($data['name']);
        $member->setRelationship($data['relationship']);
        $member->setSpace($space);
        $member->setDateOfBirth(isset($data['date_of_birth']) ? new \DateTime($data['date_of_birth']) : null);
        $member->setUser($this->getUser());

        $errors = $validator->validate($member);
        if (count($errors) > 0) {
            return $this->json(['error' => (string) $errors], Response::HTTP_BAD_REQUEST);
        }

        $entityManager->persist($member);
        $entityManager->flush();

        return $this->json([
            'message' => 'Membre ajouté avec succès',
            'member' => [
                'id' => $member->getId(),
                'name' => $member->getName(),
                'relationship' => $member->getRelationship(),
                'date_of_birth' => $member->getDateOfBirth()?->format('Y-m-d'),
                'space' => $space->getName()
            ]
        ], Response::HTTP_CREATED);
    }

    /**
     * @OA\Get(path="/api/member/all", summary="Récupérer tous les membres")
     */
    #[Route('/all', name: 'get_all_members', methods: ['GET'])]
    public function getAllMembers(MemberRepository $memberRepository): JsonResponse
    {
        $members = $memberRepository->findAll();

        $response = array_map(fn($member) => [
            'id' => $member->getId(),
            'name' => $member->getName(),
            'relationship' => $member->getRelationship(),
            'date_of_birth' => $member->getDateOfBirth()?->format('Y-m-d'),
            'space' => $member->getSpace()->getName()
        ], $members);

        return $this->json($response, Response::HTTP_OK);
    }

    /**
     * @OA\Get(path="/api/member/{id}", summary="Récupérer un membre par ID")
     */
    #[Route('/{id}', name: 'get_member_by_id', methods: ['GET'])]
    public function getMemberById(string $id, MemberRepository $memberRepository): JsonResponse
    {
        $member = $memberRepository->find($id);
        if (!$member) {
            return $this->json(['error' => 'Membre non trouvé'], Response::HTTP_NOT_FOUND);
        }

        return $this->json([
            'id' => $member->getId(),
            'name' => $member->getName(),
            'relationship' => $member->getRelationship(),
            'date_of_birth' => $member->getDateOfBirth()?->format('Y-m-d'),
            'space' => $member->getSpace()->getName()
        ]);
    }

    /**
     * @OA\Put(path="/api/member/update/{id}", summary="Mettre à jour un membre")
     */
    #[Route('/update/{id}', name: 'update_member', methods: ['PUT'])]
    public function updateMember(
        string $id,
        Request $request,
        EntityManagerInterface $entityManager,
        MemberRepository $memberRepository,
        ValidatorInterface $validator
    ): JsonResponse {
        $member = $memberRepository->find($id);
        if (!$member) {
            return $this->json(['error' => 'Membre non trouvé'], Response::HTTP_NOT_FOUND);
        }

        $data = json_decode($request->getContent(), true);
        if (isset($data['name'])) {
            $member->setName($data['name']);
        }
        if (isset($data['relationship'])) {
            $member->setRelationship($data['relationship']);
        }
        if (isset($data['date_of_birth'])) {
            $member->setDateOfBirth(new \DateTime($data['date_of_birth']));
        }

        $errors = $validator->validate($member);
        if (count($errors) > 0) {
            return $this->json(['error' => (string) $errors], Response::HTTP_BAD_REQUEST);
        }

        $entityManager->flush();

        return $this->json(['message' => 'Membre mis à jour avec succès'], Response::HTTP_OK);
    }

    /**
     * @OA\Delete(path="/api/member/delete/{id}", summary="Supprimer un membre")
     */
    #[Route('/delete/{id}', name: 'delete_member', methods: ['DELETE'])]
    #[IsGranted('ROLE_ADMIN')]
    public function deleteMember(
        string $id,
        EntityManagerInterface $entityManager,
        MemberRepository $memberRepository
    ): JsonResponse {
        $member = $memberRepository->find($id);
        if (!$member) {
            return $this->json(['error' => 'Membre non trouvé'], Response::HTTP_NOT_FOUND);
        }

        $entityManager->remove($member);
        $entityManager->flush();

        return $this->json(['message' => 'Membre supprimé avec succès'], Response::HTTP_OK);
    }
}
