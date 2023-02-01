<?php
 
$posts = [];
$sql = " 
  SELECT ( nickname, content ) 
  FROM posts
";
$stmt = $mysqli->prepare($sql); 
$stmt->execute(); 
$stmt->bind_result('ss', $nickname, $content);
while($stmt->fetch()){
  array_unshift($posts, [
    'nickname' => $nickname,
    'content' => $content
  ]);
}
$stmt->close();
 
?>
 
<html>
<head>
<title>掲示板</title>
</head>
<body>
  <div class="container">
  <?php foreach($posts as $post): ?>
    <div class="post">
      <div class="nickname">
        <?php echo $post->nickname; ?>
      </div>
      <div class="content">
        <?php echo $post->content; ?>
      </div>
    </div>
  <?php endforeach; ?>
</div>
</body>
</html>
