<?php

class AjaxControl {

    private $response;

    public function __construct($data) {
        // TODO: detect if action exists
        $functionName = $data['action'];

        try {
            $this->response = $this->$functionName($data);
        } catch(Exception $e) {
            $this->response = array("FAIL", $e);
        }
    }

    public function getResponse() {
        return json_encode($this->response);
    }
}