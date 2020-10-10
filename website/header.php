<?php
ob_end_flush();

if (isset($_SESSION['username'])) {
  //Normal NavBar with Logged-in Functionality
  echo '
  <!DOCTYPE html>
  <html lang="en">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Quizzane Homepage. Create and Join quiz games in varying categories in this familiar and exciting game format for FREE!">
  </head>
  
  <body>

  <nav class="navbar navbar-expand-lg nav-signature-green navbar-light" style="border-radius: 10px; border: 2px solid #67e827;">
  <a class="navbar-brand" href="/"><img src="src/logos/quizzane-no-text.png" alt="Quizzane Logo Without Text" height="32"></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link btn-signature-green" href="/">Home</a>
      </li>
      <li class="nav-item">
        <a class="nav-link btn-signature-blue" href="create.php">Create Games</a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle btn-signature-blue" href="#" id="navbarDropdownGames" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Browse Games
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownGames" style="background-color: white; border-radius: 10px;">
          <a class="dropdown-item" href="games.php">Sports</a>
          <a class="dropdown-item" href="games.php">Movies</a>
          <a class="dropdown-item" href="games.php">TV Shows</a>
          <a class="dropdown-item" href="games.php">Technology</a>
          <a class="dropdown-item" href="games.php">Web Development</a>
          <a class="dropdown-item" href="games.php">Education</a>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link btn-signature-blue" href="announcements.php">Announcements</a>
      </li>
      <li class="nav-item">
        <a class="nav-link disabled" href="community.php">Community</a>
      </li>
      </ul>
    <ul class="navbar-nav">
    <li class="nav-item dropdown" style="padding-right: 10px; padding-left: 10px;">
        <a class="nav-link dropdown-toggle btn-signature-green" href="#" id="navbarDropdownUser" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          ' . $_SESSION["username"] . '
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownUser" style="background-color: white; border-radius: 10px;">
          <a class="dropdown-item" href="src/logout.php">Logout</a>
          <a class="dropdown-item disabled" href="profile">Profile</a>
        </div>
      </li>
    </ul>
    <form class="form-inline my-2 my-lg-0" method="POST" action="games.php">
      <input class="form-control mr-sm-2" name="search" type="search" placeholder="Game Title..." aria-label="Search">
      <button class="btn-signature-blue my-2 my-sm-0" type="submit">Search Games</button>
    </form>
  </div>
</nav>
</body>
</html>
  ';
} else {
  //normal navbar when user is not logged in
  echo '
  <!DOCTYPE html>
  <html lang="en">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Quizzane Homepage. Create and Join quiz games in varying categories in this familiar and exciting game format for FREE!">
  </head>
  
  <body>

  <nav class="navbar navbar-expand-lg nav-signature-green navbar-light" style="border-radius: 10px; border: 2px solid #67e827;">
  <a class="navbar-brand" href="/"><img src="src/logos/quizzane-no-text.png" alt="Quizzane Logo Without Text" height="32"></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link btn-signature-green" href="/">Home</a>
      </li>
      <li class="nav-item">
        <a class="nav-link btn-signature-blue" href="create.php">Create Games</a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle btn-signature-blue" href="#" id="navbarDropdownGames" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Browse Games
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownGames" style="background-color: white; border-radius: 10px;">
          <a class="dropdown-item" href="games.php">Sports</a>
          <a class="dropdown-item" href="games.php">Movies</a>
          <a class="dropdown-item" href="games.php">TV Shows</a>
          <a class="dropdown-item" href="games.php">Technology</a>
          <a class="dropdown-item" href="games.php">Web Development</a>
          <a class="dropdown-item" href="games.php">Education</a>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link btn-signature-blue" href="announcements.php">Announcements</a>
      </li>
      <li class="nav-item">
        <a class="nav-link disabled" href="community.php">Community</a>
      </li>
      </ul>
  <ul class="navbar-nav">
  <div style="line-height: 0.3;">
    <li class="nav-item">
        <a class="nav-link" data-toggle="modal" data-target="#loginModal" style="cursor: pointer;">Login</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" data-toggle="modal" data-target="#registerModal" style="cursor: pointer;">Register</a>
    </li>
  </div>
  </ul>
    <form class="form-inline my-2 my-lg-0" method="POST" action="games.php">
      <input class="form-control mr-sm-2" name="search" type="search" placeholder="Game Title..." aria-label="Search">
      <button class="btn-signature-blue my-2 my-sm-0" type="submit">Search Games</button>
    </form>
  </div>
</nav>

<!-- Login Modal -->
<div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="loginModal" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header modal-signature-green">
        <h5 class="modal-title" id="exampleModalLongTitle" style="text-align: center;">Quizzane Login</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body modal-signature-blue" style="padding-bottom: 0px;">
      <form action="src/loginbe.php" method="POST" name="loginForm">
<div>
<p style="padding-left: 5px;">
<span style="font-size: 1rem; color: white;">*</span> = required
</p>
</div>
  <div class="form-group">
    <input type="text" class="form-control" id="loginUsername" name="username" aria-describedby="loginUsername" placeholder = "Username *" required />
  </div>
  <div class="form-group">
    <input type="password" class="form-control" id="loginPassword" name="password"placeholder = "Password *" required />
  </div>
      <div class="modal-footer" style="padding-bottom: 3vh;">
        <button type="button" class="btn btn-signature-red" data-dismiss="modal">Cancel</button>
        <input type="submit" class="btn btn-signature-green" value="Login" />
        </form>
      </div>
      </div>
  </div>
</div>
</div>

<!-- Registration Modal -->
<div class="modal fade" id="registerModal" tabindex="-1" role="dialog" aria-labelledby="registerModal" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header modal-signature-green">
        <h5 class="modal-title" id="exampleModalLongTitle" style="text-align: center;">Quizzane Registration</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body modal-signature-blue">
      <div class="form-content">
        <p style="padding-left: 5px;"><sup><span style="font-size: 1rem; color: white;">*</span></sup> = Required</p>
            <div class="row">
                <div class="col-md-6">
                    <form action="src/registerbe.php" method="POST" name="registerForm">
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Username *" name="username" required />
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" name="email" maxlength="64" pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$" title = "Must be a valid email and less than 64 characters" placeholder="Email *" required>
                        </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <input type="password" class="form-control" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" placeholder="Your Password *" name="passwordField1" required />
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" placeholder="Confirm Password *" name="passwordField2" required />
                    </div>
                </div>
            </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-signature-red" data-dismiss="modal">Cancel</button>
        <input type="submit" class="btn btn-signature-green" value="Register" />
        </form>
      </div>
    </div>
  </div>
</div>
</div>
</body>
  ';
}
