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
		<title>Manager</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<link rel="stylesheet" href="assets/css/main.css" />
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
						<div class="inner" style="">
						<?php
						$query = "SELECT * FROM billboard ORDER BY date , time"; 
						$res = $db->query($query);
						$row = $res-> fetchAll();
						
						echo '<form method="post" action="managerBBDelete.php">';
						echo '<div class="inner" style="background-color:white; width:100%; height:300px; overflow: auto;" >';
						for($i=0; $i<count($row); $i++){
							
							echo "<input type='checkbox' id='".$row[$i]['data']."' name='bb[]' value='".$row[$i]['data']."'><label for='".$row[$i]['data']."'><span style='font-family:微軟正黑體'><b>".$row[$i]['date']."  ".$row[$i]['time']."  ".$row[$i]['data']."</b></span></label><br/>";
							
						}
						echo'</div>
							<ul class="actions">
								<li><input type="submit" value="Delete" class="special" /></li>
							</ul>';
						echo '</form>';
						?>
						</div>
						<div class="inner">
							<form method="post" action="managerBBInsert.php">
							<div class="field half first">
								<input type="date" name="date" min="2017-01-01" max="2087-12-31" id="date" placeholder="Date">
							</div>
							<div class="field half">
								<input type="time" name="time" id="time" placeholder="Time">
							</div>
							<div class="field">
								<textarea name="data" id="data" placeholder="Message" rows="1" style="overflow: hidden; resize: none; height: 79px;"></textarea>
							</div>
							<ul class="actions">
								<li><input type="submit" value="Insert" class="special" /></li>
							</ul>
							</form>
						<hr style=" border: 0;height: 0;box-shadow: 0 0 10px 1px black;" />
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
				<!-- Main -->
					<div id="main">
						<div class="inner">	
						<h1>Court Management</h1>
							<table>
							<form method="post" action="courtManagement.php">
							<tr>
								<th></th>
								<th>Court 1</th>
								<th>Court 2</th>
								<th>Court 3</th>
								<th>Court 4</th>
								<th>Court 5</th>
								<th>Court 6</th>
								<th>Court 7</th>
								<th>Court 8</th>
							</tr>
							<?php
								$day = date("w", strtotime('+7HOUR'));
								if($day == 0||$day == 6){
									$time_courts = 88;
								}else{
									$time_courts = 48;
								}
								
								for($i=0;$i<$time_courts;$i++){
									if(($i%8)==0){
										if($time_courts==48){
											$time = (floor($i/8)+17);
										}else{
											$time = (floor($i/8)+11);
										}
										echo '<tr><th>'.$time.':00</th>';
									}
									$query = "SELECT * FROM courts WHERE courts_id ='".($i%8+1)."' AND courts_time ='".$time.":00:00'"; 
									$res = $db -> query($query);
									$row = $res -> fetchAll();
									if(count($row)!=0){
										echo '<td><input type="checkbox" id="'.$i.'" name="CM[]" value="'.$i.'" checked><label for="'.$i.'"></td>';
									}else {
										echo '<td><input type="checkbox" id="'.$i.'" name="CM[]" value="'.$i.'"><label for="'.$i.'"></td>';
									}
									if(($i%8)==7){
										echo '</tr>';
									}
								}
							?>
							</table>
							<ul class="actions">
								<li><input type="submit" value="SEND" class="special" /></li>
							</ul>
							</form>
						</div>
					</div>
				<div id="showbox" style="text-align:center;"></div>
				<!-- Footer -->
					<footer id="footer">
						<div class="inner">
							<section>
								<h2>Share</h2>
								<ul class="icons">
									<li><a target="view_window" href="https://twitter.com/share" data-url="http://jazz1617821.ddns.net" data-text="Fuck you." data-lang="zh-tw" data-size="large" class="icon style2 fa-twitter"><span class="label">Twitter</span></a></li>
									<script>!function(d,s,id){
										var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';
										if(!d.getElementById(id)){js=d.createElement(s);
										js.id=id;js.src=p+'://platform.twitter.com/widgets.js';
										fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');
									</script>
									<li><a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Fjazz1617821.ddns.net%2F&amp;src=sdkpreparse" class="icon style2 fa-facebook"><span class="label">Facebook</span></a></li>
									<script>(function(d, s, id) {
										  var js, fjs = d.getElementsByTagName(s)[0];
										  if (d.getElementById(id)) return;
										  js = d.createElement(s); js.id = id;
										  js.src = "//connect.facebook.net/zh_TW/sdk.js#xfbml=1&version=v2.8";
										  fjs.parentNode.insertBefore(js, fjs);
										}(document, 'script', 'facebook-jssdk'));
									</script>
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