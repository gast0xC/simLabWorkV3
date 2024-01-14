<?php 

require(__DIR__ . '/vendor/autoload.php');
require(__DIR__ . '/backend/library/constants.php');

// UNCOMENT ONE OF THESE TWO LINES FOR SETTING THE APP_MODE 
define("APP_MODE", MODE_DEVELOPMENT);
//define("APP_MODE", MODE_PRODUCTION);

if (defined("APP_MODE")) {
    if (APP_MODE == MODE_DEVELOPMENT) {
        // use these settings for the development localhost
        define("DATABASE_HOST", "localhost");
        define("DATABASE_PORT", 3306);
        define("DATABASE_USER",  "root");
        define("DATABASE_PASSWORD",  "xpto");
        define("DATABASE_NAME",  "sim_webapp");
        
    } else if (APP_MODE == MODE_PRODUCTION) {
        // use these settings for the PRODUCTION server
        define("DATABASE_HOST", "fdb30.awardspace.net");
        define("DATABASE_PORT", 3306);
        define("DATABASE_USER",  "4212750_webapp");
        define("DATABASE_PASSWORD",  "Xpto+11235813");
        define("DATABASE_NAME",  "4212750_webapp");
    } else {
        echo '<h2>App mode not set  to existing modes ...</h2>';
        die;
    }
} else {
    echo '<h2>App mode not set...</h2>';
    die;
}