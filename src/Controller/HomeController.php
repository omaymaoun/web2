<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class HomeController extends AbstractController
{
    #[Route('/home', name: 'app_home')]
    public function index(): Response
    {
        return $this->render('home/index.html.twig');
    }
    #[Route('/contact', name: 'app_contact')]
    public function contact(): Response
    {
        $name=" omayma ";
        return $this->render('home/contact.html.twig',array(
            'name'=>$name
        ));
        
    }
    #[Route('/reclamation', name: 'app_reclamation')]
    public function reclamation(): Response
    {
        return $this->render('home/reclamation.html.twig');
    }


}

   


