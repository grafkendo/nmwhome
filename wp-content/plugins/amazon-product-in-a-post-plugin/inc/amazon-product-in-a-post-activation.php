<?php
// Plugin Hooks

	function appip_deinstall() {
		//moved to uninstall.php as it should be.
	}
	// Install Function - called on activation
	function appip_install () {
		global $wpdb;
		$curappipver = get_option("apipp_version");
		$dbversion = get_option("apipp_dbversion");
		$appiptable = $wpdb->prefix . 'amazoncache';
		if((int) get_option('apipp_amazon_cache_sec', '0' ) == 0 )
			add_option("apipp_amazon_cache_sec", 3600);
		if($curappipver == ''){
			$createSQL = "CREATE TABLE IF NOT EXISTS $appiptable (`Cache_id` int(10) NOT NULL auto_increment, `URL` text NOT NULL, `updated` datetime default NULL, `body` longtext, PRIMARY KEY (`Cache_id`), UNIQUE KEY `URL` (`URL`(255)), KEY `Updated` (`updated`)) ENGINE=MyISAM;";
	      	$wpdb->query($createSQL);
			add_option("apipp_version", APIAP_PLUGIN_VER);
			add_option("apipp_dbversion", APIAP_DBASE_VER);
		}
		if($dbversion != APIAP_DBASE_VER){
			$alterSQL = "ALTER TABLE `{$appiptable}` CHANGE `body` `body` LONGTEXT CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL;";
	      	$testif = $wpdb->query($alterSQL);
			update_option("apipp_version", APIAP_PLUGIN_VER);
			update_option("apipp_dbversion", APIAP_DBASE_VER);
		}
	}
