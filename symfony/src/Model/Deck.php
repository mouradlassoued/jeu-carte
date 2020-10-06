<?php

namespace App\Model;

class Deck
{

    const SUITES = ["Carreaux","Coeur","Pique","Trèfle"];
    const VALUES = ['AS', 2, 3, 4, 5, 6, 7, 8, 9, 10, 'Valet', 'Dame', 'Roi'];

    private $cards;

    /**
     * Deck constructor.
     */
    public function __construct()
    {

        $this->cards=array();

        foreach ($this::SUITES as $suit){
            foreach ($this::VALUES as $value){
                array_push($this->cards,new Card($suit,$value));
            }
        }

    }

    /**
     * Shuffles the cards
     */
    public function shuffle()
    {
        shuffle($this->cards);
    }

    /**
     * get the cards
     */
    public function getCards()
    {
        return $this->cards;
    }

    /**
     * Deals number of Cards from the deck
     * @param $numberOfCards
     */
    public function dealCards($numberOfCards)
    {
        $hand = array_slice($this->cards,0,$numberOfCards);

        for($i=0;$i<$numberOfCards;$i++) {
            array_shift($this->cards);
        }
        return $hand;
    }
}