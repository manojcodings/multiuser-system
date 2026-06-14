<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include('connection.php');

$msg = '';
$result = false;

if (isset($_POST['submit'])) {
    date_default_timezone_set('Asia/Kolkata');

    $uname = trim($_POST['uname']);
    $email = trim($_POST['email']);
    $upwd  = $_POST['upwd'];
    $role  = $_POST['role'];
    $date  = date('Y-m-d');

    // Basic validation
    if (empty($uname) || empty($email) || empty($upwd) || empty($role)) {
        $msg = "All fields are required.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $msg = "Invalid email format.";
    } else {
        $uname_esc = mysqli_real_escape_string($conn, $uname);
        $email_esc = mysqli_real_escape_string($conn, $email);
        $upwd_esc  = mysqli_real_escape_string($conn, $upwd);
        $role_esc  = mysqli_real_escape_string($conn, $role);

        $sql = "INSERT INTO users (uname, email, upwd, role, added_date)
                VALUES ('$uname_esc', '$email_esc', '$upwd_esc', '$role_esc', '$date')";

        $result = mysqli_query($conn, $sql);

        if ($result) {
            $msg = "Registration successful!";
        } else {
            $msg = "Database Error: " . mysqli_error($conn);
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Registration</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background: linear-gradient(135deg, #1f1c2c 0%, #928dab 100%);
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      font-family: 'Segoe UI', sans-serif;
      margin: 0;
    }
    .card {
      border: none;
      border-radius: 18px;
      overflow: hidden;
      box-shadow: 0 20px 50px rgba(0,0,0,0.35);
      max-width: 950px;
      width: 100%;
    }
    .card-img-side {
      background: url('https://images.unsplash.com/photo-1544005313-94ddf0286df2?auto=format&fit=crop&w=600&q=80') center/cover;
      min-height: 100%;
      position: relative;
    }
    .card-img-side::after {
      content: "";
      position: absolute;
      inset: 0;
      background: linear-gradient(180deg, rgba(0,0,0,0.1), rgba(0,0,0,0.5));
    }
    .form-side {
      padding: 55px 45px;
      background: #ffffff;
    }
    .form-side h2 {
      color: #2c2350;
      font-weight: 800;
      letter-spacing: -0.5px;
      margin-bottom: 5px;
    }
    .form-side p.subtitle { color: #999; margin-bottom: 30px; }
    .form-control {
      padding: 12px 14px;
      border-radius: 8px;
      border: 1px solid #ddd;
    }
    .form-control:focus {
      border-color: #928dab;
      box-shadow: 0 0 0 0.2rem rgba(146,141,171,0.25);
    }
    .btn-primary {
      background-color: #2c2350;
      border: none;
      padding: 12px;
      font-weight: 600;
      border-radius: 8px;
      transition: 0.2s;
    }
    .btn-primary:hover { background-color: #1f1c2c; }
    .alert { border-radius: 10px; }
  </style>
</head>
<body>

<div class="card">
  <div class="row g-0">
    <div class="col-md-5 card-img-side d-none d-md-block"></div>
    <div class="col-md-7 form-side">
      <h2>Create Account</h2>
      <p class="subtitle">Join us — it only takes a minute</p>

      <?php if ($msg !== ''): ?>
        <div class="alert <?= $result ? 'alert-success' : 'alert-danger' ?>">
          <?= htmlspecialchars($msg) ?>
        </div>
      <?php endif; ?>

      <form method="post">
        <div class="mb-3">
          <label for="uname" class="form-label">Username</label>
          <input type="text" class="form-control" id="uname" placeholder="Enter username" name="uname" required>
        </div>
        <div class="mb-3">
          <label for="email" class="form-label">Email</label>
          <input type="email" class="form-control" id="email" placeholder="Enter email" name="email" required>
        </div>
        <div class="mb-3">
          <label for="upwd" class="form-label">Password</label>
          <input type="password" class="form-control" id="upwd" placeholder="Enter password" name="upwd" required>
        </div>
        <div class="mb-3">
          <label for="role" class="form-label">Role</label>
          <select class="form-control" id="role" name="role" required>
            <option value="">Select Role</option>
            <option value="hr">HR</option>
            <option value="digital-marketing">Digital Marketing</option>
          </select>
        </div>
        <button type="submit" name="submit" class="btn btn-primary w-100">Register</button>
      </form>
    </div>
  </div>
</div>

</body>
</html>