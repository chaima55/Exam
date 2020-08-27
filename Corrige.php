<?php
try {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "qna";
    $conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "SELECT contenue,id  FROM question WHERE  coursid=" . $_GET['id'];
    $result = $conn->query($sql);
    $score = 0;
    foreach ($result as $row) {
        $respo = $row['id'];
        $sql1 = "SELECT contenue,id  FROM reponse  WHERE  questionid=" . $respo;
        $sqlCorrecte = "SELECT contenue,id  FROM reponse  WHERE  iscorrect=1 and questionid=" . $respo;
        $result1 = $conn->query($sql1);
        $result2 = $conn->query($sqlCorrecte);
        $correte = [];
        foreach ($result2 as $res2) {
            array_push($correte, $res2["contenue"]);
        }
        $error = false;
        $questScore = 0;
        foreach ($result1 as $res1) {

            $varName = $respo . $res1["id"];
            echo $res1["contenue"];
            if (isset($_POST[$varName])) {

                $varName = $_POST[$varName];
                if (in_array($varName, $correte)) {
                    echo "✔️️";
                    $questScore++;
                } else {
                    echo "❌";
                    $error = true;
                }

            }
            echo "<br>";

        }
        if (!$error) {
            $score += $questScore;
        }
    }
    echo "Your score is: " . $score;
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
$conn = null;

?>
