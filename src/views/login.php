<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" class="commands login-form" id="commands">
    <div class="logo">tr</div>
    <h1>Terro | One file PHP terminal emulator</h1>
    <p>Terro is terminal emulator - used to fast and quick server administration</p>

    <small>Enter password and press enter:</small>
    <input type="password" name="command" id="command" />
    <button type="submit">Login</button>

    <p><br/><?= $terro->getLoginMessage() ;?></p>
</form>