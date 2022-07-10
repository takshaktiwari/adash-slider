<?php

namespace Takshak\Aslider\View\Components;

use Takshak\Aslider\Models\Slide;
use Takshak\Aslider\Models\Slider;
use Illuminate\Support\Facades\View;
use Jenssegers\Agent\Agent;
use Illuminate\View\Component;

class Aslider extends Component
{
    public $options;
    public $slides;
    public $slider;
    public $agent;
    public $slider_size = [];
    public $thisSlider;
    public $customSlides = false;
    public function __construct(
        $slider = 'Default',
        $size = null,
        $limit = null,
        $random = false,
        $options = null,
        $overrides = [],
        $autoplay = true,
        $loop = true,
        $margin = 10,
        $nav = false,
        $dots = true,
        $items = 1,
        $responsive = [],
        $customSlides = false
    ) {
        $this->customSlides = (bool)$customSlides;

        $this->agent = new Agent();

        $this->slider = $slider;
        $this->options = $options ? $options : null;

        if (!$this->options) {
            $this->options = [
                'autoplay'  =>  $autoplay,
                'loop'      =>  $loop,
                'margin'    =>  $margin,
                'nav'       =>  $nav,
                'dots'      =>  $dots,
                'items'     =>  $items
            ];
        }

        if (count($responsive)) {
            $this->options['responsive'] = $responsive;
        }

        foreach ($overrides as $key => $value) {
            $this->options[$key] = $value;
        }

        $this->options = is_array($this->options) ? json_encode($this->options) : $this->options;

        if (!$this->customSlides) {
            $this->setSlides($size, $random, $limit);

            if ($size) {
                $keyName = 'size_' . $size;
                $this->slider_size = $this->thisSlider->$keyName;
            } else {
                if ($this->agent->isTablet()) {
                    $this->slider_size = $this->thisSlider->size_medium;
                } elseif ($this->agent->isMobile()) {
                    $this->slider_size = $this->thisSlider->size_small;
                } else {
                    $this->slider_size = $this->thisSlider->size_large;
                }
            }
        }
    }

    public function setSlides($size, $random, $limit)
    {
        $this->thisSlider = Slider::query()
            ->where(function ($query) {
                $query->where('name', $this->slider)->orWhere('name', $this->slider);
            })
            ->where('status', true)
            ->first();
        abort_if(!$this->thisSlider, 404, 'Slider not found');

        $query = Slide::where('slider_id', $this->thisSlider->id)->active();
        if ($size) {
            $query->where('display_size', $size);
        } else {
            $agent = new Agent();
            if ($agent->isTablet()) {
                $query->where('display_size', 'medium');
            } elseif ($agent->isMobile()) {
                $query->where('display_size', 'small');
            } else {
                $query->where('display_size', 'large');
            }
        }

        if ($random) {
            $query->inRandomOrder();
        } else {
            $query->orderBY('set_order', 'ASC');
        }

        if ($limit) {
            $query->limit($limit);
        }

        $this->slides = $query->get();
    }

    public function render()
    {
        return View::first(['components.aslider', 'aslider::components.aslider']);
    }
}
