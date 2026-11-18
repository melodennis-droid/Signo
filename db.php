<?php
// Conexão com o banco SQLite (arquivo signos.db na mesma pasta)
function conectar(): PDO {
    $pdo = new PDO('sqlite:' . __DIR__ . '/signos.db');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    return $pdo;
}
