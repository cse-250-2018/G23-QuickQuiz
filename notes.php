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

                <div class="box-2">
                    <h1 id="heading">Upload File</h1>
                    <form method="POST" enctype="multipart/form-data" action="upload.php">
                        <div class="form-group">
                            <label>Course Name:</label>
                            <select name="course">
                                <option value="SPL">Structured Programming Language</option>
                                <option value="DM">Discrete Math</option>
                                <option value="DS">Data Structures</option>
                                <option value="ALGO">Algorithm Design & Analysis</option>
                                <option value="OOP"> OOP </option>
                                <option value="NA">Numerical Analysis </option>
                                <option value="TOC">Theory of Computation</option>
                                <option value="ECL"> Ethics & Cyber Law </option>
                                <option value="DSP">Digital Signal Processing </option>
                                <option value="DB"> Database System </option>
                                <option value="OSS"> Operating System </option>
                                <option value="CN"> Computer Networking </option>
                                <option value="CG"> Computer Graphics </option>
                                <option value="CA"> Computer Architecture </option>
                                <option value="AI"> Artificial Intelligence </option>
                                <option value="ML"> Machine Learning </option>
                
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
                                    <th>Author</th>
                                    <th>File Name</th>
                                    <th>Course</th>
                                    <th>Published</th>
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

    </body>
</html>
