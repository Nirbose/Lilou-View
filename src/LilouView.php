<?php

namespace LilouView;

use LilouView\Compilers\LilouCompiler;

class LilouView {

    /**
     * Toutes les fonctions
     * 
     * @var LilouFunc
     */
    private LilouFunc $lilouFunc;

    /**
     * Contenue du fichier .lilou
     * 
     * @var string
     */
    protected string $content;

    private string $folder;

    /**
     * Constructeur
     */
    public function __construct(string $folder)
    {
        $this->folder = dirname(__DIR__) . '/' . trim($folder, '/') . '/';
        $this->lilouFunc = new LilouFunc();
    }

    public function make(string $file, array $data = []) {
        $this->content = file_get_contents($this->folder . $file . '.lilou.php');

        $compiler = new LilouCompiler();
        dump($compiler->compile($this->content));
        return $compiler->compile($this->content);
    }

}
