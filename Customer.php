<?php

namespace TaskForProman;

class Customer extends Users implements accountType {

    function getName(): string {
        return $this->firstName." ".$this->lastName;
    }

    function __toString(): string {
        return "klient";
    }
}