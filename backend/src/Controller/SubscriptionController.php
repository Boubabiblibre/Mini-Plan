<?php

namespace App\Controller;

use App\Entity\{Subscription, Member};
use Doctrine\ORM\EntityManagerInterface;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Component\HttpFoundation\Response;
use OpenApi\Annotations as OA;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[Route('/api/subscription')]
/**
 * @OA\Tag(name="Subscription")
 */
class SubscriptionController extends AbstractController
{
    /**
     * @OA\Post(
     *     path="/api/subscription/create",
     *     summary="Create a new subscription",
     *     description="Adds a subscription for a user or a family member.",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"name", "subscription_type", "start_date"},
     *             @OA\Property(property="name", type="string", example="Netflix Premium"),
     *             @OA\Property(property="subscription_type", type="string", example="monthly"),
     *             @OA\Property(property="start_date", type="string", format="date", example="2024-01-01"),
     *             @OA\Property(property="end_date", type="string", format="date", example="2024-12-31"),
     *             @OA\Property(property="amount", type="number", example=15.99),
     *             @OA\Property(property="currency", type="string", example="EUR"),
     *             @OA\Property(property="billing_mode", type="string", example="credit_card")
     *         )
     *     ),
     *     @OA\Response(response=201, description="Subscription created successfully"),
     *     @OA\Response(response=400, description="Invalid data")
     * )
     */
    // #[Route('/create', name: 'create_subscription', methods: ['POST'])]
    // public function createSubscription(
    //     Request $request,
    //     EntityManagerInterface $entityManager,
    //     ValidatorInterface $validator,
    //     LoggerInterface $logger
    // ): JsonResponse {
    //     try {
    //         $data = json_decode($request->getContent(), true);

    //         if (!isset($data['name'], $data['subscription_type'], $data['start_date'])) {
    //             return $this->json(['error' => 'Missing required fields'], Response::HTTP_BAD_REQUEST);
    //         }

    //         $subscription = new Subscription();
    //         $subscription->setName($data['name']);
    //         $subscription->setSubscriptionType($data['subscription_type']);
    //         $subscription->setStartDate(new \DateTime($data['start_date']));
    //         $subscription->setEndDate(isset($data['end_date']) ? new \DateTime($data['end_date']) : null);
    //         $subscription->setAmount($data['amount'] ?? null);
    //         $subscription->setCurrency($data['currency'] ?? 'EUR');
    //         $subscription->setBillingMode($data['billing_mode'] ?? 'unknown');

    //         $errors = $validator->validate($subscription);
    //         if (count($errors) > 0) {
    //             return $this->json(['error' => (string) $errors], Response::HTTP_BAD_REQUEST);
    //         }

    //         $entityManager->persist($subscription);
    //         $entityManager->flush();

    //         return $this->json(['message' => 'Subscription created successfully'], Response::HTTP_CREATED);
    //     } catch (\Exception $e) {
    //         $logger->error('Error creating subscription: ' . $e->getMessage());
    //         return $this->json(['error' => 'Server error'], Response::HTTP_INTERNAL_SERVER_ERROR);
    //     }
    // }


    /**
     * @OA\Post(
     *     path="/api/subscription/create",
     *     summary="Create a new subscription",
     *     security={{"bearerAuth": {}}},
     *     description="Adds a subscription for a user or a family member.",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"name", "subscription_type", "start_date", "member_id"},
     *             @OA\Property(property="name", type="string", example="Netflix Premium"),
     *             @OA\Property(property="subscription_type", type="string", example="monthly"),
     *             @OA\Property(property="start_date", type="string", format="date", example="2024-01-01"),
     *             @OA\Property(property="end_date", type="string", format="date", example="2024-12-31"),
     *             @OA\Property(property="amount", type="number", example=15.99),
     *             @OA\Property(property="currency", type="string", example="EUR"),
     *             @OA\Property(property="billing_mode", type="string", example="credit_card"),
     *             @OA\Property(property="member_id", type="string", example="uuid")
     *         )
     *     ),
     *     @OA\Response(response=201, description="Subscription created successfully"),
     *     @OA\Response(response=400, description="Invalid data"),
     *     @OA\Response(response=404, description="Member not found")
     * )
     */
    #[Route('/create', name: 'create_subscription', methods: ['POST'])]
    #[IsGranted('IS_AUTHENTICATED_FULLY')]
    public function createSubscription(
        Request $request,
        EntityManagerInterface $entityManager,
        ValidatorInterface $validator,
        LoggerInterface $logger
    ): JsonResponse {
        try {
            $data = json_decode($request->getContent(), true);

            if (!isset($data['name'], $data['subscription_type'], $data['start_date'], $data['member_id'], $data['service_id'])) {
                return $this->json(['error' => 'Champs requis manquants'], Response::HTTP_BAD_REQUEST);
            }

            $member = $entityManager->getRepository(\App\Entity\Member::class)->find($data['member_id']);
            $service = $entityManager->getRepository(\App\Entity\Service::class)->find($data['service_id']);

            if (!$member || !$service) {
                return $this->json(['error' => 'Membre ou Service introuvable'], Response::HTTP_NOT_FOUND);
            }

            $subscription = new Subscription();
            $subscription->setName($data['name']);
            $subscription->setSubscriptionType($data['subscription_type']);
            $subscription->setStartDate(new \DateTime($data['start_date']));
            $subscription->setEndDate(isset($data['end_date']) ? new \DateTime($data['end_date']) : null);
            $subscription->setAmount($data['amount'] ?? null);
            $subscription->setCurrency($data['currency'] ?? 'EUR');
            $subscription->setBillingMode($data['billing_mode'] ?? 'unknown');

            // Associations obligatoires
            $subscription->setMember($member);
            $subscription->setService($service);

            // Lier l'utilisateur connecté
            if (method_exists($subscription, 'setUser') && $this->getUser()) {
                $subscription->setUser($this->getUser());
            }

            $errors = $validator->validate($subscription);
            if (count($errors) > 0) {
                return $this->json(['error' => (string) $errors], Response::HTTP_BAD_REQUEST);
            }

            $entityManager->persist($subscription);
            $entityManager->flush();

            return $this->json([
                'message' => 'Subscription créée avec succès',
                'subscription_id' => $subscription->getId()
            ], Response::HTTP_CREATED);
        } catch (\Exception $e) {
            return $this->json([
                'error' => 'Server error',
                'details' => $e->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    #[Route('/all', name: 'get_all_subscriptions', methods: ['GET'])]
    public function getAllSubscriptions(EntityManagerInterface $entityManager): JsonResponse
    {
        $subscriptions = $entityManager->getRepository(Subscription::class)->findAll();
        return $this->json($subscriptions);
    }

    #[Route('/update/{id}', name: 'update_subscription', methods: ['PUT'])]
    public function updateSubscription(string $id, Request $request, EntityManagerInterface $entityManager): JsonResponse
    {
        $subscription = $entityManager->getRepository(Subscription::class)->find($id);
        if (!$subscription) {
            return $this->json(['error' => 'Subscription not found'], Response::HTTP_NOT_FOUND);
        }

        $data = json_decode($request->getContent(), true);
        $subscription->setName($data['name'] ?? $subscription->getName());
        $subscription->setAmount($data['amount'] ?? $subscription->getAmount());
        $subscription->setCurrency($data['currency'] ?? $subscription->getCurrency());

        $entityManager->flush();

        return $this->json(['message' => 'Subscription updated successfully']);
    }
    /**
     * @OA\Delete(
     *     path="/api/subscription/delete/{id}",
     *     summary="Supprimer une souscription",
     *     security={{"bearerAuth": {}}},
     *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="string")),
     *     @OA\Response(response=200, description="Subscription supprimée"),
     *     @OA\Response(response=403, description="Non autorisé"),
     *     @OA\Response(response=404, description="Subscription introuvable")
     * )
     */


    #[Route('/delete/{id}', name: 'delete_subscription', methods: ['DELETE'])]
    #[IsGranted('ROLE_ADMIN')]
    public function deleteSubscription(string $id, EntityManagerInterface $entityManager): JsonResponse
    {
        $subscription = $entityManager->getRepository(Subscription::class)->find($id);
        if (!$subscription) {
            return $this->json(['error' => 'Subscription not found'], Response::HTTP_NOT_FOUND);
        }

        $entityManager->remove($subscription);
        $entityManager->flush();

        return $this->json(['message' => 'Subscription deleted successfully']);
    }
}
