<!DOCTYPE html>
<html>

<head>
	<title>AtCoder Contest List</title>
	
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
		<table border='1px solid black' style = ' margin-left: 0px;' cellspacing=1 width='90%' bgcolor=lightgray >
			<tr>
				<td> <h1> <center> <font color="purple"; > AtCoder Contest List </font> </center> </h1> </td>
			</tr>
		</table>
		
		<?php
			include("getData.php");
			echo "<table border='1' style = 'margin-left:0px;' cellspacing=1 width='90%' bgcolor=lightgray >";
			echo "<tr >
				<th width = '60%' height='30px'> Contest Title </th>
				<th width = '15%' height='30px'> Start </th>
				<th width = '10%' height='30px'> Duration </th>
				<th width = '15%' height='30px'> Status </th>
			</tr>";
			
			
			// AtCoder contest list scrapper
			$main_content = getData("http://atcoder.jp/contest");
			$complete_contest_list = explode( '<h3>', $main_content);
			$all_active_contest = $complete_contest_list[1];
			$all_left_contest = $complete_contest_list[2];
			$all_left_contest_list = explode('<hr>',$all_left_contest);
			$all_upcoming_contest = $all_left_contest_list[0];
			
			//Working with  active contests
			$active_contest_rows = explode('<tr>', $all_active_contest);
			$is_practice_contest = true;
			$is_contest_available = false;
			
			for( $i=2; $i<sizeof($active_contest_rows);  $i++){
				
				// Timezone Set
				date_default_timezone_set("Asia/Dhaka");
				
				$the_row_info = $active_contest_rows[$i];
				$exp_for_col_info = explode( '<td',$the_row_info);
				$first_col_info_start = explode('</a>', $exp_for_col_info[1]);
				$first_col_info_start = explode(">", $first_col_info_start[0]);
				
				//time and date link crawl
				$first_col_info_start_time_date_link = explode("<a href=", $first_col_info_start[1]);
				$time_date_link = $first_col_info_start_time_date_link[1];
				
				//Time, Date, Time Zone Split
				$time_date_explode = explode('=', $time_date_link);
				$time_date_with_extra = explode('&amp;p1', $time_date_explode[1]) ;
				$time_zone_extra = explode('" target',$time_date_explode[2]);
				$time_date = $time_date_with_extra[0];
				
				$contest_year = substr($time_date, 0, 4);
				$contest_month = substr($time_date, 4, 2);
				$contest_day = substr($time_date, 6, 2);
				$contest_hour = substr($time_date, 9, 2);
				$contest_minute = substr($time_date, 11, 2);
				$contest_second = "00";
				
				//Date Time Object Formation with format m-d-Y H:i
				$contest_date_and_time_string = $contest_month.'-'.$contest_day.'-'.$contest_year.' '.$contest_hour.':'.$contest_minute;
				$format = "m-d-Y H:i";
				$dateobj = DateTime::createFromFormat($format, $contest_date_and_time_string);
				$dateobj->modify('-3 hour');
				$contest_dt = $dateobj->format('m-d-Y H:i');
				$contest_dt_parse = date_parse($contest_dt);
				$contest_dt_explode = explode('-',$contest_dt);
				$contest_tm_explode_ex = explode(' ',$contest_dt_explode[2]);
				$contest_tm_explode = explode(':', $contest_tm_explode_ex[1]);
				$hour = $contest_tm_explode[0];
				$minute = $contest_tm_explode[1];
				$second = "00";
				$day = $contest_dt_explode[1];
				$month = $contest_dt_explode[0];
				$year = $contest_tm_explode_ex[0];
				
				//Contest Name and Link Crawl
				$second_col_info_name_link = explode('<a href="', $exp_for_col_info[2]);
				$second_col_info_name_link = explode('">', $second_col_info_name_link[1]);
				$contest_link = $second_col_info_name_link[0];
				$contest_title = $second_col_info_name_link[1];
				
				//Contest duration Crawl
				if($is_practice_contest) $contest_duration = "N/A";
				else{
					$third_col_info_duration = explode('">',$exp_for_col_info[3]);
					$contest_duration = $third_col_info_duration[1];
				}
				
				$is_practice_contest = false;
				
				echo "<tr>";
				
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
				echo '<font color ="#0a0";><b>Active</b></font>';
				echo "</td>";
				
				echo "</tr>";
				
				$i++; $i++;
				$is_contest_available = true;
			}
			
			
			//Working with  upcoming contests
			$upcoming_contest_rows = explode('<tr>', $all_upcoming_contest);
			
			for( $i=2; $i<sizeof($upcoming_contest_rows);  $i++){
				
				// Timezone Set
				date_default_timezone_set("Asia/Dhaka");
				
				$the_row_info = $upcoming_contest_rows[$i];
				$exp_for_col_info = explode( '<td',$the_row_info);
				$first_col_info_start = explode('</a>', $exp_for_col_info[1]);
				$first_col_info_start = explode(">", $first_col_info_start[0]);
				
				//time and date link crawl
				$first_col_info_start_time_date_link = explode("<a href=", $first_col_info_start[1]);
				$time_date_link = $first_col_info_start_time_date_link[1];
				
				//Time, Date, Time Zone Split
				$time_date_explode = explode('=', $time_date_link);
				$time_date_with_extra = explode('&amp;p1', $time_date_explode[1]) ;
				$time_zone_extra = explode('" target',$time_date_explode[2]);
				$time_date = $time_date_with_extra[0];
				
				$contest_year = substr($time_date, 0, 4);
				$contest_month = substr($time_date, 4, 2);
				$contest_day = substr($time_date, 6, 2);
				$contest_hour = substr($time_date, 9, 2);
				$contest_minute = substr($time_date, 11, 2);
				$contest_second = "00";
				
				//Date Time Object Formation with format m-d-Y H:i
				$contest_date_and_time_string = $contest_month.'-'.$contest_day.'-'.$contest_year.' '.$contest_hour.':'.$contest_minute;
				$format = "m-d-Y H:i";
				$dateobj = DateTime::createFromFormat($format, $contest_date_and_time_string);
				$dateobj->modify('-3 hour');
				$contest_dt = $dateobj->format('m-d-Y H:i');
				$contest_dt_parse = date_parse($contest_dt);
				$contest_dt_explode = explode('-',$contest_dt);
				$contest_tm_explode_ex = explode(' ',$contest_dt_explode[2]);
				$contest_tm_explode = explode(':', $contest_tm_explode_ex[1]);
				$hour = $contest_tm_explode[0];
				$minute = $contest_tm_explode[1];
				$second = "00";
				$day = $contest_dt_explode[1];
				$month = $contest_dt_explode[0];
				$year = $contest_tm_explode_ex[0];
				
				//Contest Name and Link Crawl
				$second_col_info_name_link = explode('<a href="', $exp_for_col_info[2]);
				$second_col_info_name_link = explode('">', $second_col_info_name_link[1]);
				$contest_link = $second_col_info_name_link[0];
				$contest_title = $second_col_info_name_link[1];
				
				
				//Contest duration Crawl
				if($is_practice_contest) $contest_duration = "N/A";
				else{
					$third_col_info_duration = explode('">',$exp_for_col_info[3]);
					$contest_duration = $third_col_info_duration[1];
				}
				
				$is_practice_contest = false;
				
				echo "<tr>";
				
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
				echo '<font color ="orange";><b>Upcoming</b></font>';
				echo "</td>";
				
				echo "</tr>";
				
				$i++; $i++;
				$is_contest_available = true;
			}
			
			if($is_contest_available == false){
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
	<br>
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
