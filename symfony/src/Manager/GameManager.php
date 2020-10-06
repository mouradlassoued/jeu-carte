<?php

namespace App\Manager;

use App\Model\Card;
use App\Model\Deck;
use App\Model\Hand;

class GameManager
{

    /**
     * Classer les cartes par couleur et valeur
     *
     * @param $hand: cartes non triées
     * @return array: Un tableau de cartes triées
    */
    public function sortCards(Hand $hand)
    {
        // Créer un tableau de 2 dimensions , les clés de ce tableau sont le couleur et la valeur de la carte
        $cards = [];
        /** @var Card $card */
        foreach ($hand->getCards() as $card) {
            // Récupérer l'ordre par  couleur et valeur
            $suit = array_search($card->getSuit(), Deck::SUITES);
            $value = array_search($card->getValue(), Deck::VALUES);
            $cards[$suit][$value] = $card->getCardAsArray();
        }
        // trier la main récursivement
        $this->recursiveSort($cards);
        // Transformer le tableau en une seule dimension
        $cards = array_merge(... $cards);

        return $cards;
    }

    /**
     * Trier les cartes récursivement
     *
     * @param $cards
     * @return boolean
    */
    public function recursiveSort(&$cards)
    {
        if (!is_array($cards)) {
            return false;
        }
        ksort($cards);
        foreach ($cards as &$card) {
            $this->recursiveSort($card);
        }
        return true;
    }
}