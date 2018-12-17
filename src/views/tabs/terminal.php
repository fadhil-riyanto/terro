<div class="content" data-content="terminal">
    <div class="terminal" onclick="document.getElementById('command').focus();" id="terminal">
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" class="commands" id="commands">
            <pre>
 _____
|_   _|__ _ __ _ __ ___   Terro - one line PHP terminal emulator
  | |/ _ \ '__| '__/ _ \  by Grabowero
  | |  __/ |  | | | (_) |
  |_|\___|_|  |_|  \___/  Hello :)

            </pre>

            <?php if ( ! empty($_SESSION['commands'])) { ?>
                <div>
                    <?php foreach ($_SESSION['commands'] as $index => $command) { ?>
                        <div class="line">
                            <pre><span class="user">terro</span>@<?= $_SERVER['HTTP_HOST']; ?>:~# <?php echo $command, "\n"; ?></pre>
                            <?php foreach ($_SESSION['command_responses'][$index] as $value) { ?>
                                <pre><?php echo htmlentities($value), "\n"; ?></pre>
                            <?php } ?>
                        </div>
                    <?php } ?>
                </div>
            <?php } ?>
            <span class="line current-line">
                <span class="command-sign"><span class="user">terro</span>@<?= $_SERVER['HTTP_HOST']; ?>:~#</span> <input type="text" name="command" id="command" autocomplete="off" onkeydown="return command_keyed_down(event);" />
            </span>
        </form>
    </div>
</div>