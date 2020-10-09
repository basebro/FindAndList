<?php

namespace App\Tests\Beers;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class GetBeersExtendedControllerTest extends WebTestCase
{

    public function testInvoke()
    {
        $client = static::createClient();
        $client->request('GET', '/api/v1/beers/extended');
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertNotNull($client->getResponse()->getContent());
        $this->assertContains('image', $client->getResponse()->getContent());
        $this->assertContains('slogan', $client->getResponse()->getContent());
        $this->assertContains('first_brewed', $client->getResponse()->getContent());
    }
}
