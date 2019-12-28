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
    </head>
    <body>
        <form action="user_register.php" method="post">
            Username <input type="text" name="username">
            Password <input type="text" name="password">
            <input type="hidden" name="create_user">
            <input type="submit" value="REGISTER!">
        </form>
        <?php
        require_once 'login.php'; 
        $conn = new mysqli($hn,$un,$pw,$db); 
        if($conn->connect_error){
            die; 
        }
        if(isset($_POST['create_user'])){
            $username = get_post($conn, 'username'); 
            $password = get_post($conn,'password'); 
            $query = "INSERT INTO user_survey_user VALUES ('$username','$password')";
            $result = $conn->query($query); 
            if(!$result){
                echo "Oops something went wrong <br>"; 
            }
        }
        function get_post($conn,$var){
            return $conn->real_escape_string($_POST[$var]);
        }
        ?>
    </body>
</html>
