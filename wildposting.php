<?php get_header(); ?>

<main>
  <!-- Hero Section -->
  <section class="hero-section">
    <div class="hero-content">
      <h1 class="hero-title">
        Denver Wild Posting. Clean. Precise. Documented.
      </h1>
      <p class="hero-description">
        We plan, print, and place across Denver. Permits where required. Proofs every day. Single‑city focus for now.
      </p>
      <div class="hero-buttons">
        <a href="#portfolio" class="btn-primary">View Portfolio</a>
        <a href="#contact" class="btn-secondary">Start a Conversation</a>
      </div>
      <ul class="hero-features">
        <li>• City: Denver</li>
        <li>• Service: Wild Posting</li>
        <li>• Photo Proofs & Map Pins</li>
      </ul>
    </div>

    <div class="video-container">
      <?php 
      $homepage_video_yt_id = "VmiR0JEcaYc";
      $homepage_video_mp4 = null;
      
      if ($homepage_video_yt_id): ?>
        <div class="video-wrapper">
          <iframe
            src="https://www.youtube.com/embed/<?php echo $homepage_video_yt_id; ?>?rel=0&modestbranding=1&playsinline=1&autoplay=1&mute=1&loop=1&playlist=<?php echo $homepage_video_yt_id; ?>"
            title="Campaign video"
            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
            allowfullscreen
            referrerpolicy="strict-origin-when-cross-origin"
          ></iframe>
        </div>
      <?php elseif ($homepage_video_mp4): ?>
        <video
          src="<?php echo $homepage_video_mp4; ?>"
          playsinline
          muted
          autoplay
          loop
          controls
          style="display: block; width: 100%; height: 100%; object-fit: cover;"
        ></video>
      <?php else: ?>
        <img 
          src="https://images.unsplash.com/photo-1441974231531-c6227db76b6e?q=80&w=1400&auto=format&fit=crop" 
          alt="portfolio preview" 
          class="fallback-image"
        />
      <?php endif; ?>
    </div>
  </section>

  <!-- Portfolio Section -->
  <section id="portfolio" class="page-section">
    <h2>Portfolio</h2>
    <p>Portfolio content will go here...</p>
  </section>

  <!-- About Section -->
  <section id="about" class="page-section">
    <h2>About</h2>
    <p>About content will go here...</p>
  </section>

  <!-- Contact Section -->
  <section id="contact" class="page-section">
    <h2>Contact</h2>
    <p>Contact form will go here...</p>
  </section>
</main>

<?php get_footer(); ?>
