<?php
return [
    'get'    => [
        'projects' => 'ManageFile\Controller\ManageFIleController@getProjects',
        'projects/' => 'ManageFile\Controller\ManageFIleController@getProjects',
    ],
    'post'   => [
        'projects' => 'ManageFile\Controller\ManageFIleController@createProjects'
    ],
    'put'    => [
        'projects' => 'ManageFile\Controller\ManageFIleController@updateProject'
    ],
    'delete' => [
        'projects' => 'ManageFile\Controller\ManageFIleController@deleteProject'
    ]
];