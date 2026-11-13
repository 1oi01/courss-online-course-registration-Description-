<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cours's</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
<header class="site-header">
    <div class="logo-area">
        <a href="index.php" class="logo">Cours's</a>
        <p>Smart registration for professional technology courses</p>
    </div>
    <nav class="main-nav">
        <a href="index.php">Home</a>
        <a href="register_login.php">Register / Login</a>
        <a href="courses.php">Courses</a>
        <a href="enroll.php">Enrollment</a>
        <a href="history.php">History</a>
    </nav>
</header>
<main>
