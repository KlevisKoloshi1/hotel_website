<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'apartment_id',
        'check_in',
        'check_out',
        'adults',
        'children',
        'nightly_price',
        'cleaning_fee',
        'service_fee',
        'currency',
        'status',
        'first_name',
        'last_name',
        'email',
        'phone',
        'address',
        'city',
        'zip_code',
        'country',
        'special_requests',
    ];

    protected $casts = [
        'check_in' => 'date',
        'check_out' => 'date',
    ];

    public function apartment(): BelongsTo
    {
        return $this->belongsTo(Apartment::class);
    }
}


