
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

##  Getting your custom slides: [Demo](https://project.takshaktiwari.com/packages/adash-slider#demo-custom-slider)
You can make your own slides for the slider. You just need to add an attribute `custom-slides="1"` with `slideItems` slot. Eg:

    <x-aslider-aslider custom-slides="1">
        <x-slot:slideItems>
            <div class="card border-0 overflow-hidden">
                <div class="card-body text-center pb-5 px-4 pt-4">
                    <p class="mb-2 fs-5">Lorem vel similique perspiciatis aperiam? ipsum dolor sit amet consectetur, adipisicing elit. Mollitia. Lorem ipsum dolor sit. Lorem, ipsum.   </p>
                    <h4 class="fw-bold">Lorem, Slide 1.</h4>
                </div>
            </div>

            <div class="card border-0 overflow-hidden">
                <div class="card-body text-center pb-5 px-4 pt-4">
                    <p class="mb-2 fs-5">Mollitia, vel similique perspiciatis aperiam? Lorem ipsum dolor sit amet consectetur, adipisicing elit. Lorem ipsum dolor sit. Lorem, ipsum.   </p>
                    <h4 class="fw-bold">Lorem, Slide 2.</h4>
                </div>
            </div>
        </x-slot>
    </x-aslider-aslider>

## Slider Demos/Examples
- **Default Slider:**[Demo](https://project.takshaktiwari.com/packages/adash-slider#demo-default-slider)

        <x-aslider-aslider />
    
- **Slider with specific size's images:**[Demo](https://project.takshaktiwari.com/packages/adash-slider#demo-sized-slider)

        <x-aslider-aslider size="large" />

- **Slider without dots:**[Demo](https://project.takshaktiwari.com/packages/adash-slider#demo-nav-slider)

        <x-aslider-aslider :dots="false" :nav="true" />

- **Slider without autoplay:**[Demo](https://project.takshaktiwari.com/packages/adash-slider#demo-autoplay-disable-slider)

        <x-aslider-aslider :autoplay="false" />

- **Slider with only 2 slides:**[Demo](https://project.takshaktiwari.com/packages/adash-slider#demo-slide-limit-slider)
    
        <x-aslider-aslider limit="2" />

- **Show different slider:**[Demo](https://project.takshaktiwari.com/packages/adash-slider#demo-other-slider)
    
        <x-aslider-aslider slider="Example Slider" />

- **Slider with advance options:**[Demo](https://project.takshaktiwari.com/packages/adash-slider#demo-advance-options-slider)

        <x-aslider-aslider slider="Example Slider" limit="3" :options="[
            'margin'    =>  15,
            'loop'      =>  false,
            'autoplayTimeout'   =>  2000,
            'autoplayHoverPause'    =>  true
        ]" />
        

