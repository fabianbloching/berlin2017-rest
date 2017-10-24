<?php

namespace Tests\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class HelloControllerTest extends WebTestCase
{
    public function testIndex()
    {
        $client = static::createClient();
        $client->request('GET', '/api/hello');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertContains('Hello API', $client->getResponse()->getContent());
    }
}
