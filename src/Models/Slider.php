<?php

namespace Takshak\Aslider\Models;

use Takshak\Aslider\Models\Slide;
use Database\Factories\SliderFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Slider extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $casts = [
        'size_small'    =>  'array',
        'size_medium'   =>  'array',
        'size_large'    =>  'array',
    ];

    protected static function newFactory()
    {
        return SliderFactory::new();
    }

    /**
     * Get all of the slides for the Slider
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function slides(): HasMany
    {
        return $this->hasMany(Slide::class);
    }
}
