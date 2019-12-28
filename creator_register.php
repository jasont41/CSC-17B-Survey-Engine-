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
        <div id='list'>
            <h3>
                <form action="creator_register.php" method="post">
                    <pre>
                Username<input type="text" name="username">
                Password<input type="password" name="password" pattern="^.{4,8}$">
                Question #1<input type="text" name="q1">
                Question #2<input type="text" name="q2">
                Question #3<input type="text" name="q3">
                <input type="hidden" name="create_user">
                <input type="submit" value="REGISTER">
                    </pre>
                </form>
            </h3>
        </div>
        <?php
        require_once 'login.php';

        $conn = new mysqli($hn, $un, $pw, $db);
        if ($conn->connect_error) {
            die;
        }
        $query = "select count(*) from user_creator";
        $result = $conn->query($query);
        if (!$result)
            echo "it didn't work";
        $count = mysqli_fetch_array($result);
        $survey_num = $count[0] + 10238;



        if (isset($_POST['create_user'])) {
            $username = get_post($conn, 'username');
            $password = get_post($conn, 'password');
            $q1 = get_post($conn, 'q1');
            $q2 = get_post($conn, 'q2');
            $q3 = get_post($conn, 'q3');
            $query = "INSERT INTO user_creator VALUES "
                    . "('$username','$password','$q1','$q2','$q3','$survey_num')";
            $result = $conn->query($query);

            if (!$result) {
                echo "<h3>The Username you entered is already taken, try another <br></h3>";
            } else {
                global $survey_num;
                echo "<h2>Your survey number is " . $survey_num . "</h2>";
            }
        }

        function get_post($conn, $var) {
            return $conn->real_escape_string($_POST[$var]);
        }
        ?>
    </body>
</html>
