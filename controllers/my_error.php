<?php
/**
 * Copyright (c) 2019, Innovate For Future Tech.
 * Powered by Elysée Asad Luboya
 * Soft-Mat
 * 
 * @package   Soft-Mat
 * @author    Dread Luiz Kiamputu & Elysée Asad Luboya (email:nel7luboya@gmail.com, Tél:+243 819664909)
 * @copyright Copyright (c) 2019, Innovate For Future Tech.  (http://innovateforfuture.com)
 * @since     Version 1.3.0
 */

class My_error extends Controller {

    function __construct() {
        parent::__construct();
    }

    function index() {
        $this->view->render('my_error/index', 0, 0);
    }

}
