<?php
	include 'functions.php';
    include 'connection.php';
    if(!isset($_SESSION['current_user'])){
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        die;
    }
	//check for reg
	if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['post_btn']))
	{
		$postid = writeBlog($_POST, $con);
		unset($_POST);
        
        header("Location: forum.php");
        exit;
	}
?>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Raiden starts developing</title>
        <link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" href="css/forum.css">
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
        <div id="post_form_container">
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST" onsubmit="return calibrateTextArea()">
                <div id="title_area">
                    <div>Title</div>
                    <input type="text" style="width:600px;" name="title" required>
                </div>
                <div id="blog_area">
                    <textarea name="blog" cols="90" rows="10" class="editor"></textarea>
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
                <button type="submit" name="post_btn" id="post_btn">Post</button>
            </form>
        </div>
    </body>
</html>