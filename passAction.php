<?php

try {
     $servername = "localhost";
       $username = "root";
       $password = "";
       $database = "qna";
       $conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "SELECT contenue,id  FROM question WHERE  coursid=".$_GET['id'] ;//****** */
    $result = $conn->query($sql);
    //****** */
    echo "<table>";
    $count=0;
    echo " <form action='Corrige.php?id=".$_GET['id'] ."'method='post' enctype='multipart/form-data'>";//****** */
        echo"<div class='form-group'>";
    foreach ($result as $row) {
     //****** *
       echo  ++$count;
     //print_r($row) ;
     $respo = $row['id'];
       echo  $row['contenue'];
       $sql1 = "SELECT contenue,id  FROM reponse  WHERE  questionid=".$respo ;//****** */
    $result1 = $conn->query($sql1);
     foreach($result1 as $res1){
      echo "<br>";
       echo '<label>'.$res1["contenue"].'</label>';
       echo '<input type="checkbox" id="scales" value="'.$res1["contenue"].'"name="'.$respo.$res1["id"].'">';
       echo "<br>";
       }
       
       
 
     }
     echo"</div>";
     echo" <button type='submit' class='btn btn-primary'>Submit</button>";
     echo" </form>";

}
catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
$conn = null;

?>