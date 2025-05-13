<?php
if (! defined('ABSPATH')) {
  exit;
}

use Automattic\WooCommerce\Blocks\Payments\Integrations\AbstractPaymentMethodType;
/**
 * Class for each sub separated gateway buttons extending Abstract "Sub" class
 */
class WC_Gateway_Midtrans_Sub_CIMB_Clicks extends WC_Gateway_Midtrans_Abstract_Sub
{
  function __construct()
  {
    // used as plugin id
    $this->id = 'midtrans_sub_cimb_clicks';
    // used as Snap enabled_payments params.
    $this->sub_payment_method_params = ['cimb_clicks'];
    // used to display icons on customer side's payment buttons.
    $this->sub_payment_method_image_file_names_str_final = 'cimb_clicks.png';

    parent::__construct();
  }

  public function pluginTitle()
  {
    return "Midtrans Specific: CIMB OCTO Clicks";
  }
  public function getSettingsDescription()
  {
    return "Separated payment buttons for this specific the payment methods with its own icons";
  }
  protected function getDefaultTitle()
  {
    return __('OCTO Clicks', 'midtrans-woocommerce');
  }
  protected function getDefaultDescription()
  {
    return __('', 'midtrans-woocommerce');
  }
}

final class WC_Block_Midtrans_Sub_CIMB_Clicks extends AbstractPaymentMethodType
{
  private $gateway;
  protected $name = 'midtrans_sub_cimb_clicks'; // your payment gateway name

  public function initialize()
  {
    $this->settings = get_option('woocommerce_midtrans_sub_cimb_clicks_settings', []);
    $this->gateway = new WC_Gateway_Midtrans_Sub_CIMB_Clicks();
  }

  public function get_payment_method_script_handles()
  {
    wp_register_script(
      'midtrans-sub-cimb-clicks',
      MDTR_URL . 'assets/js/cimb-clicks.js',
      [
        'wc-blocks-registry',
        'wc-settings',
        'wp-element',
        'wp-html-entities',
        'wp-i18n',
      ],
      MDTR_VERSION,
      true
    );

    if (function_exists('wp_set_script_translations')) {
      wp_set_script_translations('midtrans-sub-cimb-clicks');
    }

    return ['midtrans-sub-cimb-clicks'];
  }

  public function is_active()
  {
    return $this->gateway->is_available();
  }

  public function get_payment_method_data()
  {
    return [
      'title' => $this->gateway->title,
      'description' => $this->gateway->description,
      'icon'         => $this->gateway->icon,
    ];
  }
}
