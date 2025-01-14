<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://lucavizzi.altervista.org/readme/drunk-laravel.jpg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Drunk Laravel

Il test è stato svolto utilizzando lo starter kit [Laravel Jetstream](https://jetstream.laravel.com/introduction.html) per avere già pronte le funzionalità relative all'account utente.

Per l'emissione del token è stato usato [Sanctum](https://laravel.com/docs/8.x/sanctum)

Il login dell'utente è stato intercettato tramite il Service Provider di Fortify.
A login avvenuto, il token precedente viene eliminato (riga 31) e ne viene generato uno nuovo che viene salvato in una variabile di sessione (riga 32)
<img src="https://lucavizzi.altervista.org/readme/provider.png" alt="Screenshot Provider">
https://github.com/lucavizzi/cloud-care/blob/main/app/Providers/FortifyServiceProvider.php

La variabile di sessione viene poi utilizzata nella route della pagina che eseguirà le interrogazioni all'API, definita in web.php, per il passaggio del dato a Vuejs (riga 22)
<img src="https://lucavizzi.altervista.org/readme/route-web.png" alt="Screenshot Route Web">
https://github.com/lucavizzi/cloud-care/blob/main/routes/web.php
È stata usata una variabile di sessione per evitare di salvare in chiaro nel data-base il token generato.

Il token viene poi utilizzato da Vuejs per interrogare (con Axios) l’api che funge da proxy (righe 5 e 23).
<img src="https://lucavizzi.altervista.org/readme/vuejs.png" alt="Screenshot API call">
https://github.com/lucavizzi/cloud-care/blob/main/resources/js/Components/Welcome.vue


Di seguito è riportata la route dell’api protetta dal middleware Sanctum.
<img src="https://lucavizzi.altervista.org/readme/route-api.png" alt="Screenshot Route API">
https://github.com/lucavizzi/cloud-care/blob/main/routes/api.php


Il progetto è stato pubblicato su un hosting gratuito ed è visionabile all’indirizzo: [https://lucavizzi.altervista.org/](https://lucavizzi.altervista.org/)

Accedendo si viene rediretti sulla pagina di login perché anche la route definita in web.php è protetta con Sanctum ma per accedere è sufficiente l’header x-xsrf-token gestito autonomamente da Sanctum a differenza delle route definite in api.php dove è necessario utilizzare un token valido per accedere.

Il modulo per il login (https://lucavizzi.altervista.org/login) avrà già preimpostate le credenziali (email e password) per accedere.
<img src="https://lucavizzi.altervista.org/readme/login.png" alt="Screenshot Login">

A login effettuato si verrà nuovamente rediretti sulla root del dominio dove sarà possibile visionare l’api che funge da proxy.