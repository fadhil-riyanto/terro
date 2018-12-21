<?php

    $password = "terro123";
    $version = "1.1 (beta)";

    chdir("src");

    $date = date("d.m.Y_H:i:s");

    $wrappercode = "<?php /** TERRO GENERATED CODE ".$date." */ ?>\n";
    $wrappercode .= "<?php define('VERSION', '".$version."'); ?>\n";
    $wrappercode .= "<?php define('PASSWORD', '".$password."'); ?>\n";
    $wrappercode .= "<?php session_start(); ?>\n";

    foreach (scandir("classes/") as $classToLoad) {
        if($classToLoad != "." && $classToLoad != "..") {
            $wrappercode .= file_get_contents("classes/".$classToLoad);
            $wrappercode .= "?>";
        }
    }

    $wrappercode .= "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Strict//EN\"
    \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd\">
    <html xmlns=\"http://www.w3.org/1999/xhtml\">
    <head>
    <meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />
    <title>Terro | PHP Terminal Emulator</title>
    <link rel=\"stylesheet\" type=\"text/css\" href=\"https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css\" />
    <style type=\"text/css\">";

    $wrappercode .= file_get_contents("css/style.css");
    $wrappercode .= '</style></head><body>';

    $wrappercode .= '<?php $terro = new TerroManager(PASSWORD); ?>';

    $wrappercode .= '<?php if (!$terro->isLoggedIn()) { ?>';
        $wrappercode .= file_get_contents('views/login.php');
    $wrappercode .= '<?php } else { ?>';
        $wrappercode .= file_get_contents('views/menu.php');
        $wrappercode .= file_get_contents('views/tabs/terminal.php');
        $wrappercode .= file_get_contents('views/tabs/parameters.php');
        $wrappercode .= file_get_contents('views/tabs/phpinfo.php');
        $wrappercode .= file_get_contents('views/tabs/about.php');
    $wrappercode .= "<?php } ?>";

    $wrappercode .= "<script src='https://code.jquery.com/jquery-1.12.4.min.js'></script>";
    $wrappercode .= "<script type='text/javascript'>";
        $wrappercode .= 'var previous_commands = ["", "<?php echo $terro->getPreviousCommands(); ?>", ""];';
        $wrappercode .= file_get_contents("js/scripts.js");
    $wrappercode .= "</script></body></html>";

    file_put_contents("../dist/terro.php", $wrappercode);