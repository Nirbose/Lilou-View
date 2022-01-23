<?php

use LilouView\LilouView;

include './vendor/autoload.php';

$lilou = new LilouView();
$lilou->load('./view/test.lilou')->render();
