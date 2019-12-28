<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link rel="stylesheet" type="text/css" href="style.css">
    </head>
    <body>
        <header>
            <a href='index.php'><img src="survey.png" height=100 width=100></a>
        </header>
        <nav>
            <ul>
                <li class="selected"><a href="take_survey.php">Take Survey</a></li>
                <li><a href="creator_register.php">Create a Survey</a></li>
                <li><a href="creator_log_in.php">See Survey Response</a></li>
            </ul>
        </nav>
        <?php
        require_once 'login.php';
        $conn = new mysqli($hn, $un, $pw, $db);
        if ($conn->connect_error) {
            die("Fatal Error");
        }
        session_start();
        if (isset($_SESSION['survey_num'])) {
            $survey_num = $_SESSION['survey_num'];
            $query = "select * from user_creator where survey_num = '$survey_num'";
            $result = $conn->query($query);
            if (!$result) {
                echo "it didn't work";
            } else {
                echo "<div id='list'>";
                $row = $result->fetch_array(MYSQLI_NUM);
                echo "Question 1: " . $row[2] . "<br>";
                echo "Question 2: " . $row[3] . "<br>";
                echo "Question 3: " . $row[4] . "<br>";
                echo "</div>"; 
            }
        } else if (!isset($_SESSION['survey_num'])) {
            echo "The session didnt take <br>";
        }
        if(isset($_POST['survey_answers'])){
            //$survey_num = $_SESSION['survey_num']; 
            $q1 = get_post($conn, 'q1'); 
            $q2 = get_post($conn, 'q2'); 
            $q3 = get_post($conn, 'q3'); 
            $query = "INSERT INTO survey_ans VALUES ('$survey_num','$q1','$q2','$q3')"; 
            $result = $conn->query($query); 
            if(!$result){
                echo "fuck it didn't work <br>"; 
            }
            header('location:index.php');
        }
        function get_post($conn, $var) {
            return $conn->real_escape_string($_POST[$var]);
        }
        ?>
        <div id='list'>
        <form action ="survey_response.php" method="post">
            <pre>
            Question #1 <input type="text" name="q1">
            Question #2 <input type="text" name ="q2">
            Question #3 <input type="text" name="q3">
            <input type="hidden" name="survey_answers"> 
            <input type="submit" value ="Submit your response">
            </pre>
        </form>
        </div>
    </body>
</html>
