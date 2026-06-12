<?php $current = basename($_SERVER['PHP_SELF'], '.php'); ?>
<nav class="site-nav">
  <a class="nav-logo" href="index.php">
    <img src="https://upload.wikimedia.org/wikipedia/en/5/56/Real_Madrid_CF.svg" alt="Real Madrid grb" />
    <span>Real Madrid</span>
  </a>
  <div class="nav-links">
    <a href="index.php"    class="<?= $current==='index'    ? 'active':'' ?>">Momčad</a>
    <a href="trophies.php" class="<?= $current==='trophies' ? 'active':'' ?>">Trofeji</a>
    <a href="quiz.php"     class="<?= $current==='quiz'     ? 'active':'' ?>">Kviz</a>
  </div>
</nav>
