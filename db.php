<?php
$host = "localhost";      // السيرفر
$user = "root";           // اسم المستخدم في phpMyAdmin
$pass = "";               // الباسورد (غالباً فاضي في XAMPP)
$dbname = "proarena";     // اسم قاعدة البيانات حق مشروعك

// الاتصال
$conn = mysqli_connect($host, $user, $pass, $dbname);

// التأكد من الاتصال
if(!$conn){
    die("فشل الاتصال بقاعدة البيانات: " . mysqli_connect_error());
}

// ضبط اللغة (عشان تدعم العربي)
mysqli_set_charset($conn, "utf8");
?>