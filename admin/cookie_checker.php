<?php 
    if(!isset($_COOKIE['type'])) {
        echo "No Cookie?";
        die();
    } else {
        if(!($_COOKIE['type'] === 'admin')) {
            echo "Hi smart guy!";
            die();
        }
    }
