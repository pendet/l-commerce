<?php

namespace App\Models;

use App\Enums\AddressType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Customer extends Model
{
    use HasFactory;

    // protected $primaryKey = 'user_id';

    protected $fillable = ['first_name', 'last_name', 'phone', 'status',];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function address(): HasOne
    {
        return $this->hasOne(CustomerAddress::class, 'customer_id', 'id');
    }

    private function _getAddresses(): HasOne
    {
        return $this->hasOne(CustomerAddress::class, 'customer_id', 'id');
    }

    public function shippingAddress(): HasOne
    {
        return $this->_getAddresses()->where('type', '=', AddressType::Shipping->value);
    }

    public function billingAddress(): HasOne
    {
        return $this->_getAddresses()->where('type', '=', AddressType::Billing->value);
    }
}
