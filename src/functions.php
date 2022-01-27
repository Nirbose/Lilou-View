<?php

use LilouView\LilouView;

function view(string $name, array $options = []): void {
    $lilou = new LilouView();
    $explode = explode('.', $name);
    
    if (end($explode) == 'lilou') {
        echo $lilou->load($name)->render();
        return;
    }

    echo $lilou->load($name . '.lilou')->render();
}