<?php
if (! defined('ABSPATH')) {
  exit;
}

use Automattic\WooCommerce\Blocks\Payments\Integrations\AbstractPaymentMethodType;
/**
 * Class for each sub separated gateway buttons extending Abstract "Sub" class
 */
class WC_Gateway_Midtrans_Sub_Danamon_Online extends WC_Gateway_Midtrans_Abstract_Sub
{
  function __construct()
  {
    // used as plugin id
    $this->id = 'midtrans_sub_danamon_online';
    // used as Snap enabled_payments params.
    $this->sub_payment_method_params = ['danamon_online'];
    // used to display icons on customer side's payment buttons.
    $this->sub_payment_method_image_file_names_str_final = 'danamon_online.png';

    parent::__construct();
  }

  public function pluginTitle()
  {
    return "Midtrans Specific: Danamon Online Banking";
  }
  public function getSettingsDescription()
  {
    return "Separated payment buttons for this specific the payment methods with its own icons";
  }
  protected function getDefaultTitle()
  {
    return __('Danamon Online Banking', 'midtrans-woocommerce');
  }
  protected function getDefaultDescription()
  {
    return __('', 'midtrans-woocommerce');
  }
}

final class WC_Block_Midtrans_Sub_Danamon_Online extends AbstractPaymentMethodType
{
  private $gateway;
  protected $name = 'midtrans_sub_danamon_online'; // your payment gateway name

  public function initialize()
  {
    $this->settings = get_option('woocommerce_midtrans_sub_danamon_online_settings', []);
    $this->gateway = new WC_Gateway_Midtrans_Sub_Danamon_Online();
  }

  public function get_payment_method_script_handles()
  {
    wp_register_script(
      'midtrans-sub-danamon-online',
      MDTR_URL . 'assets/js/danamon-online.js',
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
      wp_set_script_translations('midtrans-sub-danamon-online');
    }

    return ['midtrans-sub-danamon-online'];
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
