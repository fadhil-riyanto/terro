<div class="content" data-content="phpinfo" style="display: none">
    <div class="phpinfo">
        <h1 class="page-label">PHP Info</h1>
        <?php
            ob_start();
            phpinfo();
            $pinfo = ob_get_contents();
            ob_end_clean();

            $pinfo = preg_replace( '%^.*<body>(.*)</body>.*$%ms','$1',$pinfo);
            echo $pinfo;
        ?>

    </div>
</div>