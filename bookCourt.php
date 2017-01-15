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
?>
<html>
	<head>
		<title>Badminton - Book Court</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<link rel="stylesheet" href="assets/css/main.css" />
	</head>
	<body>
		<!-- Wrapper -->
			<div id="wrapper">

				<!-- Header -->
					<header id="header">
						<div class="inner">

							<!-- Logo -->
								<a href="home.php" class="logo">
									<span class="symbol"><img src="images/badminton.svg" alt="" /></span><span class="title">Badminton</span>
								</a>
							<!-- User -->
							<span style="width:40%; height:35px; overflow:hidden; text-overflow:ellipsis; float:right; font-family:微軟正黑體; text-align:right;">
								<b>
								<?php
									if($_SESSION['Student_id']!=null){
										echo "歡迎, ".$_SESSION['Student_name'];
									}else{
										echo "您尚未登入.";
									}
								?>
								</b>
							</span>
							<!-- Nav -->
								<nav>
									<ul>
										<li><a href="#menu">Menu</a></li>
									</ul>
								</nav>

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
									<li><a href='regist.html'>Regist</a></li>
									<li><a href='m_login.html'>Manager Login</a></li>";
								}
								else {
									echo "<li><a href='logout.php'>Logout</a></li>";
								}
							?>
						</ul>
					</nav>
				
				<!-- Main -->
					<div id="main">
						<div class="inner">
						
						<?php
							$date = date("Y-m-d",strtotime('+7HOUR'));
							echo "<h1>Court ".$_SESSION['courtNumber']."</h1>
							<h2>".$date."  ".$_SESSION['timeSelect'];
						?>
						</div>
						<div class="inner">
							<table frame = "void" rules = "none" border = "1">
							<?php
								//get hour now
								$hour = date("h", strtotime('+7HOUR'));
								if($hour.':00:00'>$_SESSION['timeSelect']){
									echo"<tr>
									<th>使用者</th>
									</tr>";
								}
								else {
									echo"<tr>
									<th>準備簽場</th>
									</tr>";
								}
								
								
								$query = 'SELECT * FROM reservation_courts WHERE courts_id = "'.$_SESSION['courtNumber'].'"AND courts_time ="'.$_SESSION['timeSelect'].'"' ;
								
								$res =  $db->query($query);
								$row = $res-> fetchall();
								for($i = 0;$i < count($row);$i++)
								{	
									echo "<tr>
									<th>".$row[$i]['Student_id']." ".$row[$i]['Student_name']."</th>
									</tr>
									";
								}
							?>
							</table>
							
						</div>
					</div>

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
							<section>
								<?php
									if($_SESSION['Student_id'] == null){
										echo'<h2>預約</h2>';
										echo"<form method='post' action='login.html'>
											<ul class='actions'>
												<li><input type='submit' value='Login' class='special' /></li>
											</ul>
										</form>";
									}
									else{
										for($i = 0;$i < count($row);$i++)
										{	
											if($_SESSION['Student_id'] == $row[$i]['Student_id']){
												echo'<h2>取消預約</h2>';
												echo"<form method='post' action='cancelBook.php'>
													<ul class='actions'>
														<li><input type='submit' value='Cancel' class='special' /></li>
													</ul>
												</form>";
												break;
											}
										}
										
										if($_SESSION['Student_id'] != $row[$i]['Student_id']){
											echo'<h2>預約</h2>';
											echo"<form method='post' action='book.php'>
												<ul class='actions'>
													<li><input type='submit' value='Book' class='special' /></li>
												</ul>
											</form>";
										}
									}
								?>
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