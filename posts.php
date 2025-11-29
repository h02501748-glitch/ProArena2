<html lang="en">
<?php 
session_start(); 
if (!isset($_SESSION['admin_id'])) { header("Location: login.php"); exit; } 
require_once "../database/connect.php"; 
$msg = ""; 

/*━━━━━━━━━━━ ADD NEW POST ━━━━━━━━━━━*/
if (isset($_POST['add_post'])) {

    $title   = trim($_POST['title']);
    $content = trim($_POST['content']);

    // رفع الصورة
    $image = $_FILES['image']['name'];
    $tmp   = $_FILES['image']['tmp_name'];

    if($title=="" || $content==""){
        $msg="<p style='color:#ff6b6b;font-weight:bold'>⚠ Please fill all fields.</p>";
    } else {

        if(!empty($image)){
            move_uploaded_file($tmp,"../images/".$image);
        } else {
            $image="default.png"; // قيمة افتراضية
        }

        mysqli_query($connection,
            "INSERT INTO blog_posts(title,content,image,status)
            VALUES('$title','$content','$image','active')"
        );

        $msg="<p style='color:#48ff8a;font-weight:bold'>✔ Post added successfully!</p>";
    }
}

/*━━━━━━━━━━━ FETCH POSTS ━━━━━━━━━━━*/
$posts = mysqli_query($connection,"SELECT * FROM blog_posts ORDER BY created_at DESC");

include "admin_nav.php"; 
?>
<link rel="stylesheet" href="admin.css">

<style>
.post-item img{
    width:100%;
    max-height:260px;
    object-fit:cover;
    border-radius:10px;
    margin:15px 0;
}
.post-table img{
    width:90px;
    border-radius:7px;
}
</style>

<main class="admin-content">

<h1>Posts Management 📝</h1>
<p>Add & manage posts below.</p>

<?= $msg ?>

<!--━━━━━━━━━━━ ADD POST FORM ━━━━━━━━━━━-->
<div class="post-box">
    <h2>Add New Post</h2>

    <form method="POST" enctype="multipart/form-data">

        <label>Post Title</label>
        <input type="text" name="title" placeholder="Enter post title">

        <label>Upload Image</label>
        <input type="file" name="image">

        <label>Post Content</label>
        <textarea name="content" rows="6" placeholder="Write your post here..."></textarea>

        <button type="submit" name="add_post">+ Add Post</button>
    </form>
</div>

<!--━━━━━━━━━━━ DELETE ━━━━━━━━━━━-->
<?php 
if(isset($_GET['delete'])){
    $id=intval($_GET['delete']);
    mysqli_query($connection,"DELETE FROM blog_posts WHERE id=$id");
    header("Location: posts.php");
    exit;
}
?>

<!--━━━━━━━━━━━ TABLE VIEW ━━━━━━━━━━━-->
<table class="posts-table">

<tr>
    <th>ID</th>
    <th>Image</th>
    <th>Title</th>
    <th>Status</th>
    <th>Date</th>
    <th>Actions</th>
</tr>

<?php while($p=mysqli_fetch_assoc($posts)): ?>
<tr>

    <td><?= $p['id']; ?></td>

    <td>
       <?php if(!empty($p['image'])): ?>
            <img src="../images/<?= $p['image']; ?>" width="70" height="60" style="object-fit:cover;border-radius:6px;">
        <?php else: ?>
            <span style="color:#aaa;">No Image</span>
        <?php endif; ?>

    </td>

    <td><?= htmlspecialchars($p['title']); ?></td>
    <td><?= $p['status']; ?></td>
    <td><?= $p['created_at']; ?></td>

    <td>
        <a href="edit_post.php?id=<?= $p['id'] ?>" class="edit">✏ Edit</a> |
        <a href="posts.php?status=<?= $p['status'] ?>&id=<?= $p['id'] ?>" class="status">🔄 Status</a> |
        <a href="posts.php?delete=<?= $p['id'] ?>" onclick="return confirm('Delete this post?')" class="delete">🗑 Delete</a>
    </td>

</tr>
<?php endwhile; ?>

</table>

</main>
</html>
