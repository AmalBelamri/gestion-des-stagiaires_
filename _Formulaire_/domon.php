<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>php</title>
</head>
<body>
<?php 

function valid_donnees($donnes){
    $donnes=trim($donnes);
    $donnes=stripslashes($donnes);
    $donnes=htmlspecialchars($donnes);
    // $donnes=FILTER_VALIDATE_EMAIL($donnes);
    return $donnes;

                }
                $servore="localhost";
                $username="root";
                $pas="";
                $nom=valid_donnees($_GET["nom"]);
                $prenom=valid_donnees($_GET["prenom"]);
                $email=valid_donnees($_GET["email"]);
                $password=valid_donnees($_GET["password"]);
                $option=valid_donnees($_GET["option1"]);
                $mois=valid_donnees($_GET["mois"]);
                //type file and name 
                $filepdf=valid_donnees($_FILES["cv"]["name"]);
                $filetype=$_FILES["cv"]["type"];
                $file=$_FILES["cv"]["tmp_name"];
                
            try {                                        // SVP change name la base donnes  in mySQL 
                $connexion= new PDO("mysql:host=$servore;dbname=ocp",$username,$pas);
                $connexion->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
                                                           //SVP change name table in base donnes  in mySQL  
                $requete=$connexion->prepare("INSERT  INTO stagiaires (nom,prenom,email,motpass,filiere,mois,pdf)
                 VALUES (:nom,:prenom,:email,:motpass,:option,:mois,:filepdf);");
                $requete->bindParam(":nom",$nom);
                $requete->bindParam(":prenom",$prenom);
                $requete->bindParam(":email",$email); 
                $requete->bindParam(":motpass",$password);
                $requete->bindParam(":option",$option);
                $requete->bindParam(":mois",$mois);
                $requete->bindParam(":pdf",$filepdf);
                $requete->execute(); 
                echo " Puis inscrivez-vous  avec succes";
                //  header("Location:");
            }
            catch (PDOException $e ) {
                echo $e->getMessage();
            }
            finally{
                $connexion=NULL;         
               }
            
    
    ?>
</body>
</html>