<?php

namespace Nirbose\LilouView;

class LilouView {

    protected string $path;

    public static function instance(string $path = "")
    {

    }

    public function __construct(string $path = "")
    {
        $this->path = $path;
    }

    public function make(string $view, array $data = [])
    {
        $file = $this->path . $view . ".lilou.php";

        $template = file_get_contents($file);

        Tokenizer::create($template);
    }


    public function render(string $view, array $data = [])
    {
        if (!file_exists($this->path . $view . ".lilou.php")) {
            $this->make($view, $data);
        }
    }
}
