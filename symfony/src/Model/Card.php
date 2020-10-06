<?php

namespace App\Model;

use JMS\Serializer\Annotation as Serializer;

class Card
{
    /**
     * @Serializer\Groups({"list"})
     * @var string
     */
    private $suit;
    /**
     * @Serializer\Groups({"list"})
     * @var string
     */
    private $value;

    /**
     * Card constructor.
     * @param string $suit
     * @param string $value
     */
    public function __construct($suit='',$value='')
    {

        $this->suit = $suit;
        $this->value = $value;
    }

    /**
     * The suit of the Card
     * @return string
     */
    public function getSuit()
    {
        return $this->suit;
    }

    /**
     * The Value of the Card
     * @return string
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * The string of the Card
     * @return string
     */
    public function getCard()
    {
        return($this->getValue().' de '.$this->getSuit());
    }
    /**
     * The string of the Card
     * @return array
     */
    public function getCardAsArray()
    {
        return(["suit"=>$this->getSuit(),"value"=>$this->getValue()]);
    }
}