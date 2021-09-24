<?php

namespace App\Controller;

use App\Form\PostForm;
use App\Entity\Post;
use App\Service\DownloadPostResponse;
use App\Service\DownloadPostText;
use App\Service\DownloadPostHtml;
use App\Service\DownloadPostInterface;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
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
     * @param Post $post
     * @author Poprugailo Denis <d.poprugailo@piogroup.net>
     * @Route("/post/show/{post}", name="post_show")
     * @return Response
     */
    public function getPost(Post $post): Response
    {
//        $downloadForm = $this->createForm(DownloadForm::class, $post);

        return $this->render('post/show.html.twig', [
            'post' => $post,
//            'postForm' => $downloadForm->createView(),
        ]);
    }

    /**
     * @Route("/download/{post}.csv", name="post_download_csv")
     *
     * @param Post            $post
     * @param PostExporterCsv $exporterHtml
     *
     * @return Response
     */
    public function downloadCvsAction(Post $post, PostExporterCsv $exporterHtml)
    {
        $exporterHtml->setPost($post);
        $content = $exporterHtml->export();

        $filename = $post->getName() . '.' . $exporterHtml->getFileExtension();

        // Return a response with a specific content
        $response = new Response($content);

        // Create the disposition of the file
        $disposition = $response->headers->makeDisposition(
            ResponseHeaderBag::DISPOSITION_ATTACHMENT,
            $filename
        );

        // Set the content disposition
        $response->headers->set('Content-Disposition', $disposition);

        // Dispatch request
        return $response;
    }

    /**
     * @Route("/download/{post}.html", name="post_download_html")
     *
     * @param Post             $post
     * @param PostExporterHtml $exporterHtml
     *
     * @return Response
     */
    public function downloadHtmlAction(Post $post, PostExporterHtml $exporterHtml)
    {
        $exporterHtml->setPost($post);
        $content = $exporterHtml->export();

        $filename = $post->getName() . '.' . $exporterHtml->getFileExtension();

        // Return a response with a specific content
        $response = new Response($content);

        // Create the disposition of the file
        $disposition = $response->headers->makeDisposition(
            ResponseHeaderBag::DISPOSITION_ATTACHMENT,
            $filename
        );

        // Set the content disposition
        $response->headers->set('Content-Disposition', $disposition);

        // Dispatch request
        return $response;
    }

    /**
     * @Route("/download/{post}", name="post_download")
     *
     * @param Post                  $post
     * @param PostExporterInterface $exporter
     *
     * @return Response
     */
    public function downloadAction(Post $post, PostExporterInterface $exporter)
    {
        $exporter->setPost($post);
        $content = $exporter->export();

        return new Response($content);
    }
}

