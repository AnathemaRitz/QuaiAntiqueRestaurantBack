<?php

namespace App\Controller;

use App\Entity\Category;
use App\Repository\CategoryRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('api/category', name:'app_api_category_')]
class CategoryController extends AbstractController
{
    public function __construct(private EntityManagerInterface $manager, private CategoryRepository $repository)
    {
        
    }
    #[Route(name:'new', methods :'POST')]
    public function new(): Response
    {     
        $category = new category();
        $category->setTitle(title:'Quai Antique');
        $category ->setCreatedAt(new \DateTimeImmutable());

        //A stocker en base

        $this->manager->persist($category);
        $this->manager->flush();

        return $this->json(
            ['message'=>"category ressource created with {$category->getID()}id"],
            status : Response::HTTP_CREATED,
        );
    }
  
    #[Route('/{id}', name: 'show', methods: 'GET')]
    public function show(int $id): Response
    {
        //CHERCHER category ID =1
        $category = $this->repository->findOneBy(['id' => $id]);

        if (!$category) {
            throw $this->createNotFoundException("No categoryfound for {$id} id");
        }

        return $this->json(
            ['message' => "category was found : {$category->getTitle()} for {$category->getId()} id"]
        );
    } 

// …
  

    #[Route('/{id}', name: 'edit', methods: 'PUT')]
    public function edit(int $id): Response
    {
        $category = $this->repository->findOneBy(['id' => $id]);

        if (!$category) {
            throw $this->createNotFoundException("No category found for {$id} id");
        }

        $category->setTitle('category name updated');
        $this->manager->flush();

        return $this->redirectToRoute('app_api_category_show', ['id' => $category->getId()]);
    }

  
    #[Route('/{id}', name: 'delete', methods: 'DELETE')]
    public function delete(int $id): Response
    {
        $category = $this->repository->findOneBy(['id' => $id]);
        if (!$category) {
            throw $this->createNotFoundException("No category found for {$id} id");
        }

        $this->manager->remove($category);
        $this->manager->flush();

        return $this->json(['message' => "category resource deleted"], Response::HTTP_NO_CONTENT);
    }
  
}
