<div {{ $attributes->merge(['class' => 'aslider owl-carousel owl-theme', 'id' => '']) }}>
    @if($customSlides && isset($slideItems))
        {!! $slideItems !!}
    @else
        @foreach($slides as $slide)
            @if($thisSlider->in_background)
                <div class="aslider-item in_background" style="background-image: url('{{ $slide->image_lg() }}');">
                    <div class="content p-3 p-sm-4 p-md-5">
                        <h1 class="title">{{ $slide->title }}</h1>
                        <p class="subtitle">{{ $slide->subtitle }}</p>
                        @if($slide->url_link)
                            <a href="{{ $slide->url_link }}" class="btn">Learn More</a>
                        @endif
                    </div>
                </div>
            @else
                <div class="aslider-item">
                    <a href="{{ $slide->url_link }}" target="_blank">
                        <img src="{{ $slide->image_lg() }}" alt="aslider image">
                    </a>
                </div>
            @endif
        @endforeach
    @endif
</div>

@once
    @push('styles')
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" integrity="sha512-tS3S5qG0BlhnQROyJXvNjeEM4UpMXHrQfTGmbQ1gKmelCxlSEBUaxhRBj/EFTzpbP4RVSrpEikbmdJobCvhE3g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css" integrity="sha512-sMXtMNL1zRzolHYKEujM2AqCLUR9F2C4/05cdbxjjLSRvMQIciEPCQZo++nk7go3BtSuK9kfa/s+a4f4i5pLkw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <style>
            .aslider{
                background-color: {{ $thisSlider->bg_color ?? '#eaeaea' }};
            }
            .aslider .in_background{
                max-width: 100%;
                background-position: center;
                background-size: cover;
                display: flex;
                padding: 20px;
                min-height: {{ isset($slider_size['height']) ? $slider_size['height'].'px' : 'auto' }};
            }
            .aslider .in_background .content{
                margin: auto;
                color: white;
                text-align: center;
                background-color: rgba(50, 50, 50, 0.3);
                max-width: 800px;
                border: 10px solid transparent;
                transition: all 0.3s ease-in;
            }
            .aslider .in_background .content:hover{
                box-shadow: 0 .4rem 0.8rem rgba(0,0,0,.4)!important;
                background-color: rgba(50, 50, 50, 0.5);
                transition: all 0.3s ease-in;
            }
            .aslider .in_background .content .title{
                font-weight: 800;
            }
            .aslider .in_background .content .subtitle{
                font-size: 1.2rem;
            }
            .aslider .in_background .content .btn{
                background-color: rgba(50, 50, 50, 1);
                color: #fff;
                font-weight: 700;
                font-size: 1rem;
                border-radius: 2px;
                padding: 8px 28px;
                border: 2px solid transparent;
            }
            .aslider .in_background .content .btn:hover{
                border: 2px solid rgba(50, 50, 50, 1);
                background-color: transparent;
                color: rgba(50, 50, 50, 1);
                background-color: rgba(255, 255, 255, 0.4);
            }

            .aslider img { width: 100% }
            .aslider.owl-carousel .owl-nav button{
                background: rgba(50, 50, 50, 0.6);
                font-size: 1.5rem;
                color: white;
                font-weight: 800;
                opacity: 0.6;
                transition: all 0.3s ease;
            }
            .aslider.owl-carousel .owl-nav button:hover{
                opacity: 1;
                transition: all 0.3s ease;
            }
            .aslider.owl-carousel .owl-nav button span{
                padding: 0px 1rem;
            }
            .aslider.owl-carousel .owl-dots{
                position: absolute;
                width: inherit;
                bottom: 0px;
                background-color: rgb(100 100 100 / 30%);
                padding-top: 10px;
            }
        </style>
    @endpush
    @push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js" integrity="sha512-bPs7Ae6pVvhOSiIcyUClR7/q2OAsRiovw4vAkX+zJbw3ShAeeqezq50RIIcIURq7Oa20rW2n2q+fyXBNcU9lrw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        $(document).ready(function () {
            $(".aslider").owlCarousel(JSON.parse('{!! $options !!}'));
        });
    </script>
    @endpush
@endonce
