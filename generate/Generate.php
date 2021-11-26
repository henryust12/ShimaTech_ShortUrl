<?php
function generate($a){
    // get original URL
    $originalUrl = $a;

    // convert url to integer
    $intUrl = crc32($originalUrl);
    
    $output=null;
    $retval=null;
    
    $stringUrl = substr(md5($intUrl), 0, 5);
    
    return $stringUrl;
}