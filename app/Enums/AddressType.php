<?php
namespace App\Enums;


/**
 * Class AddressType
 *
 * @author  Fandy Fadian <fandy.fadian@gmail.com>
 * @package App\Enums
 */
enum AddressType: string
{
    case Shipping = 'shipping';
    case Billing = 'billing';
}
