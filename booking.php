<?php 
include "includes/header.php"; 
include "includes/navbar.php"; 
include "database/connect.php"; 
include "db.php"; 

?>

<?php
// Define available dates per game (2 days per game) with fixed time 16:00 - 20:00
$game_slots = [
    "PUBG" => ["2025-12-01", "2025-12-02"],
    "Fortnite" => ["2025-12-03", "2025-12-04"],
    "FIFA" => ["2025-12-05", "2025-12-06"],
    "Rocket League" => ["2025-12-07", "2025-12-08"]
];
$start_time = "16:00";
$end_time = "20:00";

// Form processing
if(isset($_POST['submit'])){
    $name  = mysqli_real_escape_string($connection, $_POST['name']);
    $email = mysqli_real_escape_string($connection, $_POST['email']);
    $phone = mysqli_real_escape_string($connection, $_POST['phone']);
    $game  = mysqli_real_escape_string($connection, $_POST['game']);
    $date  = mysqli_real_escape_string($connection, $_POST['booking_date']);
    $message = mysqli_real_escape_string($connection, $_POST['message']);

    if(empty($name) || empty($email) || empty($phone) || empty($game) || empty($date)){
        $error = "Please fill in all required fields!";
    } else {
        $query = "INSERT INTO bookings (name, email, phone, game, booking_date, message)
                  VALUES ('$name', '$email', '$phone', '$game', '$date', '$message')";
      if(mysqli_query($connection, $query)){
    $success = "Your appointment has been booked successfully! 🎉";

    // تفاصيل الحجز
    $details_box = "
        <div class='details-box'>
            <h3>Booking Details</h3>
            <p><strong>Name:</strong> $name</p>
            <p><strong>Email:</strong> $email</p>
            <p><strong>Phone:</strong> $phone</p>
            <p><strong>Game:</strong> $game</p>
            <p><strong>Date:</strong> $date</p>
            <p><strong>Message:</strong> $message</p>
        </div>
    ";

} else {
    $error = "Error while booking: " . mysqli_error($connection);
}
    }
}
?>

<section class="container" style="max-width:700px; margin-top:50px;">
    <h2 style="text-align:center; font-family:'Arial Black'; margin-bottom:30px; color:#FF4500;">Book Your Seat at ProArena Now!</h2>

    <!-- Game Images -->
    <div id="gameContainer" style="display:flex; justify-content:center; gap:15px; flex-wrap:wrap; margin-bottom:30px;">
        <?php 
        $games = ["PUBG"=>"pubg.png", "Fortnite"=>"fortnite.png", "FIFA"=>"fifa.png", "Rocket League"=>"rocket-league.png"];
        foreach($games as $gameName => $img){
        ?>
        <div class="game-box" data-game="<?php echo $gameName; ?>" style="cursor:pointer; border:2px solid #ccc; border-radius:10px; padding:10px; text-align:center; transition:0.2s;">
            <img src="images/<?php echo $img; ?>" alt="<?php echo $gameName; ?>" style="width:120px; height:120px; object-fit:cover; display:block; margin:auto;">
            <button type="button" style="margin-top:5px; padding:5px 10px; border:none; background:#FFB6C1; border-radius:20px; cursor:pointer;">Select <?php echo $gameName; ?></button>
            <div style="margin-top:5px; font-weight:bold;"><?php echo $gameName; ?></div>
        </div>
        <?php } ?>
    </div>

    <!-- Display messages -->
    <?php if(isset($error)) { echo "<p style='color:red; text-align:center;'>$error</p>"; } ?>
    <?php if(isset($success)) { echo "<p style='color:green; text-align:center;'>$success</p>"; } ?>

    <!-- Booking Form -->
    <form action="" method="POST">
        <input type="hidden" name="game" id="gameInput">
        <label>Full Name*</label>
        <input type="text" name="name" placeholder="Enter your full name">

        <label>Email*</label>
        <input type="email" name="email" placeholder="example@email.com">

        <label>Phone Number*</label>
        <input type="text" name="phone" placeholder="0501234567">

        <label>Choose Date*</label>
        <select id="dateSelect" name="booking_date">
            <option value="">-- Select Date --</option>
        </select>
        <p style="margin-top:5px; color:#555;">Time: 16:00 - 20:00</p>

        <label>Notes</label>
        <textarea name="message" rows="4" placeholder="Write any additional notes"></textarea>

        <button type="submit" name="submit" id="bookBtn" style="margin-top:15px; background:#FF4500; color:white; padding:12px 25px; font-family:'Arial Black'; border:none; border-radius:30px; cursor:pointer;" disabled>Book Now</button>
    </form>
</section>

<script>
// JavaScript to handle image selection and populate dates
const gameBoxes = document.querySelectorAll('.game-box');
const gameInput = document.getElementById('gameInput');
const dateSelect = document.getElementById('dateSelect');
const bookBtn = document.getElementById('bookBtn');

const gameSlots = <?php echo json_encode($game_slots); ?>;

gameBoxes.forEach(box => {
    box.addEventListener('click', function(){
        const selectedGame = this.getAttribute('data-game');
        gameInput.value = selectedGame;

        // Highlight selected box
        document.querySelectorAll('.game-box').forEach(b => b.style.borderColor="#ccc");
        this.style.borderColor="#FF4500";

        // Populate dates
        dateSelect.innerHTML = '<option value="">-- Select Date --</option>';
        gameSlots[selectedGame].forEach(day => {
            const option = document.createElement('option');
            option.value = day + "T16:00";
            option.textContent = day + " (16:00 - 20:00)";
            dateSelect.appendChild(option);
        });

        // Disable book button until date selected
        bookBtn.disabled = true;
    });
});

// Enable book button after selecting date
dateSelect.addEventListener('change', function(){
    if(this.value && gameInput.value){
        bookBtn.disabled = false;
    } else {
        bookBtn.disabled = true;
    }
});
</script>

<?php include "includes/footer.php"; ?>