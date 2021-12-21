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
        
        <link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" href="css/notes.css">
    </head>
    <body>
        <?php include 'parts/nav_bar.php' ?>
        <div id="center">
            <div class="notes_home_container">
                
                
                <div class="box-2">
                    <h1 id="heading">Upload File</h1>
                    <form method="POST" enctype="multipart/form-data" action="upload.php">
                        <div class="form-group">
                            <label>Course Name:</label>
                            <select name="course">
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
                            <label>Type:</label>
                            <select name="type">
                                <option value="public">Public</option>
                                <option value="private">Private</option>
                            </select>
                        </div>
                        
                        <div class="form-group">
                            <label>Note(Only pdf):</label>
                            <input type="file" class="choose" name="file" accept=".pdf" required />
                        </div>
                        
                        <input type="hidden" name="author" value="<?php echo $_SESSION['current_user'] ?>">
                        <input id="button" type="submit" name="submit" value="Upload">
                </form>
        
            </div>
                
                <?php
    
                        
                        $sql = "SELECT * FROM notes WHERE Type = 'public' ";
                        $sort = "ORDER BY ID DESC";
                        if(isset($_SESSION['sort']))
                        {
                            $sort = $_SESSION['sort'];
                            //echo $sort."<br>";
                            //unset($_SESSION['sort']);
                        }
                        
                        $sql = $sql.$sort;
                        //echo $sql;
                        $result = mysqli_query($con, $sql);
                        
        
                     ?>
                        <table>
                                <tr>
                                    <th>Author
                                    <?php 
                                        if(!isset($_SESSION['A_type']))
                                            echo "<a href='noteSort.php?sort=Author&cnt=1'><img src='images/both.gif' style='position: relative; right 3px; verticale aign: middle;'></a>";
                                        else if($_SESSION['A_type'] == "DESC")
                                             echo "<a href='noteSort.php?sort=Author&cnt=1'><img src='images/downvote_icon.svg' style='position: relative; right 3px; verticale aign: middle;'></a>";
                                        else
                                            echo "<a href='noteSort.php?sort=Author&cnt=0'><img src='images/upvote_icon.svg' style='position: relative; right 3px; verticale aign: middle;'></a>";
                                    ?>
                                    </th>
                                    
                                    <th>File Name
                                    <?php 
                                        if(!isset($_SESSION['N_type']))
                                            echo "<a href='noteSort.php?sort=Name&cnt=1'><img src='images/both.gif' style='position: relative; right 3px; verticale aign: middle;'></a>";
                                        else if($_SESSION['N_type'] == "DESC")
                                             echo "<a href='noteSort.php?sort=Name&cnt=1'><img src='images/downvote_icon.svg' style='position: relative; right 3px; verticale aign: middle;'></a>";
                                        else
                                            echo "<a href='noteSort.php?sort=Name&cnt=0'><img src='images/upvote_icon.svg' style='position: relative; right 3px; verticale aign: middle;'></a>";
                                    ?>
                                    </th>
                                    
                                    <th>Course
                                    <?php 
                                        if(!isset($_SESSION['C_type']))
                                            echo "<a href='noteSort.php?sort=Course&cnt=1'><img src='images/both.gif' style='position: relative; right 3px; verticale aign: middle;'></a>";
                                        else if($_SESSION['C_type'] == "DESC")
                                             echo "<a href='noteSort.php?sort=Course&cnt=1'><img src='images/downvote_icon.svg' style='position: relative; right 3px; verticale aign: middle;'></a>";
                                        else
                                            echo "<a href='noteSort.php?sort=Course&cnt=0'><img src='images/upvote_icon.svg' style='position: relative; right 3px; verticale aign: middle;'></a>";
                                    ?>
                                    </th>
                                    
                                    <th>Published
                                    <?php 
                                        if(!isset($_SESSION['T_type']))
                                            echo "<a href='noteSort.php?sort=Time&cnt=1'><img src='images/both.gif' style='position: relative; right 3px; verticale aign: middle;'></a>";
                                        else if($_SESSION['T_type'] == "DESC")
                                             echo "<a href='noteSort.php?sort=Time&cnt=1'><img src='images/downvote_icon.svg' style='position: relative; right 3px; verticale aign: middle;'></a>";
                                        else
                                            echo "<a href='noteSort.php?sort=Time&cnt=0'><img src='images/upvote_icon.svg' style='position: relative; right 3px; verticale aign: middle;'></a>";
                                    ?>
                                    </th>
                                    
                                    <th>View</th>
                                    <th>Download</th>
                                </tr>
                         <?php 
                         while($row=mysqli_fetch_array($result))
                         {	
                              $name=$row['Name'];
                              $course=$row['Course'];
                              $type=$row['Type'];
                              $author=$row['Author'];
                              $time=$row['Time'];
                              $folder="notes/".$author."/";
                              $file=$folder."/".$name;
                         ?>
                              <tr>
                                  <td><?php echo $author ?></td>
                                  <td><?php echo $name ?></td>
                                  <td><?php echo $course ?></td>
                                  <td><?php echo $time ?></td>
                                  <td><a href="<?php echo $file ?>"> <button id="button2">View</button> </a></td>
                                  <td><a download="<?php echo $name ?>" href="<?php echo $file ?>" >  <button id="button2">Download</button> </a></td>
                             </tr>
                        <?php

                            }

                        ?>

                         </table>
                    </div>
        </div>

    </body>
</html>
