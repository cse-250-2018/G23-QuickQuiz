<?php
    include 'connection.php';
    include 'functions.php';
?>

<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Random Quiz</title>
        <link rel="stylesheet"href="css/style.css">
        <link rel="stylesheet" href="css/quiz.css">
        <script src="scripts/quiz.js"></script>
        <div ></div>
    </head>
    <body>
        <?php include 'parts/nav_bar.php' ?>
        
        
       <div id="home"> 
            
            <div class="box-2">
                <h1 id="heading">Random Quiz</h1>
                <form method="POST" enctype="multipart/form-data" action="randomQuiz.php">
                    <div class="form-group">
                        <label>Course Name:</label>
                        <select name="course">
                            <option value="any">Random</option>
                            <option value="Structured Programming Language">Structured Programming Language</option>
                            <option value="Discrete Math">Discrete Math</option>
                            <option value="Data Structures">Data Structures</option>
                            <option value="Algorithm Design & Analysis">Algorithm Design & Analysis</option>
                            <option value="Object Oriented Programming">Object Oriented Programming </option>
                            <option value="Numerical Analysis">Numerical Analysis </option>
                            <option value="Theory of Computation">Theory of Computation</option>
                            <option value="Ethics & Cyber Law"> Ethics & Cyber Law </option>
                            <option value="Digital Signal Processing">Digital Signal Processing </option>
                            <option value="Database System"> Database System </option>
                            <option value="Operating System"> Operating System </option>
                            <option value="Computer Networking"> Computer Networking </option>
                            <option value="Computer Graphics"> Computer Graphics </option>
                            <option value="Computer Architecture"> Computer Architecture </option>
                            <option value="Artificial Intelligence"> Artificial Intelligence </option>
                            <option value="Machine Learning"> Machine Learning </option>
                            <option value="Others"> Others </option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>No. of Questions:</label>
                        <input type="number" min="1" max="200" value="5" name="noQ" required>
                        <script>
                            document.querySelector('input').addEventListener('input', e=>{
                                const el = e.target || e

                                if(el.type == "number" && el.max && el.min ){
                                    let value = parseInt(el.value)
                                    el.value = value
                                    let max = parseInt(el.max)
                                    let min = parseInt(el.min)
                                    if ( value > max ) el.value = el.max
                                    if ( value < min ) el.value = el.min
                                }
                            });
                        </script>
                    </div>

                    <input id="button" type="submit" name="submit" value="Start">
                </form>

            </div>
        </div>
       
    </body>
</html>
