<?php
    include 'connection.php';
    if(!isset($_SESSION['current_user']))
    {
        header("Location:login.php");
        die;
    }
?>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>LeaderBoard</title>
        <link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" href="css/leaderboard.css">
    </head>
    <body>
        <?php include 'parts/nav_bar.php' ?>
            
            <form  class="flex-form" method="POST" enctype="multipart/form-data" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                <select name="course"> 
                    <option value="any">Overall</option>
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
                <input type="submit" name="submit" value="Get Ranking">
            </form>

            <?php

                    $course = "any";
                    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit']))
                        $course=$_POST['course'];
                    /*
                    SELECT RANK() OVER (ORDER BY `any` DESC, `any Total` ASC) AS Rank, `user`, `any` AS Marks, `any`*100/`any Total` AS Accuracy FROM `leaderboard`WHERE 1
                    */
                    $sql = "SELECT RANK() OVER (ORDER BY `".$course."` DESC, `".$course." Total` ASC) AS Rank, `user`, `".$course."` AS Marks, `".$course."`*100/`".$course." Total` AS Accuracy FROM `leaderboard`WHERE 1";
                        
                    $result = mysqli_query($con, $sql);


                 ?>
                    <table>
                            <tr>
                                <th>Rank</th>

                                <th>User Name
                                
                                </th>

                                <th>Marks
                                
                                </th>

                                <th>Accuracy
                                
                                </th>
                            </tr>
                     <?php 
                     while($row=mysqli_fetch_array($result))
                     {	
                          $rank=$row['Rank'];
                          $user=$row['user'];
                          $marks=$row['Marks'];
                          $accuracy=$row['Accuracy'];
                     ?>
                          <tr>
                              <td><?php echo $rank ?></td>
                              <td><?php echo $user ?></td>
                              <td><?php echo $marks ?></td>
                              <td><?php echo $accuracy ?></td>
                    <?php

                    }

                    ?>

                     </table>

    </body>
</html>