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
        $org='profile/system/dummy.jpg';
        $nw='profile/'.$username.'.jpg';
        copy($org,$nw);
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

    //Storing Details of note
    function uploadNote($FILES, $data, $con)
	{
		//get input data
        $course       = $data['course'];
        $type         = $data['type'];
        $author       = $data['author'];
        $file         = $FILES['file']['name'];
        $size         = $FILES['file']['size'];
        
        $size = round($size / 1024 / 1024, 5); //in MB
		

        $sql = "INSERT INTO notes (Author, Course, Name, Type, Size) values ('$author','$course', '$file', '$type', '$size')";
        $result = mysqli_query($con, $sql);

        if($result)
		{
            return "* Stored successfully";
        }
		else
		{
            $s = $author." ".$course." ".$file." ".$type." ".$size." MB";
            return $s;
			//return "<div class='msg'>* Something error in data. Try again.</div>";
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

	function timeSince ($time)
    {
        date_default_timezone_set("Asia/Dhaka");
//        return $time;
        $time=strtotime($time);
        $time = strtotime(date('Y-m-d H:i:s'))-$time; // to get the time since that moment
        $tokens = array (
            31536000 => 'year',
            2592000 => 'month',
            604800 => 'week',
            86400 => 'day',
            3600 => 'hour',
            60 => 'minute',
            1 => 'second'
        );
        foreach ($tokens as $unit => $text) {
            
            if ($time < $unit) continue;
            $numberOfUnits = floor($time / $unit);
            return $numberOfUnits.' '.$text.(($numberOfUnits>1)?'s':'');
        }
        return "a few moments";

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
	//Prepares list item for list of quizs
	function get_quiz_list_item($row){
        return '<div class="quiz_list_item">
                        <div class="quiz_name">
                            <a href="quiz_single.php?quizid='.$row['id'].'">'.$row['name'].'</a>
                        </div>
                        <a class="quiz_list_author" href="#">'.$row['author'].'</a>
                </div>';
    }

	// Prepares list item for forum
	function get_forum_list_item($row,$cnt,$con){
        $blog=$row['content'];
		$votes=0;
        $query = "SELECT * FROM votes WHERE post = ".$row['id']." AND vote = 1";
        $result = mysqli_query($con,$query);
        if($result) $votes = $votes + mysqli_num_rows($result);
        $query = "SELECT * FROM votes WHERE post = ".$row['id']." AND vote = -1";
        $result = mysqli_query($con,$query);
        if($result) $votes = $votes - mysqli_num_rows($result);
        return '<div class="blog_list_item">
                        <div class="blog_list_prefix">
                            <img src="images/upvote.svg" onclick="upvoteInit(this,'.$row['id'].')">
                            <label>'.$votes.'</label>
                            <img src="images/downvote.svg" onclick=downvoteInit(this,"'.$row['id'].'")>
                        </div>
                        <div class="blog_list_suffix">
                            <a href="blog_single.php?blogid='.$row['id'].'" class="blog_title">'.$row['title'].'</a>
                            <div class="blog_preview">
                                '.$blog.'
                            </div>
                            
                            <div class="blog_list_bottom">
                                <div class="bottom_prefix">
                                    <img src="profile/'.$row['author'].'.jpg">
                                    <p>posted by <a href="#">'.$row['author'].'</a> '.timeSince($row['time']).' ago</p>
                                </div>
                                <div class="bottom_suffix">
                                    <div class="comments">
                                        <img src="images/comments.svg"> '.$cnt.' comments
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                    </div>';
    }
    //Writes a blog into database
    function writeBlog($data,$con){
        if(!isset($_SESSION['current_user'])) return ;
        $title=$data['title'];
        $blog=$data['blog'];
        $author=$_SESSION['current_user'];
        $sql = "INSERT INTO posts (title, author,content) values ('$title','$author','$blog')";
        $result = mysqli_query($con, $sql);
    }
    //Writes comment into database
    function writeComment($get,$post, $con){
        if(!isset($_SESSION['current_user'])) return ;
        $user=$_SESSION['current_user'];
        $par=$get['blogid'];
        $comment = mysqli_real_escape_string($con,$_POST['comment']);
        $sql="INSERT INTO comments (lvl,par,user,content) values ('0','$par','$user','$comment')";
        mysqli_query($con, $sql);
        
    }
    //Writes reply into database
    function writeReply($post, $con){
        if(!isset($_SESSION['current_user'])) return ;
        $user=$_SESSION['current_user'];
        $par=$post['replyto'];
        $comment = mysqli_real_escape_string($con,$_POST['reply']);
        $sql="INSERT INTO comments (lvl,par,user,content) values ('1','$par','$user','$comment')";
        mysqli_query($con, $sql);
    }
    //Dfs and print replays
    function dfsReplies($n,$con){
        $query = "SELECT * FROM comments WHERE lvl != '0' AND par = '$n'";
        $result = mysqli_query($con,$query);
        if ($result){
        if(mysqli_num_rows ( $result )==0) return "";
        echo '<span>&#8596;</span>';
        echo '<div class="replies_container">';
            while($row = mysqli_fetch_array($result))
            {
                
                $cmnt=$row['content'];
                echo '<div class="comment_container">';
                    echo '<div class="comment_total">';
                        echo'<div class="comment_prefix">';
                            echo '<div class="comment_author">';
                                echo '<div>';
                                    echo '<img src="profile/'.$row['user'].'.jpg">';
                                    echo '<a href="#">'.$row['user'].'</a>
                                </div>';
                            echo '</div>';
                        echo '</div>';
                        echo '<div class="comment_suffix">
                                <p class="comment_time">'.timeSince($row['time']).' ago</p>
                                '.$cmnt.'
                                <div class="reply_btn_container"><div class="comment_replay_btn" onclick="showReplyField(this,'.$row['id'].');">&#8594;Reply</div></div>
                                <div class="reply_form_container">
                                <form method="post">
                                    <textarea name="reply" class="editor"></textarea>
                                    <input class="reply_hidden" name="replyto" type="text">
                                    <div id="reply_btns_container"><button type="submit" name="reply_submit">Post</button><button onclick="hideReplyField(this)" type="button">Cancel</button></div>
                                </form>
                                </div>
                            </div>';
                    echo '</div>';

                    echo '<div class="replies">';
                            echo dfsReplies($row['id'],$con);
                    echo '</div>';
                    echo '</div>';
                    
                
            }
            echo '</div>';
        }
    }

	//store marks to leaderboard
    function addToLeaderboard($user, $course, $marks, $total, $con){
        $sql="SELECT * FROM leaderboard WHERE user ="."'".$user."'";
        $result = $con->query($sql);
        
        //echo $user." ".$course." ".$marks." <br> ";
        if(($result && mysqli_num_rows( $result )>0))
        {
            /*UPDATE `leaderboard` SET `Structured Programming Language`=`Structured Programming Language`+1,`Structured Programming Language Total`=`Structured Programming Language`-1 WHERE user = 'admin';*/
            
            $sql = "UPDATE `leaderboard` SET `".$course."` = `".$course."` + ".$marks." , `".$course." Total` = `".$course." Total` + ".$total.", `any` = `any` + ".$marks.", `any Total` = `any Total` + ".$total." WHERE user = '".$user."'";
            $con->query($sql);
            
        }
        else
        {
            
            $sql = "INSERT INTO `leaderboard`(`user`, `".$course."`, `".$course." Total`, `any`, `any Total`) VALUES ('".$user."', '".$marks."','".$total."','".$marks."','".$total."')";
            //echo $sql;
            
            $con->query($sql);
        }
    }


?>
