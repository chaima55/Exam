<?php
$name = $_POST["name"];
//file parsing
//print_r ($_FILES["fileToUpload"]);
$txtfile = file_get_contents($_FILES["fileToUpload"]["name"]);
$rows = explode("\n", $txtfile);
array_shift($rows);
try {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "qna";
    $conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        //add cours
        $addCours = $conn->prepare('INSERT INTO cours(nom) VALUES (:nom)');
        $addCours->bindParam(':nom', $name);
        $addCours->execute();
        $dataCours = $conn->lastInsertId();
        foreach ($rows as $row => $data) {
           
            echo "<br>";
            $question = explode("*", $data);
            $addQuestion = $conn->prepare('INSERT INTO question(contenue,coursid) VALUES (:contenue,:coursid)');
            $addQuestion->bindParam(':contenue', $question[1]);
            $addQuestion->bindParam(':coursid', $dataCours);
            $addQuestion->execute();
            $dataQuestion = $conn->lastInsertId();
            $reponses = explode("+", $question[2]);
            $reponsesCorrecte = explode("^", $question[3]);
            $addReponse = $conn->prepare('INSERT INTO reponse(contenue,iscorrect,questionid) VALUES (:contenue,:iscorrect,:questionid)');
            $addReponse->bindParam(':contenue', $rep);
            $addReponse->bindParam(':questionid', $dataQuestion);
            echo $question[0];
            echo " question :";
            echo $question[1];
            echo "<br>";
            echo "all reponses";
            echo "<br>";

            foreach ($reponses as $rep) {
                echo $rep;
                for ($i = 0; $i < sizeof($reponsesCorrecte); $i++) {
                    $bool = 0;
                    if (rtrim($reponsesCorrecte[$i]) === $rep) {
                        echo "✔️";
                        $bool = 1;
                        break;
                    }
                }
                $addReponse->bindParam(':iscorrect', $bool);
                $addReponse->execute();
                echo "<br>";

            }
            echo "<br>";
            echo "all correctes";
            echo "<br>";

            foreach ($reponsesCorrecte as $cor) {
                echo $cor;
                echo "<br>";

            }

        }

    }
echo "<a href='allCourses.php'>all courses</a>";


} catch (PDOException $e) {
    echo  "<br>" . $e->getMessage();
}

?>
