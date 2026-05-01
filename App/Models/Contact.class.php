<?php

    namespace App\Models;
    class Contact extends User{
        

        public function setContact($email, $comment){
            $sql = "INSERT INTO contacts (email, commentaire) VALUES (?, ?)";
            $this->execute($sql, [$email, $comment]);
        }

    }