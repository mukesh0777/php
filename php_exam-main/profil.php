<?php  
 session_start();  
 if(!isset($_SESSION["username"]))  
 {  
      header("location:index.php?action=login");  
 }  

 include 'dbConnect.php';
 
 if(isset($_GET["id"]))  {  
     $result = $_SESSION['mysqli']->query("SELECT * FROM users WHERE Id = ". $_GET['id']);
 }else{
     $result = $_SESSION['mysqli']->query("SELECT * FROM users WHERE Id = ".$_SESSION['userId']);
 }

 $row = $result->fetch_array(MYSQLI_ASSOC);

 if($row['ProfilPic'] != NULL){
    $ProfilPic = $row['ProfilPic'];
 }else{
    $ProfilPic = "ProfilPics/default.png";
 }

?>  

 <!DOCTYPE html>  
<html>  
     <head>  
          <title>Accueil</title> 
          <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
          <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
          <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
          <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
          <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
          <link rel="stylesheet" href="css/profil.css" />
          <link rel="stylesheet" href="css/navbar.css" />
     </head>  
     <body>  
          <?php include 'navbar.php'?>

    <section class="section about-section gray-bg" id="about">
         <div class="parametre">
               <a href="profilEdit.php">
               <svg class="iconparametre" xmlns="http://www.w3.org/2000/svg" width="42" height="43.178" viewBox="0 0 42 43.178">
                    <path id="ic_settings_24px" d="M39.316,25.7a16.824,16.824,0,0,0,.151-2.116,16.826,16.826,0,0,0-.151-2.116l4.555-3.562a1.089,1.089,0,0,0,.259-1.382L39.813,9.06A1.085,1.085,0,0,0,38.5,8.585L33.12,10.744a15.773,15.773,0,0,0-3.649-2.116l-.82-5.721A1.053,1.053,0,0,0,27.593,2H18.958a1.053,1.053,0,0,0-1.058.907l-.82,5.721a16.587,16.587,0,0,0-3.649,2.116L8.055,8.585a1.053,1.053,0,0,0-1.317.475L2.42,16.529a1.064,1.064,0,0,0,.259,1.382l4.555,3.562a17.121,17.121,0,0,0-.151,2.116A17.121,17.121,0,0,0,7.235,25.7L2.679,29.267a1.089,1.089,0,0,0-.259,1.382l4.318,7.47a1.085,1.085,0,0,0,1.317.475l5.376-2.159a15.773,15.773,0,0,0,3.649,2.116l.82,5.721a1.053,1.053,0,0,0,1.058.907h8.636a1.053,1.053,0,0,0,1.058-.907l.82-5.721a16.587,16.587,0,0,0,3.649-2.116L38.5,38.594a1.053,1.053,0,0,0,1.317-.475l4.318-7.47a1.089,1.089,0,0,0-.259-1.382Zm-16.041,5.44a7.556,7.556,0,1,1,7.556-7.556A7.564,7.564,0,0,1,23.275,31.145Z" transform="translate(-2.271 -2)"/>
               </svg>
               </a>
          </div>
            <div class="container">
                <div class="row align-items-center flex-row-reverse">
                    <div class="col-lg-6">
                        <div class="about-text go-to">
                            <h3 class="dark-color"><?php echo $row['Username'] ?></h3>
                            <div class="row about-list">
                                <div class="col-md-6">
                                    <div class="media">
                                        <label>Membre depuis le</label>
                                        <p class="date"><?php echo $row['RegisterDate'] ?></p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="media">
                                        <label>E-mail</label>
                                        <p class="date"><?php echo $row['Email'] ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="about-avatar">
                        <img class="rounded-circle mt-5" alt width="200px" height="200px"  src="<?php echo $ProfilPic ?>">
                        </div>
                    </div>
                </div>
            </div>
        </section>   
     </body>  
</html> 