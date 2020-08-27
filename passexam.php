<?php
                              session_start();

 if(!isset($_SESSION['UserId']) || $_SESSION["UserRoles"]=="ROLE_PROF"){
     $errMsg="You cant pass exam";
    header("location:login.php?errMsg=".$errMsg);
 }
try {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "qna";
    $conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "SELECT *  FROM cours";
    $result = $conn->query($sql);
    if ($result->rowCount()) {
        echo "<table>";
        foreach ($result as $row) {
            echo "<tr>";
            echo "<td><a href='passAction.php?id=" . $row['id'] . "'>" . $row['nom'] . "</a></td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "0 Cours";
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
$conn = null;
