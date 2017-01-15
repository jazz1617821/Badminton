<!DOCTYPE HTML>
<!--
	Phantom by HTML5 UP
	html5up.net | @ajlkn
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<?php
	session_start();
	error_reporting(0);
	include "conect.php";
	$_SESSION['courtNumber'] = null;
?>
<html>
	<head>
		<title>Badminton</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<link rel="stylesheet" href="assets/css/main.css" />
		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
		<script language="JavaScript">
			function ShowTime(){
				var day_list = ['日', '一', '二', '三', '四', '五', '六'];
				var date = new Date();		
				var yyyy = date.getFullYear();		
				var mm = date.getMonth()+1;
				var dd = date.getDate();
				var h = date.getHours();
				var m = date.getMinutes();
				var s = date.getSeconds();
				var d = date.getDay();
			//	document.getElementById('showbox').innerHTML = '今天是'+yyyy+'年'+mm+'月'+dd+'日星期'+day_list[d]+h+'時'+m+'分'+s+'秒';		
				setTime(d);				
				//setTimeout('ShowTime()',1000);
			}
			function setTime(day){
				if(day == 1 || day == 2 || day == 3 || day == 4 || day == 5){
					document.getElementById('selectTime').innerHTML = 
						'<option selected disabled>時間</option>' +
						'<option value="17:00:00">17:00~18:00</option>' +
						'<option value="18:00:00">18:00~19:00</option>' +
						'<option value="19:00:00">19:00~20:00</option>' +
						'<option value="20:00:00">20:00~21:00</option>' +
						'<option value="21:00:00">21:00~22:00</option>';						
				}
				else if(day == 0 || day == 6){
					document.getElementById('selectTime').innerHTML = 
						'<option selected disabled>時間</option>' +
						'<option value="11:00:00">11:00~12:00</option>' +
						'<option value="12:00:00">12:00~13:00</option>' +
						'<option value="13:00:00">13:00~14:00</option>' +
						'<option value="14:00:00">14:00~15:00</option>' +
						'<option value="15:00:00">15:00~16:00</option>' +
						'<option value="16:00:00">16:00~17:00</option>' +
						'<option value="17:00:00">17:00~18:00</option>' +
						'<option value="18:00:00">18:00~19:00</option>' +
						'<option value="19:00:00">19:00~20:00</option>' +
						'<option value="20:00:00">20:00~21:00</option>';
				}
			}
		</script>
	</head>
	<body onload="ShowTime()">
		<!-- Wrapper -->
			<div id="wrapper">
				<!-- Header -->
					<header id="header">
						<div class="inner">

							<!-- Logo -->
								<a href="home.php" class="logo">
									<span class="symbol"><img src="images/badminton.svg" alt="" /></span><span class="title">Badminton</span>
								</a>

							<!-- Nav -->
								<nav>
									<ul>
										<li><a href="#menu">Menu</a></li>
									</ul>
								</nav>
							
						</div>
						<div style="width:150px; margin:30px auto; " >
						<form method="post" action="home.php">
							<select id = "selectTime" name = "selectTime" ></select>
							<ul class="actions">
								<li><input type="submit" value="SEND" class="special fit" /></li>
							</ul>
						</form>
						</div>
					</header>
				<!-- Menu -->
					<nav id="menu">
						<h2>Menu</h2>
						<ul>
							<li><a href="home.php">Home</a></li>
							<?php
								if($_SESSION['Student_id'] == null){
									echo "<li><a href='login.html'>Login</a></li>
									<li><a href='regist.html'>Regist</a></li>";
								}
								else {
									echo "<li><a href='logout.php'>Logout</a></li>";
								}
							?>
							<li><a href="m_login.html">Manager Login</a></li>
						</ul>
					</nav>
					<!-- Time -->
				<?php
					$Time = $_POST[selectTime];
					$day = date("w", strtotime('+7HOUR'));
					$date = date("Y-m-d",strtotime('+7HOUR'));
					if($Time == null){
						if($day == 0||$day == 6){
							$Time = "11:00:00";
						}else{
							$Time = "17:00:00";
						}
					}
					$_SESSION['timeSelect'] = $Time;
					
					echo '	<div id="Time">
								<div class="inner">
									<section>
										<h2>'.$date.'  '.$Time.'</h2>
									</section>
								</div>
							</div>';
				?>
				<!-- Main -->
					<div id="main">
						<div class="inner">	
							<section class="tiles">
							<?php
							
							$query = "SELECT * FROM reservation_courts WHERE courts_time = ?";
							$res=$db->prepare($query);
							$res->execute(array($Time));
							$row = $res-> fetchAll();
							
							$courts_state[8];
							
							for($i=0; $i<count($row); $i++){
								$courts_state[$row[$i]['courts_id']] = 1;
							}
							
							for($j = 0; $j < 8; $j++){
							echo '
								<article>
									<span class="image">';
									if($courts_state[$j+1]==1){
										echo '<img src="images/court_red.png" alt="" />';
									}else{
										echo '<img src="images/court_green.png" alt="" />';
									}
							echo '
									</span>
									<a href="gotoBookCourt';
							echo 							$j+1;
							echo '								.php">
										<h2>Court ';
							echo					$j+1;
							echo '						</h2>
										<div class="content">
											<p id = "appointee">';
											$count = 0;
											for($i=0; $i<count($row); $i++){
												if($row[$i]['courts_id']==$j+1 && $count!=5){
													echo $row[$i]['Student_id']." ".$row[$i]['Student_name']."</br>";
													$count++;													
												}
											}
							echo 			'</p>
										</div>
									</a>
								</article>';
							}
							?>
							</section>
						</div>
					</div>
				<div id="showbox" style="text-align:center;"></div>
				<!-- Footer -->
					<footer id="footer">
						<div class="inner">
							<section>
								<h2>Share</h2>
								<ul class="icons">
									<li><a href="#" class="icon style2 fa-twitter"><span class="label">Twitter</span></a></li>
									<li><a href="#" class="icon style2 fa-facebook"><span class="label">Facebook</span></a></li>
									<li><a href="#" class="icon style2 fa-instagram"><span class="label">Instagram</span></a></li>
									<li><a href="#" class="icon style2 fa-dribbble"><span class="label">Dribbble</span></a></li>
									<li><a href="#" class="icon style2 fa-github"><span class="label">GitHub</span></a></li>
									<li><a href="#" class="icon style2 fa-500px"><span class="label">500px</span></a></li>
									<li><a href="#" class="icon style2 fa-phone"><span class="label">Phone</span></a></li>
									<li><a href="#" class="icon style2 fa-envelope-o"><span class="label">Email</span></a></li>
								</ul>
							</section>
							<ul class="copyright">
								<li>&copy; Untitled. All rights reserved</li><li>Design: <a href="http://html5up.net">HTML5 UP</a></li>
							</ul>
						</div>
					</footer>
				
			</div>

		<!-- Scripts -->
			<script src="assets/js/jquery.min.js"></script>
			<script src="assets/js/skel.min.js"></script>
			<script src="assets/js/util.js"></script>
			<!--[if lte IE 8]><script src="assets/js/ie/respond.min.js"></script><![endif]-->
			<script src="assets/js/main.js"></script>

	</body>
</html>