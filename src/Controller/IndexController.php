<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends AbstractController
{
    /**
     * @Route("/{path}", name="index")
     */
    public function index(): Response
    {
        return $this->render('index/index.html.twig', [
        		'bh' => array('bh/header.html.twig', 'bh/breadcrumbs.html.twig'),
            'controller_name' => 'IndexController',
        ]);
    }
}
