<?php

//librairies
require 'public/librairies/fpdf1/fpdf.php';
require 'public/librairies/dompdf/autoload.inc.php';

//libs main files
require 'libs/bootstrap.php';
require 'libs/controller.php';
require 'libs/database.php';
require 'libs/session.php';
require 'libs/model.php';
require 'libs/view.php';

//Config
require 'config/paths.php';
require 'config/database.php';

// Le routeur
$app = new Bootstrap();