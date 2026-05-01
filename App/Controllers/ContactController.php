<?php

    namespace App\Controllers;
    use App\Models\Contact;

    class ContactController {

        private ?Contact $contact;

        function __construct(){
            $this->contact = new Contact();
            if($_SERVER["REQUEST_METHOD"] !== "POST"){
                header('Location: contact');
                exit;
            }
        }

        function contactHandler() {
            $email = $_POST['email'];
            $commentaire = $_POST['commentaire'];

            if(empty($email) || empty($commentaire)){
                $_SESSION['error'] = "Veuillez remplir tous les champs";
                header('Location: contact');
                exit;
            }

            $this->contact->setContact($email, $commentaire);
            header('Location: /pfa/');
            exit;
        }
    }