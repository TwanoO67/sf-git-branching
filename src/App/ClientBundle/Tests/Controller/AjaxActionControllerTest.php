<?php

namespace App\ClientBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class AjaxActionControllerTest extends WebTestCase
{
    public function testAjax()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/ajax/action');
    }

}
