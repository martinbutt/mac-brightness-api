<?php
set_time_limit(0);

require '../vendor/autoload.php';

use Slim\Slim;

define('BRIGHTNESS_STEPS', 10);
define('DEFAULT_FADE_IN_RATE', 2);
define('DEFAULT_DISPLAY', 0);

$app = new Slim();

$app->get('/wake', function () use ($app) {
	$vars = $app->request->get();
	$level = isset($vars['level']) ? $vars['level'] : BRIGHTNESS_STEPS;
	$level = ($level > BRIGHTNESS_STEPS) ? BRIGHTNESS_STEPS : $level;
	$rate = isset($vars['rate']) ? $vars['rate'] : DEFAULT_FADE_IN_RATE;
	$display = isset($vars['display']) ? $vars['display'] : DEFAULT_DISPLAY;

	dimToZero($display);

	for ($i=0; $i<$level; $i++) {
		system('../bin/brightness -d '.$display.' '.($i/10));
		sleep((int)$rate);
	}
});

function dimToZero($display) {
	exec('../bin/brightness -d '.$display.' 0');
}

$app->run();
