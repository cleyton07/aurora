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

// Retornar resposta JSON
header('Content-Type: application/json');
echo json_encode(['success' => true, 'message' => 'Logout realizado com sucesso', 'redirect' => '../aurora/index.php']);
exit();
?>