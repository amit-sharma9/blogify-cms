<?php
session_start();
include "includes/db.php";

// Fetch all posts ordered by newest first
$sql    = "SELECT * FROM posts ORDER BY created_at DESC";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>MyCMS Blog</title>
  <link rel="stylesheet" href="style.css">
</head>
<body class="blog-page">
  <header class="navbar">
    <div class="container">
      <h1 class="logo">MyCMS Blog</h1>
      <nav>
        <?php if (isset($_SESSION['username'])): ?>
          <a class="btn small" href="dashboard.php">Dashboard</a>
          <a class="btn small logout" href="logout.php">Logout</a>
        <?php else: ?>
          <a class="btn small" href="login.php">Admin Login</a>
        <?php endif; ?>
      </nav>
    </div>
  </header>

  <main class="container">
    <?php if ($result->num_rows > 0): ?>
      <?php while ($post = $result->fetch_assoc()): ?>
        <article class="post">
          <h2 class="post-title"><?php echo htmlspecialchars($post['title']); ?></h2>
          <div class="post-meta">Posted on <?php echo $post['created_at']; ?></div>
          <div class="post-content"><?php echo nl2br(htmlspecialchars($post['content'])); ?></div>
        </article>
      <?php endwhile; ?>
    <?php else: ?>
      <p class="no-posts">No posts found.</p>
    <?php endif; ?>
  </main>

  <footer class="footer">
    <div class="container">
      &copy; <?php echo date('Y'); ?> MyCMS. All rights reserved.
    </div>
  </footer>
</body>
</html>
<?php $conn->close(); ?>
