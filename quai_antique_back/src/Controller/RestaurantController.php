<?php

namespace App\Controller;

use App\Entity\Restaurant;
use App\Repository\RestaurantRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('api/restaurant', name:'app_api_restaurant_')]
class RestaurantController extends AbstractController
{
    public function __construct(private EntityManagerInterface $manager, private RestaurantRepository $repository)
    {
        
    }
    #[Route(name:'new', methods :'POST')]
    public function new(): Response
    {     
        $restaurant = new Restaurant();
        $restaurant->setName(name:'Quai Antique');
        $restaurant ->setDescription(description: 'Le chef Arnaud Michant vous accueille.');
        $restaurant ->setCreatedAt(new \DateTimeImmutable());

        //A stocker en base

        $this->manager->persist($restaurant);
        $this->manager->flush();

        return $this->json(
            ['message'=>"Restaurant ressource created with {$restaurant->getID()}id"],
            status : Response::HTTP_CREATED,
        );
    }
  
    #[Route('/{id}', name: 'show', methods: 'GET')]
    public function show(int $id): Response
    {
        //CHERCHER RESTAURANT ID =1
        $restaurant = $this->repository->findOneBy(['id' => $id]);

        if (!$restaurant) {
            throw $this->createNotFoundException("No Restaurant found for {$id} id");
        }

        return $this->json(
            ['message' => "A Restaurant was found : {$restaurant->getName()} for {$restaurant->getId()} id"]
        );
    } 

// …
  

    #[Route('/{id}', name: 'edit', methods: 'PUT')]
    public function edit(int $id): Response
    {
        $restaurant = $this->repository->findOneBy(['id' => $id]);

        if (!$restaurant) {
            throw $this->createNotFoundException("No Restaurant found for {$id} id");
        }

        $restaurant->setName('Restaurant name updated');
        $this->manager->flush();

        return $this->redirectToRoute('app_api_restaurant_show', ['id' => $restaurant->getId()]);
    }

  
    #[Route('/{id}', name: 'delete', methods: 'DELETE')]
    public function delete(int $id): Response
    {
        $restaurant = $this->repository->findOneBy(['id' => $id]);
        if (!$restaurant) {
            throw $this->createNotFoundException("No Restaurant found for {$id} id");
        }

        $this->manager->remove($restaurant);
        $this->manager->flush();

        return $this->json(['message' => "Restaurant resource deleted"], Response::HTTP_NO_CONTENT);
    }
  
}
