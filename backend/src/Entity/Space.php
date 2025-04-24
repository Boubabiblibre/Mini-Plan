<?php

namespace App\Entity;

use App\Repository\SpaceRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\Doctrine\UuidGenerator;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: SpaceRepository::class)]
#[ORM\Table(name: "spaces")]
#[ORM\HasLifecycleCallbacks]
class Space
{
    public const STATUS_ACTIVE = 'active';
    public const STATUS_ARCHIVED = 'archived';

    public const VISIBILITY_PUBLIC = 'public';
    public const VISIBILITY_PRIVATE = 'private';

    private const STATUS_TYPES = [self::STATUS_ACTIVE, self::STATUS_ARCHIVED];
    private const VISIBILITY_TYPES = [self::VISIBILITY_PUBLIC, self::VISIBILITY_PRIVATE];

    #[ORM\Id]
    #[ORM\Column(type: "guid", unique: true)]
    #[ORM\GeneratedValue(strategy: "CUSTOM")]
    #[ORM\CustomIdGenerator(class: UuidGenerator::class)]
    private ?string $id = null;

    #[Assert\NotBlank]
    #[Assert\Length(min: 2, max: 255)]
    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[Assert\NotBlank]
    #[Assert\Regex(
        pattern: '/\.(jpg|jpeg|png|gif)$/i',
        message: "Le logo doit être une image valide (jpg, jpeg, png, gif)."
    )]
    #[ORM\Column(length: 255)]
    private ?string $logo = null;

    #[Assert\Length(max: 1000)]
    #[ORM\Column(type: "text", nullable: true)]
    private ?string $description = null;

    #[Assert\Choice(choices: self::STATUS_TYPES)]
    #[ORM\Column(length: 20, options: ["default" => self::STATUS_ACTIVE])]
    private ?string $status = self::STATUS_ACTIVE;

    #[Assert\Choice(choices: self::VISIBILITY_TYPES)]
    #[ORM\Column(length: 20, options: ["default" => self::VISIBILITY_PRIVATE])]
    private ?string $visibility = self::VISIBILITY_PRIVATE;

    #[ORM\OneToMany(mappedBy: "space", targetEntity: Member::class, cascade: ["persist", "remove"])]
    private Collection $members;

    #[ORM\OneToMany(mappedBy: "space", targetEntity: Permission::class, cascade: ["persist", "remove"])]
    private Collection $permissions;

    #[ORM\OneToMany(mappedBy: "space", targetEntity: Notification::class, cascade: ["persist", "remove"])]
    private Collection $notifications;

    #[ORM\Column]
    private ?\DateTimeImmutable $created_at = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $updated_at = null;

    #[ORM\ManyToOne(targetEntity: User::class)]
    #[ORM\JoinColumn(nullable: false, onDelete: "CASCADE")]
    private ?User $createdBy = null;

    public function __construct()
    {
        $now = new \DateTimeImmutable();
        $this->created_at = $now;
        $this->updated_at = $now;
        $this->members = new ArrayCollection();
        $this->permissions = new ArrayCollection();
        $this->notifications = new ArrayCollection();
    }

    #[ORM\PrePersist]
    public function setCreatedAtValue(): void
    {
        $this->created_at = new \DateTimeImmutable();
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

    public function setName(string $name): static
    {
        $this->name = $name;
        return $this;
    }

    public function getLogo(): ?string
    {
        return $this->logo;
    }

    public function setLogo(string $logo): static
    {
        $this->logo = $logo;
        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): static
    {
        $this->description = $description;
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

    public function isArchived(): bool
    {
        return $this->status === self::STATUS_ARCHIVED;
    }

    public function archiveSpace(): static
    {
        $this->status = self::STATUS_ARCHIVED;
        $this->updated_at = new \DateTimeImmutable();
        return $this;
    }

    public function restoreSpace(): static
    {
        $this->status = self::STATUS_ACTIVE;
        $this->updated_at = new \DateTimeImmutable();
        return $this;
    }

    public function getVisibility(): ?string
    {
        return $this->visibility;
    }

    public function setVisibility(string $visibility): static
    {
        if (!in_array($visibility, self::VISIBILITY_TYPES, true)) {
            throw new \InvalidArgumentException("Visibilité invalide.");
        }
        $this->visibility = $visibility;
        return $this;
    }

    public function toggleVisibility(): static
    {
        $this->visibility = ($this->visibility === self::VISIBILITY_PUBLIC)
            ? self::VISIBILITY_PRIVATE
            : self::VISIBILITY_PUBLIC;
        return $this;
    }

    public function getMembers(): Collection
    {
        return $this->members;
    }

    public function getPermissions(): Collection
    {
        return $this->permissions;
    }

    public function getNotifications(): Collection
    {
        return $this->notifications;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->created_at;
    }

    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updated_at;
    }

    public function getCreatedBy(): ?User
    {
        return $this->createdBy;
    }

    public function setCreatedBy(User $user): self
    {
        $this->createdBy = $user;
        return $this;
    }

    public function getFullInfo(): string
    {
        return "{$this->name} - {$this->description}";
    }
}
