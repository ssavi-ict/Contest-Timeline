<!DOCTYPE html>
<html>

<head>
	<title>Codeforces Contest List</title>
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
	<br>
	<center> <img src="Banner.jpg" alt="Banner" style='width:90%; height: 200px;'/> </center>
	<br><br>
	<div class="main_content">
		<center>
		<table border='01 px solid black' style = 'margin-left: 0px;' cellspacing=1 width='90%' bgcolor=lightgray >
			<tr>
				<td> <h1> <center> <font color="purple"; > Codeforces Contest List </font> </center> </h1> </td>
			</tr>
		</table>
		<br><br>
		
		<?php
			include("getData.php");
			echo "<table border='1' style = 'margin-left:0px;' cellspacing=1 width='90%' bgcolor=lightgray >";
			echo "<tr >
				<th width = '60%' height='30px'> Contest Title </th>
				<th width = '15%' height='30px'> Start </th>
				<th width = '10%' height='30px'> Duration </th>
				<th width = '15%' height='30px'> Status </th>
			</tr>";
			
			

			function convert_date($p_date){
				$dd = substr($p_date, 4, 2);
				$YY = substr($p_date, 7, 4);
				$mm = substr($p_date, 0, 3);
				if(strcmp($mm,"Jan")==0) $mm = '01';
				else if(strcmp($mm,"Feb")==0) $mm = '02';
				else if(strcmp($mm,"Mar")==0) $mm = '03';
				else if(strcmp($mm,"Apr")==0) $mm = '04';
				else if(strcmp($mm,"May")==0) $mm = '05';
				else if(strcmp($mm,"Jun")==0) $mm = '06';
				else if(strcmp($mm,"Jul")==0) $mm = '07';
				else if(strcmp($mm,"Aug")==0) $mm = '08';
				else if(strcmp($mm,"Sep")==0) $mm = '09';
				else if(strcmp($mm,"Oct")==0) $mm = '10';
				else if(strcmp($mm,"Nov")==0) $mm = '11';
				else if(strcmp($mm,"Dec")==0) $mm = '12';
				
				$c_date = $mm.'-'.$dd.'-'.$YY;
				return $c_date;
			}
			
			$is_contest_avaiable = false;
		
			// CF contest list scrapper
			$main_content = getData("http://codeforces.com/contests?complete=true");
			$overall_contest_list = explode( "<div class='contests-table' style='margin-top:2em;'>" , $main_content);
			//print_r ($overall_contest_list);
			$current_contest_list = explode('<table class="">', $overall_contest_list[0]);
			//print_r ($current_contest_list[1]);
			$just_contest_list = explode('<tr', $current_contest_list[1]);
			//print_r($just_contest_list);
			for($i=2; $i<sizeof($just_contest_list); $i++){
				$var_to_work = $just_contest_list[$i];
				$contest_details_list = explode('<td>', $var_to_work);
				
				//Contest ID Crawl
				$var_contest = $contest_details_list[0];
				$contestID = explode('data-contestId="', $var_contest);
				if(empty($contestID[1])==true) break;
				$contestID = explode('"', $contestID[1]);
				$contest_ID = $contestID[0];
				
				//Contest Title Crawl
				$contest_title_extra = explode('</td>', $contest_details_list[1]);
				$contest_title = $contest_title_extra[0];
				
				// Timezone Set
				date_default_timezone_set("Asia/Dhaka");
				
				//Contest Date and Time Information
				$contest_date_and_time = $contest_details_list[2];
				$contest_date_and_time_array = explode( '<span class="format-time" data-locale="en">', $contest_date_and_time);
				$just_contest_date_and_time_array = explode( '</span>', $contest_date_and_time_array[1]);
				$contest_date_and_time = $just_contest_date_and_time_array[0];
				$contest_date_details = explode( ' ', $contest_date_and_time);
				$just_contest_date = convert_date($contest_date_details[0]);
				$just_contest_time = $contest_date_details[1];
				$contest_date_and_time_string = $just_contest_date.' '.$just_contest_time;
				
				// Unexpected Line Break
				//if($contest_date_and_time_string[0]=='-') break;
				
				$format = "m-d-Y H:i";
				$dateobj = DateTime::createFromFormat($format, $contest_date_and_time_string);
				$dateobj->modify('+3 hour');
				$contest_dt = $dateobj->format('m-d-Y H:i');
				$contest_dt_parse = date_parse($contest_dt);
				$contest_dt_explode = explode('-',$contest_dt);
				$contest_tm_explode_ex = explode(' ',$contest_dt_explode[2]);
				$contest_tm_explode = explode(':', $contest_tm_explode_ex[1]);
				$hour = $contest_tm_explode[0];
				$minute = $contest_tm_explode[1];
				$second = 0;
				$day = $contest_dt_explode[1];
				$month = $contest_dt_explode[0];
				$year = $contest_tm_explode_ex[0];
				
				
				//Current Date and Time
				$current_dt = new DateTime("-1 hour");
				$current_dt = $current_dt->format('m-d-Y H:i');
				$current_dt_parse = date_parse($current_dt);
				$current_hour = str_pad($current_dt_parse['hour'], 2, "0", STR_PAD_LEFT);
				$current_minute = str_pad($current_dt_parse['minute'], 2, "0", STR_PAD_LEFT);
				$current_second = str_pad($current_dt_parse['second'], 2, "0", STR_PAD_LEFT);
				$current_day = str_pad($current_dt_parse['day'], 2, "0", STR_PAD_LEFT);
				$current_month = str_pad($current_dt_parse['month'], 2, "0", STR_PAD_LEFT);
				$current_year = $current_dt_parse['year'];
				
				//Decision about Status 
				
				
				if(intval($year)>intval($current_year)) $contest_status = "Upcoming";
				else if(intval($month)>intval($current_month)) $contest_status = "Upcoming";
				else if(intval($day)>intval($current_day)) $contest_status = "Upcoming";
				else if(intval($hour)>intval($current_hour)) $contest_status = "Upcoming";
				else if(intval($minute)>intval($current_minute)) $contest_status = "Upcoming";
				else if(intval($second)>intval($current_second)) $contest_status = "Upcoming";
				else $contest_status = "Active";
						
				
				//Contest Duration
				$contest_duration = $contest_details_list[3];
				$contest_duration_array = explode('<td class="state">', $contest_duration);
				$contest_duration_a_ex = explode ('</td>', $contest_duration_array[0]);
				$contest_duration = $contest_duration_a_ex[0];
				
				
				//echo "Contest ID = ".$contest_ID;
				echo "<tr>";
				
				$contest_link = "http://codeforces.com/contests/". $contest_ID;
				echo "<td>";
				echo "<a style='text-decoration:none' href=".$contest_link." target='_blank'>".$contest_title."</a>";
				echo "<br>";
				echo "</td>";
				
				echo "<td>";
				echo "<a style='text-decoration:none' href = 'https://www.timeanddate.com/worldclock/fixedtime.html?day=".$day."&month=".$month."&year=".$year."&hour=".$hour."&min=".$minute."&sec=0&p1=73' target='_blank'>";
				echo ($month.'-'.$day.'-'.$year.'<br>'.$hour.':'.$minute.' ');
				echo "<small><sup>UTC+6</sup></small>";
				echo "</a>";
				echo "</td>";
				
				echo "<td>";
				echo $contest_duration;
				echo "</td>";
				
				echo "<td>";
				if($contest_status=="Active") echo '<font color ="#0a0"; ><b>'.$contest_status.'</b></font>';
				else echo '<font color ="orange"; ><b>'.$contest_status.'</b></font>';
				echo "</td>";
				
				echo "</tr>";
				
				//echo "<br>";
				$is_contest_avaiable = true;
				
			}
			
			if($is_contest_avaiable == false){
				echo '<tr>';
				echo '<td colspan = "4">';
				echo 'Sorry!! No Contest is Available Right Now. Check Back Later ';
				echo '</td>';
				echo '</tr>';
			}
			
			echo "</table>";
		?>
	</center>
	</div>
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