<?php include "includes/header.php"; ?>
<?php include "includes/navbar.php"; ?>
<?php include "database/connect.php"; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Booking Confirmation</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>


    <div class="confirmation-container page-animate">

        <h1 class="title-glow">Let's go</h1>
        <div class="title-divider"></div>

        <div class="booking-card card-shadow soft-zoom">
<div class="arena-heading">
  <h2>🔥 Ready for the Challenge?</h2>
  <p style="color:deeppink">💥 Are you excited? The arena awaits your skills, your strategy, and your victory! 🎯</p>
</div>
        </div>

        <!-- Games Section -->
        <h2 class="games-title"> Selected Game Categories</h2>

        <div class="games-grid">

            <div class="game-box game-hover card-shadow">
                <h3>⚽🎮 FIFA</h3>
                <p>Football esports experience with competitive gameplay.</p>
  <article class="pe-card">
  <div class="pe-card-body">
    <h2 class="pe-card-title">⚽ FIFA Tournament</h2>
    <p class="pe-card-desc">🏆 Knockout-style football tournament with 32 players.</p>
    <button class="pe-btn pe-toggle" data-target="#details-fifa">📂 View Details</button>
  </div>
  <div class="pe-details" id="details-fifa">
    <p>👥 <strong>Players:</strong> 32</p>
    <p>🧩 <strong>Format:</strong> Home & Away matches</p>
    <p>⏱️ <strong>Match Duration:</strong> 10 minutes per round</p>
    <p>🎁 <strong>Prize:</strong> 500 SAR + 🏆 Trophy</p>
    <p>📝 <strong>Requirements:</strong> Age 16+ and bring ID</p>
    <img src="images/fifaa.png" alt="Match Preview" class="pe-gallery-img">
    <a href="booking.php?game=FIFA" class="pe-btn-outline">🖊️ Register Now</a>
  </div>
</article>
</div>
                  <div class="game-box game-hover card-shadow">

                <h3>🪂 Fortnite</h3>
                <p>Battle royale action with building & fast-paced combat.</p>
       <article class="pe-card">
  <div class="pe-card-media">
  </div>
  <div class="pe-card-body">
    <h2 class="pe-card-title">🎮 Fortnite Battle Royale</h2>
    <p class="pe-card-desc">💥 100 players per round in intense survival mode.</p>
    <button class="pe-btn pe-toggle" data-target="#details-fortnite">📂 View Details</button>
  </div>
  <div class="pe-details" id="details-fortnite">
    <p>👥 <strong>Players:</strong> 100</p>
    <p>🧩 <strong>Format:</strong> Solo & Duo rounds with point system</p>
    <p>⏱️ <strong>Match Duration:</strong> 15 minutes per round</p>
    <p>🎁 <strong>Prize:</strong> 700 SAR + 🎧 Gaming Gear</p>
    <p>📝 <strong>Requirements:</strong> Age 16+ and bring ID</p>
    <img src="images/fort.jpg" alt="Fortnite Action" class="pe-gallery-img">
    <a href="booking.php?game=Fortnite" class="pe-btn-outline">🖊️ Register Now</a>
  </div>
</article>
            </div>

            <div class="game-box game-hover card-shadow">
                <h3>🔫 PUBG</h3>
                <p>Realistic tactical survival battle royale.</p>
<article class="pe-card">
  <div class="pe-card-media">
  </div>
  <div class="pe-card-body">
    <h2 class="pe-card-title">🔫 PUBG Tactical Survival</h2>
    <p class="pe-card-desc">🎯 Squad-based tournament with 64 players in total.</p>
    <button class="pe-btn pe-toggle" data-target="#details-pubg">📂 View Details</button>
  </div>
  <div class="pe-details" id="details-pubg">
    <p>👥 <strong>Players:</strong> 64 (16 squads)</p>
    <p>🧩 <strong>Format:</strong> Points based on ranking and kills</p>
    <p>⏱️ <strong>Match Duration:</strong> 20 minutes per round</p>
    <p>🎁 <strong>Prize:</strong> 1000 SAR + 🥇 Medal</p>
    <p>📝 <strong>Requirements:</strong> Age 16+ and bring ID</p>
    <img src="images/pubg.png" alt="PUBG Squad" class="pe-gallery-img">
    <a href="booking.php?game=PUBG" class="pe-btn-outline">🖊️ Register Now</a>
  </div>
</article>
            </div>

            <div class="game-box game-hover card-shadow">
                <h3>🚗💨 Rocket League</h3>
                <p>High-speed football… but with cars!</p>
         <article class="pe-card">
  <div class="pe-card-media">
  </div>
  <div class="pe-card-body">
    <h2 class="pe-card-title">🚗 Rocket League</h2>
    <p class="pe-card-desc">⚡ Fast-paced car soccer with 24 players.</p>
    <button class="pe-btn pe-toggle" data-target="#details-rocketleague">📂 View Details</button>
  </div>
  <div class="pe-details" id="details-rocketleague">
    <p>👥 <strong>Players:</strong> 24 (8 teams)</p>
    <p>🧩 <strong>Format:</strong> 3v3 matches, Best of 3 rounds</p>
    <p>⏱️ <strong>Match Duration:</strong> 8 minutes per round</p>
    <p>🎁 <strong>Prize:</strong> 600 SAR + 📜 Certificate</p>
    <p>📝 <strong>Requirements:</strong> Age 16+ and bring ID</p>
    <img src="images/Rocket.webp" alt="Rocket League Match" class="pe-gallery-img">
    <a href="booking.php?game=Rocket%20League" class="pe-btn-outline">🖊️ Register Now</a>
  </div>
</article>
        </div>


</section>

    </div>


</body>

<script>
document.addEventListener("DOMContentLoaded", function() {
  document.querySelectorAll(".pe-toggle").forEach(function(button) {
    button.addEventListener("click", function() {
      var targetId = button.getAttribute("data-target");
      var target = document.querySelector(targetId);
      if (target) {
        target.classList.toggle("is-open");
        target.setAttribute("aria-hidden", target.classList.contains("is-open") ? "false" : "true");
      }
    });
  });
});
</script>

</html>
<?php include "includes/footer.php"; ?>