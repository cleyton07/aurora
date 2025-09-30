<?php
session_start();
session_destroy();
header("Location: login.php");
exit();
?>


<?php
session_start();

// Destruir a sessão
$_SESSION = array();

// Se deseja destruir a sessão completamente, apague também o cookie de sessão.
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

session_destroy();

// Redirecionar para a página index na pasta aurora
header("Location: ../aurora/index.php");
exit();
?>