<?php
require_once __DIR__ . '/../Database/database.php';

function getPortfolio($pdo, $userId = 1) {
    $stmt = $pdo->prepare("SELECT * FROM portfolio WHERE user_id = ?");
    $stmt->execute([$userId]);
    return $stmt->fetch();
}

function updatePortfolio($pdo, $info, $userId = 1) {
    $stmt = $pdo->prepare("UPDATE portfolio SET info=? WHERE user_id=?");
    return $stmt->execute([$info, $userId]);
} 