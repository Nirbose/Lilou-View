<?php

namespace LilouView;

class LilouView {

    private string $regex = '/@[A-Za-z\s]+\((.*)\)/';

    private LilouFunc $lilouFunc;

    public function __construct()
    {
        $this->lilouFunc = new LilouFunc();
    }

    public function render(string $file)
    {
        if (pathinfo($file)['extension'] != 'lilou') {
            throw new \Exception('The file extension must be .lilou');
        }

        $content = file_get_contents($file);

        // Get all the @function("content")
        preg_match_all($this->regex, $content, $matches);

        // Get the function name
        foreach ($matches[0] as $value) {
            // Preg test
            preg_match('/\((.*)\)/', $value, $match);
            preg_match('/@[^@]+\(/', $value, $func);

            // get Args for function
            $args = explode(',', str_replace("\"", "", $match[1]));

            foreach ($func as $funcName) {
                // Remove the @ and (
                $funcName = substr($funcName, 1, -1);

                // Method exists ?
                if (method_exists($this->lilouFunc, $funcName)) {
                    $r = call_user_func_array([$this->lilouFunc, $funcName], $args);
                    $content = str_replace($value, $r, $content);
                }
            }
        }

        echo $content;

        return $this;
    }

}
