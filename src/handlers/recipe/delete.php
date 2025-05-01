<?php
$id = (int)$_GET['id'];

$pdo = connectDB();
$stmt = $pdo->prepare("DELETE FROM recipes WHERE id = ?");
$stmt->execute([$id]);

header("Location: ?route=home");
exit;