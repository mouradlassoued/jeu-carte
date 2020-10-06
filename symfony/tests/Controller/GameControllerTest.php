<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class GameControllerTest extends WebTestCase
{
    private $hand;

    public function setUp()
    {
        $this->hand = "[{\"suit\":\"Trèfle\",\"value\":5},{\"suit\":\"Carreaux\",\"value\":\"Roi\"},{\"suit\":\"Coeur\",\"value\":\"Dame\"},{\"suit\":\"Carreaux\",\"value\":8},{\"suit\":\"Pique\",\"value\":7},{\"suit\":\"Coeur\",\"value\":3},{\"suit\":\"Trèfle\",\"value\":9},{\"suit\":\"Coeur\",\"value\":\"Valet\"},{\"suit\":\"Trèfle\",\"value\":10},{\"suit\":\"Carreaux\",\"value\":\"Dame\"}]";
    }
    public function testCards()
    {
        $client = static::createClient();

        $client->request('GET', '/api/cards');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertResponseHeaderSame('Content-Type', 'application/json');
        $this->assertStringContainsString('suit', $client->getResponse()->getContent());
        $this->assertEquals(10, substr_count( $client->getResponse()->getContent(), 'suit'));
    }
    public function testSortCards()
    {
        $client = static::createClient();
        $client->request(
            'POST',
            '/api/sort/cards',
            [],
            [],
            ['CONTENT_TYPE' => 'application/json'],
            $this->hand
        );

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertResponseHeaderSame('Content-Type', 'application/json');
        $this->assertStringContainsString('suit', $client->getResponse()->getContent());
        $this->assertEquals(10, substr_count( $client->getResponse()->getContent(), 'suit'));
        $expectedResult = '[{"suit":"Carreaux","value":8},{"suit":"Carreaux","value":"Dame"},{"suit":"Carreaux","value":"Roi"},{"suit":"Coeur","value":3},{"suit":"Coeur","value":"Valet"},{"suit":"Coeur","value":"Dame"},{"suit":"Pique","value":7},{"suit":"Tr\u00e8fle","value":5},{"suit":"Tr\u00e8fle","value":9},{"suit":"Tr\u00e8fle","value":10}]';
        $this->assertEquals($expectedResult, $client->getResponse()->getContent());
    }

}