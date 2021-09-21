<?php

namespace App\Service;

use App\Entity\Post;
use App\Service\DownloadPostInterface;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;

/**
 * Class DownloadPostHtml - класс-сервис для скачивания поста
 * @author Denis Poprugailo
 * @package App\Service
 */
class DownloadPostHtml implements DownloadPostInterface
{
    /**
     * @param Post $post
     * @return array
     */
    public function getDataFromPost(Post $post)
    {
        $fileName = $post->getId() . '.html';
        $fileContent = $post->getName();
        $fileContent .= '<br><br>'.$post->getDescription();

        return ['fileName' => $fileName,
            'fileContent' => $fileContent,
        ];
    }
}