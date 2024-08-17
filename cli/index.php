<?php

 ob_start();  
 define("INC_DIR_PATH", "../inc");
 $sEnvironment = "prod";
 $sAppName = "rightersgroup";
 require("/home/rightersdev/group.rightersdev.com/inc/bootstrap.inc.php");  
 $sModule = $argv[1];
 $sAction = $argv[2];
 $sLayoutPath = '';
 
 if(file_exists(getconfig('rootDir')."/controllers/".$sAppName."/modules/".$sModule."/controller.php"))
 {   
      require(getconfig('rootDir')."/controllers/".$sAppName."/modules/".$sModule."/controller.php");
       
   $oMainController = eval("return new ".$sModule."Controller();");
   if(method_exists($oMainController,'call'.$sAction))
   {
           if($oMainController->aLayout[$sAction])
           {               
               require(getconfig('rootDir')."/controllers/".$sAppName."/templates/".$sLayoutPath.$oMainController->aLayout[$sAction].".layout.php");
           }
           else
           {
               eval('$oMainController->call'.$sAction.'();');
           }
               
   }
 }
 else 
 {   
     redirect(getConfig('siteUrl').'/error/page');
 }