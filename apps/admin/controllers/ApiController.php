<?php
class ApiController extends ControllerBase{

    public function __construct()
    {
        parent::__construct();
        App::uses('api');
    }

    public function coordinateAction()
    {
        View::disable();
        $address = Response::request('address','string');
        $data = Api::getCoordinates($address);
        Response::sendAjax($data);
    }

    public function postalAction()
    {
        View::disable();
        $zipcode = Response::request('zipcode','string');
        $data = Api::getPostal($zipcode);
        Response::sendAjax($data);
    }
}