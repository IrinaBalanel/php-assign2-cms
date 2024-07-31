<?php
    if (session_status() === PHP_SESSION_NONE) {
        session_start(); // Start the session if it's not already started
    }

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