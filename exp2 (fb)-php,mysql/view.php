<html><head>
<?php include "connection.php";
session_start(); ?>
</head>
 <body>
   <table border = 1 width="90%"cellspacing = 0 cellpadding = 10>
     <tr>
       <td>Id </td>
       <td> Image </td>
      <td> Description </td>
      <td> No of Likes </td>
      <td> Comments </td>
     </tr>
     <?php
     $i = 1;
     $rows = mysqli_query($db, "SELECT fb_users.image,description.des, fb_users.likes,fb_users.id from `fb_users` inner join `description` where fb_users.username = '$_SESSION[user]' and description.username = '$_SESSION[user]' and fb_users.id = description.id ORDER BY fb_users.id DESC;");
     ?>

     <?php while($row = mysqli_fetch_row($rows))
     { ?>
     <tr>
       <td><?php echo $i++; ?></td>
       <td> <img src="images/<?php echo $row[0]; ?>" width = 200 > </td>
        <td><?php echo $row[1]; ?></td>
          <td><?php echo $row[2]; ?></td>
          <td>
            <table>

            <?php
              $r = 1;
              $c = $row[3];
              $q = mysqli_query($db,"SELECT * from `comments` where postid = $c;");
              while($row = mysqli_fetch_array($q))
              {
                ?>
                <tr>
                  <td><?php echo $r.")"; ?></td>
                     <td>  <?php echo $row['comment']; echo "   commented by <b>"; echo $row['username'];echo "</b>"; ?> </td>
                </tr>
                <?php
                $r = $r + 1;
              }
             ?>


             </table>
          </td>
     </tr>
   <?php } ?>
   </table>
   <br>
 </body>
</html>
