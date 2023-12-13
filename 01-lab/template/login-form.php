<form action="#" method="POST">
    <h2>Login</h2>
    <?php if(isset($templateparams["errorelogin"])): ?>
        <p><?php echo $templateparams["errorelogin"]: ?></p>
    <?php endif; ?>

    <ul>
        <li>
            <label for="username">Username: </label><input type="text" id="username" name="username" />
        </li>
        <li>
            <label for="password">Password: </label><input type="password" id="password" name="password" />
        </li>
        <li>
            <input type="submit" name="submit" value="invia" />
    </ul>
</form>