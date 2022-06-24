<?php

use Nirbose\LilouView\LilouView;
use PHPUnit\Framework\TestCase;

class FunctionTest extends TestCase {
    
    public function testRenderString()
    {
        LilouView::set('cache', __DIR__ . DIRECTORY_SEPARATOR . "cache" );
        LilouView::set('path', __DIR__ . DIRECTORY_SEPARATOR . "views");

        LilouView::make('test');

        $this->assertEquals('salut', 'salut');
    }

}
