<?php require_once 'database/connect.php'; ?>
<?php
$search = '';

if (isset($_GET['q'])) {
    $search = trim($_GET['q']);
}

$sql = "SELECT * FROM blog_posts WHERE status = 'active'";

if ($search !== '') {
    $safe = mysqli_real_escape_string($connection, $search);
    $sql .= " AND (title LIKE '%$safe%' OR content LIKE '%$safe%')";
}

$sql .= " ORDER BY created_at DESC";
$posts = mysqli_query($connection, $sql);
?>

<?php include "includes/header.php"; ?>

<?php include "includes/navbar.php"; ?>

    <!-- Hero Section -->
    <section class="hero" style="text-align:center; padding: 60px 20px;">
        <h1> Welcome to <strong>ProArena</strong>, the official platform for the <strong>Esports Championship 2026</strong>!  
            Register as a player, choose your favorite game, check the <strong>tournament schedule</strong>, and secure your spot before it’s gone! 🤩🔥</h1>

        <p style="font-size:18px; margin-top:10px; max-width:700px; margin:auto;">
            Compete for the title of <strong>Best Player of 2026</strong>.  
            Whether you're a shooter, strategist, or competitive gamer, this is your chance to shine and challenge the best!
        </p>

        </p>
<!-- Search Box -->
<form action="index.php" method="get" style="max-width:600px; margin:20px auto; display:flex; gap:10px;">
    <input 
        type="text" 
        name="q" 
        placeholder="Search posts..."
        value="<?php echo htmlspecialchars($search); ?>"
        style="flex:1; padding:10px;">
    <button type="submit" class="submit-btn">Search</button>
</form>

<!-- Blog Posts -->
<div style="display:flex; gap:20px; justify-content:center; flex-wrap:wrap;">

<?php if ($posts && mysqli_num_rows($posts) > 0): ?>
    <?php while ($post = mysqli_fetch_assoc($posts)): ?>

        <div class="feature-box" style="width:320px; text-align:left;">
            
            <?php if (!empty($post['image'])): ?>
                <img src="<?php echo $post['image']; ?>" 
                     style="width:100%; border-radius:10px; margin-bottom:10px;">
            <?php endif; ?>

            <h3><?php echo htmlspecialchars($post['title']); ?></h3>

            <p>
                <?php
                $text = strip_tags($post['content']);
                echo strlen($text) > 120 ? substr($text, 0, 120) . '...' : $text;
                ?>
            </p><br><br>

            <a href="post.php?id=<?php echo $post['id']; ?>">Read More</a>
        </div>

    <?php endwhile; ?>
<?php else: ?>
    <p style="text-align:center;">No posts found.</p>
<?php endif; ?>

</div>

        <!-- Button -->
        <a href="booking.php" style="margin-top:25px; display:inline-block; text-decoration:none;">
           Register Now
        </a>

        <!-- Hero Image -->
        <div style="margin-top:40px;">
            <img src="https://cdn-icons-png.flaticon.com/512/1496/1496074.png" 
                 alt="Appointment Illustration" 
                 style="width:230px;">
        </div>
    </section>

    <!-- Features Section -->
    <section>
        <h2 style="text-align:center;">Why Join ProArena?</h2>

        <div class="features" style="display:flex; gap:20px; justify-content:center; margin-top:30px; flex-wrap:wrap;">
            
            <div class="feature-box" style="width:300px; text-align:center;">
                <h3>Fast Registration</h3>
                <p>Pick your favorite e-sport and compete in your strongest arena.</p>
            </div>


            <div class="feature-box" style="width:300px; text-align:center;">
                <h3>Choose Your Game</h3>
                <p>Friendly and clean design suitable for all users.</p>
            </div>

            <div class="feature-box" style="width:300px; text-align:center;">
                <h3>Competitive Schedule</h3>
                <p>See available match times and book your tournament slot easily..</p>
            </div>

        </div>
    </section>


</body>
</html>

<?php include "includes/footer.php"; ?>