<?php
include "db_connection.php";
// ambil data dari form login
$username = $_POST['username']; //<-- ini belum aman dari sql injection :D  

// ambil data dari database
$sql = "SELECT * FROM account WHERE username='$username'";
$result = $conn->query($sql);
$user = mysqli_fetch_assoc($result);

// bandingkan password yang dikirim dari form login dengan password
// yang ada di database
if ($result->num_rows > 0){
    echo "QUERY succsessfuly";
} else {
    echo "QUERY failed";
}

echo "<br>";

if (password_verify($_POST['password'], $user['password'])) {
        session_start();
        $_SESSION["name"] = $user["name"];
        $_SESSION["address"] = $user["address"];
        $_SESSION["phone"] = $user["phone"];
        $_SESSION["login"] = true;
        $_SESSION["role"] = "admin";
        $_SESSION["username"] = $user["username"];
        echo"Anda Berhasil login!!";
        header("Location: index.php");
    
}else{
    $_SESSION["login"] = false;
    $_SESSION["role"] = "none";
    $_SESSION["username"] = "none";
    header("Location: form_login.php");
}


?>