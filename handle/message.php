<?php

function displayMessage($message, $type = 'success') {
    if ($type === 'error') {
        echo '<div style="color: red;">' . $message . '</div>';
    } else {
        echo '<div style="color: green;">' . $message . '</div>';
    }
}

?>