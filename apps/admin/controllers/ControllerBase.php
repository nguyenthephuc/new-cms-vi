<?php

class ControllerBase {

    public function __construct()
    {
        App::uses('session', 'response');
    }

    /** kiem tra neu ko ton tai user-login thi chuyen ve trang dang nhap */
    public static function authentical()
    {
        if(!Session::has('user-login') || !Session::get('user-login')){
            Response::redirect('/admin/login/login-security/');
        }
    }

    public function listPage($table, $title)
    {
        $currentPage = (Response::getParam(2, 'int')) ? Response::getParam(2, 'int') : 1;
        $data = Paginator::getPaginate(array(
            'table' => $table,
            'limit' => 20,
            'page' => $currentPage,
            'order' => 'id DESC'
            ));
        View::set('data', $data);
        View::set('title', $title);
        if(!Response::isAjax()){
            View::setLayout('admin');
        }
    }

    public function form($obj, $action1, $action2, $title)
    {
        $id = Response::getParam(2, 'int');
        if(!empty($id)){
            $demo = $obj::find( $id );
            if($demo){
                View::set('data', $demo);
            }
            View::set('action', $action1);
        }else{
            View::set('action', $action2);
        }
        View::set('title', $title);
        View::setLayout('form');
    }

    public function confdel($obj, $title)
    {
        $id = Response::getParam(2, 'int');
        if(!empty($id)){
            $data = $obj::find( $id );
            if($data){
                View::set('data', $data);
            }
        }
        View::set('title', $title);
        View::setLayout('form');
    }
}