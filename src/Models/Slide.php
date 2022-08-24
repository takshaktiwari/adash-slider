<?php

namespace Takshak\Aslider\Models;

use Takshak\Aslider\Models\Slider;
use Database\Factories\SlideFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Slide extends Model
{
    use HasFactory;
    protected $guarded = [];

    protected static function newFactory()
    {
        return SlideFactory::new();
    }

    /**
     * Get the slider that owns the Slide
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function slider(): BelongsTo
    {
        return $this->belongsTo(Slider::class);
    }

    public function image_lg()
    {
        return ($this->image_lg && \Storage::disk('public')->exists($this->image_lg))
            ? storage($this->image_lg)
            : 'https://via.placeholder.com/1000x800?text=No+Image';
    }
    public function image_md()
    {
        return ($this->image_md && \Storage::disk('public')->exists($this->image_md))
            ? storage($this->image_md)
            : 'https://via.placeholder.com/500x400?text=No+Image';
    }
    public function image_sm()
    {
        return ($this->image_sm && \Storage::disk('public')->exists($this->image_sm))
            ? storage($this->image_sm)
            : 'https://via.placeholder.com/250x200?text=No+Image';
    }

    public function scopeActive(Builder $query)
    {
        return $query->where('status', true);
    }
}
