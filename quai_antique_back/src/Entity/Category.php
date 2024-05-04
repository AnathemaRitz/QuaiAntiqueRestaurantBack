<?php

namespace App\Entity;

use App\Repository\CategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CategoryRepository::class)]
class Category
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 36)]
    private ?string $title = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $updatedAt = null;

    /**
     * @var Collection<int, MenuCategory>
     */
    #[ORM\OneToMany(targetEntity: MenuCategory::class, mappedBy: 'categoryID', orphanRemoval: true)]
    private Collection $menuCategoryID;

    public function __construct()
    {
        $this->menuCategoryID = new ArrayCollection();
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
     * @return Collection<int, MenuCategory>
     */
    public function getMenuCategoryID(): Collection
    {
        return $this->menuCategoryID;
    }

    public function addMenuCategoryID(MenuCategory $menuCategoryID): static
    {
        if (!$this->menuCategoryID->contains($menuCategoryID)) {
            $this->menuCategoryID->add($menuCategoryID);
            $menuCategoryID->setCategoryID($this);
        }

        return $this;
    }

    public function removeMenuCategoryID(MenuCategory $menuCategoryID): static
    {
        if ($this->menuCategoryID->removeElement($menuCategoryID)) {
            // set the owning side to null (unless already changed)
            if ($menuCategoryID->getCategoryID() === $this) {
                $menuCategoryID->setCategoryID(null);
            }
        }

        return $this;
    }
}
