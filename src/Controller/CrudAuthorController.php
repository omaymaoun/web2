<?php

namespace App\Controller;

use App\Form\AuthorType;
use App\Form\ModifierAuthorType;
use App\Entity\Author; 
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request; 
use Symfony\Component\Routing\Attribute\Route;
use App\Repository\AuthorRepository;
#[Route('/crud')]
class CrudAuthorController extends AbstractController
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/list', name: 'app_list_author')]
    public function list(AuthorRepository $authorRepository): Response
    {
        $authors = $authorRepository->findAll();
        return $this->render('crud_author/list.html.twig', ['authors' => $authors]);
    }

    #[Route('/add-static-author', name: 'app_add_static_author')]
    public function addStaticAuthor(): Response
    {
        
        $author = new Author();

        
        $author->setUsername('omayma oun');
        $author->setEmail('omayma.oun@example.com');

       
        $this->entityManager->persist($author);
        $this->entityManager->flush(); 

        
        return new Response('L\'auteur omayma a été ajouté avec succès.');
    }



    
    
    #[Route('/add-author', name: 'app_add_author')]
    public function addAuthor(Request $request): Response
    {
        $author = new Author();
        $form = $this->createForm(AuthorType::class, $author); 

        $form->handleRequest($request); 

        if ($form->isSubmitted() && $form->isValid()) {
            
            $this->entityManager->persist($author);
            $this->entityManager->flush();

            return $this->redirectToRoute('app_list_author'); 
        }

        return $this->render('crud_author/add.html.twig', [
            'form' => $form->createView(), 
        ]);
    }




   #[Route('/author/delete/{id}', name: 'author_delete')]
   public function deleteAuthor(int $id): Response 
    {
        
        $author = $this->entityManager->getRepository(Author::class)->find($id);

        
        if (!$author) {
            throw $this->createNotFoundException('Aucun auteur trouvé pour cet ID.');
    
        } else {

        
        $this->entityManager->remove($author);
        $this->entityManager->flush();

        
        $this->addFlash('success', 'Auteur supprimé avec succès.');
        return $this->redirectToRoute('app_list_author');
        }
       
    }
    #[Route('/author/edit/{id}', name: 'author_edit')]
    public function edit(Request $request, Author $author): Response
    {
        $form = $this->createForm(AuthorType::class, $author);
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
           
            $this->entityManager->flush(); 
    
            return $this->redirectToRoute('app_list_author'); 
        }
    
        return $this->render('crud_author/edit_author.html.twig', [
            'form' => $form->createView(),
            'author' => $author,
        ]);
    }



    
    
    }



 




