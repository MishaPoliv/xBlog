<?php

namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

class BlogController extends Controller
{

    /**
     * @Route("/", name="homepage")
     */
    public function index()
    {

        return $this->render('blog/index.html.twig');
    }








}
