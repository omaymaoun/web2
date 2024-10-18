<?php
namespace App\Controller;

use App\Entity\Book;
use App\Form\bookType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/crud')]
class BookController extends AbstractController
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }
    #[Route('/book/list', name: 'book_list')]
    public function listBooks(): Response
    {
        $books = $this->entityManager->getRepository(Book::class)->findAll();

        return $this->render('book/book_list.html.twig', [
            'books' => $books,
        ]);
    }
    #[Route('/book/add', name: 'book_add')]
    public function addBook(Request $request): Response
    {
        $book = new Book();
        $form = $this->createForm(bookType::class, $book);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $author = $book->getAuthor();
            if ($author) {
                
                // $author->incrementNbBooks();
                $this->entityManager->persist($author);
            }

            $this->entityManager->persist($book);
            $this->entityManager->flush();

            
            return $this->redirectToRoute('book_list'); 
        }

        return $this->render('crud_author/addbook.html.twig', [
            'form' => $form->createView(),
        ]);
    }


    #[Route('/book/edit/{id}', name: 'book_edit')]
public function editBook(Request $request, Book $book): Response
{
    $form = $this->createForm(BookType::class, $book);
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
        $this->entityManager->flush(); 

        return $this->redirectToRoute('book_list'); 
    }

    return $this->render('book/modifier_book.html.twig', [
        'form' => $form->createView(), 
        'book' => $book 
    ]);
}




    
}
