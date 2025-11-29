



<?php
session_start();


include "../database/connect.php";

$result=mysqli_query($conn,"SELECT * FROM users");
echo "<h2>All Users</h2><table border=1 cellpadding=8><tr>
<th>ID</th><th>Username</th><th>Firstname</th><th>Lastname</th><th>Email</th><th>Role</th></tr>";

while($row=mysqli_fetch_assoc($result)){
    echo "<tr>
        <td>{$row['id']}</td>
        <td>{$row['username']}</td>
        <td>{$row['firstname']}</td>
        <td>{$row['lastname']}</td>
        <td>{$row['email']}</td>
        <td>{$row['role']}</td>
    </tr>";
}
echo "</table>";
?>
<?php include "admin_nav.php"; ?>
