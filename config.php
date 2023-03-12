<?php

// DB
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_NAME', 'library');
define('DB_PASSWORD', '');

//URL

define('PROTOCOL', 'http://');
define('ROOT_DOAMIN', 'localhost:8000/');
define('ROOT_URL', PROTOCOL . ROOT_DOAMIN);

//autoloader 

foreach (glob("app/*.php") as $filename) {
    include $filename;
   }

foreach (glob("controllers/*.php") as $filename) {
    include $filename;
    }

foreach (glob("models/*.php") as $filename) {
    include $filename;
   }