<?php

namespace App\Controller;


use App\Entity\Post;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

class BlogController extends Controller
{

    /**
     * @Route("/", name="homepage")
     */
    public function index()

    {
        $repo = $this->getDoctrine()->getRepository(Post::class);
        $post = $repo->findBy(array(),array('DatePublic' => 'DESC'),3 ,null);
        return $this->render('blog/index.html.twig',
            ['post'=>$post]
        );
    }



}
