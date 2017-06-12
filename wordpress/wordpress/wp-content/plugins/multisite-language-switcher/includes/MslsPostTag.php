<?php
/**
 * MslsPostTag
 * @author Dennis Ploetner <re@lloc.de>
 * @since 0.9.8
 */

/**
 * Post Tag
 * @package Msls
 */
class MslsPostTag extends MslsMain {

	/**
	 * Suggest
	 *
	 * Echo a JSON-ified array of posts of the given post-type and
	 * the requested search-term and then die silently
	 */
	public static function suggest() {
		$json = new MslsJson;

		if ( filter_has_var( INPUT_POST, 'blog_id' ) ) {
			switch_to_blog(
				filter_input( INPUT_POST, 'blog_id', FILTER_SANITIZE_NUMBER_INT )
			);

			$args = array(
				'orderby'    => 'name',
				'order'      => 'ASC',
				'number'     => 10,
				'hide_empty' => 0,
			);

			if ( filter_has_var( INPUT_POST, 's' ) ) {
				$args['s'] = sanitize_text_field(
					filter_input( INPUT_POST, 's' )
				);
			}

			/**
			 * Overrides the query-args for the suggest fields
			 * @since 0.9.9
			 * @param array $args
			 */
			$args = (array) apply_filters( 'msls_post_tag_suggest_args', $args );

			foreach ( get_terms( sanitize_text_field( filter_input( INPUT_POST, 'post_type' ) ), $args ) as $term ) {

				/**
				 * Manipulates the term object before using it
				 * @since 0.9.9
				 * @param StdClass $term
				 */
				$term = apply_filters( 'msls_post_tag_suggest_term', $term );

				if ( is_object( $term ) ) {
					$json->add( $term->term_id, $term->name );
				}
			}
			restore_current_blog();
		}
		wp_die( $json->encode() );
	}

	/**
	 * Init
	 * @return MslsPostTag
	 */
	public static function init() {
		if ( MslsOptions::instance()->activate_autocomplete	) {
			$obj = new self();
		}
		else {
			$obj = MslsPostTagClassic::init();
		}

		$taxonomy = MslsContentTypes::create()->acl_request();
		if ( '' != $taxonomy ) {
			add_action( "{$taxonomy}_add_form_fields",  array( $obj, 'add_input' ) );
			add_action( "{$taxonomy}_edit_form_fields", array( $obj, 'edit_input' ) );
			add_action( "edited_{$taxonomy}", array( $obj, 'set' ) );
			add_action( "create_{$taxonomy}", array( $obj, 'set' ) );
		}

		return $obj;
	}

	/**
	 * Add the input fields to the add-screen of the taxonomies
	 * @param StdClass $tag
	 */
	public function add_input( $tag ) {
		$title_format = '<h3>%s</h3>
			<input type="hidden" name="msls_post_type" id="msls_post_type" value="%s"/>
			<input type="hidden" name="msls_action" id="msls_action" type="text" value="suggest_terms"/>';

		$item_format = '<label for="msls_title_%1$s">%2$s</label>
			<input type="hidden" id="msls_id_%1$s" name="msls_input_%3$s" value="%4$s"/>
			<input class="msls_title" id="msls_title_%1$s" name="msls_title_%1$s" type="text" value="%5$s"/>';

		echo '<div class="form-field">';
		$this->the_input( $tag, $title_format, $item_format );
		echo '</div>';
	}

	/**
	 * Add the input fields to the edit-screen of the taxonomies
	 * @param StdClass $tag
	 */
	public function edit_input( $tag ) {
		$title_format = '<tr>
			<th colspan="2">
			<strong>%s</strong>
			<input type="hidden" name="msls_post_type" id="msls_post_type" value="%s"/>
			<input type="hidden" name="msls_action" id="msls_action" type="text" value="suggest_terms"/>
			</th>
			</tr>';

		$item_format = '<tr class="form-field">
			<th scope="row" valign="top">
			<label for="msls_title_%1$s">%2$s</label>
			</th>
			<td>
			<input type="hidden" id="msls_id_%1$s" name="msls_input_%3$s" value="%4$s"/>
			<input class="msls_title" id="msls_title_%1$s" name="msls_title_%1$s" type="text" value="%5$s"/>
			</td>
			</tr>';

		$this->the_input( $tag, $title_format, $item_format );
	}

	/**
	 * Print the input fields
	 * Returns true if the blogcollection is not empty
	 * @param StdClass $tag
	 * @param string $title_format
	 * @param string $item_format
	 * @return boolean
	 */
	public function the_input( $tag, $title_format, $item_format ) {
		$term_id = ( is_object( $tag ) ? $tag->term_id : 0 );
		$blogs   = MslsBlogCollection::instance()->get();
		if ( $blogs ) {
			$my_data = MslsOptionsTax::create( $term_id );
			$type    = MslsContentTypes::create()->get_request();

			printf(
				$title_format,
				__( 'Multisite Language Switcher', 'multisite-language-switcher' ),
				$type
			);
			foreach ( $blogs as $blog ) {
				switch_to_blog( $blog->userblog_id );

				$language = $blog->get_language();
				$flag_url = MslsOptions::instance()->get_flag_url( $language );
				$icon     = MslsAdminIcon::create()->set_language( $language )->set_src( $flag_url );

				$value = $title = '';
				if ( $my_data->has_value( $language ) ) {
					$term = get_term( $my_data->$language, $type );
					if ( is_object( $term ) ) {
						$icon->set_href( $my_data->$language );
						$value = $my_data->$language;
						$title = $term->name;
					}
				}
				printf(
					$item_format,
					$blog->userblog_id,
					$icon,
					$language,
					$value,
					$title
				);
				restore_current_blog();
			}
			return true;
		}
		return false;
	}

	/**
	 * Set calls the save method if taxonomy is set
	 * @param int $term_id
 	 * @codeCoverageIgnore
	 */
	public function set( $term_id ) {
		if ( MslsContentTypes::create()->acl_request() ) {
			$this->save( $term_id, 'MslsOptionsTax' );
		}
	}

}
