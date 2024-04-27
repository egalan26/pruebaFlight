<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ApiAbstractController extends AbstractController
{

    public function extractFromQuery($request, $key): string
    {
        return (string)$request->query->get($key);
    }
}