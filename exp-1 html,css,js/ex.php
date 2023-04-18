<?php
$u=$_POST['u']; 
$res=$_POST['a'];
$b=count($res);
?>
<h3> Congratultions </h3>
<?php 
echo $u+"You have successfully registered for";
for ($i=0;$i<$b;$i++)
{
echo $res[$i];
}
echo "courses";

