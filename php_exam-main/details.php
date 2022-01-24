<?php  
 session_start();  
 if(!isset($_SESSION["username"]))  {  
    header("location:index.php?action=login");  
 }  
 if(!isset($_GET["id"]))  {  
    header("location:home.php");  
 }  

 include 'dbConnect.php';

 $result = $_SESSION['mysqli']->query("SELECT * FROM `events` INNER JOIN users ON events.UserId = users.id WHERE events.Id = ". $_GET['id']);
 $row = $result->fetch_array(MYSQLI_ASSOC);
 
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
        <link rel="stylesheet" href="css/details.css" />
        <link rel="stylesheet" href="css/navbar.css" />
    </head>  
    <body>  
    <?php include 'navbar.php'?>
    <div class="event">  
        <?php  
        echo '<div class="eventHead">';
        /// a href profil
        echo '<h2><b>'.$row['Title'].'</b></h2> <h3><i> par '.$row['Username'].'</i></h3>';
        echo '<a href="editArticle.php?id='.$row['Id'].'"><button class="detailsBtn">Modifier</button></a>';

        echo '</div>';
        
        echo '<div class="content"><p class="contentText">'.$row['Content'].'<p></div>';
        echo '<p><i> aura lieu le : '.$row['StartDate'].' à '.$row['Localisation'].'</i></p>';
        echo '</div>';
        ?>  
    </div>  
    </body>  
</html>  