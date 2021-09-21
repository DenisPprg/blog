<?php

namespace App\Controller;

use App\Form\PostForm;
use App\Entity\Post;
use App\Service\DownloadPost;
use App\Form\DownloadForm;
use App\Service\DownloadPostResponse;
use App\Service\DownloadPostText;
use App\Service\DownloadPostHtml;
use App\Service\DownloadPostInterface;
use phpDocumentor\Reflection\Types\This;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class NewsControllerTest
 *
 * @package App\Controller
 *
 * @author Denis
 */
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

            /*$record = $postForm->getData();*/
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
     * @Route("/DownloadFile/{post}/Text", name="DownloadFile_Text")
     * @param Post                 $post
     * @param DownloadPostText     $exporterText
     * @param DownloadPostResponse $downloadPostResponse
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function downloadText(Post $post, DownloadPostText $exporterText, DownloadPostResponse $downloadPostResponse)
    {
        return $downloadPostResponse->getResponse($exporterText->getDataFromPost($post));
    }

    /**
     * @Route("/DownloadFile/{post}/Html", name="DownloadFile_Html")
     * @param Post                 $post
     * @param DownloadPostHtml     $exporterHtml
     * @param DownloadPostResponse $downloadPostResponse
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function downloadHtml(Post $post, DownloadPostHtml $exporterHtml, DownloadPostResponse $downloadPostResponse)
    {
        return $downloadPostResponse->getResponse($exporterHtml->getDataFromPost($post));
    }

    /**
     * @param Post $post
     * @author Poprugailo Denis <d.poprugailo@piogroup.net>
     * @Route("/post/show/{post}", name="post_show")
     * @return Response
     */
    public function getPost(Post $post): Response
    {
        $downloadForm = $this->createForm(DownloadForm::class, $post);

        return $this->render('post/show.html.twig', [
            'post' => $post,
            'postForm' => $downloadForm->createView(),
        ]);
    }
}
