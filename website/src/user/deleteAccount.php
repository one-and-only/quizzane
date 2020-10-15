<?php
ob_start();
session_name('user');
session_start();
session_regenerate_id(true);
include('../dbconn.php');

// delete the user
$deleteUser = 'DELETE FROM users WHERE username = :username';
$username = [
    ':username' => $_SESSION['username']
];
$deleteUser = $pdo->prepare($deleteUser);
$deleteUser->execute($username);

// delete all answers
$deleteAnswers = 'DELETE ans FROM answers ans INNER JOIN users usr ON ans.user_id = usr.user_id WHERE usr.username = :username';
$username = [
    ':username' => $_SESSION['username']
];
$deleteAnswers = $pdo->prepare($deleteAnswers);
$deleteAnswers->execute($username);

// delete all games
$deleteGames = 'DELETE gms FROM games gms INNER JOIN users usr ON gms.user_id = usr.user_id WHERE usr.username = :username';
$username = [
    ':username' => $_SESSION['username']
];
$deleteGames = $pdo->prepare($deleteGames);
$deleteGames->execute($username);

// delete all questions
$deleteQuestions = 'DELETE q FROM questions q INNER JOIN users usr ON q.user_id = usr.user_id WHERE usr.username = :username';
$username = [
    ':username' => $_SESSION['username']
];
$deleteQuestions = $pdo->prepare($deleteQuestions);
$deleteQuestions->execute($username);

// logout the user and redirect to home page
session_destroy();
header('Location: /');
ob_end_flush();