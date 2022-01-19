<?php

use LilouView\LilouView;

include './vendor/autoload.php';

$lilou = new LilouView();
$lilou->render('./test.lilou');
