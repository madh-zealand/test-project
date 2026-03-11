<?php
/**
 * Application Configuration
 */

define('APP_NAME', 'Test Project');
define('APP_VERSION', '0.1.0');

// Base path of the application
define('BASE_PATH', dirname(__DIR__));

// Path to the SQLite database file
define('DB_PATH', BASE_PATH . '/data/app.db');

// Display errors in development; set to false in production
define('DEBUG', true);

if (DEBUG) {
    ini_set('display_errors', 1);
    error_reporting(E_ALL);
} else {
    ini_set('display_errors', 0);
    error_reporting(0);
}
