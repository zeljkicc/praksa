<?php
/**
 * MslsLinkTextImage
 * @author Dennis Ploetner <re@lloc.de>
 * @since 0.9.8
 */

/**
 * Link type: Text and image
 * @package Msls
 */
class MslsLinkTextImage extends MslsLink {

	/**
	 * Output format
	 * @var string
	 */
	protected $format_string = '{txt} <img src="{src}" alt="{alt}"/>';

	/**
	 * Get the description
	 * @return string
	 */
	public static function get_description() {
		return __( 'Description and flag', 'multisite-language-switcher' );
	}

}
