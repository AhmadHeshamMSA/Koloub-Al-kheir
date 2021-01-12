<?php

class AccountStatus {
    private $id;
    private $type;
    
    
    function __construct($id, $type) {
        $this->id = $id;
        $this->type = $type;
    }

    function getId() {
        return $this->id;
    }

    function getType() {
        return $this->type;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setType($type) {
        $this->type = $type;
    }

}
