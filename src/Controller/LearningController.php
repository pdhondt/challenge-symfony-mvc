<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

session_start();

class LearningController extends AbstractController
{
    #[Route('/learning', name: 'learning')]
    public function index(): Response
    {
        return $this->render('learning/index.html.twig', [
            'controller_name' => 'LearningController',
        ]);
    }

    #[Route('/about-me', name: 'about')]
    public function aboutMe(): Response
    {
        return $this->render('learning/about.html.twig', [
            'name' => 'Peter'
        ]);
    }

    #[Route('/', name: 'showmyname')]
    public function showMyName(): Response
    {
        if(!empty($_SESSION['name'])){
            $name = $_SESSION['name'];
        } else {
            $name = 'Unknown';
        }

        return $this->render('learning/showmyname.html.twig', [
            'name' => $name,
        ]);
    }

    #[Route('/change-my-name', name: 'changemyname', methods: ['POST'])]
    public function changeMyName(): Response
    {
        if (isset($_POST['change'])){
            $_SESSION['name'] = $_POST['name'];

            return $this->render('learning/changemyname.html.twig', [
                'name' => $_SESSION['name'],
            ]);
        }

        if (isset($_POST['save'])){
            return $this->redirectToRoute('showmyname');
        }

    }


}
