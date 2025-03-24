<!DOCTYPE html>
<html class="scroll-smooth" lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jeroen's Projecten</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
<body class="bg-gray-900 text-white font-sans scroll-smooth relative bg-custom glow overflow-x-hidden">
    <div id="glow-container" class="absolute top-0 left-0 border-2 w-full h-full overflow-hidden z-[-1]"></div>

    <header class="fixed top-0 left-0 w-full bg-gray-800 p-4 text-center shadow-lg z-50">
        <h1 class="text-xl font-bold">jeroen<span class="text-purple-400">&lt;wessel&gt;</span></h1>
    </header>

    <nav class="fixed left-0 top-8 w-16 h-full bg-gray-800 flex flex-col items-center justify-center py-4 space-y-6 z-50">
        <a href="/" class="text-gray-300 hover:text-white"><i class="active:text-purple-100 hover:text-purple-200 text-purple-400 fa-solid fa-house"></i></a>
        <a href="#about" class="text-gray-300 hover:text-white"><i class="active:text-purple-100 hover:text-purple-200 text-purple-400 fa-solid fa-address-card"></i></a>
        <a href="#projects" class="text-gray-300 hover:text-white"><i class="active:text-purple-100 hover:text-purple-200 text-purple-400 fa-solid fa-code"></i></a>
        <a href="#contact" class="text-gray-300 hover:text-white"><i class="active:text-purple-100 hover:text-purple-200 text-purple-400 fa-solid fa-envelope"></i></a>
    </nav>


    <style>
    /* Achtergrond met paarse gloed */
    .bg-custom {
        background: linear-gradient(to bottom, #0b0b2b, #1b2735 70%, #090a0f);
    }

    .glow::before {
        content: "";
        position: absolute;
        width: 100%;
        height: 100%;
        background: radial-gradient(circle, rgba(128,0,128,0.2) 10%, transparent 80%);
        z-index: -1;
    }



    /* Twinkling effect */
    @keyframes customwave {
    0% {
        transform: rotate3d(0, 0, 1, var(--rotate)) translate(0%, 0%);
    }
    25% {
        transform: rotate3d(0, 0, 1, calc(var(--rotate) * 0.8)) translate(var(--x-offset), var(--y-offset));
    }
    50% {
        transform: rotate3d(0, 0, 1, calc(var(--rotate) * -0.6)) translate(calc(var(--x-offset) * -1.5), calc(var(--y-offset) * -1.5));
    }
    75% {
        transform: rotate3d(0, 0, 1, calc(var(--rotate) * 1.2)) translate(var(--x-offset), var(--y-offset));
    }
    100% {
        transform: rotate3d(0, 0, 1, var(--rotate)) translate(0%, 0%);
    }
}

.animated-icon {
    position: absolute;
    top: var(--top);
    left: var(--left);
    animation: customwave var(--duration) infinite ease-in-out;
    filter: brightness(35%);
    drop-shadow: 0px 0px 10px rgba(255, 255, 255, 0.5);
}

.floating-glow {
    height: 450px;
    width: 450px;
    position: absolute;
    width: var(--size);
    height: var(--size);
    background: radial-gradient(circle, rgba(255, 0, 200, 0.555) 20%, transparent 80%);
    border-radius: 50%;
    opacity: 0.35;
    animation: floatAround var(--duration) infinite ease-in-out alternate;
    filter: blur(60px);
}

/* Animatie voor zwevende gloed */
@keyframes floatAround {
    0% {
        transform: translate(0px, 0px) scale(1);
    }
    50% {
        transform: translate(var(--x-end), var(--y-end)) scale(1.2);
        opacity: 0.6;
    }
    100% {
        transform: translate(0px, 0px) scale(1);
    }
}



    </style>

    <main class="ml-16 min-h-screen flex flex-col items-center px-6 sm:px-10 py-24 text-gray-300 space-y-12">

        <h1 class="text-3xl sm:text-3xl font-extrabold text-purple-400 text-center leading-tight drop-shadow-md">
            {{ $project->title }}
        </h1>

        <div class="max-w-4xl mt-4">
            <img src="{{ asset('storage/' . $project->thumbnail) }}" class="rounded-xl w-full object-cover h-[450px] shadow-2xl border border-gray-800">
        </div>

        <section class="text-center w-full max-w-3xl">
            <h1 class="text-3xl font-bold text-purple-300 pt-6 border-b border-purple-800 pb-2">Inleiding</h1>
            <p class="text-lg leading-relaxed text-gray-300 mt-4">
                {{ $project->introduction }}
            </p>
        </section>

        <section class="text-center w-full">
            <h1 class="text-3xl font-bold text-purple-300 pt-6 border-b border-purple-800 pb-2">Afbeeldingen</h1>

            @if ($project->images->count() > 0)
                <div class="relative w-full overflow-hidden p-6 md:p-20">
                    <div class="flex justify-center">
                        <div id="carousel-track" class="flex transition-transform duration-500 ease-in-out gap-4">
                            {{-- Clone van laatste afbeelding aan het begin --}}
                            @if ($project->images->count() > 1)
                                @php $lastImage = $project->images->last(); @endphp
                                <div class="max-w-[60%] flex-shrink-0 aspect-video rounded-xl overflow-hidden bg-black shadow-xl flex items-center justify-center">
                                    <img src="{{ asset('storage/' . $lastImage->path) }}" class="object-contain max-h-full max-w-full">
                                </div>
                            @endif

                            {{-- Echte afbeeldingen --}}
                            @foreach ($project->images as $image)
                                <div class="max-w-[60%] flex-shrink-0 aspect-video rounded-xl overflow-hidden bg-black shadow-xl flex items-center justify-center">
                                    <img src="{{ asset('storage/' . $image->path) }}" class="object-contain max-h-full max-w-full" draggable="false">
                                </div>
                            @endforeach

                            {{-- Clone van eerste afbeelding aan het einde --}}
                            @if ($project->images->count() > 1)
                                @php $firstImage = $project->images->first(); @endphp
                                <div class="max-w-[60%] flex-shrink-0 aspect-video rounded-xl overflow-hidden bg-black shadow-xl flex items-center justify-center">
                                    <img src="{{ asset('storage/' . $firstImage->path) }}" class="object-contain max-h-full max-w-full">
                                </div>
                            @endif
                        </div>
                    </div>

                    {{-- Carousel indicators --}}
                    <div id="carousel-indicators" class="absolute bottom-4 left-1/2 transform -translate-x-1/2 flex space-x-2">
                        @foreach ($project->images as $index => $image)
                            <div
                                class="w-3 h-3 bg-gray-600 rounded-full cursor-pointer transition duration-300 hover:scale-125 hover:bg-purple-400"
                                onclick="goToSlide({{ $index }})"
                                data-index="{{ $index }}">
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        </section>





        <section class="text-center w-full max-w-3xl">
            <h1 class="text-3xl font-bold text-purple-300 pt-6 border-b border-purple-800 pb-2">Over dit project</h1>
            <p class="text-lg leading-relaxed text-gray-300 mt-4">
                {{ $project->body }}
            </p>
        </section>

        <div class="mt-6 flex flex-wrap gap-4 justify-center">
            @if($project->url)
                <a href="{{ $project->url }}" target="_blank"
                   class="bg-purple-800/20 hover:bg-purple-800/40 text-purple-300 px-5 py-2 rounded-lg transition duration-300 text-base flex items-center space-x-2 shadow-md">
                    🌍 <span>Live Demo</span>
                </a>
            @endif
            @if($project->github)
                <a href="{{ $project->github }}" target="_blank"
                   class="bg-gray-700/30 hover:bg-gray-700/50 text-gray-300 px-5 py-2 rounded-lg transition duration-300 text-base flex items-center space-x-2 shadow-md">
                    <span>GitHub Repo</span>
                </a>
            @endif
        </div>

        <div class="mt-10 text-center">
            <h3 class="text-xl font-semibold text-purple-400">🛠️ Gebruikte technologieën:</h3>
            <div class="flex flex-wrap justify-center gap-3 mt-4">
                @foreach ($project->technologies as $technology)
                    <span class="px-4 py-1.5 bg-purple-700/80 text-white text-sm font-medium rounded-full shadow-md hover:scale-105 transition duration-300">
                        {{ $technology->name }}
                    </span>
                @endforeach
            </div>
        </div>

        <div class="mt-12">
            <a href="{{ route('projects.index') }}"
               class="text-purple-400 hover:bg-purple-800/30 px-5 py-2 rounded-md transition duration-300 text-base flex items-center space-x-2 border border-purple-500/30 hover:shadow-lg">
                <span>Terug naar projecten</span>
            </a>
        </div>
    </main>
</body>


<script>
    const track = document.getElementById('carousel-track');
    const indicators = document.querySelectorAll('#carousel-indicators > div');
    const totalSlides = {{ $project->images->count() }};
    let currentIndex = 1;
    let startX = 0;
    let isDragging = false;
    let autoplayInterval;

    function updateSlidePosition(animate = true) {
        const slides = track.querySelectorAll('div');
        const slideWidth = slides[0].offsetWidth;
        const gap = 16; // gap-4 = 16px
        const wrapperWidth = track.parentElement.offsetWidth;

        const offset = (slideWidth + gap) * currentIndex - (wrapperWidth - slideWidth) / 2;

        if (!animate) {
            track.style.transition = 'none';
        } else {
            track.style.transition = 'transform 0.5s ease-in-out';
        }

        track.style.transform = `translateX(-${offset}px)`;

        indicators.forEach((dot, i) => {
            dot.classList.toggle('bg-purple-400', i === (currentIndex - 1));
            dot.classList.toggle('bg-gray-600', i !== (currentIndex - 1));
        });
    }




    track.addEventListener('transitionend', () => {
        const slides = track.querySelectorAll('div');

        if (currentIndex === 0) {
            // van clone laatste → echte laatste
            currentIndex = totalSlides;
            updateSlidePosition(false); // zonder animatie
        } else if (currentIndex === slides.length - 1) {
            // van clone eerste → echte eerste
            currentIndex = 1;
            updateSlidePosition(false); // zonder animatie
        }
    });





function goToSlide(index) {
    currentIndex = index + 1;
    updateSlidePosition();
    resetAutoplay();
}


    function nextSlide() {
        currentIndex++;
        updateSlidePosition();
    }


    function resetAutoplay() {
        clearInterval(autoplayInterval);
        autoplayInterval = setInterval(nextSlide, 5000);
    }

    // Swipe / drag functionaliteit
    track.addEventListener('mousedown', (e) => {
        isDragging = true;
        startX = e.clientX;
    });

    track.addEventListener('mouseup', (e) => {
        if (!isDragging) return;
        isDragging = false;
        const diff = e.clientX - startX;
        handleSwipe(diff);
    });

    track.addEventListener('mouseleave', () => {
        isDragging = false;
    });

    track.addEventListener('touchstart', (e) => {
        startX = e.touches[0].clientX;
    });

    track.addEventListener('touchend', (e) => {
        const endX = e.changedTouches[0].clientX;
        const diff = endX - startX;
        handleSwipe(diff);
    });

    function handleSwipe(diff) {
        const threshold = 50;

        if (diff > threshold) {
            currentIndex--;
        } else if (diff < -threshold) {
            currentIndex++;
        }

        updateSlidePosition();
        resetAutoplay();
    }



    updateSlidePosition(false); // zonder animatie bij eerste keer laden
    autoplayInterval = setInterval(nextSlide, 10000);

</script>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        document.querySelectorAll(".animated-icon").forEach(icon => {
            let baseTop = parseFloat(icon.getAttribute("data-top"));
            let baseLeft = parseFloat(icon.getAttribute("data-left"));

            let randomXOffset = (Math.random() * 8 - 4) + "%";  // **-4% tot +4%**
            let randomYOffset = (Math.random() * 8 - 4) + "%";  // **-4% tot +4%**

            let randomRotate = (Math.random() * 60 - 30) + "deg";  // -30° tot +30°
            let randomDuration = (Math.random() * 15 + 25) + "s";  // **25s tot 40s** (vloeiendere beweging)

            icon.style.setProperty("--top", baseTop + "%");
            icon.style.setProperty("--left", baseLeft + "%");
            icon.style.setProperty("--x-offset", randomXOffset);
            icon.style.setProperty("--y-offset", randomYOffset);
            icon.style.setProperty("--rotate", randomRotate);
            icon.style.setProperty("--duration", randomDuration);
        });
    });

    document.addEventListener("DOMContentLoaded", function () {
        const glowContainer = document.getElementById("glow-container");
        const numBubbles = 15;
        const padding = 100;

        const pageWidth = document.documentElement.scrollWidth;
        const pageHeight = document.documentElement.scrollHeight;

        for (let i = 0; i < numBubbles; i++) {
            let glow = document.createElement("div");
            glow.classList.add("floating-glow");

            let size = Math.random() * 250 + 450 + "px";
            let duration = Math.random() * 5 + 5 + "s";

            glow.style.setProperty("--size", size);
            glow.style.setProperty("--duration", duration);

            //positie
            let xStart = Math.random() * (pageWidth - padding * 2) + padding;
            let yStart = Math.random() * (pageHeight - padding * 2) + padding;

            //bewegingen
            let xEnd = (Math.random() * 600 - 200) + "px";  // Beweegt max 200px links/rechts
            let yEnd = (Math.random() * 600 - 200) + "px";  // Beweegt max 200px op/neer

            glow.style.left = `${xStart}px`;
            glow.style.top = `${yStart}px`;
            glow.style.setProperty("--x-end", xEnd);
            glow.style.setProperty("--y-end", yEnd);

            glowContainer.appendChild(glow);
        }
    });

</script>

</html>
