<?php

namespace App\Service;

use App\Entity\Post;
use App\Servise\PostExporterInterface;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;

/**
 * Class PostExporterHtml
 * @author Denis Poprugailo
 * @package App\Service\PostExporter
 */
class PostExporterHtml implements PostExporterInterface
{
    /**
     * @var Post
     */
    protected $post;

    /**
     * @param Post $post
     * @return void
     */
    public function setPost(Post $post)
    {
        $this->post = $post;
    }

    /**
     * @return string
     */
    public function getFileExtension()
    {
        return 'html';
    }

    /**
     * @return string
     */
    public function export()
    {
        $s = '';
        $s .= '<strong>' . $this->post->getName() . '</strong>' . "<br>\n";
        $s .= '<p>' . $this->post->getDescription() . '</p>' . "<br>\n";

        return $s;
    }
}
