<?php
    include 'connection.php';
?>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Raiden starts developing</title>
        <link rel="stylesheet" href="css/style.css">
        <script src="scripts/run.js"></script>
        <div ></div>
    </head>
    <body>
        <?php include 'parts/nav_bar.php' ?>
        <div id="home">
            <div id="front_page">
                <div id="front_left">
                    <p>Wellcome to</p>
                    <h2>Quick Quiz</h2>
                    <div id="btn_container">
                        <div id="btn1">Contact Us</div>
                        <div id="btn2">About Us</div>
                    </div>
                </div>
                <div id="front_right">
                    <img src="images/bg.svg">
                </div>
                
            </div>
            <div id="cards_container">
                <a href="create_exam.php"><div class="card" id="card_1">
                    <img src="images/exam.svg">
                    <div id="card_bottom_quiz">
                        <h3>Exam & Quizes</h3>
                        <p>Random texts here. I don't even know what kind of things I'm saying. My hand kept typing and my mind went dead. Picking up the pieces now where to begin. The hardest part of ending is starting again</p>
                    </div>
                    </div></a>
                <a href="#"><div class="card" id="card_2">
                    <img src="images/books.svg">
                    <div id="card_bottom_notes">
                        <h3>Notes</h3>
                        <p>Random texts here. I don't even know what kind of things I'm saying. My hand kept typing and my mind went dead. Picking up the pieces now where to begin. The hardest part of ending is starting again</p>
                    </div>
                    </div></a>
                <a href="forum.php"><div class="card" id="card_3">
                    <img src="images/community.svg">
                    <div id="card_bottom_blog">
                        <h3>Forum</h3>
                        <p>Random texts here. I don't even know what kind of things I'm saying. My hand kept typing and my mind went dead. Picking up the pieces now where to begin. The hardest part of ending is starting again</p>
                    </div>
                    </div></a>

            </div>
        </div>
    </body>
</html>