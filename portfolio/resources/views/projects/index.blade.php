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
        <a href="/#about" class="text-gray-300 hover:text-white"><i class="active:text-purple-100 hover:text-purple-200 text-purple-400 fa-solid fa-address-card"></i></a>
        <a href="/#projects" class="text-gray-300 hover:text-white"><i class="active:text-purple-100 hover:text-purple-200 text-purple-400 fa-solid fa-code"></i></a>
        <a href="/#contact" class="text-gray-300 hover:text-white"><i class="active:text-purple-100 hover:text-purple-200 text-purple-400 fa-solid fa-envelope"></i></a>
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
    <main class="ml-16 min-h-screen flex">
        <!-- 🔥 Sidebar (Filters) -->
        <aside class="w-1/6 flex h-4/5 flex-col text-white p-5 shadow-lg sticky top-16">
            <h2 class="text-xl font-semibold  mb-4">Filter op technologieën</h2>

            <form method="GET" action="{{ route('projects.index') }}">
                <div class="space-y-3">
                    @foreach ($technologies as $tech)
                        <label class="flex items-center gap-2 cursor-pointer">
                            <input type="checkbox" name="technologies[]" value="{{ $tech->name }}"
                                {{ in_array($tech->name, $selectedTechs) ? 'checked' : '' }}
                                class="w-5 h-5 text-purple-500 bg-gray-700 border-gray-600 rounded focus:ring-purple-400">
                            <span class="text-gray-300">{{ $tech->name }} ({{ $tech->projects->count() }})</span>
                        </label>
                    @endforeach
                </div>

                <!-- 🔥 Zoek en reset knoppen -->
                <div class="mt-6 flex flex-col gap-3">
                    <button type="submit" class="bg-purple-600 px-5 py-2 rounded-lg hover:bg-purple-700 transition text-white w-full">
                        Zoek
                    </button>

                    @if (!empty($selectedTechs))
                        <a href="{{ route('projects.index') }}" class="text-red-400 hover:underline text-center">
                            Reset filter
                        </a>
                    @endif
                </div>
            </form>
        </aside>

        <!-- 🔥 Projectenlijst -->
        <div class="flex items-center py-20 w-5/6 flex-col px-20">
            @forelse ($projects as $project)
                <a href="{{ route('projects.show', $project->id) }}" class="project-box transition-all duration-300 transform hover:scale-105 h-[230px] border-2 m-4 w-full flex flex-row border-gray-700 bg-opacity-40 shadow-lg shadow-black border-solid p-4 rounded-lg bg-gray-800">
                    <div class="project-thumbnail pr-5 w-1/4 flex justify-center items-center object-cover overflow-hidden h-auto">
                        <img src="{{ asset('storage/' . $project->thumbnail) }}" alt="{{ $project->title }}" class="rounded-lg">
                    </div>
                    <div class="project-text w-3/4 relative pl-5 border-l-2 border-gray-700">
                        <h3 class="text-lg font-bold">{{ $project->title }}</h3>
                        <p class="text-sm">{{ $project->introduction }}</p>
                        <div class="mt-2 absolute inset-x-5 bottom-0">
                            @foreach ($project->technologies as $technology)
                                <span class="px-3 py-1 bg-purple-600 text-white text-xs rounded-full mr-2">
                                    {{ $technology->name }}
                                </span>
                            @endforeach
                        </div>
                    </div>
                </a>
                @empty
                <div class="flex flex-col items-center justify-center text-gray-400 mt-10 h-[600px]">
                    <img src="{{ asset('storage/img/no-projects.png') }}" alt="Geen projecten gevonden"
                         class="w--[500px] h-auto opacity-80 drop-shadow-[0_4px_10px_rgba(255,255,255,0.6)]">

                    <h3 class="text-xl font-semibold text-white mt-5">Geen projecten gevonden!</h3>
                    <p class="text-gray-500 text-sm text-white text-center max-w-sm">Probeer een andere combinatie van filters of voeg nieuwe projecten toe.</p>

                    @if (!empty($selectedTechs))
                        <a href="{{ route('projects.index') }}"
                           class="mt-6 bg-purple-400 px-5 py-2 rounded-lg hover:bg-red-700 transition text-white">
                            Reset filters
                        </a>
                    @endif
                </div>
            @endforelse

        </div>
    </main>
    <footer class="fixed bottom-0 mt-10 left-0 w-full bg-gray-800 p-4 text-center text-gray-400 z-50">
        © 2025 Jeroen Wessel - Alle rechten voorbehouden
    </footer>

</body>

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
