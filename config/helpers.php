<?php
function isAdmin() {
    return isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'admin';
}
function isEnfermera() {
    return isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'enfermera';
}

function getRol(){
    if(isAdmin()){
        return 1;
    }
    if(isEnfermera()){
        return 2;
    }
    return 0;
}
?>