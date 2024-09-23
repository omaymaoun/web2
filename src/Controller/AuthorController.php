<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class AuthorController extends AbstractController
{
      

    #[Route('/author', name: 'app_author')]
    public function index(): Response
    {
        return $this->render('author/index.html.twig', [
            'controller_name' => 'AuthorController',
        ]);
    }
    #[Route("/author/{name}",name:"app_showAuthor",methods:["GET"],defaults:["name"=>"omayma_oun"])]
   public function showAuthor($name){
       return $this->render('author/show.html.twig',
       array(
           'name'=>$name
       ));
   }
    
    #[Route('/list', name: 'app_list')]
    public function listAuthors()
    {
        $authors = array(
            array(
                'id' => 1,
                'picture' => '/images/vh.jpeg',
                'name' => 'Victor Hugo',
                'email' => 'victor.hugo@gmail.com',
                'nbrBooks' => 100
            ),
            array(
                'id' => 2,
                'picture' => '/images/ws.jpeg',
                'name' => 'William Shakespeare',
                'email' => 'william.shakespeare@gmail.com',
                'nbrBooks' => 200
            ),
            array(
                'id' => 3,
                'picture' => '/images/th.jpeg',
                'name' => 'Taha Hussein',
                'email' => 'taha.hussein@gmail.com',
                'nbrBooks' => 300
            ),
        );

        return $this->render('author/list.html.twig', [
            'authors' => $authors
        ]);
    }


    #[Route('/author/{name}', name: 'app_details')]
    public function authorDetails(int $id): Response
{
  
}
}

   
    

    
       
    





