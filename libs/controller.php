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

class Controller
{

  function __construct()
  {
    $this->view = new View();
  }

  function loadModel($name)
  {
    $path = 'models/' . $name . '_model.php';

    if (file_exists($path)) {
      require $path;
      $modelName = $name . '_model';
      $this->model = new $modelName;
    }
  }

  public function str_random($length)
  {
    $alphabet = "0123456789azertyuiopqsdfghjklmwxcvbnAZERTYUIOPQSDFGHJKLMWXCVBN";
    return substr(str_shuffle(str_repeat($alphabet, 120)), 0, $length);
  }
  public function date_time()
  {
    return date('Y-m-d H:i:s');
  }

}