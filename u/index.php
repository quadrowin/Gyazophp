<?php

$login = isset($_REQUEST['login']) ? $_REQUEST['login'] : '';
$users = require __DIR__ . '/users.php';

if (isset($_REQUEST['logout'])) {
    if (isset($_COOKIE['login'])) {
        setcookie('login', null, -1, '/');
        unset($_COOKIE['login']);
    }
    if (isset($_COOKIE['pass'])) {
        setcookie('pass', null, -1, '/');
        unset($_COOKIE['pass']);
    }
}

if (isset($_REQUEST['login']) && isset($_REQUEST['password'])) {
    if (
        is_string($login)
        && isset($users[$login])
        && $users[$login] === $_REQUEST['password']
    ) {
        setcookie('login', $login, 0, '/');
        setcookie('pass', md5($_REQUEST['password']), 0, '/');
        header('Location: content.php');
        die();
    }
}

if (isset($_COOKIE['login'])) {
    header('Location: content.php');
    die();
}

?><html>
<head>
    <title>gyazo</title>
</head>
<body>
    <form method="get" action="">
        <table>
            <tr>
                <td>Login</td>
                <td><input type="text" name="login" value="<?php echo $login; ?>"/></td>
            </tr>
            <tr>
                <td>Pass</td>
                <td><input type="password" name="password"/><br/></td>
            </tr>
            <tr>
                <td></td>
                <td><input type="submit" value="Auth"/></td>
            </tr>
        </table>
    </form>
</body>
</html>