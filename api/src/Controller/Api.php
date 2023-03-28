<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

class Api
{
    #[Route('/api/ping')]
    public function ping() : Response
    {
        return new Response('pong');
    }

    #[Route('/api/info')]
    public function info() : JsonResponse
    {
        $data = [
            'date' => (new \DateTime())->format('c'),
            'hostname' => gethostname()
        ];
        return new JsonResponse($data);
    }
}