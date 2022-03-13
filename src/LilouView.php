<?php

namespace LilouView;

use LilouView\Compilers\LilouCompiler;
use LilouView\Config\Config;

class LilouView {

    /**
     * View Folder
     *
     * @var string
     */
    protected string $folder;

    /**
     * Constructeur
     */
    public function __construct($engine)
    {
        $this->folder = dirname(__DIR__) . '/' . trim(Config::get('viewsFolderPath'), '/');
    }

    /**
     * Make view file in PHP
     *
     * @param string $file
     * @param array $data
     * @return self
     */
    public function make(string $file, array $data = []): self
    {
        $content = file_get_contents($this->folder . '/' . $file . '.lilou.php');
        
        $compiler = new LilouCompiler($file, $this->folder);
        $compiler->compile($content, $data);

        return $this;
    }

    /**
     * Render content view in cache
     *
     * @param string $file
     * @return void
     */
    public function render(string $file)
    {
        $file = $this->folder . '/cache/' . sha1($file) . '.php';
        
        if (file_exists($file) === false) {
            return;
        }

        require_once $file;
    }

}
