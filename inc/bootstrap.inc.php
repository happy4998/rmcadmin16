<?php

 require("config.inc.php");
 require("functions.inc.php");
 require("constant.inc.php"); 
 require(getconfig('rootDir')."/i18n/en.php");
 require(getconfig('rootDir')."/controllers/".$sAppName."/config/config.inc.php");
 $oUser = new users();
 $oSession = new sessionManager();