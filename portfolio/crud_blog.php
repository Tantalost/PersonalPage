<?php
require_once __DIR__ . '/../Database/database.php';

function getBlogPosts($pdo, $userId = 1) {
    $stmt = $pdo->prepare("SELECT * FROM blog WHERE user_id = ? ORDER BY created_at DESC");
    $stmt->execute([$userId]);
    return $stmt->fetchAll();
}

function addBlogPost($pdo, $title, $content, $userId = 1) {
    $stmt = $pdo->prepare("INSERT INTO blog (user_id, title, content) VALUES (?, ?, ?)");
    return $stmt->execute([$userId, $title, $content]);
}

function updateBlogPost($pdo, $id, $title, $content, $userId = 1) {
    $stmt = $pdo->prepare("UPDATE blog SET title=?, content=? WHERE id=? AND user_id=?");
    return $stmt->execute([$title, $content, $id, $userId]);
}

function deleteBlogPost($pdo, $id, $userId = 1) {
    $stmt = $pdo->prepare("DELETE FROM blog WHERE id=? AND user_id=?");
    return $stmt->execute([$id, $userId]);
} 