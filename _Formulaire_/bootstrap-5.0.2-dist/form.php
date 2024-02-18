<?php
// Connexion à la base de données
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ocp";

// Créer une nouvelle connexion
$conn = new mysqli($servername, $username, $password, $dbname);

// Vérifier la connexion
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Récupérer les valeurs du formulaire
$nom = $_POST['nom'];
$prenom = $_POST['prenom'];
$email = $_POST['email'];
$password = $_POST['password'];
$filiere = $_POST['filiere'];
$duree = $_POST['duree'];
$lettre = $_POST['lettre'];
$cv = $_FILES['formFile']['name'];

// Télécharger le fichier CV
$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["formFile"]["name"]);
move_uploaded_file($_FILES["formFile"]["tmp_name"], $target_file);

// Préparer la requête SQL
$sql = "INSERT INTO mesStagiaires (nom, prenom, email, password, filiere, duree, lettre, cv)
VALUES ('$nom', '$prenom', '$email', '$password', '$filiere', '$duree', '$lettre', '$cv')";

// Exécuter la requête SQL
if ($conn->query($sql) === TRUE) {
  echo "Nouvel enregistrement créé avec succès";
} else {
  echo "Erreur : " . $sql . "<br>" . $conn->error;
}

// Fermer la connexion
$conn->close();
?>