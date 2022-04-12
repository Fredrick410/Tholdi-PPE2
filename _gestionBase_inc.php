<?php

function gestionnaireDeConnexion() 
{
    try {
        $pdo = new PDO(
                'mysql:dbhost=localhost;dbname=tholdim',
                'root', '', array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8")
        );
    } catch (PDOException $err) 
    {
        var_dump($err);
        die;
    }
    return $pdo;
}


// Fait par Sami
function connexionUtilisateur($login, $mdp)
{
    if(isset($_POST['login']) && isset($_POST['mdp']))
    {
           
            $pdo = gestionnaireDeConnexion();
            $req = "SELECT * FROM utilisateur WHERE login = :login AND mdp = :mdp";
            $reqPrep = $pdo->prepare($req);
            $reqPrep->execute([
                'login' => $login,
                'mdp' => $mdp
            ]);

            $tab = $reqPrep->fetch();
            
        if ($tab > 0) 
        {
            extract($tab);
            $_SESSION['login'] = $login;
            $_SESSION['code'] = $code;
            $authOK = true;
        }
        else
        {
            $authOK = false;
        }
    }
        if($authOK)
        {
            header('location: index.php?ConnexionOk');
        }
        else{
            header('location: index.php?ConnexionMauvaise');
        }
}


// Fait par Sami
function ajouterUtilisateur($raisonSociale, $adresse, $cp, $ville, $adrMel, $telephone, $contact, $codePays, $login, $mdp)
{
    $pdo = gestionnaireDeConnexion();
    $requetePrep = "INSERT INTO utilisateur (raisonSociale, adresse, cp, ville, adrMel, telephone, contact, codePays, login, mdp)" . 
            "VALUES ( :raisonSociale, :adresse, :cp, :ville, :adrMel, :telephone, :contact, :codePays, :login, :mdp)";
    $requete = $pdo->prepare($requetePrep);
    $requete->execute([
        'raisonSociale' => $raisonSociale,
        'adresse' => $adresse,
        'cp' => $cp,
        'ville' => $ville,
        'adrMel' => $adrMel,
        'telephone' => $telephone,
        'contact' => $contact,
        'codePays' => $codePays,
        'login' => $login,
        'mdp' => $mdp ]);
    $insert = $requete->fetchAll();
    return $insert;
}

// Fait par Sami
function obtenirVille() 
{
    $pdo = gestionnaireDeConnexion();
    $requetePrep = "SELECT nomVille, codeVille FROM Ville";
    $requete = $pdo->prepare($requetePrep);
    $requete->execute();
    $insert = $requete->fetchAll();
    return $insert;
}

// Fait par Sami
function obtenirTypeContainer()
{
  $pdo = gestionnaireDeConnexion();
  $requetePrep = "SELECT libelleTypeContainer FROM typecontainer";
  $requete = $pdo->prepare($requetePrep);
  $requete->execute();
  $insert = $requete->fetchAll();
  return $insert;
}


// Fait par Sami
function obtenirPays() 
{
   $pdo = gestionnaireDeConnexion();
   $req = "SELECT codePays FROM pays";
   $reqPrep = $pdo->prepare($req);
   $reqPrep->execute();
   $insert = $reqPrep->fetchAll();
   return $insert;
}


// Fait par le prof
function ajouterUneReservation($dateDebutReservation, $dateFinReservation,$dateReservation, $volumeEstime, $codeVilleMiseDisposition, $codeVilleRendre, $codeUtilisateur,$etat) 
{

    $pdo = gestionnaireDeConnexion() ;
    $dateReservation = time();
    $dateDebutReservation = strtotime($dateDebutReservation);
    $dateFinReservation = strtotime($dateFinReservation);
    $req = "INSERT INTO reservation (dateDebutReservation,dateFinReservation,dateReservation," . 
            " volumeEstime,codeVilleMiseDisposition, codeVilleRendre,codeUtilisateur,etat) " .
            " VALUES " . 
            " ( :dateDebutReservation,:dateFinReservation,:dateReservation," . 
            " :volumeEstime, :codeVilleMiseDisposition, :codeVilleRendre, :codeUtilisateur, :etat)";
    $requete = $pdo->prepare($req);

    $requete->execute([
        "dateDebutReservation" => $dateDebutReservation,
        "dateFinReservation" => $dateFinReservation,
        "dateReservation" => $dateReservation,
        "volumeEstime" => $volumeEstime, 
        "codeVilleMiseDisposition" => $codeVilleMiseDisposition, 
        "codeVilleRendre" => $codeVilleRendre, 
        "codeUtilisateur" => $codeUtilisateur, 
        "etat" => $etat
    ]);
    $insert = $requete->fetchAll();
    return $insert;
}


/* UPDATE reservation SET dateDebutReservation= 1649289600 , dateFinReservation= 1648684800 ,dateReservation= 1648728211 , volumeEstime= 100, codeVilleMiseDisposition= 1 ,codeVilleRendre=4, codeUtilisateur=1, etat='enCours' 
WHERE codeReservation = 70 and codeUtilisateur = 1; */ 



/*Fait par le prof*/
function ajouterLigneDeReservation($numTypeContainer,$qteReserver)
{
    $pdo = gestionnaireDeConnexion();
    $req = "INSERT INTO reserver (numTypeContainer,qteReserver) VALUES (:numTypeContainer, :qteReserver)";
    $requete = $pdo->prepare($req);
    $requete->execute([ 
      "numTypeContainer" => $numTypeContainer,
      "qteReserver" => $qteReserver
    ]);
    $insert = $requete->fetchAll();
    return $insert;
}





function afficherReservation() {
	   
	    $code = $_SESSION['code'] ;
        $pdo = gestionnaireDeConnexion();

        $req = "SELECT * FROM reservation where codeUtilisateur = $code";

        $pdoStatement = $pdo->query($req);
        $lesReservations = $pdoStatement->fetchAll(PDO::FETCH_ASSOC);
        return $lesReservations;
        $lesReservations = array();
        return $lesReservations;
        }
		
	


/* A fairre */

/* Fait par Matheo */


function modifierReservation ($dateDebutReservation ,$dateFinReservation , $volumeEstime ,$codeVilleMiseDisposition , $codeVilleRendre , $codeReservation) 
{

$pdo = gestionnaireDeConnexion() ;/*Connexion à la BDD */
$dateDebutReservation = strtotime($dateDebutReservation);
$dateFinReservation = strtotime($dateFinReservation);
$req = "UPDATE reservation SET dateDebutreservation = $dateDebutReservation, dateFinReservation  = $dateFinReservation, volumeEstime = $volumeEstime,
 codeVilleMiseDisposition =$codeVilleMiseDisposition, codeVilleRendre = $codeVilleRendre Where codeReservation = $codeReservation";
$requete = $pdo->prepare($req); /* Prepare la requete*/
$requete->execute();/*Execute la requete */
}





/*function supprimerReservation ()

DELETE FROM reservation WHERE codeReservation = codeReservation  ; 
/* A <faire></faire>	
		/*


// Fait par Sami
function afficherReservation() 
{
    $pdo = gestionnaireDeConnexion();
        
    $req = "SELECT * 
         FROM reservation 
         INNER JOIN utilisateur ON reservation.codeUtilisateur = utilisateur.code
          WHERE utilisateur.code = " .  $_SESSION['code'] . " ORDER BY codeReservation ASC";
                    
    $stmt = $pdo->prepare($req);
    $stmt->execute();
    $lesReservations = $stmt->fetch();
  
    $lesReservations = array();
    return $lesReservations;
}
          
          */
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		