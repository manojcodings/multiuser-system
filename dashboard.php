<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

if (!isset($_SESSION['uname'])) {
    header("Location: login.php");
    exit();
}

include('connection.php');

$role = $_SESSION['role'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Dashboard</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
  <style>
    body {
      background: linear-gradient(135deg, #1f1c2c 0%, #928dab 100%);
      min-height: 100vh;
      font-family: 'Segoe UI', sans-serif;
      margin: 0;
      display: flex;
    }

    /* Sidebar */
    .sidebar {
      width: 260px;
      background: #1f1c2c;
      min-height: 100vh;
      padding-top: 20px;
      transition: margin-left 0.3s ease;
      flex-shrink: 0;
    }
    .sidebar.collapsed { margin-left: -260px; }

    .sidebar .brand {
      color: #fff;
      font-weight: 800;
      font-size: 1.3rem;
      padding: 10px 25px 25px;
      letter-spacing: -0.5px;
    }

    .sidebar a {
      display: block;
      color: #fff;
      padding: 12px 25px;
      text-decoration: none;
      font-weight: 600;
      font-size: 0.95rem;
      transition: 0.2s;
      border-left: 4px solid transparent;
    }
    .sidebar a:hover { filter: brightness(1.2); }
    .sidebar a.active { border-left: 4px solid #fff; }

    /* Section labels */
    .section-label {
      text-transform: uppercase;
      font-size: 0.72rem;
      letter-spacing: 1.5px;
      padding: 16px 25px 6px;
      font-weight: 800;
    }

    /* Color-coded sections */
    .section-admin    { background: #2c2350; }
    .section-admin .section-label { color: #c9b8ff; }

    .section-hr       { background: #1f3d2e; }
    .section-hr .section-label { color: #9be3b9; }

    .section-marketing { background: #4a2e1a; }
    .section-marketing .section-label { color: #ffc99b; }

    .section-account  { background: #2a2a2a; }
    .section-account .section-label { color: #bbbbbb; }

    /* Main content */
    .main-content { flex-grow: 1; transition: margin-left 0.3s ease; }
    .topbar {
      background: #fff;
      padding: 15px 25px;
      display: flex;
      align-items: center;
      justify-content: space-between;
      box-shadow: 0 2px 10px rgba(0,0,0,0.08);
    }
    .toggle-btn {
      background: #2c2350;
      border: none;
      color: #fff;
      width: 40px;
      height: 40px;
      border-radius: 8px;
      font-size: 1.2rem;
      cursor: pointer;
    }
    .toggle-btn:hover { background: #1f1c2c; }

    .container-card {
      background: #fff;
      border-radius: 15px;
      box-shadow: 0 15px 40px rgba(0,0,0,0.25);
      padding: 35px 40px;
      max-width: 1000px;
      margin: 30px auto;
    }
    h2 { color: #2c2350; font-weight: 800; letter-spacing: -0.5px; }
    p.subtitle { color: #888; margin-bottom: 25px; }
    .table thead { background-color: #2c2350; color: #fff; }
    .table thead th { border: none; padding: 14px; font-weight: 600; }
    .table tbody td { padding: 14px; vertical-align: middle; }
    .badge-role {
      padding: 6px 12px;
      border-radius: 20px;
      font-size: 0.8rem;
      font-weight: 600;
      text-transform: capitalize;
    }
    .badge-hr { background: #d4f5e2; color: #1f3d2e; }
    .badge-digital-marketing { background: #ffe6d1; color: #4a2e1a; }

    .user-pill {
      background: #f0eefa;
      color: #2c2350;
      padding: 8px 16px;
      border-radius: 20px;
      font-weight: 600;
      font-size: 0.9rem;
    }

    /* Legend */
    .legend {
      display: flex;
      gap: 15px;
      flex-wrap: wrap;
      margin-bottom: 20px;
    }
    .legend-item {
      display: flex;
      align-items: center;
      gap: 8px;
      font-size: 0.85rem;
      font-weight: 600;
      color: #555;
    }
    .legend-dot {
      width: 14px;
      height: 14px;
      border-radius: 4px;
      display: inline-block;
    }

    @media (max-width: 768px) {
      .sidebar { position: fixed; z-index: 1000; }
      .sidebar:not(.collapsed) { margin-left: 0; }
    }
  </style>
</head>
<body>

<!-- Sidebar -->
<div class="sidebar" id="sidebar">
  <div class="brand">📊 Admin Panel</div>

  <a href="dashboard.php" class="active" style="border-left:4px solid #fff;">🏠 Dashboard</a>

  <?php if ($role === 'admin' || $role === 'hr' || $role === 'digital-marketing'): ?>
    <!-- Admin only section -->
    <?php if ($role === 'admin'): ?>
    <div class="section-admin">
      <div class="section-label">🟣 Admin Only</div>
      <a href="employees.php">👥 Manage Employees</a>
      <a href="campaigns.php">📢 Manage Campaigns</a>
      <a href="settings.php">⚙️ System Settings</a>
      <a href="all-users.php">🗂️ All Users (HR + Marketing)</a>
    </div>
    <?php endif; ?>

    <!-- HR section -->
    <?php if ($role === 'hr' || $role === 'admin'): ?>
    <div class="section-hr">
      <div class="section-label">🟢 HR Department</div>
      <a href="employees.php">👥 Employees</a>
      <a href="attendance.php">🗓️ Attendance</a>
      <a href="payroll.php">💰 Payroll</a>
    </div>
    <?php endif; ?>

    <!-- Marketing section -->
    <?php if ($role === 'digital-marketing' || $role === 'admin'): ?>
    <div class="section-marketing">
      <div class="section-label">🟠 Digital Marketing</div>
      <a href="campaigns.php">📢 Campaigns</a>
      <a href="analytics.php">📈 Analytics</a>
      <a href="social-media.php">📱 Social Media</a>
    </div>
    <?php endif; ?>
  <?php endif; ?>

  <!-- Shared account section -->
  <div class="section-account">
    <div class="section-label">⚪ Account</div>
    <a href="profile.php">👤 My Profile</a>
    <a href="logout.php">🚪 Logout</a>
  </div>
</div>

<!-- Main content -->
<div class="main-content">
  <div class="topbar">
    <button class="toggle-btn" id="toggleBtn">☰</button>
    <div class="user-pill">
      <?= htmlspecialchars($_SESSION['uname']) ?> — <?= htmlspecialchars(str_replace('-', ' ', $role)) ?>
    </div>
  </div>

  <div class="container-card">
    <h2>Registered Users</h2>
    <p class="subtitle">Overview of all registered accounts</p>

    <div class="legend">
      <div class="legend-item"><span class="legend-dot" style="background:#2c2350;"></span> Admin Access</div>
      <div class="legend-item"><span class="legend-dot" style="background:#1f3d2e;"></span> HR Access</div>
      <div class="legend-item"><span class="legend-dot" style="background:#4a2e1a;"></span> Marketing Access</div>
      <div class="legend-item"><span class="legend-dot" style="background:#2a2a2a;"></span> Shared Account Access</div>
    </div>

    <div class="table-responsive">
      <table class="table table-hover align-middle">
        <thead>
          <tr>
            <th>Username</th>
            <th>Email</th>
            <th>Role</th>
            <th>Added Date</th>
            <th>Edit</th>
            <th>Delete</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $sql = "SELECT id, uname, email, role, added_date FROM users ORDER BY added_date DESC";
          $result = mysqli_query($conn, $sql);

          if ($result && mysqli_num_rows($result) > 0):
              while ($row = mysqli_fetch_assoc($result)):
          ?>
            <tr>
              <td><strong><?= htmlspecialchars($row['uname']) ?></strong></td>
              <td><?= htmlspecialchars($row['email']) ?></td>
              <td>
                <span class="badge-role badge-<?= htmlspecialchars($row['role']) ?>">
                  <?= htmlspecialchars(str_replace('-', ' ', $row['role'])) ?>
                </span>
              </td>
              <td><?= htmlspecialchars($row['added_date']) ?></td>
              <td>
                <a href="edit.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-outline-primary">Edit</a>
              </td>
              <td>
                <a href="delete.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure you want to delete this user?');">Delete</a>
              </td>
            </tr>
          <?php
              endwhile;
          else:
          ?>
            <tr><td colspan="6" class="text-center text-muted">No users found</td></tr>
          <?php endif; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>

<script>
  document.getElementById('toggleBtn').addEventListener('click', function() {
    document.getElementById('sidebar').classList.toggle('collapsed');
  });
</script>

</body>
</html>