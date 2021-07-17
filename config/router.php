<?php
return [
    'get'    => [
        'projects'   => 'ManageFile\Controller\ManageFIleController@getProjects',
        'lecturers'  => 'ManageFile\Controller\LecturerController@getLecturers',
        'lecturers/' => 'ManageFile\Controller\LecturerController@getLecturers',
        'projects/'  => 'ManageFile\Controller\ManageFIleController@getProjects',
    ],
    'post'   => [
        'login'     => 'ManageFile\Controller\UserController@login',
        'projects'  => 'ManageFile\Controller\ManageFIleController@createProject',
        'lecturers' => 'ManageFile\Controller\LecturerController@createLecturer',
    ],
    'put'    => [
        'projects'  => 'ManageFile\Controller\ManageFIleController@updateProject',
        'lecturers' => 'ManageFile\Controller\LecturerController@updatelecturer',
    ],
    'delete' => [
        'projects'  => 'ManageFile\Controller\ManageFIleController@deleteProject',
        'lecturers' => 'ManageFile\Controller\LecturerController@deletelecturer',
    ]
];