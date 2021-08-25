<?php

namespace App\Controller;

use App\Form\PostForm;
use App\Entity\Post;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PostController extends AbstractController
{
    /**
     * @Route("/post/create", name="post_create")
     */
    public function create(Request $request) :Response
    {
        $post = new Post();
        $post->setName('New post');
        $post->setPublishedAt(new \DateTime());

        $postForm = $this->createForm(PostForm::class, $post);

        $postForm->handleRequest($request);
        if ($postForm->isSubmitted() && $postForm->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $em->persist($post);
            $em->flush();

            return $this->redirectToRoute('post_show', [
                'post'=>$postForm->createView(),
            ]);
        }

        return $this->render('post/create.html.twig', [
            'post' => $post,
            'postForm' => $postForm->createView(),
        ]);
    }

    /**
     * @Route("/post/edit/{post}", name="post_edit")
     */
    public function edit(Request $request, Post $post) : Response
    {
        $em = $this->getDoctrine()->getManager();
        $postForm = $this->createForm(PostForm::class, $post);

        $postForm->handleRequest($request);
        if ($postForm->isSubmitted() && $postForm->isValid()) {

            $record = $postForm->getData();
            $em->persist($record);
            $em->flush();

            return $this->redirectToRoute('post_show', [
                'post'=>$postForm->createView(),
            ]);
        }

        return $this->render('post/edit.html.twig',[
            'post' => $post,
            'postForm' => $postForm->createView(),
        ]);
    }

    /**
     * @author Poprugailo Denis <d.poprugailo@piogroup.net>
     * @Route("/post/show/{post}", name="post_show")
     * @return Response
     */
    public function getPost(Post $post): Response
    {
        return $this->render('post/show.html.twig', [
            'post' => $post,
        ]);
    }
}