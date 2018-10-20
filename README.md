# ENSIIE Project Web Trouvemonbar

Projet Web ENSIIE:
* Samir Lazzali
* Jerôme O'Keffe
* Emilio De sousa
* Swann Castel

## Notre Projet
Notre souhait est de créer une application Web qui propose à nos utilisateurs des bars qui correspondent à leurs préférences. les utilisateurs pourront ainsi se créer un compte afin d'enregistrer leurs paramètres et ainsi profiter de nos recommandations. Ils pourront aussi donner des avis sur les bars.

## Architecture du projet
Pour la partie backend, nous utilisons nginx et php-fpm pour fournir une API REST.

Pour le partie frontend, c'est une application Vue.js complétement indépendante alimentée par des reqêtes AJAX par le biais de l'api exposé par nginx.

---

## Install you application
* Change the parameters in .env file by your own values.
* To install and start the application run `make install`
* Your web site is running here [http:localhost:3000](http:localhost:3000)

## Start you application
`make start`

This command starts the application without installing anything.

## Connect to the database
`make db.connect`

## Run backend unit tests
`make phpunit.run`

## Run frontend unit tests
`make npmunit.run`

## Build frontend project
`make npm.build`
