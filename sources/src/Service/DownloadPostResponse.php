<?php


namespace App\Service;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;

/**
 * Class DownloadPostResponse
 * @author
 * @package App\Service
 */
class DownloadPostResponse
{
    public function getResponse($data)
    {
        $response = new Response($data['fileContent']);
        $disposition = $response->headers->makeDisposition(
            ResponseHeaderBag::DISPOSITION_ATTACHMENT,
            $data['fileName'],
        );
        $response->headers->set('Content-Disposition', $disposition);
        return $response;
    }
}