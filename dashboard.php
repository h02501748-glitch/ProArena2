<?php
session_start();
if (!isset($_SESSION['admin_id'])) { header("Location: login.php"); exit; }
include "admin_nav.php";
?>
<!DOCTYPE html>
<html>
<head>
<title>Admin Dashboard – ProArena</title>
<link rel="stylesheet" href="../style.css">
<link rel="stylesheet" href="admin.css">
</head>

<body>
<main class="admin-content">
<h1>Dashboard Overview 📊</h1>

<div style="display:flex; gap:30px; flex-wrap:wrap; justify-content:center; margin-top:25px;">

    <div class="dashboard-box">
        <h3>Posts</h3>
     
        <a href="posts.php">Manage</a>
    </div>

    <div class="dashboard-box">
        <h3>Users</h3>
       
        <a href="users.php">Manage</a>
    </div>

    <div class="dashboard-box">
        <h3>Comments</h3>
  
        <a href="comments.php">Review</a>
    </div>

     <div class="dashboard-box">
        <h3>Categories</h3>
     
        <a href="categories.php">Manage</a>
    </div>

</div>

</main>

</body>
</html>
