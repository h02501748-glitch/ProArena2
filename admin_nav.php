<?php
if(!isset($_SESSION)) session_start();
?>

<!-- ▪▪ الشريط العلوي Top Navbar ▪▪ -->
<div class="admin-topbar">
    <a href="../index.php">🏠 Home</a>
    <a href="dashboard.php">⚡ Admin</a>
    <a href="logout.php" class="logout">🚪 Logout</a>
</div>

<!-- ▪▪ الـ Sidebar الجانبي (ثابت بكل الصفحات) ▪▪ -->
<div class="admin-sidebar">

    <h2>ProArena Admin</h2>  <!-- أصبح العنوان الرئيسي -->

    <a href="dashboard.php" class="active">Dashboard</a>
    <a href="users.php">Users</a>
    <a href="add_user.php">Add User</a>
    <a href="posts.php">Posts</a>
    <a href="comments.php">Comments</a>
    <a href="categories.php">Categories</a>

   
</div>

<style>

    /* ▪▪ الشريط العلوي ▪▪ */
    .admin-topbar{
        width:100%;
        background:#b17cff;
        padding:12px;
        text-align:right;
        font-size:17px;
        font-weight:bold;
        box-shadow:0 2px 6px rgba(0,0,0,.2);
        position:fixed;
        top:0; left:0;
        z-index:10;
    }
    .admin-topbar a{
        margin-right:20px;
        color:white;
        text-decoration:none;
    }
    .admin-topbar .logout{ color:#ffebeb; }

    /* ▪▪ القائمة الجانبية ▪▪ */
    .admin-sidebar{
        width:230px;
        background:#1e1e1e;
        color:white;
        position:fixed;
        top:55px;   /* لأن التوب بار ثابت فوق */
        left:0;
        height:100vh;
        padding:15px;
    }
    .admin-sidebar h2{
        font-size:21px;
        margin-bottom:15px;
        color:#b17cff;
    }
    .admin-sidebar a{
        display:block;
        padding:12px;
        margin-bottom:7px;
        color:white;
        text-decoration:none;
        font-size:16px;
        border-radius:6px;
    }
    .admin-sidebar a:hover{
        background:#b17cff;
    }

    .logout-btn{ background:#ff2424 !important; }
    .logout-btn:hover{ background:#d80000 !important; }

    .back{ background:#444 !important; }
    .back:hover{ background:#666 !important; }

    /* ▪▪ مساحة المحتوى للصفحات ▪▪ */
    .admin-content{
        margin-left:250px;
        margin-top:80px;
        padding:25px;
        width: calc(100% - 270px);
    }

</style>
