<?php

class Terro {

    public $servicePassword;
    public $loginMessage = "";
    public $originalDirectory = "";

    public $storage = null;
    
    public function __construct($servicePassword) {
        $this->storage = new Storage();
        $this->servicePassword = $servicePassword;
        $this->originalDirectory = getcwd();
    }

    public function getVersion() {
        return VERSION;
    }

    public function isLoggedIn() {
         return $this->storage->isLoggedIn();
    }

    public function getLoginMessage() {
        return $this->loginMessage;
    }

    public function getCurrentDirectory() {
        return $this->storage->getCurrentDirectory();
    }

    public function getCommandsCount() {
        return $this->storage->getCommandsCount();
    }

    public function clear() {
        $this->storage->clearStorage();
    }

    public function login() {
        $this->storage->setLoggedIn(true);
    }

    public function logout() {
        $this->loginMessage = "Bye bye!";
        $this->storage->setLoggedIn(false);
    }

    public function remove() {
        if(VERSION == 'dev') {
            throw new Exception("This is dev version. So it's not possible to remove file.");
        } else {
            unlink(__FILE__);

            if(!file_exists(__FILE__)) {
                throw new Exception("Terro was removed. Please refresh page :)");
            } else {
                throw new Exception("Upss, something wrong. Terro was not removed.. ");
            }
        }
    }

    public function getPreviousCommands() {
        return $this->storage->getPreviousCommands();
    }
}