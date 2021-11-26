<?php
function capthca(){
    $str = date("YmdHisu")-19940122;;
    return generate($str);
}