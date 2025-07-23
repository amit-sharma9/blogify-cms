<?php
session_start();
include 'includes/db.php';

if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit;
}

$message = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title   = trim($_POST['title']);
    $content = trim($_POST['content']);

    $sql  = "INSERT INTO posts (title, content) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ss', $title, $content);

    if ($stmt->execute()) {
        $message = '✅ Post added successfully!';
    } else {
        $message = '❌ Error: ' . $conn->error;
    }
    $stmt->close();
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Create Post – MyCMS</title>
  <link rel="stylesheet" href="style.css">
</head>
<body class="form-page">
  <div class="container">
    <h2>Create New Blog Post</h2>
    <?php if ($message): ?>
      <p class="message"><?php echo $message; ?></p>
    <?php endif; ?>
    <form class="post-form" method="POST" action="create-post.php">
      <label>Title:</label><br>
      <input type="text" name="title" required><br><br>
      <label>Content:</label><br>
      <textarea name="content" rows="8" required></textarea><br><br>
      <button class="btn" type="submit">Publish Post</button>
    </form>
    <p><a href="dashboard.php">← Back to Dashboard</a></p>
  </div>
</body>
</html>
