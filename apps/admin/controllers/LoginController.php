<?php

class LoginController extends ControllerBase{

    public function __construct()
    {
        parent::__construct();
        if(Session::has('user-login') && Session::get('user-login')){
            return Response::redirect('/admin/dashboard/');
        }
        App::uses('password');
        App::model('users');
    }

    public function indexAction()
    {
        if(Response::isPost()){
            $username = Response::request('username', 'string');
            $password = Response::request('password', 'string');
            $authenLogin = Users::authenLogin($username, $password);
            if(!$authenLogin){
                Response::sendAjax(array('status'=>false, 'message'=>'Tài khoản hoặc mật khẩu không đúng'));
            }else{
                Session::set('user-login', array('id'=>$authenLogin->id, 'username'=>$authenLogin->username, 'name'=>$authenLogin->name));
                Response::sendAjax(array('status'=>true, 'message'=>'Wait a moment...', 'redirect'=>'/admin/dashboard/'));
            }
        }
    }
}