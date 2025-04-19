<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class ServiceCard extends Model
{
    use HasFactory;

    protected $fillable = [
        'service_type_id',
        'phone_id',
        'pickup_point',
        'destination',
        'price',
        'main_image',
        'description',  // Đảm bảo có trường này
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'price' => 'integer',
    ];

    // Relationship with ServiceType
    public function serviceType()
    {
        return $this->belongsTo(ServiceType::class);
    }

    // Relationship with Phone
    public function phone()
    {
        return $this->belongsTo(Phone::class);
    }

    // Get main image URL
    public function getMainImageUrlAttribute()
    {
        if ($this->main_image) {
            return Storage::url($this->main_image);
        }
        return null;
    }

    // Get secondary image URL
    public function getSecondaryImageUrlAttribute()
    {
        if ($this->secondary_image) {
            return Storage::url($this->secondary_image);
        }
        return null;
    }

    // Format price with currency
    public function getFormattedPriceAttribute()
    {
        return number_format($this->price, 0, ',', '.') . 'K';
    }
}