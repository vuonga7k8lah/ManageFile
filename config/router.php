<?php
/**
 * @var $aRoute \ManageFile\Core\Route
 */
$aRoute->get('home','ManageFile\Controller\HomeController@loadView');
$aRoute->put('home','ManageFile\Controller\HomeController@testUpdate');
$aRoute->post('home','ManageFile\Controller\HomeController@testPost');
//Manage File
$aRoute->post('files','ManageFile\Controller\ManageFIleController@createFile');
