<?php
$posts = [
  [
    "title" => "Understanding HTML",
    "content" => "HTML gives structure to your page."
  ],
  [
    "title" => "Learning CSS",
    "content" => "CSS makes your website beautiful."
  ]
];
?>

<!DOCTYPE html>
<html>
<head>
  <title>Mini Blog</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>

<header>
  <h1>My Mini Blog</h1>
</header>

<main>
  <?php foreach ($posts as $post): ?>
    <article>
      <h2><?= $post["title"]; ?></h2>
      <p><?= $post["content"]; ?></p>
      <button class="toggle">Read more</button>
    </article>
  <?php endforeach; ?>
</main>

<script src="script.js"></script>
</body>
</html>
