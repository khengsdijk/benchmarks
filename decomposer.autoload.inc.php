<?php

if (md5_file(__DIR__ . '/decomposer.json') != '83a8fd46b5beac2ee5c3b8e7b3b89a80')
{
    die("Decomposer autoload file is outdated. Please re-run 'decomposer develop'
");
}

require_once 'Lunr-0.5.php';
require_once 'Pimple-3.2.3.php';
require_once 'PHP-DI-3.2.3.php';

?>
