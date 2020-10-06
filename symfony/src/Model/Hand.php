<?php

namespace App\Model;

class Hand
{


    private $cards;

    /**
     * Hand constructor.
     */
    public function __construct($cards=array())
    {
        $this->cards = array();
        foreach ($cards as $card){
                array_push($this->cards,new Card($card['suit'],$card['value']));
        }

    }

    /**
     * Shows the hand cards in string format
     * @return string
     */
    public function show()
    {   $return ='';
        foreach($this->cards as $card){
            $return .=  $card->getCard()." \n";
        }
        return $return;
    }

    /**
     * get the cards
     */
    public function getCards()
    {
        return $this->cards;
    }
}