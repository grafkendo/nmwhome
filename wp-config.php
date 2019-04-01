<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the
 * installation. You don't have to use the web site, you can
 * copy this file to "wp-config.php" and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * MySQL settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'i5350654_wp1');

/** MySQL database username */
define('DB_USER', 'i5350654_wp1');

/** MySQL database password */
define('DB_PASSWORD', 'R.9ZP2eFxDTS8Q8buZM27');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '8jzksPJKnEdHpOUrzJWNp3Fhfn4DhtnVfryrjBvLYbQ0eEtgQwqLVvdHcM5gW3L8');
define('SECURE_AUTH_KEY',  '4Mnk9sEhOEeiiXhdZLMbMuEd6bgIotMviDJZ3MUoW01xGambx6b5TEKixZaUF9AA');
define('LOGGED_IN_KEY',    'O3BERocWJ0M9btLw2ZRmf8rdbtweuUgfnnhSBCF57Fclf7Ef5siqDpg7HHtKw4cK');
define('NONCE_KEY',        '6yMzPFdV6992y28eiWLmau6ua2KfASkKdoB5Hf0qO27TQmHRD15BNtu8dRILrK9M');
define('AUTH_SALT',        'Os0TzerhNt2iiC5eqCfgY0TtPOsF7y9hQgx8tw8J59CKr3yTk3drmmLW7kOfjuVE');
define('SECURE_AUTH_SALT', 'QGpOTM4vVnBz4JTb9sIk9V0sUe3MmHJM04QJ6wxfinkJ0H8VrEyLRpCIdHrb4M3M');
define('LOGGED_IN_SALT',   'R3ugE9XQV8yzAEAafa4XMgjlp7Nz0Cc0ZjHqcDxMGHnFnpljzpE1QMINgRjZWk5x');
define('NONCE_SALT',       'JYzHwjZJzC4GqxBXC4Io5NCT9F1gSdTKOxdhqz2O3VSmTrR3mnhGM4d4AvZde4tK');

/**
 * Other customizations.
 */
define('FS_METHOD','direct');define('FS_CHMOD_DIR',0755);define('FS_CHMOD_FILE',0644);
define('WP_TEMP_DIR',dirname(__FILE__).'/wp-content/uploads');

/**
 * Turn off automatic updates since these are managed upstream.
 */
define('AUTOMATIC_UPDATER_DISABLED', true);


/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
