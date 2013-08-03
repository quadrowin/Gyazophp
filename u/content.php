<?php
$users = require __DIR__ . '/users.php';
$login = isset($_COOKIE['login']) ? $_COOKIE['login'] : '';
$pass = isset($_COOKIE['pass']) ? $_COOKIE['pass'] : '';
if (
    !$login
    || !is_string($login)
    || !$pass
    || empty($users[$login])
    || md5($users[$login]) !== $pass
) {
    if (isset($_COOKIE['login'])) {
        setcookie('login', null, -1, '/');
    }
    if (isset($_COOKIE['pass'])) {
        setcookie('pass', null, -1, '/');
    }

    header('Location: /u/index.php');
    die();
}

$dir = __DIR__ . '/' . $login;

if (!is_dir($dir)) {
    mkdir($dir, 0777);
    chmod($dir, 0777);
}

$sources = scandir($dir);

$files = array();
foreach ($sources as $src) {
    if ($src[0] === '.') {
        continue;
    }
    $filename = $dir . '/' . $src;
    $files[] = array(
        'name' => $src,
        'href' => $login . '/' . $src,
        'src' => $login . '/' . $src,
        'size' => filesize($filename),
        'mtime' => filemtime($filename),
        'isize' => getimagesize($filename),
    );
}

?><html>
    <head>
        <title>uploaded files</title>
    </head>
    <body>
        <p>Logged in as <b><?php echo $login; ?></b> <a href="index.php?logout">logout</a></p>
        <table>
            <?php foreach ($files as $file) { ?>
                <tr>
                    <td>
                        <a href="<?php echo $file['href']; ?>">
                            <img alt="" src="<?php echo $file['src']; ?>" height="200" />
                        </a>
                    </td>
                    <td valign="top">
                        <?php echo date('Y-m-d H:i:s', $file['mtime'])?><br/>
                        <?php echo $file['name'] ?><br/>
                        <?php echo $file['isize'][0], 'x', $file['isize'][1]?><br/>
                        <?php echo $file['size']?> b
                    </td>
                </tr>
            <?php } ?>
        </table>
    </body>
</html>