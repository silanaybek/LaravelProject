<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'user_id', 'order_number', 'total_price', 'status',
        'name', 'phone', 'address', 'city', 'note', 'payment_method'
    ];

    public function getPaymentMethodLabelAttribute()
    {
        return match($this->payment_method) {
            'bank_transfer'    => 'Banka Havalesi / EFT',
            'cash_on_delivery' => 'Kapıda Ödeme',
            'paypal'           => 'PayPal',
            default            => $this->payment_method,
        };
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function getStatusLabelAttribute()
    {
        return match($this->status) {
            'new'        => 'Yeni',
            'accepted'   => 'Onaylandı',
            'onshipping' => 'Kargoda',
            'completed'  => 'Tamamlandı',
            'cancelled'  => 'İptal',
            default      => $this->status,
        };
    }

    public function getStatusBadgeAttribute()
    {
        return match($this->status) {
            'new'        => 'secondary',
            'accepted'   => 'info',
            'onshipping' => 'primary',
            'completed'  => 'success',
            'cancelled'  => 'danger',
            default      => 'secondary',
        };
    }
}
