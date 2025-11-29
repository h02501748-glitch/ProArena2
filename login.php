

<?php
session_start();
require_once "../database/connect.php";

$msg="";
if(isset($_POST['login'])){
    $user = trim($_POST['username']);
    $pass = trim($_POST['password']);

    $query = mysqli_query($connection,"SELECT * FROM admin_users WHERE username='$user' AND password='$pass'");

    if(mysqli_num_rows($query)>0){
        $_SESSION['admin_id'] = $user;
        header("Location: dashboard.php");
        exit;
    } else {
        $msg="<p class='error'>⚠ Incorrect username or password</p>";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Admin Login</title>

<style>
@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap');

body{
    margin:0;
    font-family:"Poppins",sans-serif;
    background:#0d001f;
    height:100vh;
    display:flex;
    justify-content:center;
    align-items:center;
    overflow:hidden;
}

/* ===== خلفية متوهجة ===== */
.glow{
    position:absolute;
    width:350px;
    height:350px;
    background:#9d4edd;
    filter:blur(120px);
    opacity:.45;
    border-radius:50%;
    animation:pulse 6s infinite alternate;
}
.glow:nth-child(2){
    background:#7b24d4;
    width:280px;height:280px;
    right:10%;top:15%;
}
@keyframes pulse{
    0%{transform:scale(1);}
    100%{transform:scale(1.3);}
}

/* ===== صندوق تسجيل الدخول ===== */
.login-box{
    width:400px;
    background:#17002b;
    padding:40px;
    border-radius:18px;
    border:1px solid #902df7;
    box-shadow:0 0 25px rgba(157,78,221,0.45);
    z-index:5;
    text-align:center;
    animation:fadeIn .8s ease;
}
@keyframes fadeIn{from{opacity:0;transform:translateY(15px);}}

/* ===== العنوان ===== */
.login-box h2{
    color:#dcb6ff;
    font-size:27px;
    font-weight:700;
    margin-bottom:20px;
}

/* ===== حقول الإدخال ===== */
.login-box input{
    width:100%;
    background:#250046;
    border:1px solid #9333ff;
    padding:12px;
    color:#fff;
    border-radius:6px;
    margin-bottom:15px;
    font-size:15px;
    transition:.3s;
}
.login-box input:focus{
    border-color:#c77dff; 
    box-shadow:0 0 8px #b76dff;
}

/* ===== زر الدخول ===== */
.login-box button{
    width:100%;
    background:#9d4edd;
    color:white;
    font-size:17px;
    padding:12px;
    border:none;
    border-radius:6px;
    cursor:pointer;
    transition:.35s;
    font-weight:600;
}
.login-box button:hover{
    background:#b76dff;
    box-shadow:0 0 18px #b76dff;
}

/* ===== رسالة الخطأ ===== */
.error{
    background:#ffb2b2;
    color:#a30000;
    padding:10px;
    border-radius:6px;
    margin-bottom:18px;
    font-weight:600;
}

/* Footer */
.copy{
    color:#c6a5ff;
    font-size:12px;
    margin-top:12px;
}
</style>
</head>
<body>

<div class="glow"></div>
<div class="glow"></div>

<div class="login-box">

    <h2>Admin Login 🎮</h2>

    <?= $msg ?>

    <form method="POST">
        <input type="text" name="username" required placeholder="Username">
        <input type="password" name="password" required placeholder="Password">
        <button name="login">Login</button>
    </form>

    <p class="copy">© ProArena Dashboard</p>

</div>

</body>
</html>
