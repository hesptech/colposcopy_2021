<?php

    require_once ('mysqli_connect.php'); // Connect to the db.

    if(isset($_POST["submit_btn"]))
    {   
        $json_array = mysqli_real_escape_string($connect, $_POST["post_text"]); 
        // $json_array = $_POST["post_text"];
        header('Content-Type: application/json'); 
        echo json_encode(stripslashes($json_array)); 
    }  else {
?>

<html>  
      <head>  
           <title>Make SEO Friendly / Clean Url in PHP using .htaccess</title>  
           <style>  
           .container  
           {  
                width:700px;  
                margin:0 auto;  
                border:1px solid #ccc;  
                padding:16px;  
           }  
           .form_text  
           {  
                width:100%;  
                padding:6px;  
           }  
           </style>  
      </head>  
      <body>  
           <div class="container">  
                <h3 align="center">request in json formay</h3>  
                <form name="submit_form" method="post">  
                     <p>Post Text  
                     <textarea name="post_text" class="form_text" rows="10"></textarea>  
                     </p>  
                     <p><input type="submit" name="submit_btn" value="Submit" />  
                </form>  
           </div>  
      </body>  
 </html>  

<?php
    }
?>

