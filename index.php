<?php

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>LIndex</title>
</head>
<body>
<?php

if (have_posts()) {
  while (have_posts()) {
    the_post();
    ?>

    <h3><?php the_title(); ?></h3>

    <?php the_content(); ?>

    <?php
  }
}

?>
</body>
</html>