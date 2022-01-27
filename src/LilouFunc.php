<?php

namespace LilouView;

class LilouFunc {

    public function echo(string $content, ?string $no_return_line = "false"): string
    {
        if ($no_return_line != "true") {
            return $content . PHP_EOL;
        } else {
            return $content;
        }
    }

    public function include(string $file)
    {
        include $file;
    }

    public function component(string $component, ?array $options = [])
    {
        $content = file_get_contents('./view/components/' . $component . '.lilou');

        if (isset($options['slot'])) $content = str_replace('$slot', $options['slot'], $content);
        if (isset($options['id'])) $content = str_replace('$id', $options['id'], $content);
        if (isset($options['class'])) $content = str_replace('$class', $options['class'], $content);

        return $content;
    }

    public function sum(string ...$numbers) {
        $sum = 0;
        foreach ($numbers as $number) {
            $sum += intval($number);
        }
        return $sum;
    }

}
