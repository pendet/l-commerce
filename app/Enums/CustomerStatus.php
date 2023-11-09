<?php
namespace App\Enums;


/**
 * Class CustomerStatus
 *
 * @author  Fandy Fadian <fandy.fadian@gmail.com>
 * @package App\Enums
 */
enum CustomerStatus: string
{
    case Active = 'active';
    case Disabled = 'disabled';
}
