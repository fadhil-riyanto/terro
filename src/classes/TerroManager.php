<?php

class TerroManager extends Terro {

    public function __construct($servicePassword) {
        parent::__construct($servicePassword);

        if (!$this->isLoggedIn()) {
            if ($_POST['command'] == $this->servicePassword) {
                $this->login();
            } else {
                $this->loginMessage = "Invalid password";
            }
        } else {

            if (isset($_GET['logout']) || (isset($_POST['command']) && $_POST['command'] == 'logout')) {
                $this->logout();
            }

            if (isset($_POST['command']) && $_POST['command'] == 'clear') {
                $this->clear();
            }

            if (isset($_GET['remove'])) {
                $this->remove();
            }

            if (isset($_GET['ajax'])) {
                $this->executeAjax($_GET);
            }

            if (isset($_POST['command']) && $_POST['command'] != $this->servicePassword && $_POST['command'] != '' && $_POST['command'] != 'clear' && $_POST['command'] != 'logout') {
                $this->executeCommand($_POST['command']);
            }
        }
    }
    
    private function executeAjax($parameters) {
        $ajax = new Ajax($parameters);
        die($ajax->getResponse());
    }

    private function executeCommand($command) {
        chdir($this->storage->getCurrentDirectory());

        $response = array();

        exec($command . ' 2>&1', $response, $error_code);
        if ($error_code > 0 AND $response == array()) {
            $response = array('TERRO: Error on executing command');
        } else {
            if(strpos($command, 'cd ') !== false) {
                if(strpos($command, '~') !== false) {
                    chdir(__DIR__);
                    $this->storage->setCurrentDirectory(__DIR__);
                    $response = array('TERRO: Changed dir to original base path');
                } else {
                    $directory = str_replace("cd ", "", $command);
                    if(trim($directory) != "") {
                        if(file_exists($directory)) {
                            chdir($directory);
                            $this->storage->setCurrentDirectory(getcwd());
                        }
                    }
                }
            }
        }

        chdir($this->originalDirectory);
        $this->storage->addToStorage($command, $response);
    }
}