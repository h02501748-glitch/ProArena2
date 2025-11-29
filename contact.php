<?php 
include "includes/header.php";
include "includes/navbar.php";
include "database/connect.php";
?>

<section class="container" style="max-width:800px; margin:auto; padding:40px 20px;">

    <h2 style="text-align:center; margin-bottom:30px; font-weight:800;">
        Contact & Support
    </h2>

    <?php
    if(isset($_POST['send'])){
        $name  = mysqli_real_escape_string($connection, $_POST['name']);
        $email = mysqli_real_escape_string($connection, $_POST['email']);
        $msg   = mysqli_real_escape_string($connection, $_POST['message']);

        if(empty($name) || empty($email) || empty($msg)){
            echo "<p style='color:red; text-align:center;'>Please fill all fields.</p>";
        } else {
            $query = "INSERT INTO messages (name, email, message) 
                      VALUES ('$name', '$email', '$msg')";
            mysqli_query($connection, $query);
            echo "<p style='color:green; text-align:center;'>Message sent successfully!</p>";
        }
    }
    ?>

    <!-- Contact Form -->
    <form action="" method="POST" style="margin-top:20px;">
        <label>Name*</label>
        <input type="text" name="name" placeholder="Your name">

        <label>Email*</label>
        <input type="email" name="email" placeholder="your@email.com">

        <label>Message*</label>
        <textarea name="message" rows="5" placeholder="Write your message here..."></textarea>

        <button type="submit" name="send">Send Message</button>
    </form>


    <!-- Map -->
    <h3 style="margin-top:40px; text-align:center; font-weight:700;">Event Location</h3>
    <div style="margin-top:15px; text-align:center;">
        <iframe 
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3620.556155716963!2d46.79330207538365!3d24.74137994936459!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3e2f04d9c6c2c2c3%3A0x8f8c1b2c2e9e4b8f!2z2YXYsdmD2LIg2KfZhNmF2YjYsdmK2Kkg2KfZhNmF2YjYsdmK2Kkg2KfZhNmF2YjYsdmK2Kkg2KfZhNmF2YjYsdmK2Kkg2KfZhNmF2YjYsdmK2Kkg2KfZhNmF2YjYsdmK2Kkg2KfZhNmF2YjYsdmK2Kkg2KfZhNmF2YjYsdmK2Kkg2KfZhNmF2YjYsdmK2Kkg2KfZhNmF2YjYsdmK2Kkg2KfZhNmF2YjYsdmK2Kkg!5e0!3m2!1sar!2ssa!4v1700000000000!5m2!1sar!2ssa"
            width="100%" height="300" style="border:0; border-radius:10px;" allowfullscreen=""
            loading="lazy">
        </iframe>
    </div>

    <!-- Event Organizers -->
    <h3 style="margin-top:40px; text-align:center; font-weight:700;">Event Organizers</h3>

    <div style="
        display:flex; 
        justify-content:center; 
        flex-wrap:wrap; 
        gap:15px; 
        margin-top:20px;
    ">
        <div class="organizer-box">أريام القرني</div>
        <div class="organizer-box">دانه الحربي</div>
        <div class="organizer-box">هاجر الشهراني</div>
        <div class="organizer-box">نفيلا العنزي</div>
        <div class="organizer-box">أثير العطوي</div>
    </div>

    <style>
        .organizer-box {
            padding:14px 20px;
            background:#f4f6f9;
            border-radius:10px;
            font-size:18px;
            font-weight:600;
            box-shadow:0 2px 6px rgba(0,0,0,0.1);
        }
    </style>

    <!-- Social Media -->
    <h3 style="margin-top:40px; text-align:center; font-weight:700;">Follow Us</h3>
    <div style="text-align:center; margin-top:15px;">
        <a href="#" style="margin:0 10px;">Twitter</a>
        <a href="#" style="margin:0 10px;">Instagram</a>
        <a href="#" style="margin:0 10px;">WhatsApp</a>
    </div>

</section>

<?php include "includes/footer.php"; ?>