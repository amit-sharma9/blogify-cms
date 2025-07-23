<?php
// edit-post.php
session_start();
include 'includes/db.php';

// Protect page
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit;
}

// 1. Get post ID from URL
if (!isset($_GET['id'])) {
    header('Location: manage-posts.php');
    exit;
}
$post_id = (int)$_GET['id'];

// 2. Fetch post data
$stmt = $conn->prepare("SELECT title, content FROM posts WHERE id = ?");
$stmt->bind_param('i', $post_id);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows !== 1) {
    // No such post
    header('Location: manage-posts.php');
    exit;
}

$stmt->bind_result($title, $content);
$stmt->fetch();
$stmt->close();

// 3. Handle form submission
$message = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $new_title   = trim($_POST['title']);
    $new_content = trim($_POST['content']);

    $update = $conn->prepare("UPDATE posts SET title = ?, content = ? WHERE id = ?");
    $update->bind_param('ssi', $new_title, $new_content, $post_id);

    if ($update->execute()) {
        $message = '✅ Post updated successfully!';
    } else {
        $message = '❌ Update failed: ' . $conn->error;
    }
    $update->close();

    // Refresh fetched values
    $title   = $new_title;
    $content = $new_content;
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Edit Post – MyCMS</title>
  <link rel="stylesheet" href="style.css">
</head>
<body class="form-page">
  <div class="container">
    <h2>Edit Post #<?php echo $post_id; ?></h2>
    <?php if ($message): ?>
      <p class="message"><?php echo $message; ?></p>
    <?php endif; ?>
    <form class="post-form" method="POST" action="edit-post.php?id=<?php echo $post_id; ?>">
      <label>Title:</label><br>
      <input type="text" name="title" value="<?php echo htmlspecialchars($title); ?>" required><br><br>
      <label>Content:</label><br>
      <textarea name="content" rows="8" required><?php echo htmlspecialchars($content); ?></textarea><br><br>
      <button class="btn" type="submit">Save Changes</button>
    </form>
    <p><a href="manage-posts.php">← Back to Manage Posts</a></p>
  </div>
</body>
</html>
