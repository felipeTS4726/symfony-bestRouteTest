<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class IndexController
{
    /**
     * @Route("/", name="helloWorld", methods="GET")
     */
    public function index(): JsonResponse
    {
        return new JsonResponse(['success' => true, 'data' => 'Hello World']);
    }
}
