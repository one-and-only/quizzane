<?php 

//session check
if(session_id() == ''){
  //session has not started
  session_start();
}

$_SESSION['username'] = "testing"; //remove when functionality is complete
var_dump($_SESSION['username']);

if ($_SESSION['username'] != "" and NULL) {
  //Normal NavBar with Logged in Functionality
  echo '
<nav class="navbar navbar-expand-lg navbar-light" style="background-image: -webkit-linear-gradient(left, white, #53ed65, #53e064);">
    <a class="navbar-brand" href="index.php"><img src="src/logos/quizzane-no-text.png" height="32" width=auto></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
  
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item active">
          <a class="nav-link" href="index">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="create">Create Games</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Browse Games
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown" style="background-color: white;">
            <a class="dropdown-item" href="games">Sports</a>
            <a class="dropdown-item" href="games">Movies</a>
            <a class="dropdown-item" href="games">TV Shows</a>
            <a class="dropdown-item" href="games">Technology</a>
            <a class="dropdown-item" href="games">Web Development</a>
            <a class="dropdown-item" href="games">Education</a>
        </li>
        <li class="nav-item">
          <a class="nav-link disabled" href="community">Community</a>
        </li>
      </ul>
      <form class="form-inline my-2 my-lg-0" method="POST" action="games">
        <input class="form-control mr-sm-2" name="search" type="search" placeholder="Game Title..." aria-label="Search">
        <button class="btn btn-outline-primary my-2 my-sm-0" type="submit">Search Games</button>
      </form>
      <li class="nav-item dropdown" style="padding-right: 10px; padding-left: 10px;">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <?php echo $_SESSION["username"]; ?>
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown" style="background-color: white;">
            <a class="dropdown-item" href="logout">Logout</a>
            <a class="dropdown-item disabled" href="profile">Profile</a>
        </li>
    </div>
  </nav>
  ';
}
else {
  //normal navbar
  echo '
  <nav class="navbar navbar-expand-lg navbar-light" style="background-image: -webkit-linear-gradient(left, white, #53ed65, #53e064);">
  <a class="navbar-brand" href="index.php"><img src="src/logos/quizzane-no-text.png" height="32" width=auto></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="index">Home</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="create">Create Games</a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Browse Games
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown" style="background-color: white;">
          <a class="dropdown-item" href="games">Sports</a>
          <a class="dropdown-item" href="games">Movies</a>
          <a class="dropdown-item" href="games">TV Shows</a>
          <a class="dropdown-item" href="games">Technology</a>
          <a class="dropdown-item" href="games">Web Development</a>
          <a class="dropdown-item" href="games">Education</a>
      </li>
      <li class="nav-item">
        <a class="nav-link disabled" href="community">Community</a>
      </li>
    </ul>
    <form class="form-inline my-2 my-lg-0" method="POST" action="games">
      <input class="form-control mr-sm-2" name="search" type="search" placeholder="Game Title..." aria-label="Search">
      <button class="btn btn-outline-primary my-2 my-sm-0" type="submit">Search Games</button>
    </form>
  </div>
</nav>
  ';
}