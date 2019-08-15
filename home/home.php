<?php
    session_cache_limiter('public');
	session_start();

	if (!isset($_SESSION['logged_in']) || !$_SESSION['logged_in']) {
		$_SESSION['message'] = "Please login to view";
		header("Location: /login/login.php");
		exit();
	}

    include_once '../Page.php';
    $page = new Page();
?>

<html>
	<header>
		<?php $page->header(true); ?>
	</header>		
	<body>
		<?php $page->navigation('home'); ?>

		<div class="main">
			<h1>welcome</h1>
			<?php echo "<h2 class='user-name'>" . $_SESSION['user-name'] . "</h2>"; ?>
            
            <a class="button" href="/new-entry/new-entry.php">new entry</a>
		</div>
			
		<?php $page->footer(); ?>
	</body>
</html>