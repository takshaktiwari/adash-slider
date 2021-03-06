
#  Introduction
An extension for slider for takshak/adash package. This will he helper to create image slider or even for cards, products etc

##  Installation
Require the package with composer

    composer require takshak/adash-slider

Run the command to setup the table, pages, models and all

    php artisan adash-slider:install

Add Component `<x-aslider-aslider />` to your view where you want to show the slider.
Multiple sliders for different location can be added through admin panel.

##  Component Options
| Parameters | Default | Description |
|--|--|--|
| slider | Default | Name or slug of the slider |
| size |  | Display size of slides, by default it will show all sizes in responsive behavior |
| limit |  | Number of slides to be shown, will show by default |
| random | false | Get slides in random order |
| options |  | Slider options passed as array |
| overrides |  | Override the default options |
| autoplay | true | Autoplay the slider |
| loop | true | Play slides in the loop |
| margin | 10 | Margin between slides |
| nav | false | Show navigation buttons |
| dots | true | Sow navigation dots |
| items | 1 | Items shown at one slide |
| custom-slides | false | Get your custom slides |

---

Slider uses [OwlCarousel2](https://owlcarousel2.github.io/OwlCarousel2/) for slider.

**`options:`** OwlCarousel2 options parameters should be 	passed in array format. eg:

    <x-aslider-aslider :options="[
	    'items' 	=>	2,
	    'margin' 	=>	10,
	    'nav'		=>	true
    ]" />

**`responsive:`** OwlCarousel2 options' responsive parameters should be	passed in array format for responsiveness of slider. eg:

     <x-aslider-aslider :responsive="[
    	    '0' 	=>	[
	    	    'items' => 1,
	    	    ...
    	    ],
    	    '480' 	=>	[
	    	    'items' => 2,
	    	    ...
    	    ],
    	    '768' 	=>	[
	    	    'items' => 3,
	    	    ...
    	    ]
        ]" />

For more options and customization go to  [OwlCarousel2 documentation](https://owlcarousel2.github.io/OwlCarousel2/docs/started-welcome.html)

##  Getting your custom slides
You can make your own slides for the slider. You just need to add an attribute `custom-slides="1"` with `slideItems` slot. Eg:

    <x-aslider-aslider custom-slides="1">
        <x-slot:slideItems>
            <h1 class="text-center py-5 bg-secondary mb-0 text-white">
                Lorem ipsum dolor sit amet.
            </h1>
            <h1 class="text-center py-5 bg-secondary mb-0 text-white">
                Lorem ipsum dolor sit amet, consectetur adipisicing elit.
            </h1>
            <h1 class="text-center py-5 bg-secondary mb-0 text-white">
                Lorem ipsum dolor, sit amet consectetur adipisicing elit. Odio, optio!
            </h1>
        </x-slot>
    </x-aslider-aslider>
