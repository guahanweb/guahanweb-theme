    <footer class="footer-section">
      <div class="w-container">
        <div class="w-row">
          <div class="w-col w-col-3">
            <a href="/" class="logo-footer w-nav-brand w--current">
              <div class="footer-logo logo-text">
                GUAHAN<strong>WEB</strong>
              </div>
            </a>
          </div>
          <div class="w-col w-col-9 w-clearfix footer-link-col">
            <?php get_template_part('nav/bottom'); ?>
          </div>
        </div>
      </div>
    </footer>
    <script>
      var GW_AJAXURL = '<?php echo admin_url('admin-ajax.php'); ?>';
    </script>
    <?php wp_footer(); ?>
    <?php get_template_part('analytics'); ?>
  </body>
</html>
