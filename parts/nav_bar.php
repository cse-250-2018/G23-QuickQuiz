<link id="menu_style" rel="stylesheet" type="text/css" href="css/menu_off.css">
<link id="menu_style" rel="stylesheet" type="text/css" href="css/nav.css">
<script src="scripts/vanila.js"></script>
<div id="nav_bar">
    <div id="nav_left">
        <a href="index.php" class="menu_item">Home</a>
        <a href="#" class="menu_item">Quiz</a>
        <a href="exam.php" class="menu_item">Exam</a>
        <a href="#" class="menu_item">Notes</a>
        <a href="#" class="menu_item">Forum</a>
    </div>
    <div id="nav_right">
        <div id="nav_btn" class="menu_item" onclick="togleNav()">&#9776;</div>
        <div id="mobile_nav">
            
            <img src="images/search_icon.svg">
            <?php
                if(isset($_SESSION['current_user'])) echo '<a href="#"><img src="images/notification_icon.svg"></a>';
                if(isset($_SESSION['current_user'])) echo '<a href="#"><img src="images/profile_icon.svg"></a>';
                if(isset($_SESSION['current_user'])) echo '<a href="logout.php"><img src="images/exit_icon.svg"></a>';
                if(!isset($_SESSION['current_user'])) echo '<a href="login.php"><div>SignIn</div></a>';
                if(!isset($_SESSION['current_user'])) echo '<a href="registration.php"><div>SignUp</div></a>';
            ?>
        </div>
    </div>
</div>