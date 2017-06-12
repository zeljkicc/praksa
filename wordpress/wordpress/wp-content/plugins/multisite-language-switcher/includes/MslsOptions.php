<?php
/**
 * MslsOptions
 * @author Dennis Ploetner <re@lloc.de>
 * @since 0.9.8
 */

/**
 * General options class
 * @package Msls
 * @property bool $activate_autocomplete
 * @property int $display
 * @property int $reference_user
 * @property int $content_priority
 * @property string $admin_language
 * @property string $description
 * @property string $before_item
 * @property string $after_item
 * @property string $before_output
 * @property string $after_output
 */
class MslsOptions extends MslsGetSet implements IMslsRegistryInstance {

	/**
	 * Args
	 * @var array
	 */
	protected $args;

	/**
	 * Name
	 * @var string
	 */
	protected $name;

	/**
	 * Exists
	 * @var bool
	 */
	protected $exists = false;

	/**
	 * Separator
	 * @var string
	 */
	protected $sep = '';

	/**
	 * Autoload
	 * @var string
	 */
	protected $autoload = 'yes';

	/**
	 * Available languages
	 * @var array
	 */
	private $available_languages;

	/**
	 * Rewrite with front
	 * @var bool
	 */
	public $with_front;

	/**
	 * Factory method
	 *
	 * @param int $id
	 *
	 * @return MslsOptions
	 */
	public static function create( $id = 0 ) {
		if ( is_admin() ) {
			$id = (int) $id;

			if ( MslsContentTypes::create()->is_taxonomy() ) {
				return MslsOptionsTax::create( $id );
			}

			return new MslsOptionsPost( $id );
		}

		if ( self::is_main_page() ) {
			$options = new MslsOptions();
		} elseif ( self::is_tax_page() ) {
			$options = MslsOptionsTax::create();
		} elseif ( self::is_query_page() ) {
			$options = MslsOptionsQuery::create();
		} else {
			$options = new MslsOptionsPost( get_queried_object_id() );
		}
		add_filter( 'check_url', array( $options, 'check_for_blog_slug' ), 10, 2 );

		return $options;
	}

	/**
	 * Checks if the current page is a home, front or 404 page
	 * @return boolean
	 */
	public static function is_main_page() {
		return ( is_front_page() || is_search() || is_404() );
	}

	/**
	 * Checks if the current page is a category, tag or any other tax archive
	 * @return boolean
	 */
	public static function is_tax_page() {
		return ( is_category() || is_tag() || is_tax() );
	}

	/**
	 * Checks if the current page is a date, author any other post_type archive
	 * @return boolean
	 */
	public static function is_query_page() {
		return ( is_date() || is_author() || is_post_type_archive() );
	}

	/**
	 * Constructor
	 */
	public function __construct() {
		$this->args   = func_get_args();
		$this->name   = 'msls' . $this->sep . implode( $this->sep, $this->args );
		$this->exists = $this->set( get_option( $this->name ) );
	}

	/**
	 * Gets an element of arg by index
	 * The returning value is casted to the type of $retval or will be the
	 * value of $retval if nothing is set at this index.
	 *
	 * @param int $idx
	 * @param mixed $val
	 *
	 * @return mixed
	 */
	public function get_arg( $idx, $val = null ) {
		$arg = ( isset( $this->args[ $idx ] ) ? $this->args[ $idx ] : $val );
		settype( $arg, gettype( $val ) );

		return $arg;
	}

	/**
	 * Save
	 *
	 * @param mixed $arr
	 *
	 * @codeCoverageIgnore
	 */
	public function save( $arr ) {
		$this->delete();
		if ( $this->set( $arr ) ) {
			$arr = $this->get_arr();
			if ( ! empty( $arr ) ) {
				add_option( $this->name, $arr, '', $this->autoload );
			}
		}
	}

	/**
	 * Delete
	 * @codeCoverageIgnore
	 */
	public function delete() {
		$this->reset();
		if ( $this->exists ) {
			delete_option( $this->name );
		}
	}

	/**
	 * Set
	 *
	 * @param mixed $arr
	 *
	 * @return bool
	 */
	public function set( $arr ) {
		if ( is_array( $arr ) ) {
			foreach ( $arr as $key => $value ) {
				$this->__set( $key, $value );
			}

			return true;
		}

		return false;
	}

	/**
	 * Get permalink
	 *
	 * @param string $language
	 *
	 * @return string
	 */
	public function get_permalink( $language ) {
		/**
		 * Filters the url by language
		 * @since 0.9.8
		 *
		 * @param string $postlink
		 * @param string $language
		 */
		$postlink = (string) apply_filters(
			'msls_options_get_permalink',
			$this->get_postlink( $language ),
			$language
		);

		return ( '' != $postlink ? $postlink : home_url( '/' ) );
	}

	/**
	 * Get postlink
	 *
	 * @param string $language
	 *
	 * @return string
	 */
	public function get_postlink( $language ) {
		return '';
	}

	/**
	 * Get current link
	 * @return string
	 */
	public function get_current_link() {
		return home_url( '/' );
	}

	/**
	 * Is excluded
	 * @return bool
	 */
	public function is_excluded() {
		return isset( $this->exclude_current_blog );
	}

	/**
	 * Is content
	 * @return bool
	 */
	public function is_content_filter() {
		return isset( $this->content_filter );
	}

	/**
	 * Get order
	 * @return string
	 */
	public function get_order() {
		return (
		isset( $this->sort_by_description ) ?
			'description' :
			'language'
		);
	}

	/**
	 * Get url
	 *
	 * @param string $dir
	 *
	 * @return string
	 */
	public function get_url( $dir ) {
		return esc_url( plugins_url( $dir, MSLS_PLUGIN__FILE__ ) );
	}

	/**
	 * Get flag url
	 *
	 * @param string $language
	 *
	 * @return string
	 */
	public function get_flag_url( $language ) {
		if ( ! is_admin() && isset( $this->image_url ) ) {
			$url = $this->__get( 'image_url' );
		} else {
			$url = $this->get_url( 'flags' );
		}

		/**
		 * Override the path to the flag-icons
		 * @since 0.9.9
		 *
		 * @param string $url
		 */
		$url = (string) apply_filters( 'msls_options_get_flag_url', $url );

		if ( 5 == strlen( $language ) ) {
			$icon = strtolower( substr( $language, - 2 ) );
		} else {
			$icon = $language;
		}
		$icon .= '.png';

		/**
		 * Use your own filename for the flag-icon
		 * @since 1.0.3
		 *
		 * @param string $icon
		 * @param string $language
		 */
		$icon = (string) apply_filters( 'msls_options_get_flag_icon', $icon, $language );

		return sprintf( '%s/%s', $url, $icon );
	}

	/**
	 * Get all available languages
	 * @uses get_available_languages
	 * @uses format_code_lang
	 * @return array
	 */
	public function get_available_languages() {
		if ( empty( $this->available_languages ) ) {
			$this->available_languages = array(
				'en_US' => __( 'American English', 'multisite-language-switcher' ),
			);
			foreach ( get_available_languages() as $code ) {
				$this->available_languages[ esc_attr( $code ) ] = format_code_lang( $code );
			}

			/**
			 * Returns custom filtered available languages
			 * @since 1.0
			 *
			 * @param array $available_languages
			 */
			$this->available_languages = (array) apply_filters(
				'msls_options_get_available_languages',
				$this->available_languages
			);
		}

		return $this->available_languages;
	}

	/**
	 * The 'blog'-slug-problem :/
	 *
	 * @param string $url
	 * @param MslsOptions $options
	 *
	 * @return string
	 */
	public static function check_for_blog_slug( $url, $options ) {
		if ( empty( $url ) || ! is_string( $url ) ) {
			return '';
		}

		global $wp_rewrite;
		if ( is_subdomain_install() || ! $wp_rewrite->using_permalinks() ) {
			return $url;
		}

		$count = 1;
		$url   = str_replace( home_url(), '', $url, $count );

		global $current_site;
		$permalink_structure = get_blog_option( $current_site->blog_id, 'permalink_structure' );
		if ( $permalink_structure ) {
			list( $needle, ) = explode( '/%', $permalink_structure, 2 );

			$url = str_replace( $needle, '', $url );
			if ( is_main_site() && $options->with_front ) {
				$url = "{$needle}{$url}";
			}
		}

		return home_url( $url );
	}

	/**
	 * Get or create an instance of MslsOptions
	 * @todo Until PHP 5.2 is not longer the minimum for WordPress ...
	 * @return MslsOptions
	 */
	public static function instance() {
		if ( ! ( $obj = MslsRegistry::get_object( 'MslsOptions' ) ) ) {
			$obj = new self();
			MslsRegistry::set_object( 'MslsOptions', $obj );
		}

		return $obj;
	}

}
