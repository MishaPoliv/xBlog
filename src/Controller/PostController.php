<?php

namespace App\Controller;


use App\Entity\Post;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class PostController extends Controller
{

    /**
     * @Route("/post", name="post")
     */
    public function index()

    {
        $repo = $this->getDoctrine()->getRepository(Post::class);
        $post = $repo->findAll();
        return $this->render('post/index.html.twig',[
            'post' => $post
        ]);
    }

    /**
     * @Route("/post/{id}", name="post_show")
     */
    public function show(Post $post)
    {

        return $this->render('post/show.html.twig', [
            'post'=>$post,
        ]);
    }

    /**
     * @Route("/post/{id}/delete", name="post_delete")
     */
    public function delete(Post $post)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($post);
        $entityManager->flush();
        return $this->redirectToRoute('post');
    }


}