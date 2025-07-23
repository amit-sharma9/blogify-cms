<?php
session_start();
include 'includes/db.php';

if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Dashboard – MyCMS</title>
  <link rel="stylesheet" href="style.css">
</head>
<body class="dashboard-page">
  <div class="container">
    <h1>Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?></h1>
    <nav class="admin-nav">
      <a class="btn" href="create-post.php">➕ Create Post</a>
      <a class="btn" href="manage-posts.php">📋 Manage Posts</a>
      <a class="btn logout" href="logout.php">🔒 Logout</a>
    </nav>
  </div>
</body>
</html>

