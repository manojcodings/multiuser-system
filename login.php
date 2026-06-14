<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include('connection.php');
session_start();

$msg = '';

if (isset($_POST['submit'])) {
    $uname = trim($_POST['uname']);
    $upwd  = $_POST['upwd'];

    if (empty($uname) || empty($upwd)) {
        $msg = "All fields are required.";
    } else {
        $uname_esc = mysqli_real_escape_string($conn, $uname);
        $upwd_esc  = mysqli_real_escape_string($conn, $upwd);

        $sql = "SELECT * FROM users WHERE uname = '$uname_esc' AND upwd = '$upwd_esc'";
        $result = mysqli_query($conn, $sql);

        if ($result && mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $_SESSION['uname'] = $row['uname'];
            $_SESSION['role']  = $row['role'];

            header("Location: dashboard.php");
            exit();
        } else {
            $msg = "Invalid username or password.";
        }
    }
//    $row = mysqli_fetch_assoc($result);
// print_r($row);
            if(!empty($data))
                {
                    $_SESSION['user_role']=$data['role'];
                    $_SESSION['username']=$data['uname'];

                    header('location:dashboard.php');
                }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Login</title>
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
      background: url('https://images.unsplash.com/photo-1517694712202-14dd9538aa97?auto=format&fit=crop&w=600&q=80') center/cover;
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
      <h2>Welcome Back</h2>
      <p class="subtitle">Login to continue to your account</p>

      <?php if ($msg !== ''): ?>
        <div class="alert alert-danger">
          <?= htmlspecialchars($msg) ?>
        </div>
      <?php endif; ?>

      <form method="post">
        <div class="mb-3">
          <label for="uname" class="form-label">Username</label>
          <input type="text" class="form-control" id="uname" placeholder="Enter username" name="uname" required>
        </div>
        <div class="mb-3">
          <label for="upwd" class="form-label">Password</label>
          <input type="password" class="form-control" id="upwd" placeholder="Enter password" name="upwd" required>
        </div>
        <button type="submit" name="submit" class="btn btn-primary w-100">Login</button>
      </form>

      <p class="text-center mt-3" style="color:#999;">
        Don't have an account? <a href="registration.php">Register here</a>
      </p>
    </div>
  </div>
</div>

</body>
</html>