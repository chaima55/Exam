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
        $password = $_POST["pass"];
        $sql = "SELECT *  FROM users  WHERE  email='" . $email . "' AND password='" . $password . "'";
        $result = $conn->query($sql);
        if ($result->rowCount())
        {
            foreach($result as $row){
                print_r($row);
                echo "<br>";
                session_start();
                $_SESSION["UserId"] = $row['id'];
                $_SESSION["UserRoles"] = $row['roles'];
                $_SESSION["Username"] = $row['username'];

                header("Location: index.php"); 
            }
           die;

        }
        else
        {
            echo "login invalide";
        }

    }

}
catch(PDOException $e)
{
    echo "<br>" . $e->getMessage();
}

?>
