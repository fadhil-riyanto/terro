<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Terro | PHP Terminal Emulator</title>
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" />
    <style type="text/css">
        <?php echo include("css/style.css"); ?>
    </style>
</head>
<body>
<?php if (!$terro->isLoggedIn()) { ?>
    <?php include('views/login.php'); ?>
<?php } else { ?>
    <?php include('views/menu.php'); ?>
    <?php include('views/tabs/terminal.php'); ?>
    <?php include('views/tabs/parameters.php'); ?>
    <?php include('views/tabs/phpinfo.php'); ?>
    <?php include('views/tabs/about.php'); ?>
<?php } ?>

<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
<script type="text/javascript">
    var previous_commands = ['', '<?php echo $terro->getPreviousCommands(); ?>', ''];
    <?php echo include("js/scripts.js"); ?>
</script>
</body>
</html>