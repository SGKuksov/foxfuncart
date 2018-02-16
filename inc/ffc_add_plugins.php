<?php

require_once dirname( __FILE__ ) . '/class-tgm-plugin-activation.php';

add_action( 'tgmpa_register', 'ffc__register_required_plugins' );

function ffc__register_required_plugins() {

  $plugins = array(

    // This is an example of how to include a plugin bundled with a theme.
    array(
      'name'               => 'WooCommerce', // The plugin name.
      'slug'               => 'woocommerce', // The plugin slug (typically the folder name).
      'required'           => true, // If false, the plugin is only 'recommended' instead of required.
      'version'            => '', // E.g. 1.0.0. If set, the active plugin must be this version or higher. If the plugin version is higher than the plugin version installed, the user will be notified to update the plugin.
      'force_activation'   => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
      'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
    ),

    array(
      'name'               => 'WooCommerce MailChimp', // The plugin name.
      'slug'               => 'woocommerce-mailchimp', // The plugin slug (typically the folder name).
      'required'           => true, // If false, the plugin is only 'recommended' instead of required.
      'version'            => '', // E.g. 1.0.0. If set, the active plugin must be this version or higher. If the plugin version is higher than the plugin version installed, the user will be notified to update the plugin.
      'force_activation'   => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
      'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
    ),

    array(
      'name'               => 'WooCommerce Google Analytics Integration', // The plugin name.
      'slug'               => 'woocommerce-google-analytics-integration', // The plugin slug (typically the folder name).
      'required'           => true, // If false, the plugin is only 'recommended' instead of required.
      'version'            => '', // E.g. 1.0.0. If set, the active plugin must be this version or higher. If the plugin version is higher than the plugin version installed, the user will be notified to update the plugin.
      'force_activation'   => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
      'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
    ),

    array(
      'name'               => 'WooCommerce Print Invoice & Delivery Note', // The plugin name.
      'slug'               => 'woocommerce-delivery-notes', // The plugin slug (typically the folder name).
      'required'           => true, // If false, the plugin is only 'recommended' instead of required.
      'version'            => '', // E.g. 1.0.0. If set, the active plugin must be this version or higher. If the plugin version is higher than the plugin version installed, the user will be notified to update the plugin.
      'force_activation'   => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
      'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
    ),

    array(
      'name'               => 'WooCommerce PDF Invoices & Packing Slips', // The plugin name.
      'slug'               => 'woocommerce-pdf-invoices-packing-slips', // The plugin slug (typically the folder name).
      'required'           => true, // If false, the plugin is only 'recommended' instead of required.
      'version'            => '', // E.g. 1.0.0. If set, the active plugin must be this version or higher. If the plugin version is higher than the plugin version installed, the user will be notified to update the plugin.
      'force_activation'   => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
      'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
    ),

  );

  $config = array(
    'id'           => 'ffc',                    // Unique ID for hashing notices for multiple instances of TGMPA.
    'default_path' => '',                       // Default absolute path to bundled plugins.
    'menu'         => 'tgmpa-install-plugins',  // Menu slug.
    'parent_slug'  => 'plugins.php',            // Parent menu slug.
    'capability'   => 'manage_options',         // Capability needed to view plugin install page, should be a capability associated with the parent menu used.
    'has_notices'  => true,                     // Show admin notices or not.
    'dismissable'  => true,                     // If false, a user cannot dismiss the nag message.
    'dismiss_msg'  => '',                       // If 'dismissable' is false, this message will be output at top of nag.
    'is_automatic' => false,                    // Automatically activate plugins after installation or not.
    'message'      => '',                        // Message to output right before the plugins table.

    /*
    'strings'      => array(
      'page_title'                      => __( 'Install Required Plugins', 'yo_test' ),
      'menu_title'                      => __( 'Install Plugins', 'yo_test' ),
      /* translators: %s: plugin name. * /
      'installing'                      => __( 'Installing Plugin: %s', 'yo_test' ),
      /* translators: %s: plugin name. * /
      'updating'                        => __( 'Updating Plugin: %s', 'yo_test' ),
      'oops'                            => __( 'Something went wrong with the plugin API.', 'yo_test' ),
      'notice_can_install_required'     => _n_noop(
        /* translators: 1: plugin name(s). * /
        'This theme requires the following plugin: %1$s.',
        'This theme requires the following plugins: %1$s.',
        'yo_test'
      ),
      'notice_can_install_recommended'  => _n_noop(
        /* translators: 1: plugin name(s). * /
        'This theme recommends the following plugin: %1$s.',
        'This theme recommends the following plugins: %1$s.',
        'yo_test'
      ),
      'notice_ask_to_update'            => _n_noop(
        /* translators: 1: plugin name(s). * /
        'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.',
        'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.',
        'yo_test'
      ),
      'notice_ask_to_update_maybe'      => _n_noop(
        /* translators: 1: plugin name(s). * /
        'There is an update available for: %1$s.',
        'There are updates available for the following plugins: %1$s.',
        'yo_test'
      ),
      'notice_can_activate_required'    => _n_noop(
        /* translators: 1: plugin name(s). * /
        'The following required plugin is currently inactive: %1$s.',
        'The following required plugins are currently inactive: %1$s.',
        'yo_test'
      ),
      'notice_can_activate_recommended' => _n_noop(
        /* translators: 1: plugin name(s). * /
        'The following recommended plugin is currently inactive: %1$s.',
        'The following recommended plugins are currently inactive: %1$s.',
        'yo_test'
      ),
      'install_link'                    => _n_noop(
        'Begin installing plugin',
        'Begin installing plugins',
        'yo_test'
      ),
      'update_link'             => _n_noop(
        'Begin updating plugin',
        'Begin updating plugins',
        'yo_test'
      ),
      'activate_link'                   => _n_noop(
        'Begin activating plugin',
        'Begin activating plugins',
        'yo_test'
      ),
      'return'                          => __( 'Return to Required Plugins Installer', 'yo_test' ),
      'plugin_activated'                => __( 'Plugin activated successfully.', 'yo_test' ),
      'activated_successfully'          => __( 'The following plugin was activated successfully:', 'yo_test' ),
      /* translators: 1: plugin name. * /
      'plugin_already_active'           => __( 'No action taken. Plugin %1$s was already active.', 'yo_test' ),
      /* translators: 1: plugin name. * /
      'plugin_needs_higher_version'     => __( 'Plugin not activated. A higher version of %s is needed for this theme. Please update the plugin.', 'yo_test' ),
      /* translators: 1: dashboard link. * /
      'complete'                        => __( 'All plugins installed and activated successfully. %1$s', 'yo_test' ),
      'dismiss'                         => __( 'Dismiss this notice', 'yo_test' ),
      'notice_cannot_install_activate'  => __( 'There are one or more required or recommended plugins to install, update or activate.', 'yo_test' ),
      'contact_admin'                   => __( 'Please contact the administrator of this site for help.', 'yo_test' ),

      'nag_type'                        => '', // Determines admin notice type - can only be one of the typical WP notice classes, such as 'updated', 'update-nag', 'notice-warning', 'notice-info' or 'error'. Some of which may not work as expected in older WP versions.
    ),
    */
  );

  tgmpa( $plugins, $config );
}
