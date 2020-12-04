<?php

    class Connection {
        
        static public function connect() {

            $link = new PDO("mysql:host=localhost;dbname=blog-php",
                            "root",
                            "");

            $link->exec("set names utf8");

            return $link;

        }

    }