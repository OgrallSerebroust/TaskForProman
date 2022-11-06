<?php

namespace TaskForProman;

abstract class Users {

    function __construct(public int $id, protected string $firstName, protected string $lastName, public bool $isActive) {

    }

    abstract function getName(): string;
}