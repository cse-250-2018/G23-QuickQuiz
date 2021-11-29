<?php
	
	//user registration mechanism is created here
    function userRegistration($data, $con)
	{
		//get input data
        $name       = $data['name'];
        $username   = $data['username'];
        $email      = $data['email'];
        $password   = $data['password'];
        $cpassword  = $data['cpassword'];
		
		//store data for reuse in form
		$_SESSION['f_name']=$name;
		$_SESSION['f_user_name']=$username;
		$_SESSION['f_email']=$email;
		$_SESSION['f_reg']="";
		
		//empty?
		if($name ==  "" && $username ==  "" && $email ==  "" && $password ==  "" && $cpassword ==  "")
		{
            return "";
        }
		
		//name validate
        if( $name ==  "" )
		{
			return "<div class='msg'>* Name is required</div>";
		}
        if(strlen($name) < 3)
		{
            return "<div class='msg'>* Name can not be less than 3 character!</div>";
        }
		
		//username validate
		if( $username ==  "" )
		{
			return "<div class='msg'>* Usernameame is required</div>";
		}
        if(strlen($username) < 5)
		{
            return "<div class='msg'>* Username can not be lass than 5 characters</div>";
        }
		if( checkUserName($username, $con) == true)
		{
			return "<div class='msg'>* Username already exits! Choose a different one.</div>";
		}

		//email vaidate
        if(filter_var($email, FILTER_VALIDATE_EMAIL) == false){
            return "<div class='msg'>Invalid email format</div>";
        }
        if(checkEmail($email, $con) == true)
		{
            return "<div class='msg'>* Email already exist!</div>";
        }
		
		
        //password and confirm password validation
		if( $password ==  "" )
		{
			return "<div class='msg'>* Password is required</div>";
		}
        if(strlen($password) < 3)
		{
            return "<div class='msg'>* Password can not be lass than 3 characters</div>";
        }
        if($password != $cpassword)
		{
            return "<div class='msg'>* Passwords are not the same</div>";
        }


        
        //insert data if there is no error    
		$password = modifyPassword($password);//get hash
        $sql = "INSERT INTO users (name, username, email, password) values ('$name','$username', '$email', '$password')";
        $result = mysqli_query($con, $sql);

        if($result)
		{
            return "* Your account is created successfully";
        }
		else
		{
			return "<div class='msg'>* Something error in data. Try again.</div>";
		}

	}
	
	//user login check
    function userLogin($data, $con)
	{
        $username   = $data['username'];
        $password   = $data['password'];
		
		$_SESSION['f_user_name']=$username;
		
		//empty?
		if($username ==  "" && $password ==  "")
		{
            return "";
        }
		
		//username check
		if( $username ==  "" )
		{
			return "<div class='msg'>* Usernameame is required</div>";
		}
        
		if( checkUserName($username, $con) == false)
		{
			return "<div class='msg'>* This username is not registered!!</div>";
		}
		
        //password check
		if( $password ==  "" )
		{
			return "<div class='msg'>* Password is required</div>";
		}
		
		//user will be login if there is no error
  
        $sql = "SELECT * FROM users WHERE username = '$username' ";
		$result = mysqli_query($con, $sql);
		
		if(mysqli_num_rows($result) > 0)
		{	
			$row = mysqli_fetch_assoc($result);
			$ori_pass=$row['password'];//hash store ache
			
			$password=modifyPassword($password);//get hash
			if($ori_pass == $password ){	
				$user=$row['username'];
				$_SESSION['current_user']=$user;
				return "* Login successfull";
			}
			else
				return "<div class='msg'>* Password wrong!</div>";
		}

	}
	
	//all data of current user
	function getData($con)
	{
		$user="";
		if(isset($_SESSION['current_user']))
		{
			$user = $_SESSION['current_user'];
		}
		
		$query = "select * from users where user_name = '$user' limit 1";

		$result = mysqli_query($con,$query);
		if($result && mysqli_num_rows($result) > 0)
		{
			$user_data = mysqli_fetch_assoc($result);
			return $user_data;
		}
	}
	
	//email exits?
	function checkEmail($email, $con)
	{
		$sql = "SELECT * FROM users WHERE email = '$email' ";
		$result = mysqli_query($con, $sql);
		
		if(mysqli_num_rows($result) > 0)
			return true;
		else
			return false;
	}
	
	//username exits?
	function checkUserName($username, $con)
	{
		$sql = "SELECT * FROM users WHERE username = '$username' ";
		$result = $con->query($sql);
		
		if($result && mysqli_num_rows($result) > 0)
			return true;
		else
			return false;
	}
	
	
	function alreadyLogin($con)
	{

		if(isset($_SESSION['current_user']))
		{
			$username = $_SESSION['current_user'];
			$query = "SELECT * FROM users where user_name = '$username' limit 1";

			$result = mysqli_query($con,$query);
			if($result && mysqli_num_rows($result) > 0)
			{
				$user_data = mysqli_fetch_assoc($result);
				return $user_data;
			}
		}

		//redirect to login
		header("Location: login.php");
		die;
	}
	
	//hash
	function modifyPassword($password)
	{
		return hash('ripemd128', $password, false);
		//return hash('ripemd128', hash('ripemd128', $password, false), flase);
	}
	
	//checking for pass reset
    function passwordReset($data, $con)
	{
        $email   = $data['email'];
		
		$_SESSION['f_email']=$email;
		
		//email check
		if( $email ==  "" )
		{
			return "<div class='msg'>* Email is required</div>";
		}
        
		if( checkEmail($email, $con) == false)
		{
			return "<div class='msg'>* This email is not registered!!</div>";
		}
		
        $code = random_num(8);
		$_SESSION['code']=$code;
		
		//send verification code if there is no error
		$to      = $email;
		$subject = 'Password Reset';
		$message = "Verification code for password reset: $code";
		
		
		if(mail($to, $subject, $message))
		{	
			$_SESSION['email']=$email;
			return "Email send";
		}
		else
		{
			return "<div class='msg'>Something Error. Try again.</div>";
		}
	}
	
	function checkCode($data, $con)
	{
        $code   = $data['code'];
		$email 	= $_SESSION['email'];
		
		if( $code ==  "" )
		{
			return "<div class='msg'>* Code is required</div>";
		}
		if( $code != $_SESSION['code'])
		{
			return "<div class='msg'>* Code is wrong!</div>";
		}
        
		$_SESSION['reset']="yes";
		return "valid";
	}
	
	function resetUpdate($data, $con)
	{
        $email      = $_SESSION['email'];
        $password   = $data['password'];
        $cpassword  = $data['cpassword'];
		
		//empty?
		if($password ==  "" && $cpassword ==  "")
		{
            return "";
        }
				
        //password and confirm password validation
		if( $password ==  "" )
		{
			return "<div class='msg'>* Password is required</div>";
		}
        if(strlen($password) < 3)
		{
            return "<div class='msg'>* Password can not be lass than 3 characters</div>";
        }
		if( $cpassword ==  "" )
		{
			return "<div class='msg'>* Retype your Password.</div>";
		}
        if($password != $cpassword)
		{
            return "<div class='msg'>* Passwords are not the same</div>";
        }


        
        //Update data if there is no error    
		$password = modifyPassword($password);//get hash
		
        $sql = "UPDATE users SET password='$password' WHERE email='$email'";
        $result = mysqli_query($con, $sql);

        if($result)
		{
            return "* Password reset successfull";
        }
		else
		{
			return "<div class='msg'>* Something error in data. Try again.</div>";
		}

	}
	
	function random_num($len)
	{

		$text = "";
		$text .= rand(1,9);
		for ($i=1; $i < $len; $i++)
		{ 
			$text .= rand(0,9);
		}

		return $text;
	}
	
	function getNotes($con)
    {
        $_SESSION['rename_id']=0;
        $username=$_SESSION['current_user'];
        $sql = "SELECT * FROM notes WHERE Author = '$username' ORDER BY ID DESC";
        $result = mysqli_query($con, $sql);
 
                                    
        $folder = "notes/".$_SESSION['current_user'];
        if( is_dir($folder) === false )
        {
            mkdir($folder);
        }
                                    
        while($row=mysqli_fetch_array($result))
        {	
            $idx=$_SESSION['rename_id'];
            $_SESSION['rename_id']=$idx+1;
            makeRow($row, $idx);
        }
        
    }
    
    function makeRow($row, $idx)
    {
        $folder = "notes/".$_SESSION['current_user'];
        
        $name=$row['Name'];
        $course=$row['Course'];
        $type=$row['Type'];
        $id=$row['ID'];
        $time=$row['Time'];
        $file=$folder."/".$name;
        
        $delLink="noteDelete.php?id=$id&which=$name";
        $rename = " <form action='noteRename.php' method='get'>
                    <input type='text' value='$name' id='renameID' name='rename' >
                    <input type='hidden' value='$id' name='id' >
                    <input type='submit' value='Rename' class='button2' >
                    </form>
                    ";
                
        echo "
              <script>
                var tr, td1,td2,td3,td4,td5,td6,td7,a1,a2,a3,btn1,btn2,btn3;
                var td = new Array();
                
                tr = document.createElement('tr');
                td[$idx] = document.createElement('td');
                td[$idx].innerHTML ='$name';
                td2 = document.createElement('td');
                td2.innerHTML = '$course';
                td3 = document.createElement('td');
                td3.innerHTML = '$type';
                td7 = document.createElement('td');
                td7.innerHTML = '$time';
                
                td4 = document.createElement('td');
                a1 = document.createElement('a');
                a1.setAttribute('href','$file');
                btn1 = document.createElement('button');
                btn1.innerHTML = 'View';
                btn1.classList.add('button2');
                a1.appendChild(btn1);
                td4.appendChild(a1);
                
                td5 = document.createElement('td');
                a2 = document.createElement('a');
                a2.setAttribute('href','$file');
                a2.setAttribute('download','$name');
                btn2 = document.createElement('button');
                btn2.innerHTML = 'Download';
                btn2.classList.add('button2');
                a2.appendChild(btn2);
                td5.appendChild(a2);
                
                td6 = document.createElement('td');
                a3 = document.createElement('a');
                a3.setAttribute('href','$delLink');
                btn3 = document.createElement('button');
                btn3.innerHTML = 'Delete';
                btn3.classList.add('button2');
                a3.appendChild(btn3);
                td6.appendChild(a3);
                
                tr.appendChild(td[$idx]);
                tr.appendChild(td2);
                tr.appendChild(td3);
                tr.appendChild(td7);
                tr.appendChild(td4);
                tr.appendChild(td5);
                tr.appendChild(td6);
                
                document.getElementById('main').appendChild(tr);
                
                
            </script>
                
        ";
        
        $action = "td[$idx].addEventListener('click', function(){
                    alert('working $id!');
                    td[$idx].innerHTML="."$rename"."
                    alert('Kaj sesh,....$id!');
                
                });";
                
        
        echo "<script>";
        echo "$action";
        echo "</script>";
        

    }


	//Prepares list item for list of exams
	function get_exam_list_item($row){
        return '<div class="exam_list_item">
                        <div class="exam_name">
                            <a href="exam_single.php?examid='.$row['id'].'">'.$row['name'].'</a>
                        </div>
                        <a class="exam_list_author" href="#">'.$row['author'].'</a>
                        <p class="start_time">'.$row['startTime'].'</p>
                        <p class="end_time">'.$row['endTime'].'</p>
                </div>';
    }

?>
