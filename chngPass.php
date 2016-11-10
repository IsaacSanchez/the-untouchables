<?php
include_once('connection.php');
if(isset($_POST['update']))
{
$id=$_SESSION['sid'];
$op=$_POST['op'];
$np=$_POST['np'];
$cp=$_POST['cp'];


	if($op=="" || $np=="" || $cp=="")
	{
	$err="<h3 style='color:red'>Fill all the fields first</h3>";
	}
	else
	{
		$sql="select * from userinfo where user_name ='$id'";
		$d=mysqli_query($con,$sql);
		list($a,$b,$c)=mysqli_fetch_array($d);
		if($c==$op)
		{
			if($np==$cp)
			{
			$sql="update userinfo set password='$np' where user_name='$id'";
		$d=mysqli_query($con,$sql);
		$err= "<h3 style='color:blue'>Congrates Pass updated...</h3>";
			}
			
			else
			{
			$err= "<h3 style='color:red'>New pass doesn't match to confirm pass</h3>";
			}
		}
		else
		{
		$err= "<h3 style='color:red'>Wrong old password</h3>";
		}
	}
		
}
?>
<form method="post">
<table border="2" cellspacing="5" cellpadding="5">
 <tr>
 	<Td colspan="2"><?php echo @$err; ?></Td>
 </tr>
  <tr>
    <td>Enter Your Old Password</td>
    <td><input type="password" name="op"/></td>
  </tr>
  <tr>
    <td>Enter Your New Password</td>
    <td><input type="password" name="np"/></td>
  </tr>
  
  <tr>
    <td>Enter Your Confirm Password</td>
    <td><input type="password" name="cp"/></td>
  </tr>
  <tr>
    <td colspan="2"><input type="submit" value="Update Password" name="update"/></td>
  </tr>
</table>
</form>