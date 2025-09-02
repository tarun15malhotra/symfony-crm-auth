<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractController
{
    #[Route('/', name: 'app_dashboard')]
    public function index(): Response
    {
        return $this->render('dashboard/index.html.twig');
    }

    #[Route('/form', name: 'app_form')]
    public function form(): Response
    {
        return $this->render('dashboard/form.html.twig');
    }


    #[Route('/list', name: 'app_list')]
    public function list(): Response
    {
        return $this->render('dashboard/list.html.twig');
    }
}
