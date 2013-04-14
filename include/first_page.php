
<!doctype html>
<html>
<head>
	<title>Routinie</title>
	
	<!-- Meta -->
	<?php include('meta.php'); ?>
	
	<!-- Stylesheets -->	
	<?php include('stylesheet.php'); ?>
	<link rel="stylesheet" href="css/style.css">

	<!-- Javascript -->
	<?php include('javascript.php'); ?>
	<script type="text/javascript">

		  var _gaq = _gaq || [];
		  _gaq.push(['_setAccount', 'UA-35241157-1']);
		  _gaq.push(['_trackPageview']);

		  (function() {
			var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
			ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
			var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
		  })();

	</script>
	
</head>

<body>
<?php session_destroy(); ?>
<div class="wrapper">
	<div id="content">
	<!-- Logo -->
		<?php include('logo.php'); ?>
		
	<!-- Menu -->
		<?php include('menu.php'); ?>
	</div>	

</div>
<!-- Footer -->
			<?php include('footer.php'); ?>	

</body>

</html>