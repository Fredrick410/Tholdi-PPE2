<?php 
    session_start();
    require_once '_gestionBase_inc.php';
?>
<!DOCTYPE html>
<html style="font-size: 16px;">
  <head>

    
    <link rel="stylesheet" href="css/header.css" media="screen">

<!-- Fait par Sami -->
  </head>
<body>
  <div class="box">
        <header class="header">
            <a href="index.php" class="header-logo">THOLDI</a>
            <nav class="header-nav">
                <a href="index.php">Acceuil</a>
                <a href="tarif.php">Tarif</a>
                <?php if(!empty($_SESSION['login']) && !empty($_SESSION['code']))
                { 
                  echo "<a href=\"reservation.php\">Reservation</a>";
                  echo "<a href=\"consultationReservation.php\">Consultation des Reservations</a>";
				          echo "<a href=\"modification_reservation.php\">Modification des Reservations</a>";
				  }?>
               
            </nav>
            <?php if(empty($_SESSION['login']) && empty($_SESSION['code'])){
              echo "<a class=\"button\" href=\"connexion.php\">Se connecter</a>";
            }else{
              echo "<a class=\"button\" href=\"deconnexion.php\">Deconnexion</a>";
            } ?>
           
           
        </header>
		
		<br>
		<br><br><br>
		
    </div>
