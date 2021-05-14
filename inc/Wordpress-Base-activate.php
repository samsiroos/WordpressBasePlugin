<?php
/**
 * @package  WordpressBasePlugin
 */
class Wordpress_baseActivate 
{
	public static function activate() {
		flush_rewrite_rules();
	}
}