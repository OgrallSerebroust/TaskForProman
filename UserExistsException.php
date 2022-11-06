<?php

namespace TaskForProman;

class UserExistsException extends \Exception {
    protected $message = "Podany użytkownik już istnieje";
}