<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract; // Alias the contract
use OwenIt\Auditing\Auditable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model implements AuditableContract // Implement the contract
{
    use HasFactory, Notifiable, Auditable; // Use the trait

    protected $fillable = [
        'name',
        'description',
        'price',
        'points',
        'quantity',
        'image',
        'category_id',
        'sku',
        'is_active',
    ];

    protected $auditInclude = [
        'name',
        'price',
        'description',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
