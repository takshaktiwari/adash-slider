<?php

namespace Takshak\Aslider\View\Components;

use App\Models\Slider;
use Illuminate\Support\Facades\View;
use Jenssegers\Agent\Agent;
use Illuminate\View\Component;

class Aslider extends Component
{
    public $options;
    public $slides;
    public function __construct(
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
        $responsive = []
    ) {
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
        $this->setSlides($size, $random, $limit);

    }

    public function setSlides($size, $random, $limit)
    {
        $query = Slider::active();
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
