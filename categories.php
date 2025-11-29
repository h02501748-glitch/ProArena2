<html lang="en">
<?php
session_start();
if (!isset($_SESSION['admin_id'])) { 
    header("Location: login.php"); 
    exit; 
}
require_once "../database/connect.php";

// ======= تأكد من وجود عمود created_at =======
mysqli_query($connection, "ALTER TABLE categories ADD COLUMN IF NOT EXISTS created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP");

// ADD NEW CATEGORY
$msg = "";
if (isset($_POST['add_category'])) {
    $name = trim($_POST['name']);
    if ($name == "") {
        $msg = "<p class='msg error'>⚠ Please enter category name.</p>";
    } else {
        mysqli_query($connection, "INSERT INTO categories(name,status) VALUES('$name','active')");
        $msg = "<p class='msg success'>✔ Category added successfully!</p>";
    }
}

// DELETE CATEGORY
if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    mysqli_query($connection, "DELETE FROM categories WHERE id=$id");
    header("Location: categories.php");
    exit;
}

/* ===========================
      ✏ FEATURE: EDIT CATEGORY
   =========================== */

// GET CATEGORY DATA TO EDIT
$edit_data = null;
if (isset($_GET['edit'])) {
    $edit_id = intval($_GET['edit']);
    $result = mysqli_query($connection, "SELECT * FROM categories WHERE id = $edit_id");
    $edit_data = mysqli_fetch_assoc($result);
}

// UPDATE CATEGORY
if (isset($_POST['update_category'])) {
    $id = intval($_POST['id']);
    $name = trim($_POST['name']);

    if ($name == "") {
        $msg = "<p class='msg error'>⚠ Please enter category name.</p>";
    } else {
        mysqli_query($connection, "UPDATE categories SET name='$name' WHERE id=$id");
        header("Location: categories.php");
        exit;
    }
}

// FETCH CATEGORIES 
$categories = mysqli_query($connection, "SELECT * FROM categories ORDER BY created_at DESC");

include "admin_nav.php";
?>
<link rel="stylesheet" href="admin.css">

<style>
/* ======= ستايل الصفحة ======= */
.admin-content {
    max-width: 900px;
    margin: 40px auto;
    padding: 0 20px;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    color: #23231dff;
}

h1, h2 {
    text-align: center;
    margin-bottom: 20px;
    color: #222;
}

.category-box, .categories-list {
    background: rgba(202, 202, 198, 1);
    padding: 20px;
    border-radius: 12px;
    box-shadow: 0 6px 15px rgba(0,0,0,0.1);
    margin-bottom: 30px;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.category-box:hover, .category-item:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 25px rgba(0,0,0,0.15);
}

input[type="text"] {
    width: 100%;
    padding: 12px;
    margin: 10px 0 15px 0;
    border: 1px solid #ccc;
    border-radius: 8px;
    transition: border 0.3s ease;
}

input[type="text"]:focus {
    border-color: #d62a91ff;
    outline: none;
}

button {
    padding: 12px 20px;
    background-color: #4128a7ff;
    border: none;
    color: white;
    font-weight: bold;
    border-radius: 8px;
    cursor: pointer;
    transition: background-color 0.3s ease, transform 0.2s ease;
}

button:hover {
    background-color: #c74dddff;
    transform: scale(1.05);
}

.category-item {
    border: 1px solid #9d7cb4ff;
    padding: 20px;
    border-radius: 12px;
    margin-bottom: 15px;
    background-color: #9561a5ff;
    transition: background-color 0.3s ease;
}

.category-item:hover {
    background-color: #af7cbcff;
}

.category-item a {
    text-decoration: none;
    margin-right: 15px;
    transition: color 0.3s ease;
}

.category-item a:hover {
    color: #b0c362ff;
}

.msg {
    text-align: center;
    font-weight: bold;
    padding: 10px 0;
    border-radius: 8px;
    margin-bottom: 20px;
    animation: fadeIn 0.5s ease forwards;
}

.msg.success { background-color: #73a27eff; color: #155724; }
.msg.error { background-color: #b7686fff; color: #721c24; }

/* ====== حركة fadeIn ====== */
@keyframes fadeIn {
    from {opacity: 0; transform: translateY(-10px);}
    to {opacity: 1; transform: translateY(0);}
}
</style>

<main class="admin-content">

    <h1>Categories Management 📂</h1>
    <p style="text-align:center;">Add and manage categories below.</p>

    <?= $msg ?>

    <!-- 📌 إضافة / تعديل تصنيف -->
    <div class="category-box">

        <?php if ($edit_data): ?>
            <h2>Edit Category</h2>
            <form method="POST">
                <input type="hidden" name="id" value="<?= $edit_data['id'] ?>">

                <label>Category Name</label>
                <input type="text" name="name" value="<?= htmlspecialchars($edit_data['name']) ?>">

                <button type="submit" name="update_category">✔ Update</button>
            </form>
            <hr style="margin: 30px 0; border: 0; border-top: 2px solid #999;">

        <?php else: ?>

            <h2>Add New Category</h2>
            <form method="POST">
                <label>Category Name</label>
                <input type="text" name="name" placeholder="Enter category name">
                <button type="submit" name="add_category">+ Add Category</button>
            </form>

        <?php endif; ?>

    </div>

    <!-- عرض التصنيفات -->
    <div class="categories-list">
        <h2>All Categories</h2>
        <?php while ($c = mysqli_fetch_assoc($categories)): ?>
            <div class="category-item">
                <h3><?= htmlspecialchars($c['name']); ?></h3>
                <small>Status: <?= $c['status']; ?> | Date: <?= date("d M Y, H:i", strtotime($c['created_at'])); ?></small><br>

                <a href="categories.php?edit=<?= $c['id'] ?>">✏ Edit</a> |
                <a href="categories.php?delete=<?= $c['id'] ?>" onclick="return confirm('Delete this category?')" style="color:red">🗑 Delete</a>
            </div>
        <?php endwhile; ?>
    </div>

</main>
