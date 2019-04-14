<?php

function getDesignedMessage($message, $type = 1) {
    $designedMessage = '';
    switch ($type) {
        case 1:
            $designedMessage = '<div class="alert alert-success"><strong>Success!</strong> ' . $message . '</div>';
            break;
        case 2:
            $designedMessage = '<div class="alert alert-danger"><strong>Error!</strong> ' . $message . '</div>';
            break;
        default:
            break;
    }
    return $designedMessage;
}
