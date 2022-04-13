<?php 
    session_start();
    require_once '_gestionBase_inc.php';

    $login = $_POST['login'];
    $mdp =  $_POST['mdp'];

    connexionUtilisateur($login, $mdp);


    ?>