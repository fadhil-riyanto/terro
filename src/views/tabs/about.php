<div class="content" data-content="about" style="display: none">
    <div class="about">
        <h1 class="page-label">About</h1>
        <p>Terro is one file php terminal emulator used to fast and quick server administration</p>
        <p>Version: <b><?= $terro->getVersion(); ?></b></p>


        <div class="about-me">
            <span>About me:</span>
            <a target="_blank" href="https://github.com/adriangrabowski/terro"><i class="fa fa-github"></i></a>
            <a target="_blank" href="https://www.linkedin.com/in/adrian-grabowski-455137b9"><i class="fa fa-linkedin"></i></a>
            
        </div>

        <div class="privacy">
            <p>This tool should be used only on your private server. <b>Please do not use generated file to attack web app by broken file uploading.</b></p>
            <p>If you found security mistake and you must remove this tool from your server, click this button.</p>
            <button onclick="window.location.href='<?php echo $_SERVER['PHP_SELF']; ?>?remove'">Remove me from server</button>
        </div>
    </div>
</div>