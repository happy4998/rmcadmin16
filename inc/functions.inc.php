<?php

function  si_autoload($sClassName)
 {
   if (file_exists(getconfig('rootDir')."/lib/".$sClassName.".class.php")) {
     require(getconfig('rootDir')."/lib/".$sClassName.".class.php");  
   }
 }
 spl_autoload_register('si_autoload');

function __($sString, $aDynamicValues = array()) {
    global $aLanguage;
    return isset($aLanguage[getconfig('language')][$sString]) ? vsprintf($aLanguage[getconfig('language')][$sString], $aDynamicValues) : $sString;
}

//Pagging Component
function add_component($sComponentName, $aParameters = array()) {
    global $sAppName;

    $sAction = '';

    if (file_exists(getconfig('rootDir') . "/controllers/" . $sAppName . "/modules/components/" . $sComponentName . "Component/controller.php")) {
        //if controller exists get the file otherwise return __(missing component)
        require_once(getconfig('rootDir') . "/controllers/" . $sAppName . "/modules/components/" . $sComponentName . "Component/controller.php");
        //create object of controller
        $oComponentController = eval("return new " . $sComponentName . "ComponentController();");

        //call component
        eval('$oComponentController->callComponent' . $sAction . '($aParameters);');
    }
}

function getConfig($sConfigurationOption) {
    global $aConfig, $sAppName, $sEnvironment, $aOngageListID;
    if (isset($aConfig[$sAppName][$sEnvironment]) && isset($aConfig[$sAppName][$sEnvironment][$sConfigurationOption]))
        return $aConfig[$sAppName][$sEnvironment][$sConfigurationOption];
    elseif ($aConfig['common'][$sEnvironment][$sConfigurationOption])
        return $aConfig['common'][$sEnvironment][$sConfigurationOption];
    else
        return false;
}

function redirect($url) {
    ob_clean();
    header('Location: ' . $url);
}

/**
 * getParamsFromUrl use into routers class
 * @param type $sRequestURL
 * @return type
 */
function getParamsFromUrl($sRequestURL) {
    $aAllParams = explode('?', $sRequestURL);
    $sRequestURL = $aAllParams[0] . '/' . DEVELOPERSTRING;

    //replace // to / into stringUrl
    $sRequestURL = str_replace("//", "/", $sRequestURL);

    //Add slash because if url is abc.com or abc.com/jaimin then its create issues    
    $aParams = explode('/', $sRequestURL);

    //Array pop
    array_pop($aParams);
    //Array reverse
    $aRequestParams = array_reverse($aParams);
    //Array pop
    array_pop($aRequestParams);
    //Array reverse
    $aUrlParams = array_reverse($aRequestParams);

    isset($aAllParams[1]) ? $aUrlParams[] = $aAllParams[1] : '';

    return $aUrlParams;
}

function generatePassword($length = 6, $strength = 0) {
    $vowels = 'aeuy';
    $consonants = 'bdghjmnpqrstvz';
    if ($strength & 1) {
        $consonants .= 'BDGHJLMNPQRSTVWXZ';
    }
    if ($strength & 2) {
        $vowels .= "AEUY";
    }
    if ($strength & 4) {
        $consonants .= '23456789';
    }
    if ($strength & 8) {
        $consonants .= '@#$%';
    }
    $password = '';
    $alt = time() % 2;
    for ($i = 0; $i < $length; $i++) {
        if ($alt == 1) {
            $password .= $consonants[(rand() % strlen($consonants))];
            $alt = 0;
        } else {
            $password .= $vowels[(rand() % strlen($vowels))];
            $alt = 1;
        }
    }
    return $password;
}

function prepareUniqueName($aLogo) {
    $sLogo = array_pop($aLogo);
    $sCompanyLogo = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 10);
    $sCombineName = $sCompanyLogo . '.' . $sLogo;
    $logo = $sCombineName;
    return $logo;
}
