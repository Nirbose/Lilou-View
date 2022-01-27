<?php

namespace LilouView;

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
    private string $content;

    /**
     * Constructeur
     */
    public function __construct()
    {
        $this->lilouFunc = new LilouFunc();
    }

    /**
     * Permet de load une vue
     *
     * @param string $file
     * @return self
     */
    public function load(string $file): self
    {
        if (pathinfo($file)['extension'] != 'lilou') {
            throw new \Exception('The file extension must be .lilou');
        }

        $this->content = file_get_contents($file);

        $this->func();

        return $this;
    }

    /**
     * Permet de chercher les functions dans le fichier
     *
     * @return void
     */
    private function func(): void
    {
        // Get all the @function("content")
        preg_match_all('/@[A-Za-z\s]+\((.*)\)/', $this->content, $matches);

        // Get the function name
        foreach ($matches[0] as $value) {
            // Preg test
            preg_match('/\((.*)\)/', $value, $content_func);
            preg_match('/@[^@]+\(/', $value, $func);

            // get Args for function
            $args = explode(',', str_replace("\"", "", $content_func[1]));

            foreach ($func as $funcName) {
                // Remove the @ and (
                $funcName = substr($funcName, 1, -1);

                // Method exists ?
                if (method_exists($this->lilouFunc, $funcName)) {
                    $r = call_user_func_array([$this->lilouFunc, $funcName], $args);
                    $this->content = str_replace($value, $r, $this->content);
                }
            }
        }

        $this->comp();
    }

    /**
     * Permet de chercher les components dans le fichier
     *
     * @return void
     */
    private function comp(): void
    {
        preg_match_all('/<l-(.*)>(.*)<\/l-(.*)>/', $this->content, $matches);

        // dd($matches);
        foreach ($matches[1] as $key => $value) {

            $replace = preg_replace('/\sid="(.*)"/', '', $value);
            if ($replace != $matches[3][$key]) {
                throw new \Exception('The id is not the same');
            }

            $options = [];

            if (!empty($matches[2][$key])) $options['slot'] = $matches[2][$key];

            $component = $this->lilouFunc->component($value, $options);

            $this->content = str_replace($matches[0][$key], $component, $this->content);
            
            $this->func();
        }
    }

    /**
     * Render view
     *
     * @return string
     */
    public function render(): string
    {
        return $this->content;
    }

}
