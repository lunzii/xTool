<?php

/**
  ReduxFramework Sample Config File
  For full documentation, please visit: https://docs.reduxframework.com
 * */

if ( !class_exists( 'ReduxFramework' ) && file_exists( dirname( __FILE__ ) . '/inc/redux-framework.php' ) ) {
    require_once(dirname( __FILE__ ) . '/inc/redux-framework.php' );
}

if (!class_exists('Redux_Framework_Config')) {

    class Redux_Framework_Config {

        public $args        = array();
        public $sections    = array();
        public $theme;
        public $ReduxFramework;

        public function __construct() {

            if (!class_exists('ReduxFramework')) {
                return;
            }

            // This is needed. Bah WordPress bugs.  ;)
            if (  true == Redux_Helpers::isTheme(__FILE__) ) {
                $this->initSettings();
            } else {
                add_action('plugins_loaded', array($this, 'initSettings'), 10);
            }

        }

        public function initSettings() {

            // Just for demo purposes. Not needed per say.
            $this->theme = wp_get_theme();

            // Set the default arguments
            $this->setArguments();

            // Set a few help tabs so you can see how it's done
            $this->setHelpTabs();

            // Create the sections and fields
            $this->setSections();

            if (!isset($this->args['opt_name'])) { // No errors please
                return;
            }

            // If Redux is running as a plugin, this will remove the demo notice and links
            //add_action( 'redux/loaded', array( $this, 'remove_demo' ) );
            
            // Function to test the compiler hook and demo CSS output.
            // Above 10 is a priority, but 2 in necessary to include the dynamically generated CSS to be sent to the function.
            //add_filter('redux/options/'.$this->args['opt_name'].'/compiler', array( $this, 'compiler_action' ), 10, 3);
            
            // Change the arguments after they've been declared, but before the panel is created
            //add_filter('redux/options/'.$this->args['opt_name'].'/args', array( $this, 'change_arguments' ) );
            
            // Change the default value of a field after it's been set, but before it's been useds
            //add_filter('redux/options/'.$this->args['opt_name'].'/defaults', array( $this,'change_defaults' ) );
            
            // Dynamically add a section. Can be also used to modify sections/fields
            //add_filter('redux/options/' . $this->args['opt_name'] . '/sections', array($this, 'dynamic_section'));

            $this->ReduxFramework = new ReduxFramework($this->sections, $this->args);
        }

        /**

          This is a test function that will let you see when the compiler hook occurs.
          It only runs if a field   set with compiler=>true is changed.

         * */
        function compiler_action($options, $css, $changed_values) {
            echo '<h1>The compiler hook has run!</h1>';
            echo "<pre>";
            print_r($changed_values); // Values that have changed since the last save
            echo "</pre>";
            //print_r($options); //Option values
            //print_r($css); // Compiler selector CSS values  compiler => array( CSS SELECTORS )

            /*
              // Demo of how to use the dynamic CSS and write your own static CSS file
              $filename = dirname(__FILE__) . '/style' . '.css';
              global $wp_filesystem;
              if( empty( $wp_filesystem ) ) {
                require_once( ABSPATH .'/wp-admin/includes/file.php' );
              WP_Filesystem();
              }

              if( $wp_filesystem ) {
                $wp_filesystem->put_contents(
                    $filename,
                    $css,
                    FS_CHMOD_FILE // predefined mode settings for WP files
                );
              }
             */
        }

        /**

          Custom function for filtering the sections array. Good for child themes to override or add to the sections.
          Simply include this function in the child themes functions.php file.

          NOTE: the defined constants for URLs, and directories will NOT be available at this point in a child theme,
          so you must use get_template_directory_uri() if you want to use any of the built in icons

         * */
        function dynamic_section($sections) {
            //$sections = array();
            $sections[] = array(
                'title' => __('Section via hook', MD_THEME_NAME),
                'desc' => __('<p class="description">This is a section created by adding a filter to the sections array. Can be used by child themes to add/remove sections from the options.</p>', MD_THEME_NAME),
                'icon' => 'el-icon-paper-clip',
                // Leave this as a blank section, no options just some intro text set above.
                'fields' => array()
            );

            return $sections;
        }

        /**

          Filter hook for filtering the args. Good for child themes to override or add to the args array. Can also be used in other functions.

         * */
        function change_arguments($args) {
            //$args['dev_mode'] = true;

            return $args;
        }

        /**

          Filter hook for filtering the default value of any given field. Very useful in development mode.

         * */
        function change_defaults($defaults) {
            $defaults['str_replace'] = 'Testing filter hook!';

            return $defaults;
        }

        // Remove the demo link and the notice of integrated demo from the redux-framework plugin
        function remove_demo() {

            // Used to hide the demo mode link from the plugin page. Only used when Redux is a plugin.
            if (class_exists('ReduxFrameworkPlugin')) {
                remove_filter('plugin_row_meta', array(ReduxFrameworkPlugin::instance(), 'plugin_metalinks'), null, 2);

                // Used to hide the activation notice informing users of the demo panel. Only used when Redux is a plugin.
                remove_action('admin_notices', array(ReduxFrameworkPlugin::instance(), 'admin_notices'));
            }
        }

        public function setSections() {
            
            $md_animations = array('' => 'No Animation', 'flash' => __('Flash', 'js_composer'),'bounce' => __('Bounce', 'js_composer'),'shake' => __('Shake', 'js_composer'),'tada' => __('Tada', 'js_composer'),'swing' => __('Swing', 'js_composer'),'wobble' => __('Wobble', 'js_composer'),'pulse' => __('Pulse', 'js_composer'),'flip' => __('Flip', 'js_composer'),'flipInX' => __('FlipInX', 'js_composer'),'flipOutX' => __('FlipOutX', 'js_composer'),'flipInY' => __('FlipInY', 'js_composer'),'flipOutY' => __('FlipOutY', 'js_composer'),'fadeIn' => __('FadeIn', 'js_composer'),'fadeInUp' => __('FadeInUp', 'js_composer'),'fadeInDown' => __('FadeInDown', 'js_composer'),'fadeInLeft' => __('FadeInLeft', 'js_composer'),'fadeInRight' => __('FadeInRight', 'js_composer'),'fadeInUpBig' => __('FadeInUpBig', 'js_composer'),'fadeInDownBig' => __('FadeInDownBig', 'js_composer'),'fadeInLeftBig' => __('FadeInLeftBig', 'js_composer'),'fadeInRightBig' => __('FadeInRightBig', 'js_composer'),'slideInDown' => __('SlideInDown', 'js_composer'),'slideInLeft' => __('SlideInLeft', 'js_composer'),'slideInRight' => __('SlideInRight', 'js_composer'),'slideOutUp' => __('SlideOutUp', 'js_composer'),'slideOutLeft' => __('SlideOutLeft', 'js_composer'),'slideOutRight' => __('SlideOutRight', 'js_composer'),'bounceIn' => __('BounceIn', 'js_composer'),'bounceInDown' => __('BounceInDown', 'js_composer'),'bounceInUp' => __('BounceInUp', 'js_composer'),'bounceInLeft' => __('BounceInLeft', 'js_composer'),'bounceInRight' => __('BounceInRight', 'js_composer'),'bounceOut' => __('BounceOut', 'js_composer'),'bounceOutDown' => __('BounceOutDown', 'js_composer'),'bounceOutUp' => __('BounceOutUp', 'js_composer'),'bounceOutLeft' => __('BounceOutLeft', 'js_composer'),'bounceOutRight' => __('BounceOutRight', 'js_composer'),'rotateIn' => __('RotateIn', 'js_composer'),'rotateInDownLeft' => __('RotateInDownLeft', 'js_composer'),'rotateInDownRight' => __('RotateInDownRight', 'js_composer'),'rotateInUpLeft' => __('RotateInUpLeft', 'js_composer'),'rotateInUpRight' => __('RotateInUpRight', 'js_composer'),'rotateOut' => __('RotateOut', 'js_composer'),'rotateOutDownLeft' => __('RotateOutDownLeft', 'js_composer'),'rotateOutDownRight' => __('RotateOutDownRight', 'js_composer'),'rotateOutUpLeft' => __('RotateOutUpLeft', 'js_composer'),'rotateOutUpRight' => __('RotateOutUpRight', 'js_composer'),'lightSpeedIn' => __('LightSpeedIn', 'js_composer'),'lightSpeedOut' => __('LightSpeedOut', 'js_composer'),'hinge' => __('Hinge', 'js_composer'),'rollIn' => __('RollIn', 'js_composer'),'rollOut' => __('RollOut', 'js_composer'));
            /**
              Used within different fields. Simply examples. Search for ACTUAL DECLARATION for field examples
             * */
            // Background Patterns Reader
            $sample_patterns_path   = ReduxFramework::$_dir . '../sample/patterns/';
            $sample_patterns_url    = ReduxFramework::$_url . '../sample/patterns/';
            $sample_patterns        = array();

            if (is_dir($sample_patterns_path)) :

                if ($sample_patterns_dir = opendir($sample_patterns_path)) :
                    $sample_patterns = array();

                    while (( $sample_patterns_file = readdir($sample_patterns_dir) ) !== false) {

                        if (stristr($sample_patterns_file, '.png') !== false || stristr($sample_patterns_file, '.jpg') !== false) {
                            $name = explode('.', $sample_patterns_file);
                            $name = str_replace('.' . end($name), '', $sample_patterns_file);
                            $sample_patterns[]  = array('alt' => $name, 'img' => $sample_patterns_url . $sample_patterns_file);
                        }
                    }
                endif;
            endif;

            ob_start();

            $ct             = wp_get_theme();
            $this->theme    = $ct;
            $item_name      = $this->theme->get('Name');
            $tags           = $this->theme->Tags;
            $screenshot     = $this->theme->get_screenshot();
            $class          = $screenshot ? 'has-screenshot' : '';

            $customize_title = sprintf(__('Customize &#8220;%s&#8221;', MD_THEME_NAME), $this->theme->display('Name'));
            
            ?>
            <div id="current-theme" class="<?php echo esc_attr($class); ?>">
            <?php if ($screenshot) : ?>
                <?php if (current_user_can('edit_theme_options')) : ?>
                        <a href="<?php echo wp_customize_url(); ?>" class="load-customize hide-if-no-customize" title="<?php echo esc_attr($customize_title); ?>">
                            <img src="<?php echo esc_url($screenshot); ?>" alt="<?php esc_attr_e('Current theme preview'); ?>" />
                        </a>
                <?php endif; ?>
                    <img class="hide-if-customize" src="<?php echo esc_url($screenshot); ?>" alt="<?php esc_attr_e('Current theme preview'); ?>" />
                <?php endif; ?>

                <h4><?php echo $this->theme->display('Name'); ?></h4>

                <div>
                    <ul class="theme-info">
                        <li><?php printf(__('By %s', MD_THEME_NAME), $this->theme->display('Author')); ?></li>
                        <li><?php printf(__('Version %s', MD_THEME_NAME), $this->theme->display('Version')); ?></li>
                        <li><?php echo '<strong>' . __('Tags', MD_THEME_NAME) . ':</strong> '; ?><?php printf($this->theme->display('Tags')); ?></li>
                    </ul>
                    <p class="theme-description"><?php echo $this->theme->display('Description'); ?></p>
            <?php
            if ($this->theme->parent()) {
                printf(' <p class="howto">' . __('This <a href="%1$s">child theme</a> requires its parent theme, %2$s.') . '</p>', __('http://codex.wordpress.org/Child_Themes', MD_THEME_NAME), $this->theme->parent()->display('Name'));
            }
            ?>

                </div>
            </div>

            <?php
            $item_info = ob_get_contents();

            ob_end_clean();

            $sampleHTML = '';
            if (file_exists(dirname(__FILE__) . '/info-html.html')) {
                /** @global WP_Filesystem_Direct $wp_filesystem  */
                global $wp_filesystem;
                if (empty($wp_filesystem)) {
                    require_once(ABSPATH . '/wp-admin/includes/file.php');
                    WP_Filesystem();
                }
                $sampleHTML = $wp_filesystem->get_contents(dirname(__FILE__) . '/info-html.html');
            }

            // ACTUAL DECLARATION OF SECTIONS
            $this->sections[] = array(
                'title'     => __('General', MD_THEME_NAME),
                'icon'      => 'lineicon-settings3',
                'fields'    => array(

                    array(
                        'id'            => 'site-layout',
                        'type'          => 'image_select',
                        'title'         => __('Site Layout', MD_THEME_NAME), 
                        'subtitle'      => __('Choose your site layout', MD_THEME_NAME),
                        'options' => array(
                                        'full-width' => array('title' => 'Full Width', 'img' => MD_THEME_URI.'/framework/assets/img/theme-options/layout-full.png'),
                                        'boxed' => array('title' => 'Boxed', 'img' => MD_THEME_URI.'/framework/assets/img/theme-options/layout-boxed.png'),
                                        ),
                        'default' => 'full-width',
                    ),

                    array(
                        'id'        => 'logo',
                        'type'      => 'media', 
                        'title'     => __('Logo', MD_THEME_NAME),
                        'subtitle'  => __('Upload your logo.', MD_THEME_NAME),
                    ),

                    array(
                        'id'        => 'logo-retina',
                        'type'      => 'media', 
                        'title'     => __('Logo Retina', MD_THEME_NAME),
                        'subtitle'  => __('Upload your logo for retina devices. Make sure that your image ends with symbols @2x (example logo@2x.png)', MD_THEME_NAME),
                    ),

                    array(
                        'id'        => 'accent-color',
                        'type'      => 'color',
                        'title'     => __('Accent color', MD_THEME_NAME),
                        'subtitle'  => __('Set accent color.', MD_THEME_NAME),
                        'validate'  => 'color',
                        'default'   => '#19B5FE',
                    ),

                    array(
                        'id'        => 'body-bgcolor',
                        'type'      => 'color',
                        'title'     => __('Body background color', MD_THEME_NAME),
                        'subtitle'  => __('Pick body background color.', MD_THEME_NAME),
                        'validate'  => 'color',
                        'default'   => '#141719',
                    ),

                    array(
                        'id'        => 'body-bgimage',
                        'type'      => 'media',
                        'title'     => __('Body background image', MD_THEME_NAME),
                        'subtitle'  => __('Pick body background image.', MD_THEME_NAME),
                    ),

                    array(
                        'id'        => 'favicon',
                        'type'      => 'media', 
                        'title'     => __('Favicon', MD_THEME_NAME),
                        'subtitle'  => __('Upload your favicon.', MD_THEME_NAME),
                    ),

                    array(
                        'id'        => 'apple-icon-57',
                        'type'      => 'media', 
                        'title'     => __('Apple Touch Icon IPhone', MD_THEME_NAME),
                        'subtitle'  => __('57x57 pixel for iPhone and iPod touch. Recommended format must be one of PNG, GIF, or JPG.', MD_THEME_NAME),
                    ),

                    array(
                        'id'        => 'apple-icon-72',
                        'type'      => 'media', 
                        'title'     => __('Apple Touch Icon IPad', MD_THEME_NAME),
                        'subtitle'  => __('72x72 pixel for iPhone and iPod touch. Recommended format must be one of PNG, GIF, or JPG.', MD_THEME_NAME),
                    ),

                    array(
                        'id'        => 'apple-icon-114',
                        'type'      => 'media', 
                        'title'     => __('Apple Touch Icon IPhone ( Retina )', MD_THEME_NAME),
                        'subtitle'  => __('114 x 114 pixel for high-resolution iPhone and iPod touch. Recommended format must be one of PNG, GIF, or JPG.', MD_THEME_NAME),
                    ),

                    array(
                        'id'        => 'apple-icon-144',
                        'type'      => 'media', 
                        'title'     => __('Apple Touch Icon IPad ( Retina )', MD_THEME_NAME),
                        'subtitle'  => __('144 x 144 pixel for high-resolution iPad. Recommended format must be one of PNG, GIF, or JPG.', MD_THEME_NAME),
                    ),
                    array(
                        'id'        => 'back-top',
                        'type'      => 'switch', 
                        'title'     => __('Back to Top', MD_THEME_NAME),
                        'subtitle'  => __('Enable / disable back to top.', MD_THEME_NAME),
                        'default'   => 1
                    ),
                )
            );
            
            $this->sections[] = array(
                'title'     => __('Page Header', MD_THEME_NAME),
                'icon'      => 'lineicon-lab',
                'fields'    => array(


                    array(
                        'id'       => 'page-header-enabled',
                        'type'     => 'radio',
                        'title'    => __('Page Header enabled', MD_THEME_NAME), 
                        'subtitle' => __('Set default page header', MD_THEME_NAME),
                        'options'  => array( 'true' => 'Yes', 'false' => 'No'),
                        'default'  => 'true'
                    ),

                    array(
                        'id'            => 'page-header-title',
                        'type'          => 'typography', 
                        'title'         => __('Page Header Title', MD_THEME_NAME),
                        'subtitle'      => __('Set default page header title font style.', MD_THEME_NAME),
                        'text-align'    => false,
                        'google'        => false,
                        'default'=> array(
                            'color'         =>  "#ffffff", 
                            'font-weight'   =>  '700', 
                            'font-family'   =>  "Verdana", 
                            'font-size'     =>  '42px', 
                            'line-height'   =>  '46px',
                        ),
                    ),

                    array(
                        'id'       => 'page-header-title-animation',
                        'type'     => 'select',
                        'title'    => __('Page Header title animation', MD_THEME_NAME), 
                        'subtitle' => __('Set default page header title animation', MD_THEME_NAME),
                        'options'  => $md_animations,
                        'default'  => '',
                    ),

                    array(
                        'id'            => 'page-header-subtitle',
                        'type'          => 'typography', 
                        'title'         => __('Page Header Subtitle', MD_THEME_NAME),
                        'subtitle'      => __('Set default page header subtitle font style.', MD_THEME_NAME),
                        'text-align'    => false,
                        'google'        => false,
                        'default'=> array(
                            'color'         =>  "#ffffff", 
                            'font-weight'   =>  '500', 
                            'font-family'   =>  "Verdana", 
                            'font-size'     =>  '24px', 
                            'line-height'   =>  '26px',
                        ),
                    ),

                    array(
                        'id'       => 'page-header-subtitle-animation',
                        'type'     => 'select',
                        'title'    => __('Page Header subtitle animation', MD_THEME_NAME), 
                        'subtitle' => __('Set default page header subtitle animation', MD_THEME_NAME),
                        'options'  => $md_animations,
                        'default'  => '',
                    ),

                    array(
                        'id'       => 'page-header-padding',
                        'type'     => 'select',
                        'title'    => __('Page Header padding', MD_THEME_NAME), 
                        'subtitle' => __('Set default page header padding', MD_THEME_NAME),
                        'options'  => array(
                            'padding-small'  => 'Small', 
                            'padding-medium' => 'Medium', 
                            'padding-large' => 'Large', 
                        ),
                        'default'  => 'padding-small',
                    ),

                    array(
                        'id'       => 'page-header-align',
                        'type'     => 'select',
                        'title'    => __('Page Header align', MD_THEME_NAME), 
                        'subtitle' => __('Set default page header align', MD_THEME_NAME),
                        'options'  => array(
                            'textalignleft'  => 'Left', 
                            'textaligncenter' => 'Center', 
                            'textalignright' => 'Right', 
                        ),
                        'default'  => 'textalignleft',
                    ),
                    array(
                        'id'       => 'page-header-bgcolor',
                        'type'     => 'color',
                        'title'    => __('Page Header background color', MD_THEME_NAME), 
                        'subtitle' => __('Set default page header background color', MD_THEME_NAME),
                        'default'  => '#141719'
                    ),

                    array(
                        'id'       => 'page-header-bgimage-type',
                        'type'     => 'select',
                        'title'    => __('Page Header background image type', MD_THEME_NAME), 
                        'subtitle' => __('Set default page header background image type', MD_THEME_NAME),
                        'options'  => array(
                            'full-image'  => 'Full Image', 
                            'pattern' => 'Pattern', 
                        ),
                        'default'  => 'pattern',
                    ),

                    array(
                        'id'       => 'page-header-bgimage-attach',
                        'type'     => 'select',
                        'title'    => __('Page Header background image attach', MD_THEME_NAME), 
                        'subtitle' => __('Set default page header background image attach', MD_THEME_NAME),
                        'options'  => array(
                            'bg-parallax'  => 'Parallax', 
                            'bg-fixed' => 'Fixed', 
                            'bg-static' => 'Static', 
                        ),
                        'default'  => 'bg-static',
                    ),

                    array(
                        'id'       => 'page-header-mask',
                        'type'     => 'radio',
                        'title'    => __('Page Header mask', MD_THEME_NAME), 
                        'subtitle' => __('Set default page header mask', MD_THEME_NAME),
                        'options'  => array( 'true' => 'Yes', 'false' => 'No'),
                        'default'  => 'false'
                    ),

                    array(
                        'id'       => 'page-header-mask-bgcolor',
                        'type'     => 'color',
                        'title'    => __('Page Header mask background color', MD_THEME_NAME), 
                        'subtitle' => __('Set default page header mask background color', MD_THEME_NAME),
                        'default'  => '#000000'
                    ),
                    array(
                        'id'       => 'page-header-mask-opacity',
                        'type'     => 'select',
                        'title'    => __('Page Header mask opacity', MD_THEME_NAME), 
                        'subtitle' => __('Set default page header mask opacity', MD_THEME_NAME),
                        'options'  => array(
                            '0.9'  => '90%', 
                            '0.8'  => '80%', 
                            '0.7'  => '70%', 
                            '0.6'  => '60%', 
                            '0.5'  => '50%', 
                            '0.4'  => '40%', 
                            '0.3'  => '30%', 
                            '0.2'  => '20%', 
                            '0.1'  => '10%', 
                        ),
                        'default'  => '0.7',
                    ),


                )
            );
            
            $this->sections[] = array(
                'title'     => __('Typography', MD_THEME_NAME),
                'icon'      => 'lineicon-pen3',
                'fields'    => array(

                    array(
                        'id'            => 'font-body',
                        'type'          => 'typography', 
                        'title'         => __('Body', MD_THEME_NAME),
                        'subtitle'      => __('Set body font style.', MD_THEME_NAME),
                        'text-align'    => false,
                        'line-height'   => false,
                        'google'        => false,
                        'default'=> array(
                            'color'         =>  "#373d41", 
                            'font-weight'   =>  '500', 
                            'font-family'   =>  "Verdana", 
                            'font-size'     =>  '14px', 
                            'line-height'   =>  '25px'
                        ),
                    ),

                    array(
                        'id'            => 'font-special',
                        'type'          => 'typography', 
                        'title'         => __('Special Font', MD_THEME_NAME),
                        'subtitle'      => __('Set special font style.', MD_THEME_NAME),
                        'text-align'    => false,
                        'font-size'     => false,
                        'line-height'   => false,
                        'color'         => false,
                        'google'        => false,
                        'default'=> array(
                            'font-family'   => "Verdana", 
                        ),
                    ),

                    array(
                        'id'            => 'font-h1',
                        'type'          => 'typography', 
                        'title'         => __('H1 Heading', MD_THEME_NAME),
                        'subtitle'      => __('Set H1 font style.', MD_THEME_NAME),
                        'text-align'    => false,
                        'google'        => false,
                        'default'=> array(
                            'color'         =>  "#1e2733", 
                            'font-weight'   =>  '500', 
                            'font-family'   =>  "Verdana", 
                            'font-size'     =>  '36px', 
                            'line-height'   =>  '42px',
                        ),
                    ),

                    array(
                        'id'            => 'font-h2',
                        'type'          => 'typography', 
                        'title'         => __('H2 Heading', MD_THEME_NAME),
                        'subtitle'      => __('Set H2 font style.', MD_THEME_NAME),
                        'text-align'    => false,
                        'google'        => false,
                        'default'=> array(
                            'color'         =>  "#1e2733", 
                            'font-weight'   =>  '500', 
                            'font-family'   =>  "Verdana", 
                            'font-size'     =>  '30px', 
                            'line-height'   =>  '36px',
                        ),
                    ),

                    array(
                        'id'            => 'font-h3',
                        'type'          => 'typography', 
                        'title'         => __('H3 Heading', MD_THEME_NAME),
                        'subtitle'      => __('Set H3 font style.', MD_THEME_NAME),
                        'text-align'    => false,
                        'google'        => false,
                        'default'=> array(
                            'color'         =>  "#1e2733", 
                            'font-weight'   =>  '600', 
                            'font-family'   =>  "Verdana", 
                            'font-size'     =>  '24px', 
                            'line-height'   =>  '32px',
                        ),
                    ),

                    array(
                        'id'            => 'font-h4',
                        'type'          => 'typography', 
                        'title'         => __('H4 Heading', MD_THEME_NAME),
                        'subtitle'      => __('Set H4 font style.', MD_THEME_NAME),
                        'text-align'    => false,
                        'google'        => false,
                        'default'=> array(
                            'color'         =>  "#1e2733", 
                            'font-weight'   =>  '600', 
                            'font-family'   =>  "Verdana", 
                            'font-size'     =>  '18px', 
                            'line-height'   =>  '22px',
                        ),
                    ),

                    array(
                        'id'            => 'font-h5',
                        'type'          => 'typography', 
                        'title'         => __('H5 Heading', MD_THEME_NAME),
                        'subtitle'      => __('Set H5 font style.', MD_THEME_NAME),
                        'text-align'    => false,
                        'google'        => false,
                        'default'=> array(
                            'color'         =>  "#1e2733", 
                            'font-weight'   =>  '700', 
                            'font-family'   =>  "Verdana", 
                            'font-size'     =>  '16px', 
                            'line-height'   =>  '20px',
                        ),
                    ),

                    array(
                        'id'            => 'font-h6',
                        'type'          => 'typography', 
                        'title'         => __('H6 Heading', MD_THEME_NAME),
                        'subtitle'      => __('Set H6 font style.', MD_THEME_NAME),
                        'text-align'    => false,
                        'google'        => false,
                        'default'=> array(
                            'color'         =>  "#1e2733", 
                            'font-weight'   =>  '700', 
                            'font-family'   =>  "Verdana", 
                            'font-size'     =>  '14px', 
                            'line-height'   =>  '18px',
                        ),
                    ),
                )
            );


            $this->sections[] = array(
                'title'     => __('Header', MD_THEME_NAME),
                'icon'      => 'lineicon-world5',
                'fields'    => array(

                    array(
                        'id'       => 'header-width',
                        'type'     => 'radio',
                        'title'    => __('Header width', MD_THEME_NAME), 
                        'subtitle' => __('Set header width', MD_THEME_NAME),
                        'options'  => array( 'fixed' => 'Fixed Width', 'full' => 'Full Width'),
                        'default'  => 'fixed'
                    ),

                    array(
                        'id'       => 'header-attachment',
                        'type'     => 'radio',
                        'title'    => __('Header attachment', MD_THEME_NAME), 
                        'subtitle' => __('Set header attachment to fixed or scroll', MD_THEME_NAME),
                        'options'  => array( 'fixed' => 'Fixed', 'scroll' => 'Scroll'),
                        'default'  => 'fixed'
                    ),

                    array(
                        'id'       => 'header-scroll-resize',
                        'type'     => 'radio',
                        'title'    => __('Header resize on scroll', MD_THEME_NAME), 
                        'subtitle' => __('Toogle header resize on scroll', MD_THEME_NAME),
                        'options'  => array( 'scroll-resize' => 'Yes', '' => 'No'),
                        'default'  => 'scroll-resize',
                        'required' => array('header-attachment','=','fixed')
                    ),

                    array(
                        'id'       => 'header-scroll-transparent',
                        'type'     => 'radio',
                        'title'    => __('Header transparent on scroll', MD_THEME_NAME), 
                        'subtitle' => __('Toogle transparent resize on scroll', MD_THEME_NAME),
                        'options'  => array( 'scroll-transparent' => 'Yes', '' => 'No'),
                        'default'  => '',
                        'required' => array('header-attachment','=','fixed')
                    ),

                    array(
                        'id'       => 'header-height',
                        'type'     => 'select',
                        'title'    => __('Header height', MD_THEME_NAME),
                        'subtitle' => __('Set header height in px', MD_THEME_NAME),
                        'options'  => array(
                            '60'  => '60px', 
                            '70'  => '70px', 
                            '80'  => '80px',
                            '90'  => '90px',
                            '100'  => '100px', 
                            '110'  => '110px', 
                            '120' => '120px', 
                        ),
                        'default'  => 80,
                    ),

                    array(
                        'id'       => 'header-border',
                        'type'     => 'select',
                        'title'    => __('Header border', MD_THEME_NAME),
                        'subtitle' => __('Set header border', MD_THEME_NAME),
                        'options'  => array(
                            0  => 'No Border', 
                            1  => 'Style 1', 
                            2  => 'Style 2', 
                            3  => 'Style 3', 
                            4  => 'Style 4', 
                        ),
                        'default'  => 4,
                    ),

                    array(
                        'id'       => 'header-bgcolor',
                        'type'     => 'color',
                        'title'    => __('Header background color', MD_THEME_NAME),
                        'subtitle' => __('Pick a background color for header', MD_THEME_NAME),
                        'validate' => 'color',
                        'default'  => '#ffffff',
                    ),


                    array(
                        'id'      => 'header-woocommerce',
                        'type'    => 'switch', 
                        'title'   => __('Header WooCommerce Shop Button', MD_THEME_NAME),
                        'subtitle'=> __('Toggle Header WooCommerce Shop Button', MD_THEME_NAME),
                        'default' => 0,
                    ),

                    array(
                        'id'      => 'header-search',
                        'type'    => 'switch', 
                        'title'   => __('Header search', MD_THEME_NAME),
                        'subtitle'=> __('Toggle header search', MD_THEME_NAME),
                        'default' => 1,
                    ),

                    array(
                        'id'      => 'header-top',
                        'type'    => 'switch', 
                        'title'   => __('Header top', MD_THEME_NAME),
                        'subtitle'=> __('Toggle header Top', MD_THEME_NAME),
                        'default' => 1,
                    ),

                    array(
                        'id'      => 'header-top-bgcolor',
                        'type'     => 'color',
                        'title'    => __('Header top background color', MD_THEME_NAME),
                        'subtitle' => __('Pick a background color for header top', MD_THEME_NAME),
                        'validate' => 'color',
                        'default'  => '#ffffff',
                        'required' => array('header-top','=','1')
                    ),

                    array(
                        'id'          => 'header-top-font',
                        'type'        => 'typography', 
                        'title'       => __('Header top font', MD_THEME_NAME),
                        'subtitle'    => __('Set header top font.', MD_THEME_NAME),
                        'text-align'  => false,
                        'google'      => false,
                        'line-height' => false,
                        'default'=> array(
                            'color'         =>  "#888888", 
                            'font-weight'   =>  '500', 
                            'font-family'   =>  "Verdana", 
                            'font-size'     =>  '12px', 
                        ),
                        'required' => array('header-top','=','1')
                    ),

                    array(
                        'id'       => 'header-slogan',
                        'type'     => 'textarea',
                        'title'    => __('Slogan', MD_THEME_NAME), 
                        'subtitle' => __('Enter slogan here', MD_THEME_NAME),
                        'required' => array('header-top','=','1'),
                        'default' => 'For information <i class="icon-phone"></i> <a href="#">+39.389.44.44.444</a> or <i class="icon-envelope-alt"></i> <a href="#">info@mydomain.com</a>',
                    ),

                    array(
                        'id'      => 'header-social',
                        'type'    => 'switch', 
                        'title'   => __('Header social', MD_THEME_NAME),
                        'subtitle'=> __('Toggle header social', MD_THEME_NAME),
                        'default' => 1,
                        'required' => array('header-top','=','1')
                    ),

                )
            );


            $this->sections[] = array(
                'title'     => __('Menu', MD_THEME_NAME),
                'icon'      => 'lineicon-shop1',
                'fields'    => array(

                    array(
                        'id'      => 'menu-uppercase',
                        'type'    => 'radio', 
                        'title'   => __('Menu uppercase', MD_THEME_NAME),
                        'subtitle'=> __('Set menu uppercase', MD_THEME_NAME),
                        'options'  => array('yes' => 'Yes', 'auto' => 'No'),
                        'default'  => 'yes'
                    ),


                    array(
                        'id'            => 'menu-font',
                        'type'          => 'typography', 
                        'title'         => __('Menu Font', MD_THEME_NAME),
                        'subtitle'      => __('Set menu font style.', MD_THEME_NAME),
                        'text-align'    => false,
                        'google'        => false,
                        'line-height'   => false,
                        'default'=> array(
                            'color'         =>  "#333333", 
                            'font-weight'   =>  '600', 
                            'font-family'   =>  "Verdana", 
                            'font-size'     =>  '13px', 
                        ),
                    ),
                )
            );


            $this->sections[] = array(
                'title'     => __('Footer', MD_THEME_NAME),
                'icon'      => 'lineicon-small58',
                'fields'    => array(
                    array(
                        'id'        => 'footer-enabled',
                        'type'      => 'switch', 
                        'title'     => __('Footer', MD_THEME_NAME),
                        'subtitle'  => __('Enable / disable footer.', MD_THEME_NAME),
                        'default'   => 1
                    ),
                    array(
                        'id'=>'footer-layout',
                        'type' => 'image_select',
                        'title' => __('Footer Layout', MD_THEME_NAME), 
                        'subtitle' => __('Choose your Footer Layout', MD_THEME_NAME),
                        'options' => array(
                                        '2' => array('title' => '2 Columns', 'img' => MD_THEME_URI.'/framework/assets/img/theme-options/2col.png'),
                                        '3' => array('title' => '3 Columns', 'img' => MD_THEME_URI.'/framework/assets/img/theme-options/3col.png'),
                                        '4' => array('title' => '4 Columns', 'img' => MD_THEME_URI.'/framework/assets/img/theme-options/4col.png'),
                                        ),
                        'default' => '3',
                        'required' => array('footer-enabled','=','1')
                    ),


                    array(
                        'id'       => 'footer-bgcolor',
                        'type'     => 'color',
                        'title'    => __('Footer background color', MD_THEME_NAME),
                        'subtitle' => __('Pick a background color for footer', MD_THEME_NAME),
                        'validate' => 'color',
                        'default'  => '#141719',
                        'required' => array('footer-enabled','=','1')
                    ),

                    array(
                        'id'        => 'copyright-enabled',
                        'type'      => 'switch', 
                        'title'     => __('Copyright', MD_THEME_NAME),
                        'subtitle'  => __('Enable / disable copyright.', MD_THEME_NAME),
                        'default'   => 1
                    ),


                    array(
                        'id'=>'copyright-text',
                        'type' => 'textarea',
                        'title' => __('Copyright Text', MD_THEME_NAME), 
                        'subtitle' => __('Insert your copyright text. Html is allowed.', MD_THEME_NAME),
                        'default' => 'Premium Wordpress Theme by <a href="http://www.themesholic.com" target="_blank">Themesholic.com</a>',
                        'required' => array('copyright-enabled','=','1')               
                    ),
                    
                    array(
                        'id'       => 'copyright-bgcolor',
                        'type'     => 'color',
                        'title'    => __('Copyright background color', MD_THEME_NAME),
                        'subtitle' => __('Pick a copyright color for footer', MD_THEME_NAME),
                        'validate' => 'color',
                        'default'  => '#111',
                        'required' => array('copyright-enabled','=','1')
                    ),

                )
            );



            $this->sections[] = array(
                'title'     => __('Blog', MD_THEME_NAME),
                'icon'      => 'lineicon-leaf5',
                'fields'    => array(

                    array(
                        'id'       => 'blog-style',
                        'type'     => 'select',
                        'title'    => __('Blog style', MD_THEME_NAME),
                        'subtitle' => __('Set blog style', MD_THEME_NAME),
                        'options'  => array(
                            'classic'  => 'Classic', 
                            'masonry'  => 'Masonry', 
                        ),
                        'default'  => 'classic',
                    ),

                    array(
                        'id'      => 'blog-masonry-cols',
                        'type'    => 'select', 
                        'title'    => __('Shop blog columns', MD_THEME_NAME),
                        'subtitle' => __('Set blog columns', MD_THEME_NAME),
                        'options'  => array(
                            6 => '2', 
                            4 => '3', 
                            3 => '4', 
                        ),
                        'default'  => 4,
                        'required' => array('blog-style','=','masonry')
                    ),

                    array(
                        'id'       => 'blog-images-size',
                        'type'     => 'select',
                        'title'    => __('Blog Images Size', MD_THEME_NAME),
                        'subtitle' => __('Set blog images size', MD_THEME_NAME),
                        'options'  => array(
                            'md-blog'         => 'Standard', 
                            'md-two-thirds'   => 'Big', 
                        ),
                        'default'  => 'md-blog',
                    ),

                    array(
                        'id'       => 'blog-sidebar',
                        'type'     => 'select',
                        'title'    => __('Blog sidebar', MD_THEME_NAME),
                        'subtitle' => __('Set blog sidebar', MD_THEME_NAME),
                        'options'  => array(
                            'none'  => 'None', 
                            'left'  => 'Left', 
                            'right' => 'Right', 
                        ),
                        'default'  => 'right',
                    ),

                    array(
                        'id'       => 'post-sidebar',
                        'type'     => 'select',
                        'title'    => __('Post sidebar', MD_THEME_NAME),
                        'subtitle' => __('Set post sidebar', MD_THEME_NAME),
                        'options'  => array(
                            'none'  => 'None', 
                            'left'  => 'Left', 
                            'right' => 'Right', 
                        ),
                        'default'  => 'right',
                    ),

                    array(
                        'id'       => 'post-show-author',
                        'type'     => 'switch',
                        'title'    => __('Show post author', MD_THEME_NAME),
                        'subtitle' => __('Toggle post author', MD_THEME_NAME),
                        'default'  => 1,
                    ),

                    array(
                        'id'       => 'post-show-categories',
                        'type'     => 'switch',
                        'title'    => __('Show post categories', MD_THEME_NAME),
                        'subtitle' => __('Toggle post categories', MD_THEME_NAME),
                        'default'  => 1,
                    ),

                    array(
                        'id'       => 'post-show-tags',
                        'type'     => 'switch',
                        'title'    => __('Show post tags', MD_THEME_NAME),
                        'subtitle' => __('Toggle post tags', MD_THEME_NAME),
                        'default'  => 0,
                    ),

                    array(
                        'id'       => 'post-show-date',
                        'type'     => 'switch',
                        'title'    => __('Show post date', MD_THEME_NAME),
                        'subtitle' => __('Toggle post date', MD_THEME_NAME),
                        'default'  => 1,
                    ),

                    array(
                        'id'       => 'post-show-comments-count',
                        'type'     => 'switch',
                        'title'    => __('Show post comments count', MD_THEME_NAME),
                        'subtitle' => __('Toggle post comments count', MD_THEME_NAME),
                        'default'  => 1,
                    ),


                )
            );

            $this->sections[] = array(
                'title'     => __('Portfolio', MD_THEME_NAME),
                'icon'      => 'lineicon-fire',
                'fields'    => array(

                     array(
                        'id'       => 'portfolio-pagination',
                        'type'     => 'switch',
                        'title'    => __('Show portfolio pagination', MD_THEME_NAME),
                        'subtitle' => __('Toggle portfolio pagination', MD_THEME_NAME),
                        'default'  => 1,
                    ),

                    array(
                        'id'       => 'portfolio-url',
                        'type'     => 'text',
                        'title'    => __('Portfolio url', MD_THEME_NAME), 
                        'subtitle' => __('Set the url of your portfolio', MD_THEME_NAME),
                        'default'  => '',
                        'required' => array('portfolio-pagination','=',1)
                    ),

                )
            );

            $this->sections[] = array(
                'title'     => __('WooCommerce', MD_THEME_NAME),
                'icon'      => 'lineicon-small59',
                'fields'    => array(

                    array(
                        'id'       => 'woocommerce-sidebar',
                        'type'     => 'select',
                        'title'    => __('Shop sidebar', MD_THEME_NAME),
                        'subtitle' => __('Set shop sidebar', MD_THEME_NAME),
                        'options'  => array(
                            'none'  => 'None', 
                            'left'  => 'Left', 
                            'right'  => 'Right', 
                        ),
                        'default'  => 'left',
                    ),

                    array(
                        'id'       => 'woocommerce-products-cols',
                        'type'     => 'select',
                        'title'    => __('Shop products columns', MD_THEME_NAME),
                        'subtitle' => __('Set shop products columns', MD_THEME_NAME),
                        'options'  => array(
                            2 => '2', 
                            3 => '3', 
                            4 => '4', 
                        ),
                        'default'  => 3,
                    ),


                )
            );


            $this->sections[] = array(
                'title'     => __('Social', MD_THEME_NAME),
                'icon'      => 'lineicon-user12',
                'fields'    => array(

                    array(
                        'id'       => 'social-rss',
                        'type'     => 'text',
                        'title'    => __('RSS Url', MD_THEME_NAME),
                        'subtitle' => __('Enter your RSS URL', MD_THEME_NAME),
                    ),

                    array(
                        'id'       => 'social-facebook',
                        'type'     => 'text',
                        'title'    => __('Facebook Profile', MD_THEME_NAME),
                        'subtitle' => __('Enter your Facebook Profile URL', MD_THEME_NAME),
                        'default'  => 'https://www.facebook.com/ThemesHolic'
                    ),

                    array(
                        'id'       => 'social-twitter',
                        'type'     => 'text',
                        'title'    => __('Twitter Profile', MD_THEME_NAME),
                        'subtitle' => __('Enter your Twitter Profile URL', MD_THEME_NAME),
                        'default'  => 'https://twitter.com/ThemesHolic'
                    ),

                    array(
                        'id'       => 'social-google-plus',
                        'type'     => 'text',
                        'title'    => __('Google Plus Profile', MD_THEME_NAME),
                        'subtitle' => __('Enter your Google Plus Profile URL', MD_THEME_NAME),
                    ),

                    array(
                        'id'       => 'social-youtube',
                        'type'     => 'text',
                        'title'    => __('Youtube Profile', MD_THEME_NAME),
                        'subtitle' => __('Enter your Youtube Profile URL', MD_THEME_NAME),
                    ),

                    array(
                        'id'       => 'social-linkedin',
                        'type'     => 'text',
                        'title'    => __('LinkedIn Profile', MD_THEME_NAME),
                        'subtitle' => __('Enter your LinkedIn Profile URL', MD_THEME_NAME),
                    ),

                    array(
                        'id'       => 'social-pinterest',
                        'type'     => 'text',
                        'title'    => __('Pinterest Profile', MD_THEME_NAME),
                        'subtitle' => __('Enter your Pinterest Profile URL', MD_THEME_NAME),
                    ),

                    array(
                        'id'       => 'social-flickr',
                        'type'     => 'text',
                        'title'    => __('Flickr Profile', MD_THEME_NAME),
                        'subtitle' => __('Enter your Flickr Profile URL', MD_THEME_NAME),
                    ),

                    array(
                        'id'       => 'social-instagram',
                        'type'     => 'text',
                        'title'    => __('Instagram Profile', MD_THEME_NAME),
                        'subtitle' => __('Enter your Instagram Profile URL', MD_THEME_NAME),
                    ),

                    array(
                        'id'       => 'social-tumblr',
                        'type'     => 'text',
                        'title'    => __('Tumblr Profile', MD_THEME_NAME),
                        'subtitle' => __('Enter your Tumblr Profile URL', MD_THEME_NAME),
                    ),

                    array(
                        'id'       => 'social-dribbble',
                        'type'     => 'text',
                        'title'    => __('Dribbble Profile', MD_THEME_NAME),
                        'subtitle' => __('Enter your Dribbble Profile URL', MD_THEME_NAME),
                        'default'  => 'https://dribbble.com/ThemesHolic'
                    ),

                    array(
                        'id'       => 'social-apple',
                        'type'     => 'text',
                        'title'    => __('Apple Profile', MD_THEME_NAME),
                        'subtitle' => __('Enter your Apple Profile URL', MD_THEME_NAME),
                    ),

                    array(
                        'id'       => 'social-android',
                        'type'     => 'text',
                        'title'    => __('Android Profile', MD_THEME_NAME),
                        'subtitle' => __('Enter your Android Profile URL', MD_THEME_NAME),
                    ),

                    array(
                        'id'       => 'social-email',
                        'type'     => 'text',
                        'title'    => __('Email Address', MD_THEME_NAME),
                        'subtitle' => __('Enter your Email address', MD_THEME_NAME),
                    ),


                )
            );

            $this->sections[] = array(
                'title'     => __('Custom JS/CSS', MD_THEME_NAME),
                'icon'      => 'lineicon-small57',
                'fields'    => array(

                    array(
                        'id'            => 'tracking-code',
                        'type'          => 'ace_editor',
                        'title'         => __('Tracking Code', MD_THEME_NAME), 
                        'subtitle'      => __('Put here your tracking code', MD_THEME_NAME),
                    ),

                    array(
                        'id'            => 'custom-css',
                        'type'          => 'ace_editor',
                        'title'         => __('Custom CSS', MD_THEME_NAME), 
                        'subtitle'      => __('Put here your custom CSS', MD_THEME_NAME),
                        'mode'          => 'css'
                    ),

                    array(
                        'id'            => 'custom-js',
                        'type'          => 'ace_editor',
                        'title'         => __('Custom JS', MD_THEME_NAME), 
                        'subtitle'      => __('Put here your custom JS', MD_THEME_NAME),
                    ),

                )
            );


            if (file_exists(trailingslashit(dirname(__FILE__)) . 'README.html')) {
                $tabs['docs'] = array(
                    'icon'      => 'el-icon-book',
                    'title'     => __('Documentation', MD_THEME_NAME),
                    'content'   => nl2br(file_get_contents(trailingslashit(dirname(__FILE__)) . 'README.html'))
                );
            }
        }

        public function setHelpTabs() {

            // Custom page help tabs, displayed using the help API. Tabs are shown in order of definition.
            $this->args['help_tabs'][] = array(
                'id'        => 'redux-help-tab-1',
                'title'     => __('Theme Information 1', MD_THEME_NAME),
                'content'   => __('<p>This is the tab content, HTML is allowed.</p>', MD_THEME_NAME)
            );

            $this->args['help_tabs'][] = array(
                'id'        => 'redux-help-tab-2',
                'title'     => __('Theme Information 2', MD_THEME_NAME),
                'content'   => __('<p>This is the tab content, HTML is allowed.</p>', MD_THEME_NAME)
            );

            // Set the help sidebar
            $this->args['help_sidebar'] = __('<p>This is the sidebar content, HTML is allowed.</p>', MD_THEME_NAME);
        }

        /**

          All the possible arguments for Redux.
          For full documentation on arguments, please refer to: https://github.com/ReduxFramework/ReduxFramework/wiki/Arguments

         * */
        public function setArguments() {

            $theme = wp_get_theme(); // For use with some settings. Not necessary.

            $this->args = array(
                // TYPICAL -> Change these values as you need/desire
                'opt_name'          => MD_THEME_NAME,            // This is where your data is stored in the database and also becomes your global variable name.
                'display_name'      => $theme->get('Name'),     // Name that appears at the top of your panel
                'display_version'   => $theme->get('Version'),  // Version that appears at the top of your panel
                'menu_type'         => 'menu',                  //Specify if the admin menu should appear or not. Options: menu or submenu (Under appearance only)
                'allow_sub_menu'    => true,                    // Show the sections below the admin menu item or not
                'menu_title'        => __('Theme Options', MD_THEME_NAME),
                'page_title'        => __('Theme Options', MD_THEME_NAME),
                
                // You will need to generate a Google API key to use this feature.
                // Please visit: https://developers.google.com/fonts/docs/developer_api#Auth
                'google_api_key'    => 'AIzaSyAX_2L_UzCDPEnAHTG7zhESRVpMPS4ssII', // Must be defined to add google fonts to the typography module
                
                'async_typography'  => false,                    // Use a asynchronous font on the front end or font string
                'admin_bar'         => true,                    // Show the panel pages on the admin bar
                'global_variable'   => '',                      // Set a different name for your global variable other than the opt_name
                'dev_mode'          => false,                    // Show the time the page took to load, etc
                'customizer'        => true,                    // Enable basic customizer support
                //'open_expanded'     => true,                    // Allow you to start the panel in an expanded way initially.
                //'disable_save_warn' => true,                    // Disable the save warning when a user changes a field

                // OPTIONAL -> Give you extra features
                'page_priority'     => null,                    // Order where the menu appears in the admin area. If there is any conflict, something will not show. Warning.
                'page_parent'       => 'themes.php',            // For a full list of options, visit: http://codex.wordpress.org/Function_Reference/add_submenu_page#Parameters
                'page_permissions'  => 'manage_options',        // Permissions needed to access the options panel.
                'menu_icon'         => '',                      // Specify a custom URL to an icon
                'last_tab'          => '',                      // Force your panel to always open to a specific tab (by id)
                'page_icon'         => 'icon-themes',           // Icon displayed in the admin panel next to your menu_title
                'page_slug'         => '_options',              // Page slug used to denote the panel
                'save_defaults'     => true,                    // On load save the defaults to DB before user clicks save or not
                'default_show'      => false,                   // If true, shows the default value next to each field that is not the default value.
                'default_mark'      => '',                      // What to print by the field's title if the value shown is default. Suggested: *
                'show_import_export' => true,                   // Shows the Import/Export panel when not used as a field.
                
                // CAREFUL -> These options are for advanced use only
                'transient_time'    => 60 * MINUTE_IN_SECONDS,
                'output'            => true,                    // Global shut-off for dynamic CSS output by the framework. Will also disable google fonts output
                'output_tag'        => true,                    // Allows dynamic CSS to be generated for customizer and google fonts, but stops the dynamic CSS from going to the head
                // 'footer_credit'     => '',                   // Disable the footer credit of Redux. Please leave if you can help it.
                
                // FUTURE -> Not in use yet, but reserved or partially implemented. Use at your own risk.
                'database'              => '', // possible: options, theme_mods, theme_mods_expanded, transient. Not fully functional, warning!
                'system_info'           => false, // REMOVE

                // HINTS
                'hints' => array(
                    'icon'          => 'icon-question-sign',
                    'icon_position' => 'right',
                    'icon_color'    => 'lightgray',
                    'icon_size'     => 'normal',
                    'tip_style'     => array(
                        'color'         => 'light',
                        'shadow'        => true,
                        'rounded'       => false,
                        'style'         => '',
                    ),
                    'tip_position'  => array(
                        'my' => 'top left',
                        'at' => 'bottom right',
                    ),
                    'tip_effect'    => array(
                        'show'          => array(
                            'effect'        => 'slide',
                            'duration'      => '500',
                            'event'         => 'mouseover',
                        ),
                        'hide'      => array(
                            'effect'    => 'slide',
                            'duration'  => '500',
                            'event'     => 'click mouseleave',
                        ),
                    ),
                )
            );

            
            /*
            // SOCIAL ICONS -> Setup custom links in the footer for quick links in your panel footer icons.
            $this->args['share_icons'][] = array(
                'url'   => 'https://github.com/ReduxFramework/ReduxFramework',
                'title' => 'Visit us on GitHub',
                'icon'  => 'el-icon-github'
                //'img'   => '', // You can use icon OR img. IMG needs to be a full URL.
            );
            $this->args['share_icons'][] = array(
                'url'   => 'https://www.facebook.com/pages/Redux-Framework/243141545850368',
                'title' => 'Like us on Facebook',
                'icon'  => 'el-icon-facebook'
            );
            $this->args['share_icons'][] = array(
                'url'   => 'http://twitter.com/reduxframework',
                'title' => 'Follow us on Twitter',
                'icon'  => 'el-icon-twitter'
            );
            $this->args['share_icons'][] = array(
                'url'   => 'http://www.linkedin.com/company/redux-framework',
                'title' => 'Find us on LinkedIn',
                'icon'  => 'el-icon-linkedin'
            );
            */

            // Panel Intro text -> before the form
            if (!isset($this->args['global_variable']) || $this->args['global_variable'] !== false) {
                if (!empty($this->args['global_variable'])) {
                    $v = $this->args['global_variable'];
                } else {
                    $v = str_replace('-', '_', $this->args['opt_name']);
                }
                $this->args['intro_text'] = sprintf(__('<p>Did you know that Redux sets a global variable for you? To access any of your saved options from within your code you can use your global variable: <strong>$%1$s</strong></p>', MD_THEME_NAME), $v);
            } else {
                $this->args['intro_text'] = __('<p>This text is displayed above the options panel. It isn\'t required, but more info is always better! The intro_text field accepts all HTML.</p>', MD_THEME_NAME);
            }

            // Add content after the form.
            $this->args['footer_text'] = __('<p>This text is displayed below the options panel. It isn\'t required, but more info is always better! The footer_text field accepts all HTML.</p>', MD_THEME_NAME);

            $this->args['intro_text'] = '';
            $this->args['footer_text'] = '';
        }

    }
    
    global $reduxConfig;
    $reduxConfig = new Redux_Framework_Config();
}

/**
  Custom function for the callback referenced above
 */
if (!function_exists('redux_my_custom_field')):
    function redux_my_custom_field($field, $value) {
        print_r($field);
        echo '<br/>';
        print_r($value);
    }
endif;

/**
  Custom function for the callback validation referenced above
 * */
if (!function_exists('redux_validate_callback_function')):
    function redux_validate_callback_function($field, $value, $existing_value) {
        $error = false;
        $value = 'just testing';

        /*
          do your validation

          if(something) {
            $value = $value;
          } elseif(something else) {
            $error = true;
            $value = $existing_value;
            $field['msg'] = 'your custom error message';
          }
         */

        $return['value'] = $value;
        if ($error == true) {
            $return['error'] = $field;
        }
        return $return;
    }
endif;
