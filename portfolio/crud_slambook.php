<?php
require_once __DIR__ . '/../Database/database.php';

function getSlambookEntries($pdo, $userId = 1) {
    $stmt = $pdo->prepare("SELECT * FROM slambook WHERE user_id = ?");
    $stmt->execute([$userId]);
    return $stmt->fetchAll();
}

function addSlambookEntry($pdo, $question, $answer, $userId = 1) {
    $stmt = $pdo->prepare("INSERT INTO slambook (user_id, question, answer) VALUES (?, ?, ?)");
    return $stmt->execute([$userId, $question, $answer]);
}

function updateSlambookEntry($pdo, $id, $question, $answer, $userId = 1) {
    $stmt = $pdo->prepare("UPDATE slambook SET question=?, answer=? WHERE id=? AND user_id=?");
    return $stmt->execute([$question, $answer, $id, $userId]);
}

function deleteSlambookEntry($pdo, $id, $userId = 1) {
    $stmt = $pdo->prepare("DELETE FROM slambook WHERE id=? AND user_id=?");
    return $stmt->execute([$id, $userId]);
} 