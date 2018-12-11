<?php
// Session
session_start();

// CONSTANTS
define('URL', 'mysql');
define('USER', 'root');
define('PASS', 'mi-contraseña');
define('DB', 'testing_db');

// VARIABLES
$nombre = "";
$apellido = "";
$id = 0;
$edit_state = false;

$sqlFind = "SELECT nombre, apellido, id FROM users WHERE id='$id'";

$connection = new mysqli(URL, USER, PASS, DB);

// SAVE
if (isset($_POST["save"])) {
    $nombre = trim($_POST["nombre"]);
    $apellido = trim($_POST["apellido"]);

    $connection->query("INSERT INTO users (nombre, apellido) VALUES ('$nombre', '$apellido')");
    if ($connection->errno) {
        die($connection->error);
    }
    $_SESSION["msg"] = "Usuario Guardado";
    header("location: .");
}

// UPDATE
if (isset($_POST["update"])) {
	$nombre = trim($_POST["nombre"]);
	$apellido = trim($_POST["apellido"]);
	$id = trim($_POST["id"]);
	
	$connection->query("UPDATE users SET nombre='$nombre', apellido='$apellido' WHERE id=$id");
	if ($connection->errno) {
        die($connection->error);
    }
    $_SESSION["msg"] = "Usuario Actualizado";
    header("location: .");
}

// GET ALL
$results = $connection->query("SELECT * FROM users");
