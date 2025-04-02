<?php

function Redirect($file) {
    header("location: $file"); 
    exit(); 
}
?>