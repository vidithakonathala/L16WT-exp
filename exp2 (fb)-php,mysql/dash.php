<?php
session_start();
include "connection.php";

 ?>
 <?php
 if(isset($_SESSION['user']))
 {
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
         body{
          background-color:#def;
         }
           .top
           {
             width:100%;
             height: 50px;

           }
           .top button
           {
             position: relative;
             top:25px;
             float: right;
           }
           .top h1
           {
             display: inline-block;
             margin: auto;
             position: relative;
             left:40%;
           }
           body
           {
             height: 100%;
           }
           .b1
           {
             display: flex;
           width:100%;
           height:100%;
             border:2px solid blue;
           }
           .b2
           {
             flex:1;
           height:100%;
           border:2px solid red;
           }
           .b3
           {
             flex:4;
             height:100%;
             border:2px solid red;
           }
         </style>
       </head>
       <header class = "top">
         <?php
              if(isset($_SESSION['user']))
              {
                echo "<h1><Welcome ".$_SESSION['user']."</h1>";
              }
           ?>
         <button type="button" name="button" class = "button">  <a href="logout.php">Logout</a></button>

       </header>
       <body>
        <div class="b1">
          <div class="b2">
             <iframe src="left.php" width="100%" height="100%"></iframe>
          </div>
          <div class="b3">
             <iframe src="view.php" width="100%" height="100%" name = "right"></iframe>
          </div>

        </div>
       </body>
     </html>
  <?php

}else {
  echo "<h1> Please Login</h1>";
  ?>
 <a href="index.php">Login</a>
  <?php
}

  ?>
