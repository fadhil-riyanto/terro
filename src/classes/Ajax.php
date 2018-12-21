<?php

class Ajax extends AjaxControl {

    public function __construct($data) {
        parent::__construct($data);
    }

    public function getMemory($parameters = null) {
        $response = array();

        exec("free" . ' 2>&1', $response, $error_code);
        if ($error_code > 0 AND $response == array()) {
            $response = array('TERRO: Error on executing command');
        }

        return $response;
    }

    public function getDiskUsage($parameters = null) {
        $response = array();

        exec("df" . ' 2>&1', $response, $error_code);
        if ($error_code > 0 AND $response == array()) {
            $response = array('TERRO: Error on executing command');
        }

        $response = str_replace(" -", "-", $response);

        $func = function($value) { return preg_split("/\s{1,}/",$value ); };
        return array_map($func, $response);
    }

    public function getUsers($parameters = null) {
        $response = array();

        exec("cat /etc/passwd" . ' 2>&1', $response, $error_code);
        if ($error_code > 0 AND $response == array()) {
            $response = array('TERRO: Error on executing command');
        }

        return $response;
    }
}