<?php
include('connection.php');

$sql = "SELECT uname, email, role, added_date FROM users ORDER BY added_date DESC";
$result = mysqli_query($conn, $sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Registered Users</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background: linear-gradient(135deg, #1f1c2c 0%, #928dab 100%);
      min-height: 100vh;
      font-family: 'Segoe UI', sans-serif;
      padding: 40px 0;
    }
    .container-card {
      background: #fff;
      border-radius: 15px;
      box-shadow: 0 15px 40px rgba(0,0,0,0.25);
      padding: 35px 40px;
      max-width: 1000px;
      margin: auto;
    }
    h2 {
      color: #2c2350;
      font-weight: 800;
      letter-spacing: -0.5px;
    }
    p.subtitle { color: #888; margin-bottom: 25px; }
    .table thead {
      background-color: #2c2350;
      color: #fff;
    }
    .table thead th {
      border: none;
      padding: 14px;
      font-weight: 600;
    }
    .table tbody td {
      padding: 14px;
      vertical-align: middle;
    }
    .badge-role {
      padding: 6px 12px;
      border-radius: 20px;
      font-size: 0.8rem;
      font-weight: 600;
      text-transform: capitalize;
    }
    .badge-hr { background: #e0d4ff; color: #5a3e85; }
    .badge-digital-marketing { background: #d4f1ff; color: #1c6e8c; }
  </style>
</head>
<body>
<div class="container-card">
  <h2>Registered Users</h2>
  <p class="subtitle">Overview of all registered accounts</p>

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
        <?php if (mysqli_num_rows($result) > 0): ?>
          <?php while ($row = mysqli_fetch_assoc($result)): ?>
          <tr>
            <td><strong><?= htmlspecialchars($row['uname']) ?></strong></td>
            <td><?= htmlspecialchars($row['email']) ?></td>
            <td>
              <span class="badge-role badge-<?= htmlspecialchars($row['role']) ?>">
                <?= htmlspecialchars(str_replace('-', ' ', $row['role'])) ?>
              </span>
            </td>
            <td><?= htmlspecialchars($row['added_date']) ?></td>
          </tr>
          <?php endwhile; ?>
        <?php else: ?>
          <tr><td colspan="4" class="text-center text-muted">No users found</td></tr>
        <?php endif; ?>
      </tbody>
    </table>
  </div>
</div>
</body>
</html>