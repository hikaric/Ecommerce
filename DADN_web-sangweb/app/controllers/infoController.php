<?php
    session_start();
    require_once '../DB.php';
    $db = new DB();
	$user = $db->getInstance();
    if(isset($_POST['change-avt'])){
        $id = $_POST['user-id'];
        $image = $_FILES['image']['name'];
        if($image){
            $image_tmp_name = $_FILES['image']['tmp_name'];
            $image_folder = '../../image/'.$image;
            $sql = "UPDATE users SET image='$image' WHERE id='$id'";
            mysqli_query($user->con, $sql);
            move_uploaded_file($image_tmp_name, $image_folder);
        }
        if(isset($_POST['change-fullname'])){
            $newname= $_POST['change-fullname'];
            $sql = "UPDATE users SET fullName='$newname' WHERE id='$id'";
            mysqli_query($user->con, $sql);
            $_SESSION['user_name']=$newname;
        }
        if(isset($_POST['change-dob'])){
            $newdob=$_POST['change-dob'];
            $sql = "UPDATE users SET dob='$newdob' WHERE id='$id'";
            mysqli_query($user->con, $sql);
        }
        if(isset($_POST['change-address'])){
            $newaddress=$_POST['change-address'];
            $sql = "UPDATE users SET address='$newaddress' WHERE id='$id'";
            mysqli_query($user->con, $sql);
        }
        $sql="SELECT * FROM users WHERE id='$id'";
        $result = mysqli_query($user->con, $sql);
        $value=$result->fetch_assoc();
        if($value['roleId']==1){
            header("Location: ../views/management.php?user_id=".$id);
        }else{
            header("Location: ../views/infoUser.php?user_id=".$id);
        }
        
    }
    if(isset($_POST['change-phone-user'])){
        $id = $_POST['user-id-phone'];
        $newphone=$_POST['phone'];
        $sql="UPDATE users SET phone='$newphone' WHERE id='$id'";
        mysqli_query($user->con,$sql);
        $sql="SELECT * FROM users WHERE id='$id'";
        $result = mysqli_query($user->con, $sql);
        $value=$result->fetch_assoc();
        if(!preg_match("/^0([0-9]){9}$/",$newphone)){
            $message="Số điện thoại không hợp lệ";
        }
        if($value['roleId']==1){
            header("Location: ../views/management.php?user_id=".$id."&messagephone=".$message);
        }else{
            header("Location: ../views/infoUser.php?user_id=".$id."&messagephone=".$message);
        }
    }
    if(isset($_POST['change-email-user'])){
        $id = $_POST['user-id-email'];
        $newemail=$_POST['new-email'];
        $sql="SELECT * FROM users WHERE email='$newemail'";
        $result=mysqli_query($user->con,$sql);
        $message="";
        if(!preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix",$newemail)){
            $message="Email không hợp lệ";
        }else if($result&&mysqli_num_rows($result)>0){
            $message="Email đã tồn tại";
        }else {
            $sql="UPDATE users SET email='$newemail' WHERE id='$id'";
        mysqli_query($user->con,$sql);
        }
        $sql="SELECT * FROM users WHERE id='$id'";
        $result = mysqli_query($user->con, $sql);
        $value=$result->fetch_assoc();
        if($value['roleId']==1){
            header("Location: ../views/management.php?user_id=".$id."&message=".$message);
        }else{
            header("Location: ../views/infoUser.php?user_id=".$id."&message=".$message);
        }
    }
?>