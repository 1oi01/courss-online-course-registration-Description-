<?php include 'header.php'; ?>
<script src="assets/js/validation.js"></script>

<h1 class="section-title">Register / Login</h1>
<p>This page gives students a simple access point before they continue to course enrollment.</p>

<section class="form-grid">
    <div class="form-box">
        <h2>Create Student Account</h2>
        <form action="register_login.php" method="post" onsubmit="return validateRegisterForm();">
            <input type="hidden" name="form_type" value="register">
            <div class="form-control">
                <label for="full_name">Full Name</label>
                <input type="text" id="full_name" name="full_name" placeholder="Enter your full name">
            </div>
            <div class="form-control">
                <label for="email">Email Address</label>
                <input type="email" id="email" name="email" placeholder="student@example.com">
            </div>
            <div class="form-control">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="At least 6 characters">
            </div>
            <button type="submit">Register</button>
        </form>
    </div>

    <div class="form-box">
        <h2>Student Login</h2>
        <form action="register_login.php" method="post" onsubmit="return validateLoginForm();">
            <input type="hidden" name="form_type" value="login">
            <div class="form-control">
                <label for="login_email">Email Address</label>
                <input type="email" id="login_email" name="login_email" placeholder="student@example.com">
            </div>
            <div class="form-control">
                <label for="login_password">Password</label>
                <input type="password" id="login_password" name="login_password" placeholder="Enter your password">
            </div>
            <button type="submit">Login</button>
        </form>
    </div>
</section>

<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if ($_POST["form_type"] === "register") {
        $_SESSION["student_name"] = htmlspecialchars($_POST["full_name"]);
        echo "<p class='message success'>Account form received for " . $_SESSION["student_name"] . ". You can now continue to enrollment.</p>";
    }

    if ($_POST["form_type"] === "login") {
        $_SESSION["student_email"] = htmlspecialchars($_POST["login_email"]);
        echo "<p class='message success'>Login form received successfully. You can now browse and enroll in courses.</p>";
    }
}
?>

<?php include 'footer.php'; ?>
