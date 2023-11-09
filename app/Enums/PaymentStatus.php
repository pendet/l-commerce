<?php

namespace App\Enums;


/**
 * Class PaymentStatus
 *
 * @author  Fandy Fadian <fandy.fadian@gmail.com>
 * @package App\Enums
 */
enum PaymentStatus: string
{
    case Pending = 'pending';
    case Paid = 'paid';
    case Failed = 'failed';
}
