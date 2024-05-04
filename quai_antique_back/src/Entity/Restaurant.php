<?php

namespace App\Entity;

use App\Repository\RestaurantRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RestaurantRepository::class)]
class Restaurant
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 32)]
    private ?string $name = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    #[ORM\Column(type: Types::ARRAY)]
    private array $amOpening = [];

    #[ORM\Column(type: Types::ARRAY)]
    private array $pmOpening = [];

    #[ORM\Column(type: Types::SMALLINT)]
    private ?int $maxGuest = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $updatedAt = null;

    /**
     * @var Collection<int, Picture>
     */
    #[ORM\OneToMany(targetEntity: Picture::class, mappedBy: 'restaurantID', orphanRemoval: true)]
    private Collection $pictureID;

    /**
     * @var Collection<int, Booking>
     */
    #[ORM\OneToMany(targetEntity: Booking::class, mappedBy: 'restaurantID', orphanRemoval: true)]
    private Collection $bookingID;

    public function __construct()
    {
        $this->pictureID = new ArrayCollection();
        $this->bookingID = new ArrayCollection();
    }

    public function getId(): ?int
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getAmOpening(): array
    {
        return $this->amOpening;
    }

    public function setAmOpening(array $amOpening): static
    {
        $this->amOpening = $amOpening;

        return $this;
    }

    public function getPmOpening(): array
    {
        return $this->pmOpening;
    }

    public function setPmOpening(array $pmOpening): static
    {
        $this->pmOpening = $pmOpening;

        return $this;
    }

    public function getMaxGuest(): ?int
    {
        return $this->maxGuest;
    }

    public function setMaxGuest(int $maxGuest): static
    {
        $this->maxGuest = $maxGuest;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): static
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(?\DateTimeImmutable $updatedAt): static
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * @return Collection<int, Picture>
     */
    public function getPictureID(): Collection
    {
        return $this->pictureID;
    }

    public function addPictureID(Picture $pictureID): static
    {
        if (!$this->pictureID->contains($pictureID)) {
            $this->pictureID->add($pictureID);
            $pictureID->setRestaurantID($this);
        }

        return $this;
    }

    public function removePictureID(Picture $pictureID): static
    {
        if ($this->pictureID->removeElement($pictureID)) {
            // set the owning side to null (unless already changed)
            if ($pictureID->getRestaurantID() === $this) {
                $pictureID->setRestaurantID(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Booking>
     */
    public function getBookingID(): Collection
    {
        return $this->bookingID;
    }

    public function addBookingID(Booking $bookingID): static
    {
        if (!$this->bookingID->contains($bookingID)) {
            $this->bookingID->add($bookingID);
            $bookingID->setRestaurantID($this);
        }

        return $this;
    }

    public function removeBookingID(Booking $bookingID): static
    {
        if ($this->bookingID->removeElement($bookingID)) {
            // set the owning side to null (unless already changed)
            if ($bookingID->getRestaurantID() === $this) {
                $bookingID->setRestaurantID(null);
            }
        }

        return $this;
    }
}
