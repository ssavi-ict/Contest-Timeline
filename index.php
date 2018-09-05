<!DOCTYPE html>
<html>

<head>
	<title>Home</title>
	
	<link href="custom-temp.css" rel="stylesheet" type="text/css">
	<meta http-equiv="Content-Type" charset="UTF-8">
	
	<style>
		div{
			border : 1px;
		}
		body { 
			margin-top: 40px;
			.all { 
				width:80%;  
				border:1px solid black; 
				border-radius:15px;
				background:gray;
			}			
			
			
		} 
		h1 {font-family: "Times New Roman"; }
		td{
			text-align:center;
			font-weight: bold;
		}
		footer{background:gray; height: 50px; width:100%; margin-left: 0px;  border-radius: 5px 5px 0 0 ;}	
		
		
	</style>
</head>

<body>
<div class="all" style =' height:98%; width:80%;margin: 0 auto; background: lightgray;' >
	<header class="main-header">
	<div class ='site_logo' style = 'height:50px; width:50px; float:left;margin-top:-5px;'>
		<a class="logo" href="index.php"><img src="Image/logo.png" alt="logo" style = 'height:60px; width:200px;'></a>
	</div>
	<div class = "nav_bar" style ='height: 50px;'>
	<ul class="main-nav">
		<li><a href="index.php">Home</a></li>
		<li class="dropdown">
			<a href="#">Online Judges</a>
			<ul class="drop-nav">
				<li><a href="judge_cf.php">Codeforces</a></li>
				<li><a href="judge_atc.php">AtCoder</a></li>
				<li><a href="#">HackerRank</a></li>       
			</ul>
		</li>
		<li><a href="about.php">About Me</a></li>
		<li><a href="contact.php">Contact</a></li>
    </ul>
	</div>
	<br>
	</header>
	<br><br>
	
	<p style ='width:40%; float:left; text-align:center; margin-left: 40px;'>
	<font color='red' size='+2' face='Verdana'><b>About</b></font>
	<br><br><i><font color = 'purple';>
	Hello, Contest freaks!!! Welcome to Contest Timeline.<br>
	Contest Timeline is a simple website containing several information about Coding Competitions hosted by Several Online Judges. <br>
	I hope you will find your expected information here. Have a Good experience with Contest Timeline!!! <br></font></i><br>
	</p>
	<center style = 'margin-right: 40px; margin-top:7px; '> <img src="Image/coding.jpg" alt="Coding Image" style='width:43%; height: 170px; float: right'/> </center>
	
	<table border='0' style = 'margin: 0 auto; border-collapse: collapse;'width='100%' >
		<tr>
			<td colspan ='3'><br><br><font color='red' size='+2' face='Verdana'>Online Judges</font></td>
		</tr>
		<tr><td colspan ='3'><br><br><br></td></tr>
	
		<tr>
			<td><a href='judge_cf.php'><img src="Image/cf.png" style=' border-radius:50%;box-shadow: 0px 10px 40px blue; height:250px; width:250px'></a>
			<br><br>CodeForces is <font color='green'>Active!!</font></td>
			<td><a href='judge_atc.php'><img src="Image/atc.png" style=' border-radius:50%;box-shadow: 0px 10px 40px blue; height:250px; width:250px'></a>
			<br><br>AtCoder is <font color='green'>Active!!</font></td>
			<td><a href='#'><img src="Image/hr.jpg" style=' border-radius:50%;box-shadow: 0px 10px 40px blue; height:250px; width:250px'></a>
			<br><br>HackerRank is <font color='orange'>Under Construction!!</font></td>
		</tr>
		<tr><td colspan ='3'><br><br></td></tr>
		<tr>
			<td><a href='#'><img src="Image/csa.png" style=' border-radius:50%;box-shadow: 0px 10px 40px blue; height:250px; width:250px'></a>
			<br><br>CS Academy is <font color='orange'>Under Construction!!</font></td>
			<td><a href='#'><img src="Image/ccf.png" style=' border-radius:50%;box-shadow: 0px 10px 40px blue; height:250px; width:250px'></a>
			<br><br>CodeChef is <font color='orange'>Under Construction!!</font></td>
			<td><a href='#'><img src="Image/dev.png" style=' border-radius:50%;box-shadow: 0px 10px 40px blue; height:250px; width:250px'></a>
			<br><br>DevSkill is <font color='orange'>Under Construction!!</font></td>
		</tr>
		
	</table>
	<br><br>
<center>
	<footer>
		<h4>
			<font color="black">
				<br>ssavi &copy; <script type = "text/javaScript"> var now = new Date(); var Y = now.getFullYear(); document.writeln(Y); </script> 
			</font>
		</h4>
	</footer>
</center>
</div>
<br>
</body>

</html>
