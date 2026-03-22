<?php include_once("../admin/includes/header.php"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Signup</title>
    <style>
        .sign-up { width: 60%; margin: auto; padding-top: 30px; }
        .error-msg { color: red; font-size: 12px; margin-top: 4px; display: none; }
        .input-group input.is-invalid { border: 1px solid red; }
        .input-group input.is-valid   { border: 1px solid green; }
    </style>
</head>
<body>
<div class="sign-up">
    <center><h3>Student Signup Form</h3></center>

    <?php if(isset($_REQUEST['message'])): ?>
        <div class="alert alert-warning"><?php echo htmlspecialchars($_REQUEST['message']); ?></div>
    <?php endif; ?>

    <form action="backend/sigup.php" method="post" id="signupForm" novalidate>

        <!-- Full Name -->
        <div class="input-group mb-1">
            <input type="text" class="form-control" name="fullname" id="fullname"
                   placeholder="Full Names" autocomplete="off">
        </div>
        <small class="error-msg" id="err-fullname">❌ Name must contain letters only, no numbers allowed.</small>
        <br>

        <!-- Email -->
        <div class="input-group mb-1">
            <input type="email" class="form-control" name="email" id="email" placeholder="Email">
        </div>
        <small class="error-msg" id="err-email">❌ Please enter a valid email address.</small>
        <br>

        <!-- School -->
        <div class="input-group mb-1">
            <input type="text" class="form-control" name="school" id="school" placeholder="School">
        </div>
        <small class="error-msg" id="err-school">❌ School name is required.</small>
        <br>

        <!-- Location -->
        <div class="input-group mb-1">
            <input type="text" class="form-control" name="location" id="location" placeholder="Location">
        </div>
        <small class="error-msg" id="err-location">❌ Location is required.</small>
        <br>

        <!-- Password -->
        <div class="input-group mb-1">
            <input type="password" class="form-control" name="password" id="password" placeholder="Password">
        </div>
        <small class="error-msg" id="err-password">❌ Password must be at least 6 characters.</small>
        <br>

        <!-- Confirm Password -->
        <div class="input-group mb-1">
            <input type="password" class="form-control" name="cpassword" id="cpassword" placeholder="Confirm Password">
        </div>
        <small class="error-msg" id="err-cpassword">❌ Passwords do not match.</small>
        <br>

        <button type="submit" class="btn btn-primary btn-block">Create Account</button><br>
        <center><a href="index.php">Back home</a></center>
    </form>
</div>

<script>
document.getElementById('signupForm').addEventListener('submit', function(e) {
    let valid = true;

    // --- Full Name: letters and spaces only, no numbers ---
    const fullname = document.getElementById('fullname').value.trim();
    const nameRegex = /^[a-zA-Z\s]+$/;
    if (!fullname || !nameRegex.test(fullname)) {
        showError('fullname', 'err-fullname');
        valid = false;
    } else {
        clearError('fullname', 'err-fullname');
    }

    // --- Email ---
    const email = document.getElementById('email').value.trim();
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!email || !emailRegex.test(email)) {
        showError('email', 'err-email');
        valid = false;
    } else {
        clearError('email', 'err-email');
    }

    // --- School ---
    const school = document.getElementById('school').value.trim();
    if (!school) {
        showError('school', 'err-school');
        valid = false;
    } else {
        clearError('school', 'err-school');
    }

    // --- Location ---
    const location = document.getElementById('location').value.trim();
    if (!location) {
        showError('location', 'err-location');
        valid = false;
    } else {
        clearError('location', 'err-location');
    }

    // --- Password: min 6 characters ---
    const password = document.getElementById('password').value;
    if (password.length < 6) {
        showError('password', 'err-password');
        valid = false;
    } else {
        clearError('password', 'err-password');
    }

    // --- Confirm Password ---
    const cpassword = document.getElementById('cpassword').value;
    if (cpassword !== password) {
        showError('cpassword', 'err-cpassword');
        valid = false;
    } else {
        clearError('cpassword', 'err-cpassword');
    }

    if (!valid) e.preventDefault(); // Stop form if errors exist
});

// Live check on fullname — block numbers as user types
document.getElementById('fullname').addEventListener('input', function() {
    const nameRegex = /^[a-zA-Z\s]+$/;
    if (this.value && !nameRegex.test(this.value)) {
        showError('fullname', 'err-fullname');
    } else {
        clearError('fullname', 'err-fullname');
    }
});

function showError(inputId, errorId) {
    document.getElementById(inputId).classList.add('is-invalid');
    document.getElementById(inputId).classList.remove('is-valid');
    document.getElementById(errorId).style.display = 'block';
}

function clearError(inputId, errorId) {
    document.getElementById(inputId).classList.remove('is-invalid');
    document.getElementById(inputId).classList.add('is-valid');
    document.getElementById(errorId).style.display = 'none';
}
</script>
</body>
</html>
