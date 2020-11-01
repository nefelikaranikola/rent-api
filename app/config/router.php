<?php

$router = $di->getRouter();

// Define your routes here

//$router->add("/login", "Index::loginAction");


$router->handle($_SERVER['REQUEST_URI']);
