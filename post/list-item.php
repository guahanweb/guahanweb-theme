        <div class="blog-block w-col w-col-4 w-dyn-item">
          <a class="blog-link project-link w-inline-block" href="<?php the_permalink(); ?>">
            <div class="blog-image-wrapper">
              <div class="blog-date"><?php the_date(); ?></div>
              <div class="blog-category nodejs">Node.js</div>
              <div class="blog-image"></div>
            </div>
            <div class="blog-title"><?php echo $post->post_title; ?></div>
            <div class="blog-description"><?php echo $post->post_excerpt; ?></div>
            <div>
              <div class="blog-author">Written by</div>
              <div class="blog-author"><?php the_author(); ?></div>
            </div>
          </a>
        </div>

