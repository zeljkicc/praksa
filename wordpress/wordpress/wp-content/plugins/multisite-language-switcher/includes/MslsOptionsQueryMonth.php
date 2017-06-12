<?php
/**
 * MslsOptionsQueryMonth
 * @author Dennis Ploetner <re@lloc.de>
 * @since 0.9.8
 */

/**
 * OptionsQueryMonth
 *
 * @package Msls
 */
class MslsOptionsQueryMonth extends MslsOptionsQuery {

	/**
	 * Check if the array has an non empty item which has $language as a key
	 *
	 * @param string $language
	 * @return bool
	 */
	public function has_value( $language ) {
		if ( ! isset( $this->arr[ $language ] ) ) {
			$cache = MslsSqlCacher::init( __CLASS__ )->set_params( $this->args );

			$this->arr[ $language ] = $cache->get_var(
				$cache->prepare(
					"SELECT count(ID) FROM {$cache->posts} WHERE YEAR(post_date) = %d AND MONTH(post_date) = %d AND post_status = 'publish'",
					$this->get_arg( 0, 0 ),
					$this->get_arg( 1, 0 )
				)
			);
		}
		return (bool) $this->arr[ $language ];
	}

	/**
	 * Get current link
	 *
	 * @return string
	 */
	public function get_current_link() {
		return get_month_link( $this->get_arg( 0, 0 ), $this->get_arg( 1, 0 ) );
	}

}
