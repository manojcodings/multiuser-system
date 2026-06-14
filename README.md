# 🚀 Multi-User Role-Based Dashboard

<div align="center">

![PHP](https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-4479A1?style=for-the-badge&logo=mysql&logoColor=white)
![Bootstrap](https://img.shields.io/badge/Bootstrap-7952B3?style=for-the-badge&logo=bootstrap&logoColor=white)
![License](https://img.shields.io/badge/License-MIT-green?style=for-the-badge)

**A sleek, role-based user management system with secure authentication and a dynamic, color-coded dashboard.**

</div>

---

## ✨ Features

- 🔐 **Secure Authentication** — Session-based login & registration
- 🎯 **Role-Based Access Control** — Admin, HR, and Digital Marketing roles with distinct permissions
- 🎨 **Color-Coded Sidebar** — Instantly see what each role can access
- 📊 **Interactive Dashboard** — Manage users with Edit & Delete actions
- 📱 **Fully Responsive** — Built with Bootstrap 5, works on any device
- ⚡ **Collapsible Sidebar** — Clean, modern slide-out navigation

---

## 🖥️ Tech Stack

| Layer | Technology |
|-------|-----------|
| Backend | PHP (mysqli) |
| Database | MySQL |
| Frontend | HTML5, CSS3, Bootstrap 5 |
| Auth | PHP Sessions |

---

## 🔑 Role Access Matrix

| Module | Admin | HR | Digital Marketing |
|--------|:---:|:---:|:---:|
| Dashboard | ✅ | ✅ | ✅ |
| Manage Employees | ✅ | ✅ | ❌ |
| Attendance / Payroll | ✅ | ✅ | ❌ |
| Campaigns | ✅ | ❌ | ✅ |
| Analytics / Social Media | ✅ | ❌ | ✅ |
| System Settings | ✅ | ❌ | ❌ |
| All Users View | ✅ | ❌ | ❌ |

---

## 🛠️ Setup Instructions

### 1️⃣ Clone the repository
```bash
git clone https://github.com/manojcodings/multiuser-system.git
cd multiuser-system
```

### 2️⃣ Set up the database
Create a MySQL database and run:
```sql
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    uname VARCHAR(50) NOT NULL,
    email VARCHAR(100) NOT NULL,
    upwd VARCHAR(255) NOT NULL,
    role VARCHAR(50) NOT NULL,
    added_date DATE NOT NULL
);
```

### 3️⃣ Configure database connection
Copy `connection.example.php` to `connection.php` and update credentials:
```php
<?php
$conn = mysqli_connect("localhost", "root", "", "your_database_name");
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
```

### 4️⃣ Run the project
- Place the folder inside `htdocs` (XAMPP)
- Start Apache & MySQL from XAMPP Control Panel
- Visit `http://localhost/multiuser/registration.php`

---

## 📂 Project Structure
