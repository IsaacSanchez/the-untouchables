<?php
session_start();
if($_SESSION['sid']=="")
{
header('Location:index.php');
}
$id=$_SESSION['sid'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>My mail server</title>
<style>
	a{text-decoration:none}
	a:hover{ background-color:#00CC66}
	#atop{margin-left:50}
</style>
</head>

<?php //include('ads/header.php');?>


<body style="background-image:url('theme/<?php
		@$conTheme=$_REQUEST['conTheme'];
		if($conTheme)
		{
			$fo=fopen("userImages/$id/theme","w");
			fwrite($fo,$conTheme);
		}
			@$f=fopen("userImages/$id/theme","r");
			@$fr=fread($f, filesize("userImages/$id/theme"));
			echo $fr;
			?>');">

<table width="975" bgcolor="#FFFFFF" border="1" align="center" >
  
  
  <tr bgcolor="#eee">
    <td height="60" colspan="3">
	<div style="float:left;margin-left:50px;color:#00CC66"> Welcome <?php  echo @$_SESSION['sid'];?>
	 </div>
	
			<div style="float:left;margin-left:70%;color:#00CC66">
		<a style="margin-left:50px" href="HomePage.php?chk=logout">LOGOUT</a>
		</div>
	</td>
  </tr>
  <tr>
    <td width="158" height="572" valign="top">
	
	<div>
	<?php
	include_once('connection.php');
	error_reporting(1);
	
	$chk=$_GET['chk'];
	if($chk=="logout")
	{
	unset($_SESSION['sid']);
	header('Location:index.php');
	}
	$r=mysqli_query($con,"select * from userinfo where user_name='{$_SESSION['sid']}'");
	
	$row=mysqli_fetch_object($r);
	@$file=$row->image;
	//echo $file;
	echo "<img style='border-radius:50px' alt='image not upload' src='userImages/$id/$file' height='80' width='80'/>";
?></div>
<hr/>
	
	<a href="HomePage.php?chk=compose">COMPOSE</a><br/><hr/>
	<a href="HomePage.php?chk=inbox">INBOX</a><br/><hr/>
	<a href="HomePage.php?chk=sent">SENT</a><br/><hr/>
	<a href="HomePage.php?chk=trash">TRASH</a><br/><hr/>
	<a href="HomePage.php?chk=draft">DRAFT</a><br/><hr/>
	<a  href="HomePage.php?chk=chngthm">CHANGE THEME</a><br/><hr/>
		<a href="HomePage.php?chk=chngPass">CHANGE PASSWORD</a><br/><hr/>
		
		<a href="HomePage.php?chk=vprofile">EDIT YOUR PROFILE</a><hr/><br/>
		
		<a href="HomePage.php?chk=updnews"></a>
	</div>
	</td>
    <td width="660" valign="top">
			
			
		<?php
		@$id=$_SESSION['sid'];
		@$chk=$_REQUEST['chk'];
			if($chk=="")
			{
			include_once('inbox.php');
			}
			else
			{
			if($chk=="vprofile")
			{
			include_once("editProfile.php");
			}
			if($chk=="compose")
			{
			include_once('compose.php');
			}
			if($chk=="sent")
			{
			include_once('sent.php');
			}
			if($chk=="trash")
			{
			include_once('trash.php');
			}
			if($chk=="inbox")
			{
			include_once('inbox.php');
			}
			if($chk=="setting")
			{
			include_once('setting.php');
			}
			if($chk=="chngPass")
			{
			include_once('chngPass.php');
			}
			if($chk=="chngthm")
			{
			include_once('chngthm.php');
			}
			if($chk=="draft")
			{
			include_once('draft.php');
			}
			//if($chk=="updnews")
			{
			//include_once('latestupd.php');
			}
		}	
		?>
		
		<!--inbox -->
		<?php
		$id=$_SESSION['sid'];
		@$coninb=$_GET['coninb'];
			
			if($coninb)
			{
			$sql="SELECT * FROM usermail where rec_id='$id' and mail_id='$coninb'";
$dd=mysqli_query($con,$sql);
			$row=mysqli_fetch_object($dd);
			echo "Subject :".$row->sub."<br/>";
			echo "Message :".$row->msg;
			}
			
			
	@$cheklist=$_REQUEST['ch'];
	if(isset($_GET['delete']))
	{
		foreach($cheklist as $v)
		{
		
		$d="DELETE from usermail where mail_id='$v'";
		mysqli_query($con,$d);
		}
		echo "msg deleted";
	}
			
		?>
		
		
		
	<!--sent box-->
	<?php
		$id=$_SESSION['sid'];
		@$consent=$_GET['consent'];
			
			if($consent)
			{
			$sql="SELECT * FROM usermail where sen_id='$id' and mail_id='$consent'";
$dd=mysqli_query($con,$sql);
			$row=mysqli_fetch_object($dd);
			echo "Subject :".$row->sub."<br/>";
			echo "Message :".$row->msg;
			}
			
			
	@$cheklist=$_REQUEST['ch'];
	if(isset($_GET['delete']))
	{
		foreach($cheklist as $v)
		{
		$d="DELETE from usermail where mail_id='$v'";
		mysqli_query($con,$d);
		}
		echo "msg deleted";
	}
			
		?>	
		
	</td>
    <td width="135">&nbsp;</td>
  </tr>
  <tr>
    <td height="47" colspan="3">
	<h2 align="center">Copyright 2016</h2>
	</td>
  </tr>
  
</table>

</body>
</html>

<?php //include('ads/header.php');?>