<?php
     
$aConfig['common']['dev'] = array(
                            'siteUrl' => 'http://'.$_SERVER["HTTP_HOST"],
                            'rootDir' => 'D:/personal/pree/rmcadmin16',
                            'language'=>'en',
                            'homeModule'=>'dashboard',
                            'homeAction'=>'home',
                            'loginModule'=>'dashboard',
                            'loginAction'=>'home',
                            'dbHost'=>'localhost',
                            'dbUser'=>'root',
                            'dbPassword'=>'',
                            'dbName'=>'rightersgroup',
                            'nPagerLength'=>'',
                            'nPerPageRecords'=>'',
                            'sSessionName'=>'userSession',
                            'routerClassName' => 'routers',
                            'dtDateTime' => "Y-m-d H:i:s",
                            'checkSlug'=>false,
                            'siteTitle'=>"",
                          );
                          $aConfig['common']['prod'] = array(
                            'siteUrl' => 'http://'.$_SERVER["HTTP_HOST"],
                            'rootDir' => '/home/u657523813/domains/rmcschoolno16.com/public_html/adminRmcSchoolNo16',
                            'language'=>'en',
                            'homeModule'=>'dashboard',
                            'homeAction'=>'home',
                            'loginModule'=>'users',
                            'loginAction'=>'login',
                            'dbHost'=>'localhost',
                            'dbUser'=>'u657523813_rmcschoolno16',
                            'dbPassword'=>'d:9GQYQVZ>a5',
                            'dbName'=>'u657523813_rmcschoolno16',
                            'nPagerLength'=>'',
                            'nPerPageRecords'=>'',
                            'sSessionName'=>'userSession',
                            'routerClassName' => 'routers',
                            'dtDateTime' => "Y-m-d H:i:s",
                            'checkSlug'=>false,
                            'siteTitle'=>"",
                          );