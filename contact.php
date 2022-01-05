<?php
	include 'functions.php';
    include 'connection.php';
    if(!isset($_SESSION['current_user'])){
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        die;
    }
    $msg = "";
	if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['post_btn']))
	{
        if(strlen($_POST['feedback'])>0)
	    {
            writeFeedback($_POST['feedback'], $con);
            $msg="<div class='msg-2'>Feedback sent</div>";
        }
        else $msg="<div class='msg'>Empty feedback</div>";
		unset($_POST);
	}
?>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Raiden starts developing</title>
        <link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" href="css/extra.css">
        <style>
            .ck-editor__editable {
                min-height: 300px;
            }

        </style>
        <script src="scripts/vanila.js"></script>
        <script src="library/ckeditor/build/ckeditor.js"></script>
        <div ></div>
    </head>
    <body>
        <?php include 'parts/nav_bar.php' ?>
        <?php echo $msg; ?>
        <div id="feedback">
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST" onsubmit="return calibrateTextArea()">

                <div>
                    <textarea name="feedback" cols="90" rows="10" class="editor"></textarea>
                </div>
                <script>ClassicEditor
                    .create( document.querySelector( '.editor' ), {
                        
                        licenseKey: '',
                        
                        
                        
                    } )
                    .then( editor => {
                        window.editor = editor;
                
                        
                        
                        
                    } )
                    .catch( error => {
                        console.error( 'Oops, something went wrong!' );
                        console.error( 'Please, report the following error on https://github.com/ckeditor/ckeditor5/issues with the build id and the error stack trace:' );
                        console.warn( 'Build id: qbme1jx5fki8-5m8tcsd1s9ci' );
                        console.error( error );
                    } );
                </script>
                <button type="submit" name="post_btn" id="feedback_btn">Send us feedback</button>
            </form>
        </div>
    </body>
</html>
