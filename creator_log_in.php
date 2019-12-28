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
    <div id='list'>
        <h3>
    <form action="creator_log_in.php" method="post"> 
        <pre>
        Username<input type="text" name="username">
        Password<input type="password" name="password">
        <input type="hidden" name="user_login">
        <input type="submit" value="LOGIN!"> 
        </pre>
    </form>
        </h3>
    </div>
    <body>
        <?php
        require_once 'login.php';
        $conn = new mysqli($hn, $un, $pw, $db);
        if ($conn->connect_error)
            die($conn->connect_error);
        if(isset($_POST['user_login'])){
            $username = get_post($conn, 'username'); 
            $password = get_post($conn, 'password'); 
            
            $query = "SELECT * from user_creator where username = '$username' and password = '$password'"; 
            $result = $conn->query($query); 
            if(!$result){
                echo "There is no account in the database with those credentials <br>"; 
            }
            else if($result){
                
                session_start(); 
                $_SESSION['username'] = $username; 
                $query2 = "select survey_num from user_creator where username='$username'"; 
                $result2 = $conn->query($query2); 
                $temp = mysqli_fetch_array($result2); 
                $survey_num_holder = $temp[0]; 
                $query3 = "SELECT * FROM survey_ans where survey_num ='$survey_num_holder'"; 
                $result3 = $conn->query($query3); 
                if(!$result3)
                    echo "Something went wrong"; 
                $rows = $result3->num_rows; 
                if($rows === 0){
                    echo "There's nothing to show <br>"; 
                }
                else if($rows > 0){
                    echo "<table>";
                    for($j = 0; $j < $rows; ++$j){
                        $result3->data_seek($j); 
                        $row = $result3->fetch_array(MYSQLI_NUM); 
                        echo "<tr>";
                        echo "<td> Question 1 " .$row[1] . "</tr>"; 
                        echo "<td> Question 2 " . $row[2] . "</tr>";
                        echo "<td> Question 3 " . $row[3] . "</tr>";
                        echo "</tr>"; 
                    }
                    echo "</table>"; 
                }
            }
        }
        function get_post($conn, $var) {
            return $conn->real_escape_string($_POST[$var]);
        }
        ?>
    </body>
</html>
