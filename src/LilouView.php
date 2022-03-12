<?php

namespace LilouView;

use LilouView\Compilers\LilouCompiler;

class LilouView {

    /**
     * Contenue du fichier .lilou
     * 
     * @var string
     */
    protected string $content;

    /**
     * View Folder
     *
     * @var string
     */
    protected string $folder;

    /**
     * Constructeur
     */
    public function __construct($engine, string $folder = "")
    {
        if (empty($this->folder)) {
            $this->folder = dirname(__DIR__) . '/' . trim($folder, '/');
        }
    }

    public function make(string $file, array $data = []) {
        $this->content = file_get_contents($this->folder . '/' . $file . '.lilou.php');
        
        $compiler = new LilouCompiler($file, $this->folder);
        $compiler->compile($this->content, $data);
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

        return;
    }

}
