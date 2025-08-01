function successAlert(title, message, timer = 3000, showConfirmButton = false) {
    Swal.fire({
        title: title,
        text: message,
        icon: 'success',
        timer: timer,
        showConfirmButton: showConfirmButton,
        timerProgressBar: false,
        position: 'center',
        width: 350,
        customClass: {
            popup: 'swal2-custom-popup'
        }
    });
}

function errorAlert(title, message, timer = 3000, showConfirmButton = false) {
    Swal.fire({
        title: title,
        text: message,
        icon: 'error',
        timer: timer,
        showConfirmButton: showConfirmButton,
        timerProgressBar: false,
        position: 'center',
        width: 350,
        customClass: {
            popup: 'swal2-custom-popup'
        }
    });
}

function infoAlert(title, message, timer = 3000, showConfirmButton = false) {
    Swal.fire({
        title: title,
        text: message,
        icon: 'info',
        timer: timer,
        showConfirmButton: showConfirmButton,
        timerProgressBar: false,
        position: 'center',
        width: 350,
        customClass: {
            popup: 'swal2-custom-popup'
        }
    });
}

function warningAlert(title, message, timer = 3000, showConfirmButton = false) {
    Swal.fire({
        title: title,
        text: message,
        icon: 'warning',
        timer: timer,
        showConfirmButton: showConfirmButton,
        timerProgressBar: false,
        position: 'center',
        width: 350,
        customClass: {
            popup: 'swal2-custom-popup'
        }
    });
}