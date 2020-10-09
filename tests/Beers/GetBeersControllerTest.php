<?php

namespace App\Tests\Beers;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class GetBeersControllerTest extends WebTestCase
{

    public function testInvoke()
    {
        $client = static::createClient();
        $client->request('GET', '/api/v1/find');
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertNotNull($client->getResponse()->getContent());
    }
}
