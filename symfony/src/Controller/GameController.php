<?php


namespace App\Controller;


use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use OpenApi\Annotations as OA;
use App\Manager\GameManager;
use App\Model\Card;
use App\Model\Deck;
use App\Model\Hand;

class GameController extends AbstractFOSRestController
{

    /**
     * Liste des cartes.
     *
     *
     * @Route("/api/cards", methods={"GET"})
     * @OA\Response(
     *     response=200,
     *     description="Returns the cards",
     *     @OA\JsonContent(
     *        type="array",
     *        @OA\Items(type="object")
     *     )
     * )
     * @OA\Parameter(
     *     name="number",
     *     in="query",
     *     description="The field used to specify number of cards",
     *     @OA\Schema(type="integer", default="10")
     * )
     * @OA\Tag(name="Cards")
     * @param Request $request
     * @return JsonResponse
     */
    public function cardsAction(Request $request)
    {
        // Créer un paquet de cartes
        $deck = new Deck();
        $result = [];
        // mélanger les cartes
        $deck->shuffle();
        // tirer une main de 10 cartes tirées de manière aléatoire
        $hand = $deck->dealCards($request->get('number')??10);
        /** @var Card $card */
        foreach ($hand as $card) {
            $result[] = $card->getCardAsArray();
        }

        return new JsonResponse($result);
    }

    /**
     * Liste des cartes triées.
     *
     *
     * @Route("/api/sort/cards", methods={"POST"})
     * @OA\Response(
     *     response=200,
     *     description="Returns the sorted cards",
     *     @OA\JsonContent(
     *        type="array",
     *        @OA\Items(type="object")
     *     )
     * )
     * @OA\RequestBody(
     *     request="cards",
     *     description="List of cards",
     *     required=true,
     *     @OA\JsonContent(
     *         type="array",
     *         @OA\Items(type="object")
     *     )
     * )
     * @OA\Tag(name="Cards")
     * @param Request $request
     * @param GameManager $gameManager
     * @return JsonResponse
     */
    public function sortCardsAction(Request $request, GameManager $gameManager)
    {
        //la main "non triée"
        $hand = new Hand(json_decode($request->getContent(), true));
        //classer les cartes par couleur et valeur
        $result = $gameManager->sortCards($hand);

        return new JsonResponse($result);
    }

}