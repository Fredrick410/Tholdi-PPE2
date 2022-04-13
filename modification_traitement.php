<?php
session_start();
require_once '_gestionBase_inc.php';


$codeReservation = $_GET["id"]; 
$dateDebutReservation = $_POST["dateDebutReservation"]; //Date début
$dateFinReservation = $_POST["dateFinReservation"]; // Date Fin
$volumeEstime = $_POST["volumeEstime"]; // Volume Estimé 
$codeVilleMiseDisposition = $_POST["codeVilleMiseDisposition"]; // Code Ville Mise à Disposition 
$codeVilleRendre = $_POST["codeVilleRendre"]; //Code Ville Rendre

modifierReservation ($dateDebutReservation, $dateFinReservation, $volumeEstime, $codeVilleMiseDisposition, $codeVilleRendre, $codeReservation);

//var_dump($codeReservation);
header("location:consultationReservation.php");
