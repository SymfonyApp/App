<?php

namespace AppBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class CartControllerTest extends WebTestCase
{
    public function testAdd()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/cart/add');
    }

    public function testIndex()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/cart');
    }

    public function testRemove()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/cart/remove');
    }

}
