<?php

	
	$msg = "";
	include 'functions.php';
	include 'connection.php';
    
    if(!isset($_GET['id']))
    {
        header("Location:profile.php");
        die;
    }
	
	if(isset($_SESSION['msg']))
	{
		$msg=$_SESSION['msg'];
	}
	$id=$_GET['id'];
    $sql = "SELECT * FROM notes WHERE ID = '".$_GET['id']."' ";
    $result = mysqli_query($con, $sql);
	
    $author="-1";
    if($result && mysqli_num_rows ( $result )>0)
    {
        $row = mysqli_fetch_assoc($result);
        $name=$row['Name'];
        $course=$row['Course'];
        $type=$row['Type'];
        $author=$row['Author'];
        $time=$row['Time'];
        $folder="notes/".$author."/";
        $file=$folder."/".$name;
    }
    
    if($author != $_SESSION['current_user'])
    {
        header("Location:profile.php");
        die;
    }
	
?>

<html>
<head>
	<title> Edit Note info </title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="stylesheet" type="text/css" href="css/form.css">
</head>

<body>
	<?php include 'parts/nav_bar.php' ?>
	<div id="container">
		<div id="form_total">
				<div id="form_lft">
					<div id="lft1">
						<img src="images/edit.png" width="370" height="490">
											</div>
					<div id="lft2"><img src="images/form_right.svg"></div>
				</div>
                
				<form id="form_rht" action="noteRename.php" method="POST">
				<?php echo $msg; ?>
					<div id="form_title">Edit Note Information</div>
					<label class="inp_lbl">File Name</label>
					<input class="inp" type="text" name="fileName" value="<?php echo $name; ?>" >
                    <input type="hidden" name="id" value="<?php echo $id; ?>" >
					<label class="inp_lbl">Course</label>
                    <select class="inp" name="course">
                        <option value="Structured Programming Language" <?php if($course == "Structured Programming Language") echo "selected"; ?> >Structured Programming Language</option>
                        <option value="Discrete Math" <?php if($course == "Discrete Math") echo "selected"; ?> >Discrete Math</option>
                        <option value="Data Structures" <?php if($course == "Data Structures") echo "selected"; ?> >Data Structures</option>
                        <option value="Algorithm Design & Analysis" <?php if($course == "Algorithm Design & Analysis") echo "selected"; ?> >Algorithm Design & Analysis</option>
                        <option value="Object Oriented Programming" <?php if($course == "Object Oriented Programming") echo "selected"; ?> >Object Oriented Programming </option>
                        <option value="Numerical Analysis" <?php if($course == "Numerical Analysis") echo "selected"; ?> >Numerical Analysis </option>
                        <option value="Theory of Computation" <?php if($course == "Theory of Computation") echo "selected"; ?> >Theory of Computation</option>
                        <option value="Ethics & Cyber Law" <?php if($course == "Ethics & Cyber Law") echo "selected"; ?> > Ethics & Cyber Law </option>
                        <option value="Digital Signal Processing" <?php if($course == "Digital Signal Processing") echo "selected"; ?> >Digital Signal Processing </option>
                        <option value="Database System" <?php if($course == "Database System") echo "selected"; ?> > Database System </option>
                        <option value="Operating System" <?php if($course == "Operating System") echo "selected"; ?> > Operating System </option>
                        <option value="Computer Networking" <?php if($course == "Computer Networking") echo "selected"; ?> > Computer Networking </option>
                        <option value="Computer Graphics" <?php if($course == "Computer Graphics") echo "selected"; ?> > Computer Graphics </option>
                        <option value="Computer Architecture" <?php if($course == "Computer Architecture") echo "selected"; ?> > Computer Architecture </option>
                        <option value="Artificial Intelligence" <?php if($course == "Artificial Intelligence") echo "selected"; ?> > Artificial Intelligence </option>
                        <option value="Machine Learning" <?php if($course == "Machine Learning") echo "selected"; ?> > Machine Learning </option>
                        <option value="Others" <?php if($course == "Others") echo "selected"; ?> > Others </option>

                    </select>
                    
                    <label class="inp_lbl">Type</label>
                    <select class="inp" name="type">
                        <option value="public" <?php if($type == "public") echo "selected"; ?> >Public</option>
                        <option value="private" <?php if($type == "private") echo "selected"; ?> >Private</option>
                    </select>
                    
					<div class="inp_btn_container"><button class="inp_btn" type="submit" name="submit">Update</button></div>
				</form>
			</div>
	</div>
</body>

</html>
