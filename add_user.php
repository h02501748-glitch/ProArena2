<?php
session_start();
if (!isset($_SESSION['admin_id'])) { header("Location: login.php"); exit; }
require_once "../database/connect.php";

$msg = "";

// إضافة يوزر جديد داخل قاعدة البيانات
if(isset($_POST['add_user'])){
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    $email    = trim($_POST['email']);
    $role     = trim($_POST['role']);

    if($username=="" || $password=="" || $email==""){
        $msg="<p style='color:#ff4b4b;font-weight:bold'>⚠ Please fill all fields!</p>";
    } else {
        mysqli_query($connection,"INSERT INTO admin_users(username,password,email,role)
        VALUES('$username','$password','$email','$role')");
        $msg="<p style='color:#28ffae;font-weight:bold'>✔ User added successfully!</p>";
    }
}

include "admin_nav.php"; // 🔥 مثل صفحة البوست تماماً
?>

<link rel="stylesheet" href="admin.css">

<main class="admin-content">

    <h1>Add User ✚</h1>
    <p>Add a new admin or normal user.</p>

    <?= $msg ?>

    <div class="post-box"> <!-- 🔥 استخدمنا نفس تنسيق صندوق إضافة بوست -->
        <h2>New User</h2>

        <form method="POST">

            <label>Username</label>
            <input type="text" name="username" required>

            <label>Password</label>
            <input type="password" name="password" required>

            <label>Email</label>
            <input type="email" name="email" required>

            <label>Role</label>
            <select name="role">
                <option value="admin">Admin</option>
                <option value="user">User</option>
            </select>

            <button type="submit" name="add_user">+ Add User</button>

        </form>
    </div>

</main>
