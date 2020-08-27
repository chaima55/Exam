<?php
$email = $_POST['email'];
$Role_Etudiant = $_POST['etudiant'];
$Role_Prof = $_POST['Prof'];
try {
    $servername = "localhost";
    $user = "root";
    $password = "";
    $database = "qna";
    $conn = new PDO("mysql:host=$servername;dbname=$database", $user, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
     $addEmail = $conn->prepare('INSERT INTO users(email) VALUES (:email)');
        $addEmail->bindParam(':email', $email);
        $addEmail->execute();
       $reponse = $conn->query('SELECT * FROM users');
        $donnees = $reponse->fetch();
        $id = $donnees['id'];
       // print_r( $donnees);
        foreach ($donnees as $row => $data) {
        $parts=explode('@',$email);
        //echo $parts[0];
        $addUsername = $conn->prepare('INSERT INTO users(username) VALUES (:username)');
        $addUsername->bindParam(':username',$parts[0]);
        $addUsername->execute();
       // $addUsername->$row;
        $addRole = $conn->prepare('INSERT INTO users(roles) VALUES (:roles)');
        if (isset($Role_Etudiant))
        {
            $addRole->bindParam(':roles', $Role_Etudiant);
        
        }elseif($Role_Prof){
          
            $addRole->bindParam(':roles',$Role_Prof);
        }
        $addRole->execute();
       echo $id;
        $addPass = $conn->prepare('INSERT INTO users(motDEpasse) VALUES (:motDEpasse)');
        function Genere_Password($size)
    { 
    // Initialisation des caractères utilisables
    $characters = array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, "a", "b", "c", "d", "e", "f", "g", "h", "i", "j", "k", "l", "m", "n", "o", "p", "q", "r", "s", "t", "u", "v", "w", "x", "y", "z");

    for($i=0;$i<$size;$i++)
    {
        $donnees['motDEpasse'] .= ($i%2) ? strtoupper($characters[array_rand($characters)]) : $characters[array_rand($characters)];
    }
		
    return $donnees['motDEpasse'];
}
}

// Petit exemple

$mon_mot_de_passe = Genere_Password(10);

echo $mon_mot_de_passe;

        $addPass->bindParam(':motDEpasse',$donnees['motDEpasse'] );
        
        $addPass->execute();
        }
        
    }
    





catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
$conn = null;




?>