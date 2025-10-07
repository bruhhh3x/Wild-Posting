<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="profile" href="https://gmpg.org/xfn/11">
  <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<header class="nav-header">
  <nav class="nav-container">
    <a href="<?php echo home_url(); ?>" class="nav-logo" aria-label="Walls Can Talk home">
      <img src="https://ik.imagekit.io/1kunhjtuk/A41C9EDD-371E-4090-8AF7-C8AF4E0E3C27%20-%20Edited%20-%20Edited.png?updatedAt=1759421076847" alt="Walls Can Talk logo" class="nav-logo-image" />
      <span class="nav-logo-text">Walls Can Talk</span>
    </a>
    <div class="nav-links">
      <a href="<?php echo home_url(); ?>#portfolio">Portfolio</a>
      <a href="<?php echo home_url(); ?>#about">About</a>
      <a href="<?php echo home_url(); ?>#contact" class="contact-link">Contact</a>
    </div>
  </nav>
</header>
