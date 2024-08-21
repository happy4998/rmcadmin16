<?php 
 
class usersController
    {
      
       public $aLayout = array('login'=>'login','logout'=>'main','changepassword'=>'main');
       public $aLoginRequired = array('login'=>false,'logout'=>true,'changepassword'=>true);
       public function __construct() 
        {
            global $sAction;
            global $oUser;

			if ($this->aLoginRequired[$sAction]) 
            {                
                if (!$oUser->isLoggedin()) 
                {
                    redirect(getConfig('siteUrl') . '/users/login');
                }
            }

            if ($this->aLoginRequired[$sAction])
		    {
                if (!$oUser->isLoggedin())
                {
                    redirect(getConfig('siteUrl').'/'.getConfig('loginModule').'/'.getConfig('loginAction'));
                }
		    }

        }
        public function calllogin()
        {
            // print_r($_POST);
            global $oSession;
            $oUser = new users();
            $sMessage =__('User_logged_in_successfully');
            $sUserName = isset($_POST["username"])?$_POST["username"]:"";
            $sPassword = isset($_POST["password"])?$_POST["password"]:"";
            if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) 
            {
                $sTableName = 'users';
                $aFields = array
                            (
                                array
                                    (
                                        'field'=>'username',
                                        'value'=>$sUserName,
                                        'validation'=>'required',
                                        'message'=>__('username_required')
                                    ),
                                array
                                    (
                                        'field'=>'Password',
                                        'value'=>$sPassword,
                                        'validation'=>'required',
                                        'message'=>__('password_required')
                                    ),
                                array
                                    (
                                        'field'=>'wrong_credentials',
                                        'aCredentials'=>array('username','password'),
                                        'aDataForSession'=> array('id_user','username'),
                                        'tableName'=>$sTableName,
                                        'value'=>array($sUserName,$sPassword),
                                        'validation'=>'isLoggedin',
                                        'message'=>__('username_or_password_is_not_valid')
                                    ),

                            );
                            // print_r($aFields);
                $bIsValid = $oUser->validateData($aFields);
                if($bIsValid)
                {
                    $oUser->doLogin($bIsValid);
                    $oUser->isLoggedin();
                    $oSession->setSession('sDisplayMessage',$sMessage);
                    redirect(getConfig('siteUrl') . '/' . getConfig('homeModule') . '/' . getConfig('homeAction'));
                }
            }
            if ($oUser->isLoggedin())
            {
                redirect(getConfig('siteUrl') . '/' . getConfig('homeModule') . '/' . getConfig('homeAction'));
            }
            else
            {
                require('login.tpl.php');
            }
        }
        public function callLogout()
	    {

            global $oUser;
            global $oSession;

            $oUser->doLogOut();
            unset($oUser);
            unset($oSession);
            redirect(getConfig('siteUrl') . '/' . getConfig('loginModule') . '/' . getConfig('loginAction'));
	    }
        public function callChangePassword()
        {
            $sDbHost = getConfig('dbHost');
            $sDbUser = getConfig('dbUser');
            $sDbPassword = getConfig('dbPassword');
            $sDbName = getConfig('dbName');
            $oSiCommon = new siCommon($sDbHost,$sDbUser,$sDbPassword,$sDbName);
            global $oSession;
            global $oUser;
            $aUser = $oUser->isLoggedin();
            $sMessage =__('change_password_successfully');
            if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['changePassword'])) 
            {
                $nAdminId = isset ($aUser[0]['id_user']) ?  $aUser[0]['id_user'] : '';               
                $sTableName = 'users';              
                $newPassword = $_POST ['new_password'];
                $aFields = array
                               (                                
                                    array
                                        (
                                            'field'=>'current_password',
                                            'value'=> isset($_POST['current_password'])?$_POST['current_password']:'',
                                            'idValue'=> $nAdminId,
                                            'idField'=> 'id_user',
                                            'tableName'=> $sTableName,
                                            'validation'=>'currentPassword',
                                            'message'=>__('Current_password_not_Valid')
                                        ),
                                    array 
                                        (
                                            'field'=>'new_password',
                                            'value'=>$_POST['new_password'],
                                            'validation'=>'required',
                                            'message'=>__('new_password_required')
                                        ),
                                    array 
                                        (
                                            'field'=>'confirm_password',
                                            'value'=>array($_POST['new_password'],$_POST['confirm_password']),
                                            'validation'=>'confirm',
                                            'message'=>__('confirm_password_not_valid')
                                        ),
                                    array 
                                        (
                                            'field'=>'confirm_password',
                                            'value'=>$_POST['confirm_password'],
                                            'validation'=>'required',
                                            'message'=>__('confirm_password_required')
                                        )
                                );                
                $bIsValid = $oSiCommon->validateData($aFields);                
                if($bIsValid)
                {
                    $aFields = array('id_user','password');
                    $asPrepareData = array
                                         (
                                            array
                                                (
                                                    $nAdminId,
                                                    sha1($bIsValid[0]['salt'].$newPassword)
                                                )
                                        );
                    $oSiCommon->saveRecords($sTableName, $aFields,$asPrepareData);
                    $oSession->setSession('sDisplayMessage',$sMessage);
                    redirect(getConfig('siteUrl') . '/' . getConfig('homeModule') . '/' . getConfig('homeAction'));
                }
            }
         require("changePassword.tpl.php");   
        }
    }