<html>
    <head>
        <style>
            body
            {
                background-color:#fab;
                text-align:center;
                color:blue;
            }
        </style>  
    </head>
    <body>
        <br>
        <br>
        <h1>Sign Up</h1>
        <br>
        <br>
        <br>
        <h3>Enter your details.</h3>
        <form name="f1" action="" method="post">
        <table align="center">
            <tr>
                <td>Name:</td>
                <td><input type="text" name="nm" placeholder="Enter your name" maxlength="30" required="required">
                </td>
            </tr>
            
            <tr>
                <td>Email Id:</td>
                <td>
                    <input type="email" name="em" placeholder="Enter mail id" max="5" maxlength="50" required="required">
                </td>
            </tr>
           
            <tr>
                <td>username:</td>
                <td>
                    <input type="text" name="un" placeholder="Enter your username" maxlength="20" required="required">
                </td>

        </tr>
<tr>
                <td>password:</td>
                <td>
                    <input type="password" name="pwd" placeholder="Enter your password" maxlength="20" required="required">
                </td>
        </tr>

        <tr>

                <td>
                    <input type="submit" name="submit">
                </td>
                <td>
                    <input type="reset" name="reset">
                </td>
            </tr>
        </table>

        </form>
    </body>
</html>


<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
        include "connection.php";

        if ($db) {
            echo "";
        }
        else{
            echo "Connection Failed.";
            die("Connection Failed:".mysqli_connect_error());
        }
$name=$_POST["nm"];
$email=$_POST["em"];
$uname=$_POST["un"];
$pwd=$_POST["pwd"];
$q="INSERT INTO registration(name,username,email,password) VALUES ('$name','$uname','$email','$pwd')";
$res=mysqli_query($db,$q);
if($res){
        echo "<script>alert('signup successfully')</script>";
}
else{
        echo "<script>alert('signup Falied')</script>";
}
        $sql = "select * from registration where username='$uname' and password='$pwd'";
        $res = mysqli_query($db,$sql);
        if(mysqli_num_rows($res)>0){
           $_SESSION['uname']=$uname;
           
           header('Location:homepage.php');
        }
        else{
            echo "<script>alert('invalid login.Please enter correct password and username')</script>";
           header('Location:homepage.php');
        }
}

?>


