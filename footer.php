</div>
    <footer>
      <div class="container">
        <nav class="footer-navi">
            <ul>

              <?php 
              $args = array(
                'theme_location' => 'place_footer',
                'container'      => false,
              );
              wp_nav_menu( $args );
              ?>
              
            </ul>
          </nav>
          <div class="footer-logo">footer</div>
      </div>
    </footer>
  <?php wp_footer(); ?>
  </body>
  </html>