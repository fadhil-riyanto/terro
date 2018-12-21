<?php

class Storage {

    public function __construct() {
        if ( ! isset($_SESSION['persist_commands']) OR ! isset($_SESSION['commands'])) {
            $this->createStorageSpace();
        }
    }

    public function createStorageSpace() {
        $_SESSION['persist_commands'] = array();
        $_SESSION['commands'] = array();
        $_SESSION['command_responses'] = array();
        $_SESSION['directory'] = getcwd();
    }

    public function clearStorage() {
        $_SESSION['commands'] = array();
        $_SESSION['command_responses'] = array();
    }

    public function setLoggedIn($status) {
        $_SESSION['logged_in'] = $status;

        if(!$status) {
            session_unset();
        }
    }

    public function isLoggedIn() {
        return isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true;
    }
    
    public function getCommandsCount() {
        return count($_SESSION['commands']); 
    }
    
    public function getCurrentDirectory() {
        return $_SESSION['directory'];
    }
    
    public function setCurrentDirectory($directory) {
        $_SESSION['directory'] = $directory;
    }

    public function getPreviousCommands() {
        $single_quote_cancelled_commands = array();
        if ( ! empty( $_SESSION['commands'] ) ) {
            foreach ($_SESSION['commands'] as $command) {
                $cancelled_command = str_replace("\"", "\\\"", $command);
                $single_quote_cancelled_commands[] = $cancelled_command;
            }
        }

        return implode("\", \"", $single_quote_cancelled_commands);
    }

    public function addToStorage($command, $response) {
        array_push($_SESSION['commands'], $command);
        array_push($_SESSION['command_responses'], $response);
    }
}