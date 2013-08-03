<?php
$uri = "http://" . $_SERVER['HTTP_HOST'] . '/';
if (isset($_FILES['imagedata']['name'])) {
    $path = 'i/' . substr(md5(time()), -28) . '.png';
    $dest = __DIR__ . '/' . $path;
    if (move_uploaded_file($_FILES['imagedata']['tmp_name'], $dest)) {
        echo $uri, $path;
    } else {
        echo $uri;
    }
} else {
    echo $uri;
}