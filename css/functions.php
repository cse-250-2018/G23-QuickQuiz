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
        $sql = "INSERT INTO users (name, user_name, email, password) values ('$name','$username', '$email', '$password')";
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
  
        $sql = "SELECT * FROM users WHERE user_name = '$username' ";
		$result = mysqli_query($con, $sql);
		
		if(mysqli_num_rows($result) > 0)
		{	
			$row = mysqli_fetch_assoc($result);
			$ori_pass=$row['password'];//hash store ache
			
			$password=modifyPassword($password);//get hash
			if($ori_pass == $password ){	
				$user=$row['user_name'];
				$_SESSION['user_name']=$user;
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
		if(isset($_SESSION['user_name']))
		{
			$user = $_SESSION['user_name'];
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
		$sql = "SELECT * FROM users WHERE user_name = '$username' ";
		$result = mysqli_query($con, $sql);
		
		if(mysqli_num_rows($result) > 0)
			return true;
		else
			return false;
	}
	
	
	function alreadyLogin($con)
	{

		if(isset($_SESSION['user_name']))
		{
			$username = $_SESSION['user_name'];
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
	
?>
