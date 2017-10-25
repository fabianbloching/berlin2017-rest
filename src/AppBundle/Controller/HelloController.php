<?php

namespace AppBundle\Controller;

use AppBundle\Exception\ApiRuntimeException;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;

class HelloController
{
    /**
     * @Route("/api/hello", name="hello")
     * @Method("GET")
     */
    public function indexAction()
    {
        return new Response('Hello API');
    }

    /**
     * @Route("/api/fail", name="fail")
     * @Method("GET")
     */
    public function failAction()
    {
        throw new ApiRuntimeException('Oops.');
    }
}
