</div> <!-- end #container -->
<?php global $selected_template;
    $arr = (array)$selected_template;
    if (!empty($arr)) {
        $sections = $selected_template->sections;
        foreach ($sections as $section) {
            $key = $section->key;
            if ($key == 'footer') { ?>
    <div id="footer">
        <div class="section"><?php
            foreach ($section->regions as $region) {
                drbase_renderRegion($region);
            }?>
            </div>
    </div> <!-- end #header -->
    <?php       break;
            }
        }
    } else {
    ?>
    <footer role="contentinfo">
    
        <div id="inner-footer" class="clearfix">
          <hr />
          <div id="widget-footer" class="clearfix row">
            <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('footer1') ) : ?>
            <?php endif; ?>
            <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('footer2') ) : ?>
            <?php endif; ?>
            <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('footer3') ) : ?>
            <?php endif; ?>
          </div>
            
            <nav class="clearfix">
                <?php wp_bootstrap_footer_links(); // Adjust using Menus in Wordpress Admin ?>
            </nav>
            
            <p class="pull-right"><a href="http://320press.com" id="credit320" title="By the dudes of 320press">320press</a></p>
    
            <p class="attribution">&copy; <?php bloginfo('name'); ?></p>
        
        </div> <!-- end #inner-footer -->
        
    </footer> <!-- end footer --><?php }?>
</div> <!-- end #wrapper -->
<!--[if lt IE 7 ]>
    <script src="//ajax.googleapis.com/ajax/libs/chrome-frame/1.0.3/CFInstall.min.js"></script>
    <script>window.attachEvent('onload',function(){CFInstall.check({mode:'overlay'})})</script>
<![endif]-->

<?php wp_footer(); // js scripts are inserted using this function ?>

	</body>

</html>