<?php

/**
 * https://www.dropbox.com/developers/core/start/php
 *
 * Now we're all set to start the OAuth 2 flow, which has three parts:

    Send the user to the "app approval" page on the Dropbox website.
    Receive an "authorization code" from Dropbox.
    Convert the authorization code into an access token, which can then be used to make Core API calls.

We first need to send the user to the app approval page. We get the URL for that page by calling the start method.

$authorizeUrl = $webAuth->start();

Next, send the user to $authorizeUrl, which gives them an opportunity to approve your app. If they choose to approve your app, they will be shown an "authorization code".

echo "1. Go to: " . $authorizeUrl . "\n";
echo "2. Click \"Allow\" (you might have to log in first).\n";
echo "3. Copy the authorization code.\n";
$authCode = \trim(\readline("Enter the authorization code here: "));

Finally, call finish to convert the authorization code into an access token.

list($accessToken, $dropboxUserId) = $webAuth->finish($authCode);
print "Access Token: " . $accessToken . "\n";
 */

require_once __DIR__ . "/../vendor/autoload.php";

use \Dropbox as dbx;

$app_info = new dbx\AppInfo($_REQUEST['key'], $_REQUEST['secret']);

$web_auth = new dbx\WebAuthNoRedirect($app_info, 'gyazophp-' . $_REQUEST['login']);
$auth_data = $web_auth->finish($_REQUEST['token']);

?><pre><?php var_dump($auth_data); ?></pre>
