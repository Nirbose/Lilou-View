<?php

use LilouView\LilouView;

require_once './vendor/autoload.php';

$l = new LilouView('', '/view');
$l->make('home', ['name' => 'Lilou']);
$l->render('home');