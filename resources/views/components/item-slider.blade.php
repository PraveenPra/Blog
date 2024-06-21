<style>
     /* //category slider style */
     .slider-container {
            position: relative;
            overflow: hidden;
            width: 100%;
            /* Adjust as needed */
        }

        .slider {
            /* width: 94%; */
            display: flex;
            overflow-x: auto;
            scroll-snap-type: x mandatory;
            -webkit-overflow-scrolling: touch;
            padding-bottom: 10px;
            /* Adjust as needed */
        }

        .slider-content {
            
            display: flex;
            gap: 10px;
            /* Adjust as needed */
        }

        .slider-item {
            scroll-snap-align: start;
            white-space: nowrap;
            border-radius: 999px;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
        }

        .slider-button {
            position: absolute;
             top: 0%;
            border: none;
            cursor: pointer;
            width: 24px;
            height: 40px;
            font-size: 24px;
            z-index: 1;
        }

        .prev {
            left: -2px;
            /* Adjust button position */
        }

        .next {
            right: -2px;
            /* Adjust button position */
        }

        /* Hide scrollbar */
        .slider::-webkit-scrollbar {
            display: none;
        }
</style>

<div class="slider-container">
    <button class="slider-button prev">&lt;</button>
    <div class="slider">
        <div class="slider-content">
            @foreach ($items as $item)
                <a href="{{ $item['route'] }}" class="slider-item bg-gray-200 text-gray-700 px-4 py-2 rounded mr-2
                    {{ request()->is($item['activeRoute']) ? 'bg-green-500 text-white' : '' }}">
                    {{ $item['name'] }}
                </a>
            @endforeach
        </div>
    </div>
    <button class="slider-button next">&gt;</button>
</div>

@push('scripts')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const sliderContainer = document.querySelector('.slider-container');
            const slider = sliderContainer.querySelector('.slider');
            const prevButton = sliderContainer.querySelector('.prev');
            const nextButton = sliderContainer.querySelector('.next');

            prevButton.addEventListener('click', function() {
                slider.scrollBy({
                    left: -slider.offsetWidth,
                    behavior: 'smooth'
                });
            });

            nextButton.addEventListener('click', function() {
                slider.scrollBy({
                    left: slider.offsetWidth,
                    behavior: 'smooth'
                });
            });
        });
    </script>
@endpush
