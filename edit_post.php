<link rel="stylesheet" href="admin.css">
<?php
session_start();
if (!isset($_SESSION['admin_id'])) { header("Location: login.php"); exit; }
require_once "../database/connect.php";

$id = intval($_GET['id']);
$post = mysqli_query($connection,"SELECT * FROM blog_posts WHERE id=$id");
$data = mysqli_fetch_assoc($post);
if(!$data){ die("Invalid post ID"); }

$msg="";
if(isset($_POST['update_post'])){

    $title   = trim($_POST['title']);
    $content = trim($_POST['content']);
    $status  = $_POST['status'];

    // صورة جديدة؟
    $newImage = $_FILES['image']['name'];
    $tmp      = $_FILES['image']['tmp_name'];

    if($newImage!=""){
        move_uploaded_file($tmp,"../images/".$newImage);
        $imgUpdate = ", image='$newImage' ";
    }else{
        $imgUpdate = "";
    }

    mysqli_query($connection,"UPDATE blog_posts SET 
            title='$title',
            content='$content',
            status='$status'
            $imgUpdate
        WHERE id=$id");

    $msg="<p style='color:#28a745;font-weight:bold'>✔ Post updated successfully.</p>";

    $post = mysqli_query($connection,"SELECT * FROM blog_posts WHERE id=$id");
    $data = mysqli_fetch_assoc($post);
}

include "admin_nav.php";
?>

<main class="admin-content">
<h1>Edit Post ✏</h1>
<?= $msg ?>

<div class="post-box">
<form method="POST" enctype="multipart/form-data">

<label>Post Title</label>
<input type="text" name="title" value="<?=htmlspecialchars($data['title'])?>">

<label>Current Image:</label>
<?php if(!empty($data['image'])): ?>
    <img src="../images/<?= $data['image'] ?>" width="160" style="border-radius:8px;margin:8px 0;">
<?php endif; ?>

<label>Upload New Image(optional)</label>
<input type="file" name="image">

<label style="margin-top:10px;">Post Content</label>
<textarea name="content" rows="6"><?=htmlspecialchars($data['content'])?></textarea>

<label>Status</label>
<select name="status">
    <option value="active" <?=$data['status']=="active"?"selected":""?>>Active</option>
    <option value="hidden" <?=$data['status']=="hidden"?"selected":""?>>Hidden</option>
</select>

<button type="submit" name="update_post">Save Changes</button>

</form>
</div>

</main>
