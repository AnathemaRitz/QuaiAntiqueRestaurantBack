<?php

namespace App\Controller;

use App\Entity\Food;
use App\Repository\FoodRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('api/food', name:'app_api_food_')]
class FoodController extends AbstractController
{
    public function __construct(private EntityManagerInterface $manager, private FoodRepository $repository)
    {
        
    }
    #[Route(name:'new', methods :'POST')]
    public function new(): Response
    {     
        $food = new Food();
        $food->setTitle(title:'Quai Antique');
        $food ->setDescription(description: 'Le chef Arnaud Michant vous accueille.');
        $food ->setCreatedAt(new \DateTimeImmutable());

        //A stocker en base

        $this->manager->persist($food);
        $this->manager->flush();

        return $this->json(
            ['message'=>"Food ressource created with {$food->getID()}id"],
            status : Response::HTTP_CREATED,
        );
    }
  
    #[Route('/{id}', name: 'show', methods: 'GET')]
    public function show(int $id): Response
    {
        //CHERCHER food ID =1
        $food = $this->repository->findOneBy(['id' => $id]);

        if (!$food) {
            throw $this->createNotFoundException("No foodfound for {$id} id");
        }

        return $this->json(
            ['message' => "Food was found : {$food->getTitle()} for {$food->getId()} id"]
        );
    } 

// …
  

    #[Route('/{id}', name: 'edit', methods: 'PUT')]
    public function edit(int $id): Response
    {
        $food = $this->repository->findOneBy(['id' => $id]);

        if (!$food) {
            throw $this->createNotFoundException("No food found for {$id} id");
        }

        $food->setTitle('food name updated');
        $this->manager->flush();

        return $this->redirectToRoute('app_api_food_show', ['id' => $food->getId()]);
    }

  
    #[Route('/{id}', name: 'delete', methods: 'DELETE')]
    public function delete(int $id): Response
    {
        $food = $this->repository->findOneBy(['id' => $id]);
        if (!$food) {
            throw $this->createNotFoundException("No food found for {$id} id");
        }

        $this->manager->remove($food);
        $this->manager->flush();

        return $this->json(['message' => "food resource deleted"], Response::HTTP_NO_CONTENT);
    }
  
}
