<?php session_start(); 
   if (isset($_GET['script']) && $_GET['script'] == 'update-account') {
      require ('scripts/update_account.php');
   }
?>
<!doctype html>
<html>

	<head>
		<title>Routinie</title>

		<link href='http://fonts.googleapis.com/css?family=Open+Sans:300,400,700,600,800' rel='stylesheet' type='text/css'>
		<link rel="stylesheet" href="css/tipsy.css" />
		<link rel="stylesheet" href="css/main_page.css" />
    <link rel="stylesheet" href="css/books.css" />
    <link rel="stylesheet" href="css/account.css" />
		<link rel="stylesheet" href="css/progress.css" />
    <link rel="stylesheet" href="css/planner.css" />
		<link type='text/css' href='css/feedback_popup.css' rel='stylesheet' media='screen' />
	  <link rel="stylesheet" href="http://code.jquery.com/ui/1.9.1/themes/base/jquery-ui.css" />
	  <script src="http://code.jquery.com/jquery-1.8.2.js"></script>
	  <script src="http://code.jquery.com/ui/1.9.1/jquery-ui.js"></script>
		<script type='text/javascript' src="js/jquery.tipsy.js"></script>
    <script type="text/javascript" src="js/preprocess_progress.js"></script>
		<script type='text/javascript' src='js/jquery.simplemodal.js'></script>
		<script type='text/javascript' src='js/feedback_popup.js'></script>		
    
		<script type='text/javascript'>
			$(function() {
				$('.wesrom').tipsy({gravity: 's', fade:true});
				$('.privacy').tipsy({gravity: 's', fade:true});
				$('.contact').tipsy({gravity: 's', fade:true});
				$('.terms').tipsy({gravity: 's', fade:true});
			});
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
		<div id="wrapper">
			<div id="header">
				<div id="header-center">
					<div id="h-menu-left">
						<a href="/"><div>Routinie</div></a>
						<a href="?q=planner"><div>Planner</div></a>
						<a href="?q=progress"><div>Progress</div></a>
					</div>
					<div id="h-menu-right">
						<a href="logout.php"><div>Logout</div></a>
						<a href="?q=account"><div>Account</div></a>
					</div>
				</div>
			</div>
			<div id="content">
				 <?php
            // $_SESSION['message'] = 'Site is under maintenance, please visit later!';
						if (!empty($_SESSION['message'])) {
							 echo "<div class='main-message'>{$_SESSION['message']}</div>";
							 unset($_SESSION['message']);
						}
				 ?>
					<a href="" class="contact"><div id="feedback">Feedback</div></a>
				<?php 
					$page = isset($_GET['page'])? $_GET['page'] : FALSE;
					
					if ($page) {
            switch($page) {
              case 'books':
               $variables = array(
                  'sid'       => 1,
                  'subcat_sg' => 'book',
                  'subcat_pl' => 'books',
                  'title'     => 'reading',
                  'table'     => 'progress_book',

                );
                include_once('templates/education_book.tpl.php');
              break;
              
              case 'courses':
                $variables = array(
                  'sid'       => 2,
                  'subcat_sg' => 'course',
                  'subcat_pl' => 'courses',
                  'table'     => 'progress_course',

                );
                include_once('templates/education_title_time.tpl.php');
              break;
              
              case 'tutorials':
                $variables = array(
                  'sid'       => 3,
                  'subcat_sg' => 'tutorial',
                  'subcat_pl' => 'tutorials',
                  'table'     => 'progress_tutorial',
                );
                include_once('templates/education_title_time.tpl.php');
              break;
              
              case 'experiments':
                $variables = array(
                  'sid'       => 4,
                  'subcat_sg' => 'experiment',
                  'subcat_pl' => 'experiments',
                  'table'     => 'progress_experiment',

                );
                include_once('templates/education_title_time.tpl.php');
              break;
              
              case 'research':
                $variables = array(
                  'sid'       => 5,
                  'subcat_sg' => 'research',
                  'subcat_pl' => 'research',
                  'table'     => 'progress_research',

                );
                include_once('templates/education_title_time.tpl.php');
              break;
              
              case 'work':
                $variables = array(
                  'sid'       => 6,
                  'subcat_sg' => 'work',
                  'subcat_pl' => 'work',
                  'table'     => 'progress_work',

                );
                include_once('templates/business_title_time_hour.tpl.php');
              break;
              
              case 'projects':
                $variables = array(
                  'sid'       => 7,
                  'subcat_sg' => 'project',
                  'subcat_pl' => 'projects',
                  'table'     => 'progress_project',

                );
                include_once('templates/business_title_time_hour.tpl.php');
              break;
              
              case 'contracts':
                 $variables = array(
                  'sid'       => 8,
                  'subcat_sg' => 'contract',
                  'subcat_pl' => 'contracts',
                  'table'     => 'progress_contract',

                );
                include_once('templates/business_title_time_hour.tpl.php');

              break;
              
              case 'sports':
                $variables = array(
                  'sid'       => 9,
                  'subcat_sg' => 'sport',
                  'subcat_pl' => 'sports',
                  'table'     => 'progress_sport',
                );
                include_once('templates/health_sport_time.tpl.php');
              break;
              
              case 'diet':
                $variables = array(
                  'sid'       => 10,
                  'subcat_sg' => 'diet',
                  'subcat_pl' => 'diet',
                  'table'     => 'progress_diet',
                );
                include_once('templates/health_diet_title_quantity.tpl.php');
              break;
              
              case 'walking':
                $variables = array(
                  'sid'       => 11,
                  'subcat_sg' => 'walking',
                  'subcat_pl' => 'walking',
                  'table'     => 'progress_walking',
                  'title'     => 'walking',
                );
                include_once('templates/health_movement.tpl.php');
              break;
              
              case 'jogging':
                $variables = array(
                  'sid'       => 12,
                  'subcat_sg' => 'jogging',
                  'subcat_pl' => 'jogging',
                  'table'     => 'progress_jogging',
                  'title'     => 'jogging',
                );
                include_once('templates/health_movement.tpl.php');
              break;

              case 'sleep':
                $variables = array(
                  'sid'       => 26,
                  'subcat_sg' => 'sleep',
                  'subcat_pl' => 'sleep',
                  'table'     => 'progress_sleep',
                  'title'     => 'sleep',
                );
                include_once('templates/health_sleep.tpl.php');
              break;
              
              case 'traveling':
                $variables = array(
                  'sid'       => 13,
                  'subcat_sg' => 'traveling',
                  'subcat_pl' => 'traveling',
                  'table'     => 'progress_traveling',
                  'title'     => 'traveling',
                );
                include_once('templates/lifestyle_traveling.tpl.php');
              break;
              
              case 'hobbies':
                $variables = array(
                  'sid'       => 14,
                  'subcat_sg' => 'hobby',
                  'title_add_new' => 'Add new hobbies',
                  'subcat_pl' => 'hobbies',
                  'table'     => 'progress_hobby',
                  'title'     => 'hobby',
                );
                include_once('templates/lifestyle_hob_vol.tpl.php');
              break;
              
              case 'volunteering':
                $variables = array(
                  'sid'       => 15,
                  'subcat_sg' => 'volunteering',
                  'title_add_new' => 'Add a new volunteering experience',
                  'subcat_pl' => 'volunteering',
                  'table'     => 'progress_volunteer',
                  'title'     => 'volunteering',
                );
                include_once('templates/lifestyle_hob_vol.tpl.php');
              break;
              
              case 'relationships':
              $variables = array(
                  'sid'       => 16,
                  'title'     => 'relationships',
                  'title_add_new' => 'Add some love',
                  'title_completed' => 'Quality time',
                  'subcat_sg' => 'relationship',
                  'subcat_pl' => 'relationships',
                  'table'     => 'progress_relationship',
                );
                include_once('templates/social.tpl.php');
              break;
              
              case 'friends':
               $variables = array(
                  'sid'       => 17,
                  'title'     => 'friends',
                  'title_add_new' => 'Add time with Friends',
                  'title_completed' => 'Time spent with friends',
                  'subcat_sg' => 'friend',
                  'subcat_pl' => 'friends',
                  'table'     => 'progress_friend',
                );
                include_once('templates/social.tpl.php');
              break;
              
              case 'family':
               $variables = array(
                  'sid'       => 18,
                  'title'     => 'family',
                  'title_add_new' => 'Add some love',
                  'title_completed' => 'Time spent with family',
                  'subcat_sg' => 'family',
                  'subcat_pl' => 'family',
                  'table'     => 'progress_family',
                );
                include_once('templates/social.tpl.php');
              break;
              
              case 'television':
               $variables = array(
                  'sid'       => 19,
                  'title'     => 'television',
                  'title_completed' => 'Time spent watching TV',
                  'subcat_sg' => 'television',
                  'subcat_pl' => 'television',
                  'table'     => 'progress_television',
                );
                include_once('templates/enterteinment_television.tpl.php');
              break;
              
              case 'movies':
              $variables = array(
                  'sid'       => 20,
                  'title'     => 'movies',
                  'title_completed' => 'Time spent watching movies',
                  'subcat_pl' => 'movies',
                  'table'     => 'progress_movie',
                );
                include_once('templates/enterteinment_movies.tpl.php');
              break;
              
              case 'music':
               $variables = array(
                  'sid'       => 21,
                  'title'     => 'music',
                  'subcat_sg' => 'music',
                  'subcat_pl' => 'music',
                  'table'     => 'progress_music',
                );
                include_once('templates/enterteinment_music_games.tpl.php');
              break;
              
              case 'games':
              $variables = array(
                  'sid'       => 22,
                  'subcat_sg' => 'game',
                  'subcat_pl' => 'games',
                  'table'     => 'progress_game',
                );
                include_once('templates/enterteinment_music_games.tpl.php');
              break;
              
              case 'income':
                $variables = array(
                  'sid'       => 23,
                  'title'     => 'income',
                  'page' => 'income',
                  'method' =>'Received',
                  'subcat_sg' => 'income',
                  'table'     => 'progress_income',
                );
                include_once('templates/finance.tpl.php');
              break;
              
              case 'expenses':
                $variables = array(
                  'sid'       => 24,
                  'title'     => 'expenses',
                  'page' => 'expenses',
                  'method' => 'Spent',
                  'subcat_sg' => 'expense',
                  'table'     => 'progress_expense',
                );
                include_once('templates/finance.tpl.php');
              break;
              
              case 'donations':
               $variables = array(
                  'sid'       => 25,
                  'title'     => 'donations',
                  'page' =>'donations',
                  'method' => 'Donated',
                  'subcat_sg' => 'donation',
                  'table'     => 'progress_donation',
                );
                include_once('templates/finance.tpl.php');
              break;
							
            }
					}
					elseif (isset($_GET['q'])) {
            $p = $_GET['q'];
            switch($p) {
              case  'account':
                include_once('account/account.php');
              break;
              
              case 'planner':
                include_once('planner/planner.php');
              break;
              
              case 'specific-planner':
                include_once('planner/specific_planner.php');
              break;
              
              case 'general-planner':
                include_once('planner/general_planner.php');
              break;
              
              case 'general-planner/health':
                include_once('planner/gp_health.php');
              break;
              
              case 'general-planner/relationships':
                include_once('planner/gp_relationships.php');
              break;
              
              case 'general-planner/hapiness':
                include_once('planner/gp_hapiness.php');
              break;
              
              case 'general-planner/finances':
                include_once('planner/gp_finances.php');
              break;
						
							 case 'specific-planner-do':
									include_once('planner/sp_do.php');
							 break;
							 
							 case 'progress':
									include_once('progress/progress.php');
							 break;
            }
            
          }
          // elseif (isset($_GET['q']) && $_GET['q'] == 'planner'){
            
          // }
          // elseif (isset($_GET['q']) && $_GET['q'] == 'specific-planner') {
            
          // }
          // elseif (isset($_GET['q']) && $_GET['q'] == 'general-planner') {
            // include_once('planner/gp_health.php');
          // }
          // elseif (isset($_GET['q']) && $_GET['q'] == 'general-planner/health') {
            // include_once('planner/gp_health.php');
          // }
          else {
				?>
				<div id="title">Add your progress</div>
				<div class="row first-row">
					<div class="item">
						<div class="cat-subcat">
							<div>
								<img src="../images/education.png"/>
								<h2>Education</h2>
							</div>
							<div>
								<a href="?page=books"><div class="subcat-item">Books</div></a>
								<a href="?page=courses"><div class="subcat-item">Courses</div></a>
								<a href="?page=tutorials"><div class="subcat-item">Tutorials</div></a>
								<a href="?page=experiments"><div class="subcat-item">Experiments</div></a>
								<a href="?page=research"><div class="subcat-item">Research</div></a>
							</div>
						</div>
					</div>
					<div class="item">
						<div class="cat-subcat">
							<div>
								<img src="../images/business.png"/>
								<h2>Business</h2>
							</div>
							<div>
								<a href="?page=work"><div class="subcat-item">Work</div></a>
								<a href="?page=projects"><div class="subcat-item">Projects</div></a>
								<a href="?page=contracts"><div class="subcat-item">Contracts</div></a>
							</div>
						</div>
					</div>
					<div class="item">
						<div class="cat-subcat">
							<div>
								<img src="../images/health.png"/>
								<h2>Health</h2>
							</div>
							<div>
								<a href="?page=sports"><div class="subcat-item">Sport</div></a>
								<a href="?page=diet"><div class="subcat-item">Diet</div></a>
								<a href="?page=walking"><div class="subcat-item">Walking</div></a>
								<a href="?page=jogging"><div class="subcat-item">Jogging</div></a>
                <a href="?page=sleep"><div class="subcat-item">Sleep</div></a>
							</div>
						</div>
					</div>
				</div>				
				<div class="row">
					<div class="item">
						<div class="cat-subcat">
							<div>
								<img src="../images/lifestyle.png" height="100px"/>
								<h2>Lifestyle</h2>
							</div>
							<div>
								<a href="?page=traveling"><div class="subcat-item">Traveling</div></a>
								<a href="?page=hobbies"><div class="subcat-item">Hobbies</div></a>
								<a href="?page=volunteering"><div class="subcat-item">Volunteering</div></a>
							</div>
						</div>
					</div>
					<div class="item">
						<div class="cat-subcat">
							<div>
								<img src="../images/social.png" height="100px"/>
								<h2>Social</h2>
							</div>
							<div>
                <a href="?page=relationships"><div class="subcat-item">Relationships</div></a>
								<a href="?page=friends"><div class="subcat-item">Friends</div></a>
								<a href="?page=family"><div class="subcat-item">Family</div></a>
              </div>
						</div>
					</div>
					<div class="item">
						<div class="cat-subcat">
							<div>
								<img src="../images/entertainment.png" height="100px"/>
								<h2>Entertainment</h2>
							</div>
							<div>
                <a href="?page=television"><div class="subcat-item">Television</div></a>
								<a href="?page=movies"><div class="subcat-item">Movies</div></a>
								<a href="?page=music"><div class="subcat-item">Music</div></a>
                <a href="?page=games"><div class="subcat-item">Games</div></a>
              </div>
						</div>
					</div>
				</div>
        <div class="row">
					<div class="item last-item">
						<div class="cat-subcat">
							<div>
								<img src="../images/finance.png" height="100px"/>
								<h2>Finance</h2>
							</div>
							<div>
								<a href="?page=income"><div class="subcat-item">Income</div></a>
								<a href="?page=expenses"><div class="subcat-item">Expenses</div></a>
								<a href="?page=donations"><div class="subcat-item">Donations</div></a>
							</div>
						</div>
					</div>
        </div>
			<?php } ?>
				
			</div>
		<div id="push"></div>	
		</div>
		<?php include('footer.php'); ?>

	</body>
</html>
