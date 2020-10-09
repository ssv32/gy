<?php

global $argv;
$isRunConsole = isset($argv);
global $br;
$br = "\n";

//print_r($argv);

function showHelpFromInstall(){
    global $br;
    echo $br."This script set options for gy framework".$br;
    echo "===================================".$br;
    echo ">php -f consoleInstallOptions.php <options>".$br;
    echo $br;
    echo "options:".$br;
    echo "    help  - show help this script".$br;
    echo "    set-all <array options> - set all options (clear options if not input)".$br;
    echo "    set-option <array options> - set options (save old options if not input)".$br;
    echo $br;
    echo "  example: php -f consoleInstallOptions.php set-all sole 111 db_type mysql".$br;
    echo "  example: php -f consoleInstallOptions.php set-option sole 111 db_type mysql".$br;
    echo "  example: php -f consoleInstallOptions.php help".$br;
    echo $br;
    echo $br;
    echo $br;
}


function parseOprions($optionsFromConsole){ 
    $arOptions = array();
    for ($i = 2; $i < (count($optionsFromConsole)-1); $i = $i+2) {
        if (empty($optionsFromConsole[$i+1])) {
            $optionsFromConsole[$i+1] = '';
        }

        if ($optionsFromConsole[$i+1] == '***') {
            $optionsFromConsole[$i+1] = '';
        }

        if (strripos($optionsFromConsole[$i], 'db') !== false) {
            $arOptions['db_config'][$optionsFromConsole[$i]] = $optionsFromConsole[$i+1];
        
        } else {
            $arOptions[$optionsFromConsole[$i]] = $optionsFromConsole[$i+1];  
        }
    }

    return $arOptions;
}

function createTextForFileCofig($options){
    global $br;
    $fileText = '';

    if (!empty($options)) { 

        $fileText = '<?php '.$br.'
if (!defined("GY_CORE") && GY_CORE !== true ) die("err_core");'.$br.'

$gy_config = array('.$br;

        foreach ($options as $key => $val) {

            if (!is_array($val)) {
                $fileText .= '    "'.$key.'" => "'.$val.'",'.$br;
            } else {
                $fileText .= '    "'.$key.'" => array('.$br;
                foreach ($val as $key2 => $val2) {
                    $fileText .= '        "'.$key2.'" => "'.$val2.'",'.$br;
                }
                $fileText .= '    ),'.$br;
            }

        }
        $fileText .= ');'.$br;
    }

    return $fileText;
}

if ($isRunConsole) { // пока запускать только из консоли
    if (empty($argv[1]) || ($argv[1] == 'help')) {
        showHelpFromInstall();
    } elseif ($argv[1] == 'set-all') {
        echo 'run set-all'.$br;

        $options = parseOprions($argv);

        if (!empty($options)) {
            $file = fopen(__DIR__.'/../config/gy_config.php', 'w');
            fwrite($file, createTextForFileCofig($options) );
            fclose($file);
        }
        echo 'finish set-all'.$br;

    } elseif ($argv[1] == 'set-option') {
        echo 'run set-option'.$br;
        $options = parseOprions($argv);

        include __DIR__."/../gy.php";
        $old_options = $app->options;

        print_r($old_options);

        foreach ($options as $key => $val) {
            if (is_array($val)) {
                //$tempArr = $old_options[$key];
                foreach ($val as $key2 => $val2) {
                    $old_options[$key][$key2] = $val2;
                }
            } else {
                $old_options[$key] = $val;
            }
        }

        if (!empty($old_options)) {
            $file = fopen(__DIR__.'/../config/gy_config.php', 'w');
            fwrite($file, createTextForFileCofig($old_options) );
            fclose($file);
        }
        echo 'finish set-option'.$br;

    }

} else {
    echo '! Error. You need to run the script in the console';

}
