<?php
/**
 * Подключение к базе данных
 * 
 * @return PDO Объект подключения к БД
 * @throws PDOException Если подключение не удалось
 */
function connectDB(): PDO
{
    $config = require __DIR__ . '/../config/db.php';
    
    $dsn = "mysql:host={$config['host']};dbname={$config['dbname']};charset={$config['charset']}";
    
    $options = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false,
    ];
    
    try {
        return new PDO($dsn, $config['username'], $config['password'], $options);
    } catch (PDOException $e) {
        throw new PDOException($e->getMessage(), (int)$e->getCode());
    }
}