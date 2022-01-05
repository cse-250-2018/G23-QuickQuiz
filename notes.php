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
        <link rel="stylesheet" href="css/form.css">
        <link rel="stylesheet" href="css/notes.css">
    </head>
    <body style="background-image: url(images/form_page_bg.svg);">
        <?php include 'parts/nav_bar.php' ?>
        
        <div id="container" style="min-height:0; padding:5px;">
            <div id="form_total">
                <div id="form_lft">
                    <div id="lft1">
                        <img src="images/file2.png" width="370" height="490">
                                            </div>
                    <div id="lft2"><img src="images/form_right.svg"></div>
                </div>

                <form id="form_rht" action="upload.php" method="POST" enctype="multipart/form-data">
                    <div id="form_title">Upload File</div>
                    <label class="inp_lbl">Course Name:</label>
                    <select class="inp" name="course"> 
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
                    <label class="inp_lbl">Type:</label>
                    <select class="inp" name="type">
                        <option value="public">Public</option>
                        <option value="private">Private</option>
                    </select>
                    <label class="inp_lbl">Note(Only pdf):</label>
                    <input type="file" class="inp" id="choose" name="file" accept=".pdf" required />
                    
                    <input type="hidden" name="author" value="<?php echo $_SESSION['current_user'] ?>">
                    <input class="inp_btn" type="submit" name="submit" value="Upload">
                </form>
            </div>  
        </div>
        <div id="center">
            <div class="notes_home_container">
                
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
                                  <td><a class="view" href="<?php echo $file ?>"> View </a></td>
                                  <td><a class="download" download="<?php echo $name ?>" href="<?php echo $file ?>" > Download</a></td>
                        <?php

                            }

                        ?>

                         </table>
                    </div>
        </div>

    </body>
</html>
