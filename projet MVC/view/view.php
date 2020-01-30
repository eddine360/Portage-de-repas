<?php
require_once File::build_path(array("view", 'header.php'));

$filepath = File::build_path(array("view", $controller, "$view.php"));
require $filepath;

require_once File::build_path(array("view", 'footer.html'));
