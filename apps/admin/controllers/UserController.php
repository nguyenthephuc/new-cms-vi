<?php

class UserController extends ControllerBase {

    public function __construct()
    {
        parent::__construct();
        parent::authentical();
        App::model('users');
        App::uses('form', 'paginator', 'validator');
    }

    public function indexAction()
    {
        $this->listPage('Users', 'Quản lý tài khoản');
    }

    public function formAction()
    {
        $this->form('Users', '/admin/user-update', '/admin/user-insert', 'Màn hình thêm - chỉnh sửa tài khoản');
    }

    public function insertAction()
    {
        View::disable();
        if(Response::isPost()){
            $params = Users::mapping();
            #validate
            $err = Validator::validate(array(
                array('Họ tên', $params['name'], 'require'),
                array('Tài khoản', $params['username'], 'require'),
                array('Mật khẩu', $params['password'], 'require'),
            ));
            #kiem tra xem nguoi dung da ton tai hay chua
            if(Users::insertCheckExistUser($params['username'])){
                $err['username'] = 'Tài khoản đã tồn tại\n';
            }
            Response::errorback($err);
            App::uses('password');
            $params['password'] = Password::create_hash($params['password']);
            $params['level'] = 0;
            Users::create($params);
            Response::closeform();
        }
    }

    public function updateAction()
    {
        View::disable();
        if(Response::isPost()){
            $params = Users::mapping();
            #validate
            $err = Validator::validate(array(
                array('Họ tên', $params['name'], 'require'),
                array('Tài khoản', $params['username'], 'require'),
            ));
            #kiem tra xem nguoi dung da ton tai hay chua
            if(Users::updateCheckExistUser($params['username'], $params['id'])){
                $err['username'] = 'Tài khoản đã tồn tại\n';
            }
            Response::errorback($err);
            if($params['password']){
                App::uses('password');
                $params['password'] = Password::create_hash($params['password']);
            }else{ unset($params['password']); }
            Users::updated($params['id'], $params);
            Response::closeform();
        }
    }

    public function confdelAction()
    {
        $this->confdel('Users', 'Màn hình xác nhận xóa tài khoản');
    }

    public function deleteAction()
    {
        View::disable();
        if(Response::isPost()){
            $id = Response::request('id', 'int');
            if(!empty($id)){
                Users::trash($id);
            }
            Response::closeform();
        }
    }
}