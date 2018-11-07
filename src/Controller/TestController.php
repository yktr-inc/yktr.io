<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TestController
{
    /**
    @Route("/")
    */
    public function number()
    {
        return new Response(
            '<html>Test</html>'
        );
    }
}