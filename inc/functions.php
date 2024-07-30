<?php
session_start(); // for dealing with session in any page, use this


function secure()
{
    if (!isset($_SESSION['id'])) {
        header('Location: login.php');
    }
}
function set_message($message, $className)
{
    $_SESSION['message'] = $message;
    $_SESSION['className'] = $className;
}

function get_message()
{
    if (isset($_SESSION['message'])) {
        echo '<div class="alert ' . $_SESSION['className'] . '" role="alert">' .
            $_SESSION['message']
            . '</div>';
        unset($_SESSION['message']);
        unset($_SESSION['className']);
    }
}
?>