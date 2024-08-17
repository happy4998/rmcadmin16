<?php
    require('_headerLogin.php');
    eval('$oMainController->call'.$sAction.'();');
    require('_footerLogin.php');
?>
