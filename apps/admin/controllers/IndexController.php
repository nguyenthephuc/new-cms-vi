<?php

class IndexController extends ControllerBase{
    public function __construct()
    {
        parent::__construct();
        parent::authentical();
    }

    public function indexAction()
    {
        if(!Response::isAjax()){
            View::setLayout('admin');
        }
        View::set('title', 'Trang chủ');
    }

    public function logoutAction()
    {
        View::disable();
        Session::removeAll();
        return Response::redirect('/admin/login/login-security/');
    }
}