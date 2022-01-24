<?php  
 session_start();  
 if($_SESSION["authorityLevel"] != 2){  
    echo '<script>alert("T\'as cru quoi sacripan ?")</script>';  
    header("location:index.php?action=login");  
 }  
 include 'dbConnect.php';

 $result = $_SESSION['mysqli']->query("SELECT Title, Content, StartDate, Localisation, events.Id, users.Username FROM `events` INNER JOIN  users ON events.UserId = users.Id ORDER BY PostDate DESC; ");
  
 while($row = $result->fetch_array()){
 $eventRows[] = $row;
 }
 $result = $_SESSION['mysqli']->query("SELECT users.Id as Id, Username, Email, RegisterDate, AuthorityLevel, COUNT(*) as PostCount FROM `users` INNER JOIN events ON users.Id = events.UserId GROUP BY UserId; ");
  
 while($row = $result->fetch_array()){
 $UserRows[] = $row;
 }

 if(isset($_POST['id']) && !empty($_POST['id'] && isset($_POST['type'])) ) {
    if(mysqli_query($_SESSION['mysqli'],"DELETE FROM `".$_POST['type']."` WHERE Id=".$_POST['id'])){
        header("location:adminPanel.php");  
    }else{
        echo '<script>alert("worked")</script>'; 
    }
 }

 ?>  
 <!DOCTYPE html>  
 <html>  
 <head>  
    <title>Admin panel</title> 
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="css/navbar.css" />
    <link rel="stylesheet" href="css/home.css" />

 </head>  
 <body>  
    <?php include 'navbar.php'?>

    <div class="heads">  
        <h2>Admin Control Panel..</h2>
        <h3>Derniers évènements postés :</h3>
    </div>  

    <div class="eventList">
        <?php  
        if(isset($eventRows) && count($eventRows) > 0 ){
             for($i = count($eventRows); $i > 0 ; $i){
                 $finalEventRows[] = array_slice($eventRows,0,3);
                 $i = $i-3;
             }

             foreach($finalEventRows as $rows){
                  echo '<div class="eventRow ">';
                  foreach($rows as $row){
                       echo '<div class="event">';
                            echo '<div class="eventHead">';
                            echo '<h2><b>'.$row['Title'].'</b><i> par '.$row['Username'].'</i></h2>';
                            echo '<a href="editArticle.php?id='.$row['Id'].'"><button class="detailsBtn">Modifier</button></a>';
                            echo '<form action="adminPanel.php" method="post">';
                                echo '<input type="hidden" name="type" value="events">';
                                echo '<button type="submit" name="id" value="'.$row['Id'].'" class="supprBtn">Supprimer</button>';
                            echo '</form>';
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

    <div class="heads">  
        <h3>Utilisateurs :</h3>
    </div>  

    <div class="eventList">
        <?php  
        if(isset($UserRows) && count($UserRows) > 0 ){
            for($i = count($UserRows); $i > 0 ; $i){
                $finalUserRows[] = array_slice($UserRows,0,3);
                $i = $i-3;
            }

            foreach($finalUserRows as $rows){
                echo '<div class="eventRow">';
                foreach($rows as $row){
                    echo '<div class="event">';
                        echo '<div class="eventHead">';
                            echo '<div style="width:30%;text-align:center;margin-top:1%">';
                                echo '<h2><b>'.$row['Username'].'</b></h2>';
                            echo '</div>';
                            echo '<form action="adminPanel.php" method="post">';
                                echo '<input type="hidden" name="type" value="users">';
                                echo '<button type="submit" name="id" value="'.$row['Id'].'"class="supprBtn">Supprimer</button>';
                            echo '</form>';
                            echo '</div>';
                        echo '<div class="content">';
                            echo'<p><b>Adresse email : </b>'.$row['Email'].'<p>';
                            echo '<p><b>Inscrit depuis le </b>'.$row['RegisterDate'].'<p>';
                            echo '<p><b>'.$row['PostCount'].'</b> articles postés<p>';
                            $role = $row['AuthorityLevel'] == 2 ? 'Admin' : 'Membre';
                            echo '<p><b>Rôle : </b>'.$role.'<p>';
                        echo '</div>';
                    echo '</div>';
                }
                echo '</div>';
            }
        }else{
            echo '<div class="emptyGrid">';
                echo '<h2>il n\'y a pas d\'users, quel site de merde</h2>';
            echo '</div>';
        }
        ?> 
    </div>
    
</body>  
</html>  