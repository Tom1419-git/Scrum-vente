<?php

namespace SW_WAPF\Includes\Classes {

    class Helper
    {

	    public static function wp_slash($value) {
		    if ( is_array( $value ) ) {
			    $value = array_map( 'self::wp_slash', $value );
		    }
		    if ( is_string( $value ) ) {
			    return addslashes( $value );
		    }
		    return $value;
	    }

        public static function get_all_roles() {

            $roles = get_editable_roles();

            return Enumerable::from($roles)->select(function($role, $id) {
                return [ 'id' => $id,'text' => $role['name'] ];
            })->toArray();
        }

        public static function cpt_to_string($cpt){

            return __('Product','advanced-product-fields-for-woocommerce');

        }

        public static function get_fieldgroup_counts(){

	        $count_cache = [ 'publish' => 0, 'draft' => 0, 'trash' => 0, 'all' => 0 ];

	        foreach(wapf_get_setting('cpts') as $cpt) {
		        $count = wp_count_posts($cpt);
		        $count_cache['publish'] += $count->publish;
		        $count_cache['trash'] += $count->trash;
		        $count_cache['draft'] += $count->draft;
	        }

	        $count_cache['all'] = $count_cache['publish'] + $count_cache['draft'];

	        return $count_cache;
        }

        public static function thing_to_html_attribute_string($thing){

            $encoded = wp_json_encode($thing);
            return function_exists('wc_esc_json') ? wc_esc_json($encoded) : _wp_specialchars($encoded, ENT_QUOTES, 'UTF-8', true);

        }

        public static function format_pricing_hint($type, $amount, $product, $for_page = 'shop') {

            $display_settings = WooCommerce_Service::get_price_display_options();

            $args = apply_filters( 'wc_price_args', [
                'ex_tax_label'       => false,
                'currency'           => '',
                'decimal_separator'  => $display_settings['decimal'],
                'thousand_separator' => $display_settings['thousand'],
                'decimals'           => $display_settings['decimals'],
                'price_format'       => $display_settings['format']
            ] );

            $original_price = $amount;
            $price = (float) $amount;
            $unformatted_price = $price;
            $negative = $price < 0;

            $price = apply_filters( 'raw_woocommerce_price', $negative ? $price * -1 : $price, $original_price );
            $price = apply_filters( 'formatted_woocommerce_price', number_format( $price, $args['decimals'], $args['decimal_separator'], $args['thousand_separator'] ), $price, $args['decimals'], $args['decimal_separator'], $args['thousand_separator'], $original_price );
            if ( $display_settings['trimzero'] && $args['decimals'] > 0 ) {
                $price = wc_trim_zeros( $price );
            }

            $formatted_price = ( $negative ? '-' : '' ) . sprintf( $args['price_format'], get_woocommerce_currency_symbol( $args['currency'] ), $price );
            $return = $formatted_price;

            $return = apply_filters( 'wc_price', $return, $price, $args, $unformatted_price, $original_price );

            $sign = '+';

            return sprintf('%s%s',$sign, $return);

        }

        public static function normalize_string_decimal($number)
        {
            return preg_replace('/\.(?=.*\.)/', '', (str_replace(',', '.', $number)));
        }

	    public static function adjust_addon_price($product, $amount,$type,$for = 'shop') {

		    if($amount === 0)
			    return 0;

		    if($type === 'percent' || $type === 'p')
			    return $amount;

		    $amount = self::maybe_add_tax($product,$amount,$for);

		    return $amount;

	    }

	    public static function maybe_add_tax($product, $price, $for_page = 'shop') {

		    if(empty($price) || $price < 0 || !wc_tax_enabled())
			    return $price;

		    if(is_int($product))
			    $product = wc_get_product($product);

		    $args = [ 'qty' => 1, 'price' => $price ];

		    if($for_page === 'cart') {
			    if(get_option('woocommerce_tax_display_cart') === 'incl')
				    return wc_get_price_including_tax($product, $args);
			    else
				    return wc_get_price_excluding_tax($product, $args);
		    }
		    else
			    return wc_get_price_to_display($product, $args);

	    }

	    public static function get_product_base_price($product) {

		    return floatval($product->get_price());

	    }

    }
}