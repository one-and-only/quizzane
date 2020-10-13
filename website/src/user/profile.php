<?php
ob_start();
//$authorized = include('../loginCheck.php');
include('../includes.php');
include('../openssl.php');
$openssl = new encrypt('../openssl.php');
echo '<title>Profile | Quizzane</title>';
include('../../header.php');
ob_end_flush();

$getUserInfo = "SELECT * FROM users WHERE username = :username";
$getUserInfo = $pdo->prepare($getUserInfo);
$username = [
    ':username' => $_SESSION['username']
];

if ($getUserInfo->execute($username)) {
    $UserInfo = $getUserInfo->fetch(PDO::FETCH_ASSOC);
    $username = $UserInfo['username'];
    $email = $openssl->opensslDecryptAES256($UserInfo['email'], include('../opensslkey.php'));

    $getLeaderboard = "SELECT * FROM users ORDER BY userScore DESC LIMIT 5";

    echo '
    <script>
        $(window).on("load", function() {
            document.getElementById("updateAccountButton").disabled = true;
            $("#updateAccountForm :input").change(function() {
                document.getElementById("updateAccountButton").disabled = false;
            });
        });
    </script>
    <style>
    * {
        box-sizing: border-box;
      }
      
      /* Create three equal columns that floats next to each other */
      .column {
        float: left;
        width: 33.33%;
        padding: 10px;
      }
      
      /* Clear floats after the columns */
      .row::after {
        content: "";
        display: table;
        clear: both;
      }
      .table th {
          padding: .75rem;
          vertical-align: top;
          border-top: 0px;
      }
      .medals:nth-child(1) {
          background-color: gold;
      }
      .medals:nth-child(2) {
          background-color: silver;
      }
      .medals:nth-child(3) {
          background-color: bronze;
      }
    </style>

        <div class="row" style="padding-top: 2vh;">
            <div class="column" style="padding-left: 3.5vw;">
            <h2 align="center" style="padding-bottom: 1vh; background-color: #67e827; border-radius: 15px; color: white;">Global Leaderboard</h2>
            
            <table class="table modal-signature-blue" style="border-radius: 15px;">
            <thead>
                <tr>
                <th scope="col">#</th>
                <th scope="col">Username</th>
                <th scope="col">Score</th>
                </tr>
            </thead>
            <tbody>';
                $rowNum = 1;
                foreach ($pdo->query($getLeaderboard) as $row) {
                    echo '
                    <tr class="medals">
                    <th scope="row">'.$rowNum.'</th>
                    <td>'.$row['username'].'</td>
                    <td>'.$row['userScore'].'</td>
                    </tr>
                    ';
                    $rowNum++;
                }
                $getStatistics = "SELECT * FROM users ORDER BY userScore DESC";
                $place = 1;
                foreach ($pdo->query($getStatistics) as $row) {
                    if ($row['username'] == $_SESSION['username']) {
                        $userScore = $row['userScore'];
                        $userPlace = $place;
                        $userQuestionsAnswered = $row['questionsAnswered'];
                        $userHighestAnswerStreak = $row['highestAnswerStreak'];
                        if ($row['correctAnswers'] == 0 and $row['wrongAnswers'] == 0) {
                            $userCorrectAnswerRatio = 0;
                        }
                        elseif ($row['correctAnswers'] > 0 and $row['wrongAnswers'] == 0) {
                            $userCorrectAnswerRatio = $row['correctAnswers'];
                        }
                        else {
                            $userCorrectAnswerRatio = ($row['correctAnswers'] / $row['wrongAnswers']);
                        }
                        $userActiveSince = $row['activeSince'];
                    }
                    $place++;
                }
            echo '
            </tbody>
            </table>

            </div>
            <div class="column">
                <form action="updateAccount.php" method="POST" class="modal-signature-blue" id="updateAccountForm" style="max-width: 30vw; padding-left: 1vw; padding-right: 1vw; border-radius: 20px;">
                <div class="form-group" style="padding-top: 1vh;">
                    <label for="Email">Email address</label>
                    <input style="border-radius: 10px;" type="text" name="email" class="form-control" id="Email" aria-describedby="newEmail" pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$" title = "Must be a valid email and less than 64 characters" placeholder="Email" value="'.$email.'" required>
                </div>
                <div class="form-group">
                    <label for="Username">Username</label>
                    <input style="border-radius: 10px;" type="text" name="username" class="form-control" id="Username" placeholder="Username" value="'.$username.'" required>
                </div>
                <div class="form-group">
                    <label for="newPassword">New Password</label>
                    <input style="border-radius: 10px;" type="password" name="newPassword" class="form-control" id="newPassword" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters">
                </div>
                <div class="form-group">
                    <label for="confirmNewPassword">Confirm New Password</label>
                    <input style="border-radius: 10px;" type="password" name="confirmNewPassword" class="form-control" id="confirmNewPassword">
                </div>
                <div align="center" style="padding-bottom: 3vh;">
                <button type="submit" id="updateAccountButton" class="btn-signature-green">Update Account</button>
                </div>
                </form>
            </div>
            <div align="left" class="column" style="position: absolute; right: 2vw;">
                <h2 align="center" style="background-color: #67e827; padding-bottom: 1vh; border-radius: 15px; color: white;">User Statistics</h2>
                <ul class="list-group" style="border-radius: 15px;">
                    <li class="list-group-item modal-signature-blue">Total Score: '.$userScore.'</li>
                    <li class="list-group-item modal-signature-blue">Total Questions Answered: '.$userQuestionsAnswered.'</li>
                    <li class="list-group-item modal-signature-blue">Global Leaderboard Position: '.$userPlace.'</li>
                    <li class="list-group-item modal-signature-blue">Highest Answer Streak: '.$userHighestAnswerStreak.'</li>
                    <li class="list-group-item modal-signature-blue">Correct Answer Ratio: '.$userCorrectAnswerRatio.'</li>
                    <li class="list-group-item modal-signature-blue">Active Since: '.$userActiveSince.'</li>
                </ul>
            </div>
        </div>
    ';
}
include('../../footer.php');