<?php

session_start();


if(!empty($_POST)) {
    echo "<pre class='text-left'>";
    // var_dump($_POST);
    echo "</pre>";
    include_once("config.php");
    $username = $_POST["form-username"];
    $pass = $_POST["form-password"];


    mysqli_set_charset($conn, "utf8");

    // if(isset($_POST["USERNAME_CUS"]) || isset($_POST["PASSWORD_CUS"])){
    //     $tendangnhap = $_POST["USERNAME_CUS"];
    //     $matkhau = $_POST["PASSWORD_CUS"];
    // }

    $truyvan = "SELECT * FROM CUSTOMER WHERE USERNAME_CUS='".$username."' AND PASSWORD_CUS='".$pass."' LIMIT 1";
    $ketqua = mysqli_query($conn,$truyvan);
    $demdong = mysqli_num_rows($ketqua);

    if($demdong >=1){
        // echo "true";

        //Lưu quá trình 
        setcookie("USERNAME_CUS", $username, time() + 3600, "/","", false, true);
        $_SESSION['USERNAME_CUS'] = $username;



        header('Location: ../agric/index.php');
    }else {
        echo "<pre>Sai tên đăng nhập hoặc mật khẩu</pre>";
    }

    mysqli_close($conn);









//     if($user["username"] == $username && $user["password"] == $pass) {
// //        echo "<h1>Welcome, <strong>$username</strong></h1>";
//         // header('Location: /index.php');
//     } else {
//         echo "<pre>Sai tên đăng nhập hoặc mật khẩu</pre>";
//     }
}

?>