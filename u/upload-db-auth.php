<html>
    <body>
        <h2>Start OAuth</h2>
        <form action="upload-db-auth-start.php" method="post">
            <p>login <input type="text" name="login"/></p>
            <p>app key <input type="text" name="key"/></p>
            <p>app secret <input type="text" name="secret"/></p>
            <p><input type="submit"/></p>
        </form>
        <br/>
        <h2>Finish OAuth</h2>
        <form action="upload-db-auth-finish.php" method="post">
            <p>login <input type="text" name="login"/></p>
            <p>app key <input type="text" name="key"/></p>
            <p>app secret <input type="text" name="secret"/></p>
            <p>app token <input type="text" name="token"/></p>
            <p><input type="submit"/></p>
        </form>
    </body>
</html>