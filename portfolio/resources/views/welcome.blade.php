<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jeroen's Website</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-900 text-white font-sans">

    <header class="fixed top-0 left-0 w-full bg-gray-800 p-4 text-center shadow-lg z-50">
        <h1 class="text-xl font-bold">Jeroen Wessel - Software Developer</h1>
    </header>

    <nav class="fixed left-0 top-16 w-16 h-full bg-gray-800 flex flex-col items-center justify-center py-4 space-y-6 z-50">
        <a href="#home" class="text-gray-300 hover:text-white">🏠</a>
        <a href="#about" class="text-gray-300 hover:text-white">👤</a>
        <a href="#projects" class="text-gray-300 hover:text-white">💻</a>
        <a href="#contact" class="text-gray-300 hover:text-white">📧</a>
    </nav>

    <main class="ml-16 pt-20">
        <section id="home" class="h-screen flex flex-col justify-center items-center text-center">
            <h1 class="text-5xl font-extrabold">Hi, ik ben <span class="text-purple-400">Jeroen Wessel</span></h1>
            <h2 class="text-2xl mt-4">Een Software Developer</h2>
            <div class="flex gap-6 mt-6">
                <img src="https://via.placeholder.com/150" alt="Image 1" class="rounded-lg">
                <img src="https://via.placeholder.com/150" alt="Image 2" class="rounded-lg">
                <img src="https://via.placeholder.com/150" alt="Image 3" class="rounded-lg">
                <img src="https://via.placeholder.com/150" alt="Image 4" class="rounded-lg">
            </div>
        </section>

        <section id="about" class="h-screen flex justify-center items-center">
            <h2 class="text-4xl">Over Mij</h2>
        </section>

        <section id="projects" class="h-screen flex flex-col justify-center items-center">
            <h2 class="text-4xl p-5">Projecten</h2>
            <p>Hier komen 3 uitgelichte projecten met thumbnail</p>
            <div class="project-box border-4 flex flex-row border-red-500 border-solid">
                <div class="project-thumbnail border-4 border-blue-500 border-solid">
                    <img src="" alt="">
                    image
                </div>
                <div class="project-text border-4 border-green-500 border-solid">
                    <h3>Titel</h3>
                    <p>Inleiding</p>
                </div>
            </div>
            <div class="project-box border-4 flex flex-row border-red-500 border-solid">
                <div class="project-thumbnail border-4 border-blue-500 border-solid">
                    <img src="" alt="">
                    image
                </div>
                <div class="project-text border-4 border-green-500 border-solid">
                    <h3>Titel</h3>
                    <p>Inleiding</p>
                </div>
            </div>
            <div class="project-box border-4 flex flex-row border-red-500 border-solid">
                <div class="project-thumbnail border-4 border-blue-500 border-solid">
                    <img src="" alt="">
                    image
                </div>
                <div class="project-text border-4 border-green-500 border-solid">
                    <h3>Titel</h3>
                    <p>Inleiding</p>
                </div>
            </div>
        </section>

        <section id="contact" class="h-screen flex flex-col justify-center items-center">
            <h2 class="text-4xl">Contact</h2>
            <form class="flex flex-col" action="">
                <label for="name">Naam</label>
                <input type="text" name="name" id="name" class="border border-gray-300 p-2 rounded w-96">
                <label for="email">E-mail</label>
                <input type="email" name="email" id="email" class="border border-gray-300 p-2 rounded w-96">
                <label for="message">Bericht</label>
                <textarea name="message" id="message" class="border border-gray-300 p-2 rounded w-96 h-32"></textarea>
                <button type="submit" class="bg-blue-600 px-4 py-2 rounded-md hover:bg-blue-700 transition mt-4">
                    Verstuur
                </button>
            </form>
        </section>
    </main>

    <footer class="fixed bottom-0 left-0 w-full bg-gray-800 p-4 text-center text-gray-400 z-50">
        © 2025 Jeroen Wessel - Alle rechten voorbehouden
    </footer>

</body>
</html>
