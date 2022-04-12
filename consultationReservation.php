<?php

include_once "_head_inc.php";
require_once '_gestionBase_inc.php';
$pdo = gestionnaireDeConnexion() ;
 
?>

<?php
               $collectionReservation = afficherReservation();
?>
                <?php 
                foreach ($collectionReservation as $lesReservation):
                    ?>
                    <p>Date Debut Reservation : <?php echo date('d/m/Y',$lesReservation["dateDebutReservation"]) ;?><p>
                    <p> Date fin Reservation : <?php echo date('d/m/Y',$lesReservation["dateFinReservation"]) ;?> </p>
                    <p> Volume Estime : <?php echo $lesReservation["volumeEstime"] ;?> </p>
                    <p> Ville MiseDisposition : <?php echo $lesReservation["codeVilleMiseDisposition"] ;?> </p>
                    <p> Ville Rendre : <?php echo $lesReservation["codeVilleRendre"] ;?> </p>
                    <p> Code Reservation : <?php echo $lesReservation["codeReservation"] ;?> </p>
                    <p> <a href="modification_reservation.php?id=<?= $lesReservation['codeReservation']; ?>"> Modifier ma commande </a> </p>
                    <p> <a href="supression_reservation.php?id=<?= $lesReservation['codeReservation']; ?>"> Supprimer Réservation  </a> </p>
                </br></br></br>

            <?php endforeach; ?>
               
            