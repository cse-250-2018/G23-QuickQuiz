<?php
    
    session_start();
    
    $orderBy = array('Rank', 'user', 'Accuracy');

    $order = 'Rank';
    $type = 'ASC'; //ASC|DESC
    
    if(!isset($_SESSION['cntRank']))
    {
        $_SESSION['cntRank']='0';
    }
    if(!isset($_SESSION['cntUser']))
    {
        $_SESSION['cntUser']='0';
    }
    if(!isset($_SESSION['cntAcc']))
    {
        $_SESSION['cntAcc']='0';
    }

    if(isset($_GET['sort']) && isset($_GET['cnt']) && in_array($_GET['sort'], $orderBy))
    {
        $order = $_GET['sort'];
        if($order == 'Rank')
        {
            if($_SESSION['cntRank']=='0')
            {
                $type = 'ASC';
                $_SESSION['cntRank'] = '1';
            }
            else
            {
                $type = 'DESC';
                $_SESSION['cntRank'] = '0';
            }
            $_SESSION['leaderboard_Rank']=$type;
            if(isset($_SESSION['leaderboard_user']))
                unset($_SESSION['leaderboard_user']);
            if(isset($_SESSION['leaderboard_Accuracy']))
                unset($_SESSION['leaderboard_Accuracy']);
            
        }
        else if($order == 'user')
        {
            if($_SESSION['cntUser']=='0')
            {
                $type = 'ASC';
                $_SESSION['cntUser'] = '1';
            }
            else
            {
                $type = 'DESC';
                $_SESSION['cntUser'] = '0';
            }
            $_SESSION['leaderboard_user']=$type;
            $_SESSION['leaderboard_Rank']="Both";
            if(isset($_SESSION['leaderboard_Accuracy']))
                unset($_SESSION['leaderboard_Accuracy']);
        }
        else if($order == 'Accuracy')
        {
            if($_SESSION['cntAcc']=='0')
            {
                $type = 'ASC';
                $_SESSION['cntAcc'] = '1';
            }
            else
            {
                $type = 'DESC';
                $_SESSION['cntAcc'] = '0';
            }
            $_SESSION['leaderboard_Accuracy']=$type;
            $_SESSION['leaderboard_Rank']="Both";
            if(isset($_SESSION['leaderboard_user']))
                unset($_SESSION['leaderboard_user']);
        }
    }

    $sort = 'ORDER BY '.$order.' '.$type;
    $_SESSION['leaderboard_sort']=$sort;
    
    header("location: leaderboard.php");
?>