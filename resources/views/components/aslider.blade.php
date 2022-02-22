<div {{ $attributes->merge(['class' => 'aslider owl-carousel owl-theme', 'id' => '']) }}>
    @foreach($slides as $slide)
        <div class="aslider-item">
            <a href="{{ $slide->url_link }}" target="_blank">
                <img src="{{ $slide->image_lg() }}" alt="aslider image">
            </a>
        </div>
    @endforeach
</div>

@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" integrity="sha512-tS3S5qG0BlhnQROyJXvNjeEM4UpMXHrQfTGmbQ1gKmelCxlSEBUaxhRBj/EFTzpbP4RVSrpEikbmdJobCvhE3g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css" integrity="sha512-sMXtMNL1zRzolHYKEujM2AqCLUR9F2C4/05cdbxjjLSRvMQIciEPCQZo++nk7go3BtSuK9kfa/s+a4f4i5pLkw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<style>
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
