<?php
    include 'connection.php';
    include 'functions.php';
?>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Raiden starts developing</title>
        <link rel="stylesheet"href="css/style.css">
        <link rel="stylesheet" href="css/exam.css">
        <script src="scripts/vanila.js"></script>
        <script src="scripts/exam.js"></script>
        <div ></div>
    </head>
    <body>
        <?php include 'parts/nav_bar.php' ?>
        <div id="home">
            <div id="create_exam"><a href="create_exam.php">Create Exam</a></div>
            <div id="exam_list_container">
                <h2>Recent Exams:</h2>
                 <?php
                            $query = "SELECT * FROM exams ORDER BY id DESC ";
                            $result = mysqli_query($con,$query);
                            if ($result){
                                while($row = mysqli_fetch_array($result))
                                {
                                    echo get_exam_list_item($row);
                                }
                            }
                    ?>
            </div>
        </div>
    </body>
</html>