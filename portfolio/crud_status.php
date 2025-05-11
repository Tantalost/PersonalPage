<?php
require_once __DIR__ . '/../Database/database.php';

function getUserStatus($pdo, $userId = 1) {
    $stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
    $stmt->execute([$userId]);
    return $stmt->fetch();
}

function updateUserStatus($pdo, $data, $userId = 1) {
    $stmt = $pdo->prepare("UPDATE users SET name=?, level=?, job=?, title=? WHERE id=?");
    return $stmt->execute([
        $data['name'], $data['level'], $data['job'], $data['title'], $userId
    ]);
}

function upgradeStat($pdo, $stat, $userId = 1) {
    $allowed = ['strength', 'agility', 'intelligence', 'sense'];
    if (!in_array($stat, $allowed)) return false;
    $user = getUserStatus($pdo, $userId);
    if ($user['points'] <= 0) return false;
    $stmt = $pdo->prepare("UPDATE users SET $stat = $stat + 1, points = points - 1 WHERE id = ?");
    return $stmt->execute([$userId]);
} 