<?php use app\core\Application; ?>
<h1>Welcome to your profile <?php echo Application::$app->user->firstname . " " . Application::$app->user->lastname; ?></h1>

<h3>
    Your Email: <?php echo Application::$app->user->email;  ?>
</h3>