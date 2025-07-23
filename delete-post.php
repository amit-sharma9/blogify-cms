<?php
// delete-post.php
session_start();
include 'includes/db.php';

// 1. Protect page
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit;
}

// 2. Get post ID from URL
if (!isset($_GET['id'])) {
    header('Location: manage-posts.php');
    exit;
}
$post_id = (int)$_GET['id'];

// 3. Prepare and execute delete
$stmt = $conn->prepare("DELETE FROM posts WHERE id = ?");
$stmt->bind_param('i', $post_id);

if ($stmt->execute()) {
    $stmt->close();
    $conn->close();
    // 4. Redirect back with success message (optional via GET)
    header('Location: manage-posts.php?deleted=1');
    exit;
} else {
    $error = $conn->error;
    $stmt->close();
    $conn->close();
    echo "Error deleting post: $error";
    exit;
}
?>
