<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'total_amount',
        'status',
        'shipping_address',
        'payment_method',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    /**
     * اسم حالة الطلب بالعربية.
     */
    public function getStatusLabelAttribute(): string
    {
        return [
            'pending'    => 'قيد الانتظار',
            'processing' => 'قيد التجهيز',
            'shipped'    => 'تم الشحن',
            'completed'  => 'مكتمل',
            'cancelled'  => 'ملغي',
        ][$this->status] ?? $this->status;
    }

    /**
     * اسم طريقة الدفع بالعربية.
     */
    public function getPaymentMethodLabelAttribute(): string
    {
        return [
            'cash'     => 'الدفع عند الاستلام',
            'transfer' => 'تحويل بنكي',
            'card'     => 'بطاقة',
        ][$this->payment_method] ?? ($this->payment_method ?? '-');
    }
}

