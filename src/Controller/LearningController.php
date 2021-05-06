<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

//session_start();

class LearningController extends AbstractController
{

    private $session;

    public function __construct(SessionInterface $session)
    {
        $this->session = $session;
    }

    #[Route('/learning', name: 'learning')]
    public function index(): Response
    {
        return $this->render('learning/index.html.twig', [
            'controller_name' => 'LearningController',
        ]);
    }

    #[Route('/about-becode', name: 'about')]
    public function aboutMe(): Response
    {
        if (empty($this->session->get('name'))){
            return $this->forward('App\Controller\LearningController::showMyName', [

            ]);
        } else {
            return $this->render('learning/about.html.twig', [
                'name' => $this->session->get('name')
            ]);
        }
    }

    #[Route('/', name: 'showmyname')]
    public function showMyName(): Response
    {
        if(!empty($this->session->get('name'))){
            $name = $this->session->get('name');
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

            $this->session->set('name', $_POST['name']);
            //$_SESSION['name'] = $_POST['name'];

            return $this->render('learning/changemyname.html.twig', [
                'name' => $this->session->get('name'),
            ]);
        }

        if (isset($_POST['save'])){
            return $this->redirectToRoute('showmyname');
        }

    }


}
