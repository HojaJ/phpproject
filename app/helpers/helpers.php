<?php
session_start();

// flash сообщения
function flash($name = '', $message = '', $class = 'alert alert-success'){
    if (!empty($name)){
        if (!empty($message) && empty($_SESSION[$name])){
            if(!empty($_SESSION[$name])){
                unset($_SESSION[$name]);
            }

            if(!empty($_SESSION[$name . '_class'])){
                unset($_SESSION[$name . '_class']);
            }

            $_SESSION[$name] = $message;
            $_SESSION[$name . '_class'] = $class;

        }elseif (empty($message) && !empty($_SESSION[$name])){
            $class = !empty($_SESSION[$name . '_class']) ? $_SESSION[$name . '_class'] : '';
            echo '<div class="'. $class . ' mt-2" id="msg-flash">'.$_SESSION[$name].'</div>';
            unset($_SESSION[$name]);
            unset($_SESSION[$name . '_class']);
        }
    }
}


function redirect($page = ''){
    header('Location: ' . URLROOT . '/' . $page);
}

function sortButtonActive($sortLink){
    if(isset($_GET['sort'])) {
        if ($_GET['sort'] == $sortLink) {
            echo 'active';
        }
    }
}