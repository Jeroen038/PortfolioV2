<!DOCTYPE html>
<html class="scroll-smooth" lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jeroen's Website</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
<body class="bg-gray-900 text-white font-sans scroll-smooth relative bg-custom glow overflow-x-hidden">
    <div class="stars"></div>

    <header class="fixed top-0 left-0 w-full bg-gray-800 p-4 text-center shadow-lg z-50">
        <h1 class="text-xl font-bold">jeroen<span class="text-purple-400">&lt;wessel&gt;</span></h1>
    </header>

    <nav class="fixed left-0 top-16 w-16 h-full bg-gray-800 flex flex-col items-center justify-center py-4 space-y-6 z-50">
        <a href="#home" class="text-gray-300 hover:text-white"><i class="active:text-purple-100 hover:text-purple-200 text-purple-400 fa-solid fa-house"></i></a>
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

    /* Sterren */
    .stars {
    position: absolute;
    width: 1px;
    height: 1px;
    background: white;
    box-shadow:
        5vw 10vh 2px white, 15vw 25vh 1px white, 30vw 40vh 2px white,
        45vw 55vh 1px white, 60vw 70vh 2px white, 75vw 85vh 1px white,
        10vw 50vh 2px white, 25vw 65vh 1px white, 50vw 80vh 2px white,
        5vw 90vh 1px white, 35vw 5vh 2px white, 80vw 10vh 2px white,
        90vw 20vh 1px white, 95vw 30vh 2px white, 10vw 90vh 1px white,
        20vw 85vh 1px white, 50vw 95vh 2px white, 70vw 15vh 1px white;
    animation: twinkle 8s infinite alternate;
    z-index: -100;
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





    </style>
    <main class="ml-16 pt-20">
        <section id="home" class="h-screen flex flex-col justify-center items-center text-center">
            <h1 class="text-5xl font-extrabold">Hi, ik ben <span class="text-purple-400">Jeroen Wessel</span></h1>
            <h2 class="text-2xl mt-4">Een Software Developer</h2>
            <div class="flex gap-6 mt-6">
                <img class="animated-icon z-[-1]" data-top="3" data-left="20" src="{{ asset('storage/img/hashtag.png') }}" alt="hashtag">
                <img class="animated-icon z-[-1]" data-top="3" data-left="70" src="{{ asset('storage/img/percent.png') }}" alt="percent">
                <img class="animated-icon z-[-1]" data-top="13" data-left="10" src="{{ asset('storage/img/bracket-closed.png') }}" alt="bracket-closed">
                <img class="animated-icon z-[-1]" data-top="15" data-left="60" src="{{ asset('storage/img/program.png') }}" alt="program">
            </div>
        </section>

        <section id="about" class="h-screen text-white flex justify-center items-center px-6 lg:px-20 relative">
            <div class="absolute inset-0 opacity-80"></div>

            <div class="relative w-full max-w-6xl flex flex-wrap justify-center items-start gap-8">

                <!-- Voorstellen blok -->
                <div class="window bg-black border border-gray-700 shadow-lg p-8 w-[550px] relative text-lg">
                    <div class="window-header flex justify-between text-gray-400 text-sm border-b border-gray-700 pb-3 mb-4">
                        <span>over-mij</span>
                        <span class="cursor-pointer">- x</span>
                    </div>
                    <p class="text-gray-300">
                        1 Hoi, ik ben <span class="font-bold text-green-400">Jeroen!</span> 22 jaar oud en een <span class="font-bold text-purple-400">gepassioneerde developer.</span><br>
                        2 Ik heb een voorkeur voor <span class="font-bold text-blue-400">front-end development</span> en vind het vakgebied erg interessant.<br>
                        3 Ik woon in <span class="font-bold text-yellow-400">Nederland</span> en werk graag met <span class="font-bold text-red-400">Tailwind</span> & <span class="font-bold text-blue-300">Laravel</span>.<br>
                        4 Ik hou van <span class="font-bold text-pink-400">leren</span> en het experimenteren met <span class="font-bold text-green-300">nieuwe technologieën.</span>
                    </p>
                </div>

                <!-- Afbeelding blok -->
                <div class="window border border-gray-700 shadow-lg w-[250px] h-[300px] flex flex-col p-6 overflow-hidden relative bg-black">
                    <div class="window-header flex justify-between text-gray-400 text-sm border-b border-gray-700 pb-3 w-full">
                        <span>portret</span>
                        <span class="cursor-pointer">- x</span>
                    </div>
                    <div class="flex-grow flex items-center justify-center">
                        <img src="{{ asset('storage/img/jeroen.png') }}" class="w-full h-full object-cover object-top hover:scale-110 transition-transform duration-300">
                    </div>
                </div>

                <!-- Werk locatie -->
                <div class="window bg-black border border-gray-700 shadow-lg p-6 w-[350px] text-lg">
                    <div class="window-header flex justify-between text-gray-400 text-sm border-b border-gray-700 pb-3 mb-4">
                        <span>waar-ik-werk</span>
                        <span class="cursor-pointer">- x</span>
                    </div>
                    <p class="text-gray-300">
                        1 <span class="text-green-400">Ik woon momenteel in Nederland</span><br>
                        2 <span class="text-blue-400">Ik studeer momenteel MBO 4 Software Development</span><br>
                        3 <span class="text-white-400">Ik werk momenteel bij FedEx in Zwolle</span><br>
                    </p>
                </div>

                <!-- Social links -->
                <div class="window bg-black border border-gray-700 shadow-lg p-6 w-[300px] text-lg">
                    <div class="window-header flex justify-between text-gray-400 text-sm border-b border-gray-700 pb-3 mb-4">
                        <span>socials</span>
                        <span class="cursor-pointer">- x</span>
                    </div>
                    <p class="text-gray-300">
                        1 <a href="#" class="text-blue-400">GitHub ↗</a><br>
                        2 <a href="#" class="text-blue-400">LinkedIn ↗</a><br>
                        3 <a href="#" class="text-blue-400">Twitter ↗</a><br>
                        4 <a href="#" class="text-blue-400">Portfolio ↗</a>
                    </p>
                </div>

                <!-- Hobby's blok -->
                <div class="window bg-black border border-gray-700 shadow-lg p-6 w-[250px] text-lg">
                    <div class="window-header flex justify-between text-gray-400 text-sm border-b border-gray-700 pb-3 mb-4">
                        <span>hobbies</span>
                        <span class="cursor-pointer">- x</span>
                    </div>
                    <p class="text-gray-300">
                        1 🎮 Gamen<br>
                        2 🎬 Video's Kijken<br>
                        3 🚗 Auto's<br>
                        4 🎨 Creatief zijn
                    </p>

                </div>
            </div>
        </section>

        <div class="spacer h-60"></div>


        <section id="projects" class="h-screen flex flex-col justify-center items-center">
            <h2 class="text-4xl p-5">Projecten</h2>
            <p>Hier komen 3 uitgelichte projecten met thumbnail</p>

            <div class="flex flex-col pt-10">
                @foreach ($featuredProjects as $project)
                    <div class="project-box transition-all duration-300 transform hover:scale-105 h-[200px] border-2 m-4 w-full flex flex-row border-gray-700 shadow-lg shadow-black border-solid p-4 rounded-lg bg-gray-800">
                        <div class="project-thumbnail pr-5 w-1/4 flex justify-center items-center object-fit h-auto">
                            <img src="{{ asset('storage/' . $project->thumbnail) }}" alt="{{ $project->title }}" class="rounded-lg">
                        </div>
                        <div class="project-text w-3/4 pl-5 border-l-2 border-gray-700">
                            <h3 class="text-lg font-bold">{{ $project->title }}</h3>
                            <p class="text-sm">{{ $project->introduction }}</p>
                            <a href="{{ $project->url ?? '#' }}" class="text-blue-400 hover:underline">Bekijk project</a>
                        </div>
                    </div>
                @endforeach
            </div>

            @if ($featuredProjects->isEmpty())
                <p class="text-gray-500 mt-6 text-center">Er zijn nog geen uitgelichte projecten.</p>
            @endif

            <button type="submit"
                class="bg-purple-600 text-white px-5 py-3 my-6 rounded-lg hover:bg-purple-700 transition-all duration-300 transform hover:scale-105 shadow-lg">
                Bekijk alle projecten
            </button>
        </section>

        <section id="contact" class="h-screen flex justify-center items-center px-6 lg:px-20">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-12 w-full max-w-5xl bg-gray-800 p-10 rounded-lg border border-gray-600 shadow-lg">

                <!-- Contact Info -->
                <div class="text-gray-300">
                    <h2 class="text-3xl font-bold text-purple-400 mb-4">Contact Info</h2>
                    <p class="text-gray-400 mb-4">Neem gerust contact met me op via onderstaande gegevens of het formulier.</p>

                    <div class="mb-4">
                        <h3 class="font-semibold text-gray-200">Adres</h3>
                        <p>Zuidwal 26</p>
                        <p>Hattem, 8051 GW</p>
                    </div>

                    <div class="mb-4">
                        <h3 class="font-semibold text-gray-200">E-mail</h3>
                        <p>jeroenwessel2002@gmail.com</p>
                    </div>

                    <div>
                        <h3 class="font-semibold text-gray-200 mb-2">Volg me</h3>
                        <div class="flex space-x-4">
                            <a href="#" class="text-gray-400 hover:text-purple-400"><i class="fa-brands fa-facebook text-2xl"></i></a>
                            <a href="#" class="text-gray-400 hover:text-purple-400"><i class="fa-brands fa-twitter text-2xl"></i></a>
                            <a href="#" class="text-gray-400 hover:text-purple-400"><i class="fa-brands fa-instagram text-2xl"></i></a>
                            <a href="#" class="text-gray-400 hover:text-purple-400"><i class="fa-brands fa-github text-2xl"></i></a>
                        </div>
                    </div>
                </div>

                <!-- Contact Form -->
                <div>
                    <h2 class="text-3xl font-bold text-purple-400 mb-6">Contact Formulier</h2>
                    <form class="flex flex-col space-y-4">
                        <input type="text" name="name" placeholder="Naam"
                            class="border border-gray-600 bg-gray-900 text-white p-3 rounded-lg focus:border-purple-400 focus:ring-2 focus:ring-purple-500 outline-none transition w-full">

                        <input type="email" name="email" placeholder="E-mailadres"
                            class="border border-gray-600 bg-gray-900 text-white p-3 rounded-lg focus:border-purple-400 focus:ring-2 focus:ring-purple-500 outline-none transition w-full">

                        <textarea name="message" rows="5" placeholder="Jouw bericht"
                            class="border border-gray-600 bg-gray-900 text-white p-3 rounded-lg focus:border-purple-400 focus:ring-2 focus:ring-purple-500 outline-none transition w-full"></textarea>

                        <button type="submit"
                            class="bg-purple-600 text-white px-5 py-3 rounded-lg hover:bg-purple-700 transition-all duration-300 transform hover:scale-105 shadow-lg">
                            Verstuur
                        </button>
                    </form>
                </div>

            </div>
        </section>


    </main>

    <footer class="fixed bottom-0 left-0 w-full bg-gray-800 p-4 text-center text-gray-400 z-50">
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
</script>





</html>
