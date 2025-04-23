<?php

namespace App\Entity;

use App\Repository\SubscriptionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\Doctrine\UuidGenerator;
use Symfony\Component\Validator\Constraints as Assert;
use App\Entity\User;

#[ORM\Entity(repositoryClass: SubscriptionRepository::class)]
#[ORM\Table(name: "subscriptions")]
#[ORM\HasLifecycleCallbacks]
class Subscription
{
    public const STATUS_ACTIVE = 'active';
    public const STATUS_INACTIVE = 'inactive';
    public const STATUS_CANCELLED = 'cancelled';
    public const STATUS_EXPIRED = 'expired';

    private const STATUS_TYPES = [
        self::STATUS_ACTIVE,
        self::STATUS_INACTIVE,
        self::STATUS_CANCELLED,
        self::STATUS_EXPIRED
    ];

    #[ORM\Id]
    #[ORM\Column(type: "guid", unique: true)]
    #[ORM\GeneratedValue(strategy: "CUSTOM")]
    #[ORM\CustomIdGenerator(class: UuidGenerator::class)]
    private ?string $id = null;

    #[Assert\NotBlank]
    #[Assert\Length(min: 2, max: 255)]
    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[Assert\Length(max: 2000)]
    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $notes = null;

    #[Assert\NotBlank]
    #[ORM\Column(length: 255)]
    private ?string $subscription_type = null;

    #[Assert\NotNull]
    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $start_date = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $end_date = null;

    #[Assert\PositiveOrZero]
    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 2, nullable: true)]
    private ?float $amount = null;

    #[Assert\Choice(choices: ["EUR", "USD", "GBP", "CAD", "AUD"], message: "Devise invalide.")]
    #[ORM\Column(length: 3, nullable: false, options: ["default" => "EUR"])]
    private ?string $currency = "EUR";

    #[Assert\PositiveOrZero]
    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 2, nullable: true)]
    private ?float $total_paid = null;

    #[ORM\Column(nullable: true)]
    private ?bool $auto_renewal = null;

    #[Assert\NotBlank]
    #[ORM\Column(length: 255)]
    private ?string $billing_mode = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $billing_frequency = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $billing_day = null;

    #[Assert\Choice(choices: self::STATUS_TYPES)]
    #[ORM\Column(length: 255, options: ["default" => self::STATUS_ACTIVE])]
    private ?string $status = self::STATUS_ACTIVE;

    #[ORM\ManyToOne(targetEntity: Member::class, inversedBy: "subscriptions")]
    #[ORM\JoinColumn(nullable: false, onDelete: "CASCADE")]
    private ?Member $member = null;

    #[ORM\ManyToOne(targetEntity: Service::class, inversedBy: "subscriptions")]
    #[ORM\JoinColumn(nullable: false, onDelete: "CASCADE")]
    private ?Service $service = null;

    #[ORM\OneToMany(mappedBy: "subscription", targetEntity: Payment::class, cascade: ["persist", "remove"])]
    private Collection $payments;

    #[ORM\OneToMany(mappedBy: "subscription", targetEntity: SubscriptionTag::class, cascade: ["persist", "remove"])]
    private Collection $subscriptionTags;

    #[ORM\Column]
    private ?\DateTimeImmutable $created_at = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $updated_at = null;

    #[ORM\ManyToOne(targetEntity: User::class)]
    #[ORM\JoinColumn(nullable: false, onDelete: "CASCADE")]
    private ?User $user = null;

    public function __construct()
    {
        $this->payments = new ArrayCollection();
        $this->subscriptionTags = new ArrayCollection();
        $this->created_at = new \DateTimeImmutable();
        $this->updated_at = new \DateTimeImmutable();
    }

    #[ORM\PrePersist]
    public function setCreatedAtValue(): void
    {
        if ($this->created_at === null) {
            $this->created_at = new \DateTimeImmutable();
        }
        $this->updated_at = new \DateTimeImmutable();
    }

    #[ORM\PreUpdate]
    public function updateTimestamps(): void
    {
        $this->updated_at = new \DateTimeImmutable();
    }

    public function getId(): ?string
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): static
    {
        $this->name = $name;
        return $this;
    }

    public function getMember(): ?Member
    {
        return $this->member;
    }

    public function setMember(?Member $member): static
    {
        $this->member = $member;
        return $this;
    }

    public function getService(): ?Service
    {
        return $this->service;
    }

    public function setService(?Service $service): static
    {
        $this->service = $service;
        return $this;
    }

    public function getBillingMode(): ?string
    {
        return $this->billing_mode;
    }

    public function setBillingMode(?string $billing_mode): static
    {
        $this->billing_mode = $billing_mode;
        return $this;
    }

    public function getNotes(): ?string
    {
        return $this->notes;
    }

    public function setNotes(?string $notes): static
    {
        $this->notes = $notes;
        return $this;
    }

    public function getSubscriptionType(): ?string
    {
        return $this->subscription_type;
    }

    public function setSubscriptionType(string $subscription_type): static
    {
        $this->subscription_type = $subscription_type;
        return $this;
    }

    public function getStartDate(): ?\DateTimeInterface
    {
        return $this->start_date;
    }

    public function setStartDate(\DateTimeInterface $start_date): static
    {
        $this->start_date = $start_date;
        return $this;
    }

    public function getEndDate(): ?\DateTimeInterface
    {
        return $this->end_date;
    }

    public function setEndDate(?\DateTimeInterface $end_date): static
    {
        $this->end_date = $end_date;
        return $this;
    }

    public function getAmount(): ?float
    {
        return $this->amount;
    }

    public function setAmount(?float $amount): static
    {
        $this->amount = $amount;
        return $this;
    }

    public function getTotalPaid(): ?float
    {
        return $this->total_paid;
    }

    public function setTotalPaid(?float $total_paid): static
    {
        $this->total_paid = $total_paid;
        return $this;
    }

    public function getCurrency(): ?string
    {
        return $this->currency;
    }

    public function setCurrency(string $currency): static
    {
        $this->currency = $currency;
        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): static
    {
        if (!in_array($status, self::STATUS_TYPES, true)) {
            throw new \InvalidArgumentException("Statut invalide.");
        }
        $this->status = $status;
        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): static
    {
        $this->user = $user;
        return $this;
    }
}