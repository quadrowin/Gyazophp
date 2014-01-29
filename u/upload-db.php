<?php
/**
 * Uploading the file to dropbox
 */
$uri = "http://" . $_SERVER['HTTP_HOST'] . '/u/';
if (
    empty($_REQUEST['login'])
    || empty($_REQUEST['password'])
    || empty($_FILES['imagedata']['name'])
) {
    die($uri);
}

$login = $_REQUEST['login'];
$users = require __DIR__ . '/settings.dropbox.php';
if (
    !is_string($login)
    || empty($users[$login])
    || $users[$login][0] !== $_REQUEST['password']
) {
    die($uri);
}

$dropbox_access_token = $users[$login][1];

$filename = substr(md5(time()), -28) . '.png';
$path = $login . '/' . $filename;
$dest = __DIR__ . '/' . $path;
if (!move_uploaded_file($_FILES['imagedata']['tmp_name'], $dest)) {
    die($uri);
}

//echo $uri, $path;

require __DIR__ . '/../vendor/autoload.php';

$client = new Dropbox\Client($dropbox_access_token, 'gyazophp-' . $login);

$fp = fopen($dest, 'rb');
$metadata = $client->uploadFile('/' . $filename, Dropbox\WriteMode::add(), $fp, $size);
fclose($fp);

$url = $client->createShareableLink('/' . $filename);

if (!$url) {
    die($uri . $path);
}

// remove local file
unlink($dest);

die($url);