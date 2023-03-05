<?php

class View {

    function __construct() {
        
    }

    public function render_head() {
        require 'views/includes/head.php';
    }

    public function render_foot() {
        require 'views/includes/foot.php';
    }

    public function render_main_content($name) {
        require 'views/' . $name . '.php';
    }
    /**
     * 
     * @param type $name
     * @param type $noInclude
     * @param type $option
     */
    public function render($name, $noInclude = false) {
        if ($noInclude == true) {
            $this->render_main_content($name);
        } else {
            $this->render_head();
            $this->render_main_content($name);
            $this->render_foot();
        }
    }

}
