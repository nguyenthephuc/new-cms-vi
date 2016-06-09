<?php

class ControllerBase {

    public function __construct()
    {
        App::uses('response');
        View::setLayout('users');
    }
}