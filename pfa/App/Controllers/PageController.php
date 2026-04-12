<?php

    namespace App\Controllers;
    class PageController {
        public function home() : void {
            $title = "Accueil";
            $view = __DIR__ . '/../Views/Partials/portail.php';
            require_once __DIR__ . '/../Views/layout.php';
        }

        public function login() : void {
            $title = "Connexion";
            $view = __DIR__ . '/../Views/Auth/log-in.php';
            require_once __DIR__ . '/../Views/layout.php';
        }

        public function contact() : void {
            $title = "Contact";
            $view = __DIR__ . '/../Views/Partials/contact.php';
            require_once __DIR__ . '/../Views/layout.php';
        }
    }