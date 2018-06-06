<?php

namespace App\Controller;


use App\Entity\Comment;
use App\Entity\Post;
use App\Form\MakeCommentType;
use App\Form\MakePostType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
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
            'post' => $post,

        ]);
    }

    /**
     * @Route("/post/{id}", name="post_show")
     */
    public function show(Post $post, Request $request, EntityManagerInterface $em, Comment $comment)
    {

        $repo = $this->getDoctrine()->getRepository(Comment::class);
        $comment = $repo->findBy(array(),array('DateCom' => 'DESC'));



        $comment = new Comment();

        $form = $this->createForm(MakeCommentType::class, $comment);
        $form->handleRequest($request);



        if ($form->isSubmitted() && $form->isValid()) {

            $comment->setPost($post);
            $em->persist($comment);
            $em->flush();
            $id = $post->getId();



            return $this->redirectToRoute('post_show', [
                'id' => $id,
            ]);


        }

        return $this->render('post/show.html.twig', [
            'post'=>$post,
            'form' => $form->createView(),
            'comment'=>$comment,

        ]);
    }

    /**
     * @Route("/add", name="post_add")
     */
    public function addPost(EntityManagerInterface $em, Request $request)
    {

        $post = new Post();

        $form = $this->createForm(MakePostType::class, $post);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $em->persist($post);
            $em->flush();
            $id = $post->getId();

            return $this->redirectToRoute('post_show', [
                'id' => $id,
            ]);
            }

        return $this->render('post/addpost.html.twig', [
                       'post' => $post,
                       'form' => $form->createView(),
                    ]);
    }

     /**
      * @Route("post/{id}/edit", name="post_edit")
      */
     public function editPost(Post $post, EntityManagerInterface $em, Request $request)
     {
         $form = $this->createForm(MakePostType::class, $post);
         $form -> handleRequest($request);

         if ($form->isSubmitted() && $form->isValid()) {
             $em->persist($post);
             $em->flush();

             return $this->redirectToRoute('post', [
                 'id' => $post->getId(),
             ]);
         }

         return $this->render('post/editpost.html.twig', [

             'post'=>$post,
             'form' => $form->createView(),
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