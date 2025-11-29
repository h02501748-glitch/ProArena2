
<?php require_once 'database/connect.php'; ?>

<?php
// Get post ID
$id = intval($_GET['id']);

// Fetch post
$post = mysqli_query($connection, "SELECT * FROM blog_posts WHERE id=$id AND status='active'");
$data = mysqli_fetch_assoc($post);
?>

<?php include "includes/header.php"; ?>
<?php include "includes/navbar.php"; ?>

<div style="max-width:800px; margin:auto; padding:20px;">

    <h1><?= htmlspecialchars($data['title']) ?></h1>

    <?php if (!empty($data['image'])): ?>
        <img src="uploads/<?= $data['image'] ?>" style="width:100%; margin:20px 0; border-radius:10px;">
    <?php endif; ?>

    <p><?= nl2br($data['content']) ?></p>

    <hr><h2>Comments</h2>

    <!-- Show comments -->
    <?php
    $comments = mysqli_query($connection, "SELECT * FROM comments WHERE post_id=$id AND status='approved' ORDER BY created_at DESC");
    while ($c = mysqli_fetch_assoc($comments)):
    ?>
        <div style="border-bottom:1px solid #ddd; margin:10px 0; padding-bottom:10px;">
            <strong><?= htmlspecialchars($c['username']) ?></strong>
            <p><?= htmlspecialchars($c['comment_text']) ?></p>
        </div>
    <?php endwhile; ?>

    <hr><h3>Write a comment</h3>

    <form method="POST">
        <input type="text" name="username" placeholder="Your name" required style="width:100%; padding:10px; margin-bottom:10px;">
        <textarea name="comment" required placeholder="Write your comment..." style="width:100%; padding:10px; height:120px;"></textarea>

        <button type="submit" name="add_comment" 
                style="padding:10px 20px; margin-top:10px; border:none; cursor:pointer;">Submit</button>
    </form>

</div>

<?php
// Insert comment
if (isset($_POST['add_comment'])) {

    $name = mysqli_real_escape_string($connection, $_POST['username']);
    $comment = mysqli_real_escape_string($connection, $_POST['comment']);

    mysqli_query($connection, "INSERT INTO comments (post_id, username, comment_text, status, created_at)
                         VALUES ($id, '$name', '$comment', 'pending', NOW())");

    echo "<script>alert('Comment sent and waiting for approval'); window.location='post.php?id=$id';</script>";
}
?>

<?php include "includes/footer.php"; ?>