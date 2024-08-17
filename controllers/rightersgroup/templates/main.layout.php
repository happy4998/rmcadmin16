<?php
    require('_header.php');
    require('_sidebar.php');
    eval('$oMainController->call'.$sAction.'();');
    require('_footer.php');
?>
