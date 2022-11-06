<?php

namespace TaskForProman;

class Admin extends Users implements accountType {

    function getName(): string {
        return $this->lastName." ".$this->firstName;
    }

    function __toString(): string {
        return "admin";
    }
}