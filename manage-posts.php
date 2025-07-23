<?php
// manage-posts.php
session_start();
include 'includes/db.php';

// Protect page
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit;
}

// Fetch all posts
$sql    = "SELECT * FROM posts ORDER BY created_at DESC";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html>
<head>
  <title>Manage Posts – MyCMS</title>
  <link rel="stylesheet" href="style.css">
</head>
<body class="manage-page">
  <div class="container">
    <h2>Manage Blog Posts</h2>
     <?php if (isset($_GET['deleted'])): ?>
      <p class="message">✅ Post deleted successfully!</p>
    <?php endif; ?>
    <a class="btn" href="create-post.php">➕ New Post</a>
    <a class="btn logout" href="logout.php">🔒 Logout</a>
    <br><br>
    <?php if ($result->num_rows > 0): ?>
      <table class="posts-table">
        <thead>
          <tr>
            <th>ID</th>
            <th>Title</th>
            <th>Created At</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
        <?php while ($post = $result->fetch_assoc()): ?>
          <tr>
            <td><?php echo $post['id']; ?></td>
            <td><?php echo htmlspecialchars($post['title']); ?></td>
            <td><?php echo $post['created_at']; ?></td>
            <td>
              <a class="btn small" href="edit-post.php?id=<?php echo $post['id']; ?>">✏️ Edit</a>
              <a class="btn small danger" href="delete-post.php?id=<?php echo $post['id']; ?>" onclick="return confirm('Are you sure you want to delete this post?');">🗑️ Delete</a>
            </td>
          </tr>
        <?php endwhile; ?>
        </tbody>
      </table>
    <?php else: ?>
      <p>No posts found. <a href="create-post.php">Create one now.</a></p>
    <?php endif; ?>
  </div>
</body>
</html>
<?php
$conn->close();
?>
