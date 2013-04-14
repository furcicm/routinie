<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" href="css/main_page.css" />
		<link rel="stylesheet" href="../css/progress.css" />
		<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.2/themes/cupertino/jquery-ui.css" />
		<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
		<script type="text/javascript" src="https://www.google.com/jsapi"></script>
		<script type='text/javascript' src="js/main_page.js"></script>
		<script type='text/javascript' src="http://code.jquery.com/ui/1.10.2/jquery-ui.js"></script>
  
	</head>
	<body>
		<header id="top-header">
			<nav id="main-navigation">
				<ul id="h-menu-left">
					<a href="/"><li>Routinie</li></a>
					<a href="?q=planner"><li>Planner</li></a>
					<a href="?q=progress"><li>Progress</li></a>
				</ul>
				<ul id="h-menu-right">
					<a href="?q=account"><li>Account</li></a>
					<a href="logout.php"><li>Logout</li></a>
				</ul>
			</nav>
		</header>
		<section id="main-wrapper">
			<aside id="left-sidebar" active=<?php print $selected_subcat; ?>>
				<ul>
					<a href="?cat=1">
						<li>
							<img src="../images/education.png"/>
							<h3>EDUCATION</h3>
						</li>
					</a>
					
					<a href="?cat=2">
						<li>
							<img src="../images/business.png"/>
							<h3>BUSINESS</h3>
						</li>
					</a>
					
					<a href="?cat=3">
						<li>
							<img src="../images/health.png"/>
							<h3>HEALTH</h3>
						</li>
					</a>

					<a href="?cat=4">
						<li>
							<img src="../images/lifestyle.png"/>
							<h3>LIFESTYLE</h3>
						</li>
					</a>

					<a href="?cat=5">
						<li>
							<img src="../images/social.png"/>
							<h3>SOCIAL</h3>
						</li>
					</a>

					<a href="?cat=6">
						<li>
							<img src="../images/entertainment.png"/>
							<h3>ENTERTAINMENT</h3>
						</li>
					</a>

					<a href="?cat=7">
						<li>
							<img src="../images/finance.png"/>
							<h3>FINANCE</h3>
						</li>
					</a>
				</ul>
			</aside>
			<div id="main-container">
				<header id="content-header">
					<ul>
						<?php foreach ($subcats as $key => $value): ?>
							<li value=<?php echo $key; ?>><?php echo ucfirst($value); ?></li>
						<?php endforeach; ?>
					</ul>
				</header>
				<div id="main-content">
					<?php print $main_content; ?>
				</div>
			</div>
			<aside id="right-sidebar"></aside>
			<div class="clearfix"></div>
		</section>
	</body>
</html>