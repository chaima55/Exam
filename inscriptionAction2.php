<?php
try
{
    $servername = "localhost";
    $user = "root";
    $password = "";
    $database = "qna";
    $conn = new PDO("mysql:host=$servername;dbname=$database", $user, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        $email = $_POST['email'];
        $username = explode("@", $email) [0];
        $Role = "";
        if (isset($_POST['etudiant']))
        {
            $Role = "ROLE_ETUDIANT";
        }
        else
        {
            $Role = "ROLE_PROF";
        }
        $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
        $pass = '';
        $alphaLength = strlen($alphabet) - 1;
        for ($i = 0;$i < 10;$i++)
        {
            $n = rand(0, $alphaLength);
            $pass = $pass . $alphabet[$n];
        }
        $addQuestion = $conn->prepare('INSERT INTO users(username,password,roles,email) VALUES (:username,:password,:roles, :email)');
        $addQuestion->bindParam(':username', $username);
        $addQuestion->bindParam(':password', $pass);
        $addQuestion->bindParam(':roles', $Role);
        $addQuestion->bindParam(':email', $email);

        $addQuestion->execute();
    }
    echo $email;
    echo "<br>";
    echo $pass;
}

catch(PDOException $e)
{
    echo "Error: " . $e->getCode();
    if ($e->getCode()==23000){
        echo "Email already exists";
    }
}
$conn = null;

?>
