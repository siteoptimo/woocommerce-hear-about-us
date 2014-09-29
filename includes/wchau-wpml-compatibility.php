<?php

class WCHAU_WPML_Compatibility {

	public function __construct() {
		add_filter( 'wchau_settings_fields', array( $this, 'translate_settings' ) );
		add_filter( 'wchau_get_option', array($this, 'translate_option'));
	}

	public function translate_settings( $setting_fields ) {

		$new_settings = array();

		$languages        = $this->wpml_get_languages();
		$default_language = $this->wpml_get_default_lang();

		foreach ( $setting_fields as $setting_field ) {
			$new_settings[] = $setting_field;

			foreach ( $languages as $language ) {
				if ( $language['language_code'] == $default_language ) {
					continue;
				}

				$field = $setting_field;

				//$field['title'] = '<img src="' . $language['country_flag_url'] . '" alt="' . sanitize_title($language['translated_name']) . '"> ' . $field['title'];
				$field['title'] .= ' (' . strtoupper( $language['language_code'] ) . ')';
				$field['id'] .= "_" . $language['language_code'];
				$field['default'] = '';

				$new_settings[] = $field;
			}

		}

		return $new_settings;

	}

	public function translate_option($option) {
		$current_lang = ICL_LANGUAGE_CODE;

		if($current_lang == $this->wpml_get_default_lang()) {
			return $option;
		}

		return $option . "_" . $current_lang;
	}

	public static function wpml_enabled() {
		global $sitepress;

		return ( isset( $sitepress ) );
	}

	private function wpml_get_default_lang() {
		global $sitepress;

		return $sitepress->get_default_language();
	}

	private function wpml_get_languages() {
		return icl_get_languages();
	}
}