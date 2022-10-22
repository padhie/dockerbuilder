<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class PingController extends AbstractController
{
    #[Route('/ping', name: 'app_ping')]
    public function index(): Response
    {
        return $this->json([
            'pong' => time(),
        ]);
    }
}
