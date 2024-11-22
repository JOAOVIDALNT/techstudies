<?php 
    if(isset($_COOKIE['nome'])) {
        echo "Bem vindo, " . $_COOKIE['nome'];
    }