<?php


namespace App\Tests\Manager;

use App\Manager\GameManager;
use App\Model\Hand;
use PHPUnit\Framework\TestCase;

class GameManagerTest extends TestCase
{

    public function testSortCards()
    {
        $hand = new Hand([["suit"=>"Trèfle", "value"=>5],
                  ["suit"=>"Carreaux", "value"=>"Roi"],
                  ["suit"=>"Coeur", "value"=>"Dame"],
                  ["suit"=>"Carreaux", "value"=>8],
                  ["suit"=>"Pique", "value"=>7],
                  ["suit"=>"Coeur", "value"=>3],
                  ["suit"=>"Trèfle", "value"=>9],
                  ["suit"=>"Coeur", "value"=>"Valet"],
                  ["suit"=>"Trèfle", "value"=>10],
                  ["suit"=>"Carreaux", "value"=>"Dame"]
        ]);
        $sortedHand = [["suit"=>"Carreaux","value"=>8],
                    ["suit"=>"Carreaux", "value"=>"Dame"],
                    ["suit"=>"Carreaux", "value"=>"Roi"],
                    ["suit"=>"Coeur", "value"=>3],
                    ["suit"=>"Coeur", "value"=>"Valet"],
                    ["suit"=>"Coeur", "value"=>"Dame"],
                    ["suit"=>"Pique", "value"=>7],
                    ["suit"=>"Trèfle", "value"=>5],
                    ["suit"=>"Trèfle", "value"=>9],
                    ["suit"=>"Trèfle", "value"=>10]
        ];
        $manager = new GameManager();
        $handCards = $manager->sortCards($hand);
        $this->assertEquals($sortedHand, $handCards);
    }

    public function testRecursiveSort()
    {
        $hand = [
            2 => [11 =>["suit" => "Pique","value" => "Dame"]],
            1 => [9  =>["suit" => "Coeur","value" => 10],6 => ["suit" => "Coeur","value" => 7],10 => ["suit" => "Coeur", "value" => "Valet"],5 => ["suit" => "Coeur", "value" => 6]],
            3 => [6  =>["suit" => "Trèfle","value" => 7],8 => ["suit" => "Trèfle","value" => 9],0 => ["suit" => "Trèfle", "value" => "AS"]],
            0 => [9  =>["suit" => "Carreaux","value" => 10],8 => ["suit" => "Carreaux","value" => 9]]
        ];

        $sortedHand = [
             0 => [8  =>["suit" => "Carreaux","value" => 9],9 => ["suit" => "Carreaux","value" => 10]],
             1 => [5  =>["suit" => "Coeur","value" => 6],6 => ["suit" => "Coeur","value" => 7],9 => ["suit" => "Coeur", "value" => 10],10 => ["suit" => "Coeur", "value" => "Valet"]],
             2 => [11 =>["suit" => "Pique","value" => "Dame"]],
             3 => [0  =>["suit" => "Trèfle","value" => "AS"],6 => ["suit" => "Trèfle","value" => 7],8 => ["suit" => "Trèfle", "value" => 9]]
        ];
        $manager = new GameManager();
        $manager->recursiveSort($hand);
        $this->assertEquals($sortedHand, $hand);
    }
}