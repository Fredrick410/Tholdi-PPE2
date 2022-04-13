<?php 
    session_start();
    require_once '_gestionBase_inc.php';
    ?>

    
    <?php
    $raisonSociale = htmlspecialchars($_POST['raisonSociale']);
    $adresse = htmlspecialchars($_POST['adresse']);
    $cp = htmlspecialchars($_POST['cp']);
    $ville = htmlspecialchars($_POST['ville']);
    $adrMel = htmlspecialchars($_POST['adrMel']);
    $telephone = htmlspecialchars($_POST['telephone']);
    $contact = htmlspecialchars($_POST['contact']);
    $codePays = htmlspecialchars($_POST['codePaysDisposition']);
    $login = htmlspecialchars($_POST['login']);
    $mdp = htmlspecialchars($_POST['mdp']);
    
    ajouterUtilisateur($raisonSociale, $adresse, $cp, $ville, $adrMel, $telephone, $contact, $codePays, $login, $mdp);
    header('location: connexion.php');

    // Attention : Clé de tableau "codePays" non définie dans /Applications/MAMP/htdocs/tholdi/inscription_traitement.php à la ligne 16