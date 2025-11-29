<?php
session_start();
if(!isset($_SESSION['admin_id'])){ header("Location: login.php"); exit; }

require "../database/connect.php";

// حذف مستخدم
if(isset($_GET['delete'])){
    $id = intval($_GET['delete']);
    mysqli_query($connection,"DELETE FROM admin_users WHERE id=$id");
    header("Location: users.php");
    exit;
}

$result = mysqli_query($connection,"SELECT * FROM admin_users");
include "admin_nav.php";
?>

<!DOCTYPE html>
<html>
<head>
<title>Users – Admin</title>
<link rel="stylesheet" href="../style.css">
<link rel="stylesheet" href="admin.css">
</head>

<body>
<main class="admin-content">

<h1>Users Management 👥</h1>
<p>Manage, view and delete users.</p>

<table class="admin-table">
<tr><th>ID</th><th>Username</th><th>Email</th><th>Role</th><th>Delete</th></tr>

<?php while($u=mysqli_fetch_assoc($result)): ?>
<tr>
<td><?= $u['id'] ?></td>
<td><?= htmlspecialchars($u['username']) ?></td>
<td><?= htmlspecialchars($u['email']) ?></td>
<td><?= $u['role']?></td>
<td><a style="color:red;font-weight:bold;" onclick="return confirm('Delete user?')" href="users.php?delete=<?= $u['id']?>">Delete</a></td>
</tr>
<?php endwhile; ?>
</table>

</main>
</body>
</html>
