<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('/css/app.css') }}">
    <title>Video Games</title>
</head>

<body class=" bg-gray-900 text-white">
    <header class="border-b border-gray-800">
        <nav class="container mx-auto flex flex-col lg:flex-row items-center justify-between px-4 py-6">
            <div class="flex flex-col lg:flex-row items-center">
                <a href="/">
                    <img src="{{ asset('/img/logo.svg') }}" alt="logo" class="w-32 flex-none">
                </a>
                <ul class="flex ml-0 lg:ml-16 space-x-8 mt-6 lg:mt-0">
                    <li> <a href="#"
                            class="hover:text-gray-400 focus:outline-none focus:ring focus:ring-indigo-600">Games</a>
                    </li>
                    <li> <a href="#"
                            class="hover:text-gray-400 focus:outline-none focus:ring focus:ring-indigo-600">Reviews</a>
                    </li>
                    <li> <a href="#"
                            class="hover:text-gray-400 focus:outline-none focus:ring focus:ring-indigo-600">Coming
                            soon</a></li>
                </ul>

            </div>
            <div class="flex items-center mt-6 lg:mt-0">
                <div class="relative">
                    <input type="text"
                        class="bg-gray-800 text-sm rounded-full px-3 pl-8 focus:outline-none focus:ring focus:ring-indigo-600 w-64 py-1"
                        placeholder="Search...">
                    <div class="absolute top-0 flex items-center h-full ml-2">
                        <svg class="fill-current text-gray-400 w-4" viewBox="0 0 24 24">
                            <path class="heroicon-ui"
                                d="M16.32 14.9l5.39 5.4a1 1 0 01-1.42 1.4l-5.38-5.38a8 8 0 111.41-1.41zM10 16a6 6 0 100-12 6 6 0 000 12z" />
                        </svg>
                    </div>
                </div>
                <div class="ml-6">
                    <a href="#"><img src="{{ asset('/img/avatar.jpg') }}" alt="avatar" class="rounded-full w-8"></a>
                </div>
            </div>
        </nav>
    </header>
    <main class="py-8">
        @yield('content')
    </main>

    <footer class="border border-gray-800">
        <div class="container mx-auto px-4 py-6">
            Powered By <a href="#" class="underline hover:text-gray-400">IGDB API</a>
        </div>
    </footer>
</body>

</html>
