<?php
function setAlert($type, $title, $message, $timer = 3000, $showConfirmButton = false) {
    $_SESSION['sweetalert'] = [
        'type' => $type,
        'title' => $title,
        'message' => $message,
        'timer' => $timer,
        'showConfirmButton' => $showConfirmButton
    ];
}

function displayAlert() {
    if (isset($_SESSION['sweetalert'])) {
        $alert = $_SESSION['sweetalert'];
        $timer = isset($alert['timer']) ? $alert['timer'] : 3000;
        $showConfirmButton = isset($alert['showConfirmButton']) ? ($alert['showConfirmButton'] ? 'true' : 'false') : 'false';
        echo "<script>";
        switch ($alert['type']) {
            case 'success':
                echo "successAlert('{$alert['title']}', '{$alert['message']}', $timer, $showConfirmButton);";
                break;
            case 'error':
                echo "errorAlert('{$alert['title']}', '{$alert['message']}', $timer, $showConfirmButton);";
                break;
            case 'info':
                echo "infoAlert('{$alert['title']}', '{$alert['message']}', $timer, $showConfirmButton);";
                break;
            case 'warning':
                echo "warningAlert('{$alert['title']}', '{$alert['message']}', $timer, $showConfirmButton);";
                break;
        }
        echo "</script>";
        unset($_SESSION['sweetalert']);
    }
}
?>