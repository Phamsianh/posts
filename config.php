<?php 

if (!defined('DB_HOST')) {
    define("DB_HOST", "localhost");
}
if (!defined('DB_USERNAME')) {
    define("DB_USERNAME", "root");
}
if (!defined('DB_PASSWORD')) {
    define("DB_PASSWORD", "");
}
if (!defined('DB_NAME')) {
    define("DB_NAME", "zapoctova_prace");
}


if (!defined('DIR_ROOT')){
    define("DIR_ROOT",  dirname(__FILE__). '/');
}

if(!defined('SERVER_DOMAIN')){
    define("SERVER_DOMAIN", "http://localhost");
}

if(!defined('ROOT_PATH')){
    define("ROOT_PATH", "/pwa/zapoctova_prace");
}

if (!defined('TITLE')) {
    define("TITLE", "POSTS");
}
?>