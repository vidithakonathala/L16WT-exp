<?php
session_start();
include "connection.php";
 ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">  
    <title></title>
    <style media="screen">
      html,body
      {
        height:100%;
        
      }
      body
      {
        background-color:#c4faf8;
      }
      .b1
      {
        width:100%;
        height:100px;
      }
      .b1 h1
      {
        text-align:center;
        color:purple;
      }
      .b2
      {
        flex:3;
        height:100%;
      }
      .b3
      {
        flex:1;

        height:85%;
        border:5px solid olive;
        background-color:#dac;
         border-radius: 10px
      }
      .main
      {
          display: flex;
        width:100%;
        height:100%;
      }
      .b5 table
      {
        margin:auto;
        padding-top:80px;
       
      }
      .b4
      {
        width:100%;
        height:25%;
      }
      .b2 table
      {
        border:2px solid navy;
        text-align:center;
      }
      .b5
      {
        width:60%;
        margin:auto;
        height:50%;
        

      }
      /*.b6
      {
        width:100%;
        height:25%;
        background-color:;
      }*/
      tr,td
      {
        padding-right:130px;
      }

    </style>
  </head>
  <body>
    <div class="b1">
      <h1><i>Welcome To FaceBook</i></h1>
      <center><a href="homepage.php" ><button>Home</button></a></center>
    </div>
    <div class="main">
      <div class="b2">
        <h3 style = "text-align:center"><i><b>Top Likes</b></i></h3>
       <table border="1" cellpadding="10px">
         <tr>
           <td>#</td>
           <td><u>Posted by</u></td>
           <td><u>Photo</u></td>
           <td><u> No of Likes</u></td>
         </tr>
         <?php
              $i = 1;
         $q = mysqli_query($db,"SELECT username,image,likes from fb_users where likes != 0   order by likes DESC limit 4;");
          ?>
          <?php while($row = mysqli_fetch_row($q))
          { ?>
          <tr>
            <td><?php echo $i++; ?></td>
            <td><?php echo $row[0]; ?></td>
            <td> <img src="images/<?php echo $row[1]; ?>" width = "135px" height = "135px" > </td>
             <td><?php echo $row[2]; ?></td>
          </tr>
        <?php } ?>
       </table>
      </div>
      <div class="b3">
         <div class="b4">
                 <img src="fblogo1.png" alt="" height = 200px width =350px>
         </div>
         <div class="b5">
          <form class="" action="index.php" method="post">
            <br>
            <table cellpadding = "10px">
              <tr>
                <td>
                  <p style = "text-align:center;"><b>Login Here</b></p>
                  
                </td>
              </tr>
              <tr>
                <td>
                USERNAME:<input type="text" name="username" value="<?php if(isset($_COOKIE["user"])){  echo $_COOKIE['user']; } ?>" required = "required">
                </td>
                </tr><tr>
                <td>
                PASSWORD:<input type="password" name="password" required = "required" value="<?php if(isset($_COOKIE["user"])){  echo $_COOKIE['pass']; } ?>">
                </td>

              </tr>
              <tr>
                <td>
                      <label>  <input type="checkbox" name="remember" <?php if(isset($_COOKIE["user"])){  echo "checked"; } ?> class="largerCheckbox">&nbsp &nbsp  Remember me</label>
                </td>
              </tr>
              <tr>
                <td>
                <p style = "text-align:center;">
                  <input type="submit" name="submit" value="Login"> &nbsp 
                </p>
              </td>
              </tr>

            </table>
          </form>
         </div>
         <?php
                if(isset($_POST['submit']))
                {
                  $q = mysqli_query($db,"SELECT * FROM `registration` where username = '$_POST[username]' and password = '$_POST[password]';");

                  $count = mysqli_fetch_row($q);

                  if($count == 0)
                  {
                    ?>  <script type="text/javascript">
                        alert("Incorrect Username or Password");
                      </script>

                    <?php
                  }else {
                    if($_POST['remember'])
                    {
                      setcookie('user',$_POST['username'],time() + (86400 * 30));
                      setcookie('pass',$_POST['password'],time() + (86400 * 30));
                    }

                    $_SESSION['user'] = $_POST['username'];
                    ?>
                    <script type="text/javascript">
                      alert("Login");
                      window.location = "dash.php";
                    </script>

                    <?php
                  }
                }

          ?>
      </div>
    </div>

  </body>
</html>
