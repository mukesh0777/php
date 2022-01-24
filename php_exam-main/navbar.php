<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <a class="navbar-brand" href="./home.php">Projet X</a>

  <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
    <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
      <li class="nav-item active">
        <a class="nav-link" href="./index.php">Home<span class="sr-only"></span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="./publish-question.php">Articles</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="./profil.php">ProfilPage</a>
      </li>
      <?php
      if ($_SESSION['authorityLevel'] == 2){
        echo '<li class="nav-item"><a class="nav-link" href="./adminPanel.php">Admin Panel</a> </li>';
      }?>
      <li class="nav-item">
        <a class="nav-link disabled" href="#"></a>
      </li>
    </ul>
    <a href="logout.php"><div id="logout" style="color:black" class="btn btn-danger">Logout</div></a>
  </div>
</nav>