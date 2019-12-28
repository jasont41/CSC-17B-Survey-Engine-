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
        <h1>This is a simple survey engine</h1>
        <h2>This site has been made so users can create a three question survey
            for participants to complete. The survey creator can then log in at any time to 
            see what participants have said. </h2>
        <div id='list'>
            <h3>Using this site takes just three easy steps: 
                <ol>
                    <li>Click 'Create a survey' and make an account</li>
                    <li>Send out the survey number and the URL to participants</li>
                    <li>Log back in and see the responses you received </li>
                </ol>
            </h3>
        </div>
        <?php
        if (isset($_SESSION['username'])) {
            echo "You're logged in <br>";
        }
        ?>
    </body>
</html>