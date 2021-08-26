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
     * @param Request $request Request
     * @Route("/post/create", name="post_create")
     * @return Response
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
                'post' => $post->getId(),
            ]);
        }

        return $this->render('post/create.html.twig', [
            'post' => $post,
            'postForm' => $postForm->createView(),
        ]);
    }

    /**
     * @param Request $request Request
     * @param Post    $post
     * @Route("/post/edit/{post}", name="post_edit")
     * @return Response
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
                'post' => $post->getId(),
            ]);
        }

        return $this->render('post/edit.html.twig', [
            'post' => $post,
            'postForm' => $postForm->createView(),
        ]);
    }

    /**
     * @param Post $post
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
