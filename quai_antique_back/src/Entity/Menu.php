<?php

namespace App\Entity;

use App\Repository\MenuRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MenuRepository::class)]
class Menu
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 64)]
    private ?string $title = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    #[ORM\Column(type: Types::SMALLINT)]
    private ?int $price = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $updatedAt = null;

    #[ORM\ManyToOne(inversedBy: 'menusID')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Restaurant $restaurantID = null;

    /**
     * @var Collection<int, MenuCategory>
     */
    #[ORM\OneToMany(targetEntity: MenuCategory::class, mappedBy: 'menuID', orphanRemoval: true)]
    private Collection $menuCategoriesID;

    public function __construct()
    {
        $this->menuCategoriesID = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;

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

    public function getPrice(): ?int
    {
        return $this->price;
    }

    public function setPrice(int $price): static
    {
        $this->price = $price;

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

    public function getRestaurantID(): ?Restaurant
    {
        return $this->restaurantID;
    }

    public function setRestaurantID(?Restaurant $restaurantID): static
    {
        $this->restaurantID = $restaurantID;

        return $this;
    }

    /**
     * @return Collection<int, MenuCategory>
     */
    public function getMenuCategoriesID(): Collection
    {
        return $this->menuCategoriesID;
    }

    public function addMenuCategoriesID(MenuCategory $menuCategoriesID): static
    {
        if (!$this->menuCategoriesID->contains($menuCategoriesID)) {
            $this->menuCategoriesID->add($menuCategoriesID);
            $menuCategoriesID->setMenuID($this);
        }

        return $this;
    }

    public function removeMenuCategoriesID(MenuCategory $menuCategoriesID): static
    {
        if ($this->menuCategoriesID->removeElement($menuCategoriesID)) {
            // set the owning side to null (unless already changed)
            if ($menuCategoriesID->getMenuID() === $this) {
                $menuCategoriesID->setMenuID(null);
            }
        }

        return $this;
    }
}
