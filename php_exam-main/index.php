<?php
 session_start();  
 include 'dbConnect.php';
 $connect = $_SESSION['mysqli'];
 if(isset($_SESSION["username"])){  
     header("location:home.php");  
 }  
 if(isset($_POST["register"])){  
      if(empty($_POST["username"]) && empty($_POST["password"]) && empty($_POST["email"]) ){  
          echo '<script>alert("Both Fields are required")</script>';  
     }  
     else{
          $username = mysqli_real_escape_string($connect, $_POST["username"]);
          if(strlen($username) > 60){
              echo '<script>alert("on a dit max 60char !")</script>'; 
          }
          $password = mysqli_real_escape_string($connect, $_POST["password"]);  
          $password = md5($password);  
           
          //   require_once 'VerifyEmail.class.php'; 
           // $mail = new VerifyEmail();
           $email = mysqli_real_escape_string($connect, $_POST["email"]); 

           // Check if email is valid and exist
           // if($mail->check($email)){ 
           //     $ok = true;
           // }elseif(verifyEmail::validate($email)){ 
           //     echo 'Email &lt;'.$email.'&gt; is valid, but not exist!'; 
           //     $ok = false;
           // }else{ 
           //     echo 'Email &lt;'.$email.'&gt; is not valid and not exist!'; 
           //     $ok = false;
           // } 

          $registerDate = date("Y-m-d");
          $query = "INSERT INTO Users (Username, Password, Email, RegisterDate, AuthorityLevel) VALUES('$username', '$password', '$email', '$registerDate', '1')";  
          if(mysqli_query($connect, $query)){  
               echo '<script>alert("Registration Done")</script>';  
          } else{
               echo '<script>alert("Registration Error, Respecte le formulaire !")</script>'; 
          }
     }  
 }  
 if(isset($_POST["login"])){  
     if(empty($_POST["username"]) && empty($_POST["password"]))  {  
          echo '<script>alert("Both Fields are required")</script>';  
     }  
     else{  
          $username = mysqli_real_escape_string($connect, $_POST["username"]);  
          $password = mysqli_real_escape_string($connect, $_POST["password"]);  
          $password = md5($password);  
          $query = "SELECT * FROM users WHERE Username = '$username' AND Password = '$password'";  
          $result = mysqli_query($_SESSION['mysqli'], $query);  
          $row = $result->fetch_array(MYSQLI_ASSOC);

          if(mysqli_num_rows($result) > 0)  {  
               $_SESSION['username'] = $username; 
               $_SESSION['userId'] = $row['Id'];
               $_SESSION['authorityLevel'] = $row['AuthorityLevel'];;
               header("location:home.php");  
          }  
          else{  
               echo '<script>alert("Wrong User Details")</script>';  
          }  
         }  
     }  
?>
<!DOCTYPE html>  
 <html>  
      <head>  
           <title>Welcome To ProjetX</title>  
           <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>  
           <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />  
           <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>  
           <link rel="stylesheet" href="css/publish-question.css" />
      </head>  
      <body>  
          <div id=wrap>
           <div class="signup-form"> 
               <h2>Projet X</h2>
                <?php  
                if(isset($_GET["action"]) == "login")  
                {  
                ?>  
                <h3 class="hint-text">Connexion</h3>  
                <form method="post">  
                     
                    <div class="form-group">
	          		<div class="row">
	          			<div class="col"><input type="text" class="form-control" name="username" placeholder="Pseudo.." required="required"></div>
	          		</div>        	
                    </div>

                    <div class="form-group">
	          		<div class="row">
	          			<div class="col"><input type="password" class="form-control" placeholder="Mot de passe.." name="password" required="required"></div>
	          		</div>        	
                    </div>

                    <div class="form-group" id="buttonRow">
                         <button class="btn btn-success btn-lg btn-block rounded" type="submit" name="login">Connexion</button> 
                         <button class="btn btn-primary btn-lg btn-block rounded"><a href="index.php">Inscription</a> </button>
                    </div>
                </form>  
                <?php       
                }  
                else  
                {  
                ?>  
                <h3 class="hint-text">Inscription </h3> 
                <form method="post">  
                    <div class="form-group">
	          		<div class="row">
                              <label>Pseudo : (max 60 caractères)</label>  
	          			<div class="col"><input type="text" name="username" placeholder="..." class="form-control" />  </div>
	          		</div>        	
                    </div>
                    <div class="form-group">
	          		<div class="row">
                              <label>Email : (max 320 caractères)</label>  
	          			<div class="col"><input type="text" name="email" placeholder="..." class="form-control" />    </div>
	          		</div>        	
                    </div>
                    <div class="form-group">
	          		<div class="row">
                              <label>Mot de passe :</label>  
	          			<div class="col"><input type="password" name="password" placeholder="..." class="form-control" />      </div>
	          		</div>        	
                    </div>
                    <div class="form-group" id="buttonRow">
                         <button class="btn btn-primary btn-lg btn-block rounded" type="submit" name="register">Inscription</button>
                         <button class="btn btn-success btn-lg btn-block rounded"><a href="index.php?action=login">Connexion</a> </button>
                    </div>
                </form>  
                <?php  
                }  
                ?>  
          </div>  
          </div>
     </body>  
 </html>