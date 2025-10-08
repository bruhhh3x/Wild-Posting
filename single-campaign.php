<?php get_header(); ?>

<main>
  <?php while (have_posts()) : the_post(); ?>
    <article class="campaign-single">
      <header class="campaign-header">
        <h1 class="campaign-title"><?php the_title(); ?></h1>
        
        <div class="campaign-meta">
          <?php 
          $client = get_post_meta(get_the_ID(), '_campaign_client', true);
          $city = get_post_meta(get_the_ID(), '_campaign_city', true);
          $services = get_post_meta(get_the_ID(), '_campaign_services', true);
          $year = get_post_meta(get_the_ID(), '_campaign_year', true);
          $role = get_post_meta(get_the_ID(), '_campaign_role', true);
          $metrics = get_post_meta(get_the_ID(), '_campaign_metrics', true);
          ?>
          
          <?php if ($client): ?>
            <p><strong>Client:</strong> <?php echo esc_html($client); ?></p>
          <?php endif; ?>
          
          <?php if ($city): ?>
            <p><strong>City:</strong> <?php echo esc_html($city); ?></p>
          <?php endif; ?>
          
          <?php if ($services): ?>
            <p><strong>Services:</strong> <?php echo esc_html($services); ?></p>
          <?php endif; ?>
          
          <?php if ($year): ?>
            <p><strong>Year:</strong> <?php echo esc_html($year); ?></p>
          <?php endif; ?>
        </div>
      </header>

      <?php if (has_post_thumbnail()): ?>
        <div class="campaign-featured-image">
          <?php the_post_thumbnail('large'); ?>
        </div>
      <?php endif; ?>

      <div class="campaign-content">
        <?php the_content(); ?>
        
        <?php
        $gallery_images = denver_wild_posting_get_campaign_gallery(get_post_field('post_name'));
        if (!empty($gallery_images)):
        ?>
          <section class="campaign-gallery">
            <h3>Campaign Gallery</h3>
            <div class="campaign-gallery-grid">
              <?php foreach ($gallery_images as $image_url): ?>
                <figure class="campaign-gallery-item">
                  <img src="<?php echo esc_url($image_url); ?>" alt="<?php echo esc_attr(get_the_title()); ?> photo" loading="lazy" />
                </figure>
              <?php endforeach; ?>
            </div>
          </section>
        <?php endif; ?>

        <?php if ($role): ?>
          <div class="campaign-role">
            <h3>Role</h3>
            <p><?php echo esc_html($role); ?></p>
          </div>
        <?php endif; ?>
        
        <?php if ($metrics): ?>
          <div class="campaign-metrics">
            <h3>Metrics</h3>
            <p><?php echo esc_html($metrics); ?></p>
          </div>
        <?php endif; ?>
      </div>
    </article>
  <?php endwhile; ?>
</main>

<?php get_footer(); ?>
