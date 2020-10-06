<?php


namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use App\Model\Hand;

class GameTest extends WebTestCase
{
    public function testCardsGame()
    {
        $client = static::createClient();

        $client->request('GET', '/api/cards');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertResponseHeaderSame('Content-Type', 'application/json');
        $this->assertStringContainsString('suit', $client->getResponse()->getContent());
        $this->assertEquals(10, substr_count( $client->getResponse()->getContent(), 'suit'));
        $content = $client->getResponse()->getContent();
        $hand = new Hand(json_decode($client->getResponse()->getContent(), true));
        print_r("\nMain non triée  : \n");
        print_r($hand->show());


        $client->request(
            'POST',
            '/api/sort/cards',
            [],
            [],
            ['CONTENT_TYPE' => 'application/json'],
            $content
        );

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertResponseHeaderSame('Content-Type', 'application/json');
        $this->assertStringContainsString('suit', $client->getResponse()->getContent());
        $this->assertEquals(10, substr_count( $client->getResponse()->getContent(), 'suit'));
        print_r("\n\n\nMain triée  : \n");
        $hand = new Hand(json_decode($client->getResponse()->getContent(), true));
        print_r($hand->show());
    }
}