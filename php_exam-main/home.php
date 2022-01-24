<?php  
 session_start();  
 if(!isset($_SESSION["username"]))  
 {  
      header("location:index.php?action=login");  
 }  
 include 'dbConnect.php';
 $result = $_SESSION['mysqli']->query("SELECT Title, Content, StartDate, Localisation, events.Id, users.Username FROM `events` INNER JOIN  users ON events.UserId = users.Id ORDER BY PostDate DESC; ");
 
 while($row = $result->fetch_array()){
 $rows[] = $row;
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
    <link rel="stylesheet" href="css/home.css" />
    <link rel="stylesheet" href="css/navbar.css" />
</head>  
<body>  
     <?php include 'navbar.php'?>

     <div class="intro">  
          <?php  
          echo '<h1>Bienvenue '.$_SESSION["username"].', tu peux retrouver tous les évènements qui ont étés postés sur ce site ci-dessous</h1>';  
          ?> 
          <h3>Ce site est le repère des alcooliques du coin, tu veux pécho? frôler la sieste éthylique ? ce site est fait pour toi</h3>
     </div>  

     <div class="eventList align-self-start">
          <?php  
          if(isset($rows) && count($rows) > 0 ){
               for($i = count($rows); $i > 0 ; $i){
                   $finalRows[] = array_slice($rows,0,3);
                   $i = $i-3;
               }

               foreach($finalRows as $rows){
                    echo '<div class="eventRow ">';
                    foreach($rows as $row){
                         echo '<div class="event">';
                              echo '<div class="eventHead">';
                              echo '<h2><b>'.$row['Title'].'</b><i> par '.$row['Username'].'</i></h2>';
                              echo '<button class="detailsBtn"><a style="color:black"href="details.php?id='.$row['Id'].'">Détails</a> </button>';
                         echo '</div>';
                         echo '<div class="content"><p>'.$row['Content'].'<p></div>';
                         echo '<p><i> aura lieu le : '.$row['StartDate'].' à '.$row['Localisation'].'</i></p>';
                         echo '</div>';
                    }
                    echo '</div>';
               }
          }else{
               echo '<div class="emptyGrid">';
                    echo '<h2>il n\'y a pas d\'event, quel site de merde</h2>';
               echo '</div>';
          }
          ?> 
     </div>
</body>  
</html>  