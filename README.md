Pirateboc
=========

Crée par Adrien Bocquet (@abocquet adrienbocquet38@gmail.com)

La pirateboc qu'est ce que c'est ?
----------------------------------------------

La pirateboC est un fork de la pirateboX. 

Pour ceux qui dormaient au fond, la piratebox, originalement crée par [David Darts] (http://daviddarts.com), est un système permettant de partager des fichiers grâce à un réseau WiFi local. Quand les utilisateurs joignent le réseau et qu'ils ouvrent leur navigateur il arrivent automatiquement sur la page d'accueil de la piratebox. Ils peuvent alors immédiatement commencer à clavarder (quel vocabulaire, n'est il pas ?) et à échanger des fichiers.

La pirateboc est une variante de la piratebox qui se veut plus simple, personnalisable et complète que la version d'origine.

Mais comment ça marche alors ?
---------------------------------------------

La pirateboc dispose, et va disposer de fonctionnalités absentes de la piratebox d'origine, comme la catégorisation des fichiers, la possibilité de renommer simplement l'interface, modifier le texte d'accueil, remettre automatiquement l'heure du système (lorsqu'il n'est plus alimenté, le système repart au 1er janvier 1970 ; pas top donc)...

Coté utilisateur, la pirateboc utilise les technologies standards du web (HTML5, CSS3...) afin d'être compatible avec un maximum  avec d'appareils, avec l'utilisation d'un design adaptatif. De plus elle utilise la bibliothèque jQuery, qui offre un très large support des navigateurs.

Coté serveur, le système utilise temporairement le PHP, destiné à être remplacé rapidement par du python, déjà utilisé dans les piratebox car il est bien plus souple et adapté à la pirateboc. De plus, la pirateboc dispose d'un système de cache statique et déporte les calculs de l'affichage des fichiers du coté client afin de soulager le serveur.

Quand au matériel, à l'image de la piratebox, on devrait utiliser des routeurs MR-3020 disposant d'[OpenWRT](https://openwrt.org)

Et concrètement comment ça se passe ?
-------------------------------------------------------

Pour l'instant, l'interface de la pirateboc est au stade de bêta. Il reste un grand nombre de fonctionnalités à rajouter parmi celles citées plus haut. De plus, il faudra trouver le moyen de faire tourner le tout sur les MR-3020, qui n'ont que très peu de mémoire interne et de puissance de calcul.

Il y a donc du travail pour ceux qui pourraient s'ennuyer. 

Comment aider ?
-----------------------

C'est très simple:
* parlez du projet autours de vous
* si vous savez faire un CGI avec du python et faire fonctionner un script python sur un serveur Apache, cela m'intéresse pour le développement
* si vous avez des connaissances sur OpenWRT ou de bonnes idées, et que le projet vous plaît, contactez-moi
