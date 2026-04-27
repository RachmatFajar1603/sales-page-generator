<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SalesPage extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'product_name',
        'target_audience',
        'price',
        'description',
        'key_features',
        'unique_selling_points',
        'tone',
        'template',
        'generated_content',
        'status',
    ];

    protected $casts = [
        'generated_content' => 'array',
        'price' => 'decimal:2',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
