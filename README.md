Jeu de carte
==============

# Installation

Aprés avoir extraire le zip (avec 7-zip) ou cloner le projet

 1. Build de l'environnement:

    docker-compose up -d --build

NB : 3 volumes partagés a valider ('logs\nginx' , 'logs\symfony' et 'symfony')

2. installation des bundles:

    windows => winpty docker exec -ti php-fpm composer install
	
    linux => docker exec -ti php-fpm composer install

3. Lancer les tests du code source, le sénario demandé sera affiché sur la console

    windows => winpty docker exec -ti php-fpm php bin/phpunit tests
	
    linux => docker exec -ti php-fpm php bin/phpunit tests

Exemple de jeu:

    Testing tests
    ...
    Main non triée  :
    Roi de Coeur
    10 de Pique
    7 de Carreaux
    6 de Pique
    AS de Coeur
    9 de Trèfle
    10 de Coeur
    Dame de Pique
    9 de Pique
    AS de Carreaux
    
    
    
    Main triée  :
    AS de Carreaux
    7 de Carreaux
    AS de Coeur
    10 de Coeur
    Roi de Coeur
    6 de Pique
    9 de Pique
    10 de Pique
    Dame de Pique
    9 de Trèfle
    ..                                                               5 / 5 (100%)
    
    Time: 522 ms, Memory: 10.00 MB

OK (5 tests, 19 assertions)




## Api doc
pour tester avec l'interface api/doc:

ajouter dans le fichier "hosts" : 127.0.0.1 symfony.localhost

Aller vers l'url : `http://symfony.localhost/api/doc`

vous trouverez 2 webservices : 
- "GET ​/api​/cards" => Liste des cartes.
- "POST ​/api​/sort​/cards" => Liste des cartes triées.


