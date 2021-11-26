<?php
function generate($a){
    // get original URL
    $originalUrl = $a;

    // convert url to integer
    $intUrl = crc32($originalUrl);
    // echo $intUrl.'<br>';
    $output=null;
    $retval=null;

    // exec program -> convert from int into unique string
    //exec('generate/convert_to_string '.$intUrl, $output, $retval);
    //$stringUrl = $output[0];
    $stringUrl = substr(md5($intUrl), 0, 5);
    // echo $stringUrl;
    return $stringUrl;
}