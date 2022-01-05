<?php
    include 'connection.php';
    if(!isset($_SESSION['current_user']))
    {
        header("Location:login.php");
        die;
    }
 
    if(!isset($_SESSION['leaderboard_Rank']))
    {
        $_SESSION['leaderboard_Rank']='ASC';
    }
?>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>LeaderBoard</title>
        <link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" href="css/leaderboard.css">
    </head>
    <body style="background-image: url(images/form_page_bg.svg);">
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
                    $sql = "SELECT RANK() OVER (ORDER BY `".$course."` DESC, `".$course." Total` ASC) AS Rank, `user`, `".$course."` AS Marks, `".$course."`*100/`".$course." Total` AS Accuracy FROM `leaderboard`WHERE 1 AND `".$course." Total` > 0";
                
                    $sql = " SELECT * FROM ( $sql ) AS tmp WHERE 1 ";
                    $sort = "ORDER BY Rank ASC";
                    if(isset($_SESSION['leaderboard_sort']))
                    {
                        $sort = $_SESSION['leaderboard_sort'];
                    }
                    $sql = $sql.$sort;
        
                    $result = mysqli_query($con, $sql);


                 ?>
                    <table>
                            <tr>
                                <th>Rank
                                <?php 
                                        if(($_SESSION['leaderboard_Rank']) == "Both")
                                            echo "<a href='leaderboardSort.php?sort=Rank&cnt=1'><img src='images/both.gif' style='position: relative; right 3px; verticale aign: middle;'></a>";
                                        else if($_SESSION['leaderboard_Rank'] == "DESC")
                                             echo "<a href='leaderboardSort.php?sort=Rank&cnt=1'><img src='images/downvote_icon.svg' style='position: relative; right 3px; verticale aign: middle;'></a>";
                                        else
                                            echo "<a href='leaderboardSort.php?sort=Rank&cnt=0'><img src='images/upvote_icon.svg' style='position: relative; right 3px; verticale aign: middle;'></a>";
                                ?>
                                </th>
                                <th>User Name
                                <?php 
                                        if(!isset($_SESSION['leaderboard_user']))
                                            echo "<a href='leaderboardSort.php?sort=user&cnt=1'><img src='images/both.gif' style='position: relative; right 3px; verticale aign: middle;'></a>";
                                        else if($_SESSION['leaderboard_user'] == "DESC")
                                             echo "<a href='leaderboardSort.php?sort=user&cnt=1'><img src='images/downvote_icon.svg' style='position: relative; right 3px; verticale aign: middle;'></a>";
                                        else
                                            echo "<a href='leaderboardSort.php?sort=user&cnt=0'><img src='images/upvote_icon.svg' style='position: relative; right 3px; verticale aign: middle;'></a>";
                                ?>
                                </th>

                                <th>Marks
                                
                                </th>

                                <th>Accuracy
                                <?php 
                                        if(!isset($_SESSION['leaderboard_Accuracy']))
                                            echo "<a href='leaderboardSort.php?sort=Accuracy&cnt=1'><img src='images/both.gif' style='position: relative; right 3px; verticale aign: middle;'></a>";
                                        else if($_SESSION['leaderboard_Accuracy'] == "DESC")
                                             echo "<a href='leaderboardSort.php?sort=Accuracy&cnt=1'><img src='images/downvote_icon.svg' style='position: relative; right 3px; verticale aign: middle;'></a>";
                                        else
                                            echo "<a href='leaderboardSort.php?sort=Accuracy&cnt=0'><img src='images/upvote_icon.svg' style='position: relative; right 3px; verticale aign: middle;'></a>";
                                ?>
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
                              <td><?php echo $accuracy." %" ?></td>
                    <?php

                    }

                    ?>

                     </table>

    </body>
</html>
