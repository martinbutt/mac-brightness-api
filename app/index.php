<?php
require '../vendor/autoload.php';

use Slim\Slim;

define('BRIGHTNESS_STEPS', 16);
define('DEFUALT_FADE_IN_RATE', 10);

$app = new Slim();

$app->get('/wake', function () use ($app) {
	$vars = $app->request->get();
	$level = isset($vars['level']) ? $vars['level'] : BRIGHTNESS_STEPS;
	$level = ($level > BRIGHTNESS_STEPS) ? BRIGHTNESS_STEPS : $level;
	$rate = isset($vars['rate']) ? $vars['rate'] : DEFAULT_FADE_IN_RATE;

	dimToZero();

	for ($i=0; $i<$level; $i++) {
		sleep($rate);
		system('/bin/bash ../bin/screenctl.sh up');
	}
});

function dimToZero() {
	for ($i=0; $i<BRIGHTNESS_STEPS; $i++) {
		system('/bin/bash ../bin/screenctl.sh down');
	}
}
	

$app->run();
