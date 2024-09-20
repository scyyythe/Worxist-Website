<?php

// check login
function check_login($con){
    if(isset($_SESSION['u_id'])){

        $id=$_SESSION['u_id'];
        $username=$_SESSION['username'];

        $query="Select * from accounts where u_id='$id' limit 1";

        $result=mysqli_query($con, $query);
        if($result  && mysqli_num_rows($result)>0){

            // assoc- associatred array
            $user_data=mysqli_fetch_assoc($result);
            return $user_data;
        }
    }else{
        // redirrect to login
        header("Location:login-register.php");
        die;
    }
}

// end php
?>