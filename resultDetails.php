<?php
    include 'connection.php';
    include 'functions.php';
?>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Result details</title>
        <link rel="stylesheet"href="css/style.css">
        <link rel="stylesheet" href="css/summary.css">
        <script src="scripts/vanila.js"></script>
        <script src="scripts/exam.js"></script>
        <div ></div>
    </head>
    <body>
        <?php include 'parts/nav_bar.php' ?>
        <div id="home">
            <div id="score_board">
                 <?php
                            if(isset($_GET['exam'])  && isset($_GET['user'])){
                                $path="results/".$_GET['user']."/exam/".$_GET['exam'].".txt";
                                if(file_exists($path))
                                {
                                    $file = fopen($path, 'r');
                                    while(!feof($file))
                                    {
                                        $code = fgets($file);
                                        echo $code;
                                    }
                                    fclose($file);
                                }
                                else
                                {
                                    echo '<br><br><div class="msg"><p align="center">Opps!! Result details file('.$path.') missing!!</p></div>';
                                }
                            }
                            else if(isset($_GET['quiz'])  && isset($_GET['user']) ){
                                $path="results/".$_GET['user']."/quiz/".$_GET['quiz'].".txt";
                                if(file_exists($path))
                                {
                                    $file = fopen($path, 'r');
                                    while(!feof($file))
                                    {
                                        $code = fgets($file);
                                        echo $code;
                                    }
                                    fclose($file);
                                }
                                else
                                {
                                    echo '<br><br><div class="msg"><p align="center">Opps!! Result details file('.$path.') missing!!</p></div>';
                                }
                            }
                            else{
                                echo"<h1>404 Not found</h1>";
                            }
                    ?>
            </div>
        </div>
    </body>
</html>