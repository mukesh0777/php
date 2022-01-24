<?php
 session_start();  
 include 'dbConnect.php';

 if(isset($_POST["adminConnexion"])){  
    if(empty($_POST["password"])){  
        echo '<script>alert("Un mot de passe est requis")</script>';  
    }  
    else{
        $password = mysqli_real_escape_string($_SESSION['mysqli'], $_POST["password"]);  
        if(strcmp($password, 'TasCruQuoi!?') == 0){
            $_SESSION['authorityLevel'] = 2; 
            header("location:adminPanel.php"); 
        }else{
            echo '<script>alert("Mhh, mauvais mot de passe")</script>'; 
        }
    }  
 }  
?>
<!DOCTYPE html>  
<html>  
<head>  
    <title>Admin Login</title>  
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>  
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />  
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>  
    <link rel="stylesheet" href="css/publish-question.css" />
</head>  
<body>  
    <div id=wrap>
        <div class="signup-form"> 
            <h2>Projet X</h2>
            <h3 class="hint-text">Admin Connexion :</h3>  
            <form method="post">  
                <div class="form-group">
         	        <div class="row">
         			    <div class="col"><input type="password" class="form-control" placeholder="Mot de passe.." name="password" required="required"></div>
         		    </div>        	
                </div>
                <div class="form-group" id="buttonRow">
                    <button class="btn btn-success btn-lg btn-block rounded" type="submit" name="adminConnexion">Connexion</button> 
                </div>
           </form>  
        </div>  
    </div>
</body>  
</html>