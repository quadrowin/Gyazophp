<?php
$uri = "http://" . $_SERVER['HTTP_HOST'] . '/u/';
if (
    empty($_REQUEST['login'])
    || empty($_REQUEST['password'])
    || empty($_FILES['imagedata']['name'])
) {
    die($uri);
}

$login = $_REQUEST['login'];
$users = require __DIR__ . '/users.php';
if (
    !is_string($login)
    || empty($users[$login])
    || $users[$login] !== $_REQUEST['password']
) {
    die($uri);
}

$path = $login . '/' . substr(md5(time()), -28) . '.png';
$dest = __DIR__ . '/' . $path;
if (move_uploaded_file($_FILES['imagedata']['tmp_name'], $dest)) {
    echo $uri, $path;
} else {
    echo $uri;
}