
 <link rel="stylesheet" href="../style.css">
 <link rel="stylesheet" href="admin.css">
<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit;
}

require_once "../database/connect.php";

// موافقة تعليق
if (isset($_GET['approve'])) {
    $id = (int) $_GET['approve'];
    mysqli_query($connection, "UPDATE comments SET status='approved' WHERE id=$id");
    header("Location: comments.php");
    exit;
}

// إرجاعه pending
if (isset($_GET['reject'])) {
    $id = (int) $_GET['reject'];
    mysqli_query($connection, "UPDATE comments SET status='pending' WHERE id=$id");
    header("Location: comments.php");
    exit;
}

// حذف تعليق
if (isset($_GET['delete'])) {
    $id = (int) $_GET['delete'];
    mysqli_query($connection, "DELETE FROM comments WHERE id=$id");
    header("Location: comments.php");
    exit;
}

// جلب التعليقات مع عنوان البوست
$sql = "SELECT c.*, p.title AS post_title
        FROM comments c
        LEFT JOIN blog_posts p ON c.post_id = p.id
        ORDER BY c.created_at DESC";
$comments = mysqli_query($connection, $sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Comments – ProArena Admin</title>
    <link rel="stylesheet" href="../style.css">
    
</head>
<body>

<?php include "admin_nav.php"; ?>

<main class="admin-content">

    <h1>Comments Management 💬</h1>
    <p>Manage, approve, hide or delete comments on posts.</p>

    <table class="admin-table">
        <tr>
            <th>ID</th>
            <th>Post</th>
            <th>User</th>
            <th>Comment</th>
            <th>Status</th>
            <th>Date</th>
            <th>Actions</th>
        </tr>

        <?php while ($row = mysqli_fetch_assoc($comments)): ?>
            <tr>
                <td><?php echo $row['id']; ?></td>
                <td><?php echo htmlspecialchars($row['post_title']); ?></td>
                <td><?php echo htmlspecialchars($row['username']); ?></td>
                <td><?php echo htmlspecialchars($row['comment_text']); ?></td>
                <td><?php echo htmlspecialchars($row['status']); ?></td>
                <td><?php echo $row['created_at']; ?></td>
                <td>
                    <a href="comments.php?approve=<?php echo $row['id']; ?>">✅</a>
                    <a href="comments.php?reject=<?php echo $row['id']; ?>">⛔</a>
                    <a href="comments.php?delete=<?php echo $row['id']; ?>"
                       onclick="return confirm('Delete this comment?');">🗑</a>
                </td>
            </tr>
        <?php endwhile; ?>
    </table>

    <div class="admin-footer">
        &copy; 2026 ProArena – Esports Championship
    </div>

</main>

</body>
</html>
