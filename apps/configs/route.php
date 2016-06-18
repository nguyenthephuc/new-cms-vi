<?php
/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell cms the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

/** render static file */
App::Route('about', function(){
    return View::html('about.html');
});

/** Route api */
App::Route('api/coordinate', function(){
    return array('admin', 'api', 'coordinate');
});

App::Route('api/postal', function(){
    return array('admin', 'api', 'postal');
});

App::Route('admin/login/login-security', function(){
    return array('admin', 'login', 'index');
});

App::Route('admin/logout', function(){
    return array('admin', 'index', 'logout');
});

App::Route('admin/dashboard', function(){
    return array('admin', 'index', 'index');
});

App::Route('admin/user-list/:int?', function(){
    return array('admin', 'user', 'index');
});

App::Route('admin/user-form/:int?', function(){
    return array('admin', 'user', 'form');
});

App::Route('admin/user-insert', function(){
    return array('admin', 'user', 'insert');
});

App::Route('admin/user-update', function(){
    return array('admin', 'user', 'update');
});

App::Route('admin/user-conf-delete/:int?', function(){
    return array('admin', 'user', 'confdel');
});

App::Route('admin/user-delete', function(){
    return array('admin', 'user', 'delete');
});

App::Route('admin/demo-list/:int?', function(){
    return array('admin', 'demo', 'index');
});

App::Route('admin/demo-form/:int?', function(){
    return array('admin', 'demo', 'form');
});

App::Route('admin/demo-insert', function(){
    return array('admin', 'demo', 'insert');
});

App::Route('admin/demo-update', function(){
    return array('admin', 'demo', 'update');
});

App::Route('admin/demo-conf-delete/:int?', function(){
    return array('admin', 'demo', 'confdel');
});

App::Route('admin/demo-delete', function(){
    return array('admin', 'demo', 'delete');
});