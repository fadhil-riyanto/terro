<div class="content" data-content="parameters" style="display: none">
    <div class="parameters">
        <h1 class="page-label">Parameters</h1>


        <div class="row">
            <div class="col">
                <div class="box">
                    <label>Hostname</label>
                    <span><?= Server::instance()->getHostName(); ?></span>
                </div>
                <div class="box">
                    <label>Apache2 version</label>
                    <span><?= Server::instance()->phpinfo()['apache2handler']['Apache Version']; ?></span>
                </div>

                <div class="box">
                    <label>Server Root</label>
                    <span><?= Server::instance()->phpinfo()['apache2handler']['Server Root']; ?></span>
                </div>

                <div class="box">
                    <label>User/Group</label>
                    <span> <?= Server::instance()->phpinfo()['apache2handler']['User/Group']; ?></span>
                </div>

                <div class="box">
                    <label>PHP version</label>
                    <span><?= Server::instance()->phpinfo()['Core']['PHP Version']; ?></span>
                </div>
            </div>
            <div class="col">

            </div>
            <div class="col">

            </div>

        </div>



    </div>







</div>