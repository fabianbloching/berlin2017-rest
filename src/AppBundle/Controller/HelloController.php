<?php

namespace AppBundle\Controller;

use AppBundle\Exception\ApiRuntimeException;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class HelloController extends Controller
{
    /**
     * @Route("/api/hello", name="hello")
     */
    public function indexAction()
    {
        return new Response('Hello API');
    }
}
