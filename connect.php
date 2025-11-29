<?php
// اتصال بقاعدة البيانات
$host = "localhost";   // عادة localhost
$user = "root";        // اسم المستخدم
$pass = "";            // الباسوورد
$db   = "proarena";    // اسم قاعدة البيانات

$connection = mysqli_connect($host, $user, $pass, $db);

// تحقق من الاتصال
if(!$connection){
    die("فشل الاتصال بقاعدة البيانات: " . mysqli_connect_error());
}
?>