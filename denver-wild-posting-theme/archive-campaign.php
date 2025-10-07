<?php get_header(); ?>

<main>
  <section class="campaigns-archive">
    <header class="archive-header">
      <h1>Campaigns</h1>
      <p>Our wild posting campaigns across Denver</p>
    </header>

    <div class="campaigns-grid">
      <?php if (have_posts()) : ?>
        <?php while (have_posts()) : the_post(); ?>
          <article class="campaign-card">
            <?php if (has_post_thumbnail()): ?>
              <div class="campaign-image">
                <a href="<?php the_permalink(); ?>">
                  <?php the_post_thumbnail('medium'); ?>
                </a>
              </div>
            <?php endif; ?>
            
            <div class="campaign-info">
              <h2 class="campaign-title">
                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
              </h2>
              
              <div class="campaign-meta">
                <?php 
                $client = get_post_meta(get_the_ID(), '_campaign_client', true);
                $city = get_post_meta(get_the_ID(), '_campaign_city', true);
                $year = get_post_meta(get_the_ID(), '_campaign_year', true);
                ?>
                
                <?php if ($client): ?>
                  <span class="campaign-client"><?php echo esc_html($client); ?></span>
                <?php endif; ?>
                
                <?php if ($city): ?>
                  <span class="campaign-city"><?php echo esc_html($city); ?></span>
                <?php endif; ?>
                
                <?php if ($year): ?>
                  <span class="campaign-year"><?php echo esc_html($year); ?></span>
                <?php endif; ?>
              </div>
              
              <div class="campaign-excerpt">
                <?php the_excerpt(); ?>
              </div>
            </div>
          </article>
        <?php endwhile; ?>
      <?php else : ?>
        <p>No campaigns found.</p>
      <?php endif; ?>
    </div>

    <?php
    // Pagination
    the_posts_pagination(array(
        'mid_size'  => 2,
        'prev_text' => __('Previous', 'denver-wild-posting'),
        'next_text' => __('Next', 'denver-wild-posting'),
    ));
    ?>
  </section>
</main>

<?php get_footer(); ?>
