<?php

use LilouView\LilouCompiler;
use LilouView\LilouView;
use LilouView\Parser;

require_once './vendor/autoload.php';

$l = new LilouView('./view');
echo $l->make('home');