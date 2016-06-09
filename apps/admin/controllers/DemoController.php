<?php
class DemoController extends ControllerBase {

    public function __construct()
    {
        parent::__construct();
        parent::authentical();
        App::model('Demos');
        App::uses('form', 'paginator', 'validator');
    }

    public function indexAction()
    {
        $this->listPage('Demos', 'DEMO TITLE');
    }

    public function formAction()
    {
        $this->form('Demos', '/admin/demo-update', '/admin/demo-insert', 'DEMO管理 登録・編集');
    }

    public function insertAction()
    {
        View::disable();
        if(Response::isPost()){
            $params = Demos::mapping();
            $err = Validator::validate(array(
                array('TITLE', $params['title'], 'require'),
                array('CONTENT', $params['content'], 'require'),
                array('PUBLIC', $params['public'], 'require'),
            ));
            Response::errorback($err);
            Demos::create($params);
            Response::closeform();
        }
    }

    public function updateAction()
    {
        View::disable();
        if(Response::isPost()){
            $params = Demos::mapping();
            $err = Validator::validate(array(
                array('TITLE', $params['title'], 'require'),
                array('CONTENT', $params['content'], 'require'),
                array('PUBLIC', $params['public'], 'require'),
            ));
            Response::errorback($err);
            Demos::updated($params['id'], $params);
            Response::closeform();
        }
    }

    public function confdelAction()
    {
        $this->confdel('Demos', 'DEMO管理　削除確認');
    }

    public function deleteAction()
    {
        View::disable();
        if(Response::isPost()){
            $id = Response::request('id', 'int');
            if(!empty($id)){
                Demos::trash($id);
            }
            Response::closeform();
        }
    }
}