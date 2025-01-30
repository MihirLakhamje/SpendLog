<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ $title ?? 'SpendLog' }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Styles / Scripts -->
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif
</head>

<body>
    @guest
        <nav
            class="bg-white dark:bg-gray-900 fixed w-full z-20 top-0 start-0 border-b border-gray-200 dark:border-gray-600">
            <div class="flex flex-wrap items-center justify-between p-4">
                <a href="https://flowbite.com/" class="flex items-center space-x-3 rtl:space-x-reverse">
                    <img src="https://flowbite.com/docs/images/logo.svg" class="h-8" alt="Flowbite Logo">
                    <span class="self-center text-2xl font-semibold whitespace-nowrap dark:text-white">SpendLog</span>
                </a>
                <div class="flex md:order-2 space-x-3 md:space-x-0 rtl:space-x-reverse">


                    <a href="{{ route('login') }}"
                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Get
                        started</a>
                </div>
            </div>
        </nav>
        <main {{ $attributes->merge(['class' => 'p-4 mt-14']) }}>
            {{ $slot }}
        </main>
    @endguest

    @auth
        <nav class="fixed top-0 z-50 w-full bg-white border-b border-gray-200 dark:bg-gray-800 dark:border-gray-700">
            <div class="px-3 py-3 lg:px-5 lg:pl-3">
                <div class="flex items-center justify-between">
                    <div class="flex items-center justify-start rtl:justify-end">
                        <button data-drawer-target="logo-sidebar" data-drawer-toggle="logo-sidebar"
                            aria-controls="logo-sidebar" type="button"
                            class="inline-flex items-center p-2 text-sm text-gray-500 rounded-lg sm:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600">
                            <span class="sr-only">Open sidebar</span>
                            <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path clip-rule="evenodd" fill-rule="evenodd"
                                    d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z">
                                </path>
                            </svg>
                        </button>
                        <a href="https://flowbite.com" class="flex ms-2 md:me-24">
                            <img src="https://flowbite.com/docs/images/logo.svg" class="h-8 me-3" alt="FlowBite Logo" />
                            <span
                                class="self-center text-xl font-semibold sm:text-2xl whitespace-nowrap dark:text-white">SpendLog</span>
                        </a>
                    </div>
                    <div class="flex items-center">
                        <button id="dropdownAvatarButton" data-dropdown-toggle="dropdownAvatar"
                            class="sm:hidden flex text-sm bg-gray-800 rounded-full md:me-0 focus:ring-4 focus:ring-gray-300 dark:focus:ring-gray-600"
                            type="button">
                            <span class="sr-only">Open user menu</span>
                            <img class="w-8 h-8 rounded-full" src="{{ auth()->user()->google_avatar }}"
                                alt="{{ Auth::user()->name }}">
                        </button>
                        <!-- Dropdown menu -->
                        <div id="dropdownAvatar"
                            class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow-sm w-44 dark:bg-gray-700 dark:divide-gray-600">
                            <div class="px-4 py-3 text-sm text-gray-900 dark:text-white">
                                <div class="font-medium ">{{ Auth::user()->name }}</div>
                                <div class="truncate">{{ Auth::user()->email }}</div>
                            </div>
                            <ul class="py-2 text-sm text-gray-700 dark:text-gray-200"
                                aria-labelledby="dropdownInformdropdownAvatarButtonationButton">
                                <li>
                                    <a href="{{ route('users.profile') }}"
                                        class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Profile</a>
                                </li>
                                <li>
                                    <a href="#"
                                        class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Settings</a>
                                </li>
                            </ul>
                            <div class="py-2">
                                <form action="{{ route('logout') }}" method="post">
                                    @csrf
                                    <button type="submit"
                                        class="block text-left w-full px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Logout</button>
                                </form>
                            </div>
                        </div>


                        <button id="dropdownAvatarNameButton" data-dropdown-toggle="dropdownAvatarName"
                            class="sm:flex hidden items-center text-sm pe-1 font-medium text-gray-900 rounded-full hover:text-blue-600 dark:hover:text-blue-500 md:me-0 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:text-white"
                            type="button">
                            <span class="sr-only">Open user menu</span>
                            <img class="w-8 h-8 me-2 rounded-full" src="{{ auth()->user()->google_avatar }}"
                                alt="{{ Auth::user()->name }}">
                            <span class="hidden md:block">{{ Auth::user()->name }}</span>
                            <svg class="w-2.5 h-2.5 ms-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 10 6">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="m1 1 4 4 4-4" />
                            </svg>
                        </button>
                        <!-- Dropdown menu -->
                        <div id="dropdownAvatarName"
                            class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow-sm w-44 dark:bg-gray-700 dark:divide-gray-600">
                            <div class="px-4 py-3 text-sm text-gray-900 dark:text-white">
                                <div class="font-medium " title="{{ Auth::user()->name }}">{{ Auth::user()->name }}</div>
                                <div class="truncate font-thin text-xs" title="{{ Auth::user()->email }}">
                                    {{ Auth::user()->email }}
                                </div>
                            </div>
                            <ul class="py-2 text-sm text-gray-700 dark:text-gray-200"
                                aria-labelledby="dropdownInformdropdownAvatarNameButtonationButton">
                                <li>
                                    <a href="{{ route('users.profile') }}"
                                        class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Profile</a>
                                </li>
                                <li>
                                    <a href="#"
                                        class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Settings</a>
                                </li>
                            </ul>
                            <div class="py-2">
                                <form action="{{ route('logout') }}" method="post">
                                    @csrf
                                    <button type="submit"
                                        class="block text-left w-full px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Logout</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </nav>

        <aside id="logo-sidebar"
            class="fixed top-0 left-0 z-40 w-64 h-screen pt-20 transition-transform -translate-x-full bg-white border-r border-gray-200 sm:translate-x-0 dark:bg-gray-800 dark:border-gray-700"
            aria-label="Sidebar" aria-hidden="true">
            <div class="h-full px-3 pb-4 overflow-y-auto bg-white dark:bg-gray-800">
                <ul class="space-y-4 font-medium">
                    <li>
                        <x-link href="/home" :active="request()->is('home')" :typeoflink="'nav-link'">
                            <x-slot:icon>
                                <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                                    viewBox="0 0 24 24">
                                    <path
                                        d="M13.5 2c-.178 0-.356.013-.492.022l-.074.005a1 1 0 0 0-.934.998V11a1 1 0 0 0 1 1h7.975a1 1 0 0 0 .998-.934l.005-.074A7.04 7.04 0 0 0 22 10.5 8.5 8.5 0 0 0 13.5 2Z" />
                                    <path
                                        d="M11 6.025a1 1 0 0 0-1.065-.998 8.5 8.5 0 1 0 9.038 9.039A1 1 0 0 0 17.975 13H11V6.025Z" />
                                </svg>
                            </x-slot:icon>
                            Home
                        </x-link>
                    </li>
                    <li>
                        <x-link href="/profile" :active="request()->is('profile')" title="profile" :typeoflink="'nav-link'">
                            <x-slot:icon>
                                <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                                    viewBox="0 0 24 24">
                                    <path fill-rule="evenodd"
                                        d="M12 4a4 4 0 1 0 0 8 4 4 0 0 0 0-8Zm-2 9a4 4 0 0 0-4 4v1a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2v-1a4 4 0 0 0-4-4h-4Z"
                                        clip-rule="evenodd" />
                                </svg>
                            </x-slot:icon>
                            Profile
                        </x-link>
                    </li>
                    <li>
                        <x-link href="/incomes" :active="request()->is('incomes') || request()->is('incomes/*')"
                            title="Incomes" :typeoflink="'nav-link'">
                            <x-slot:icon>
                                <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                                    viewBox="0 0 24 24">
                                    <path fill-rule="evenodd"
                                        d="M7 6a2 2 0 0 1 2-2h11a2 2 0 0 1 2 2v7a2 2 0 0 1-2 2h-2v-4a3 3 0 0 0-3-3H7V6Z"
                                        clip-rule="evenodd" />
                                    <path fill-rule="evenodd"
                                        d="M2 11a2 2 0 0 1 2-2h11a2 2 0 0 1 2 2v7a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2v-7Zm7.5 1a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5Z"
                                        clip-rule="evenodd" />
                                    <path d="M10.5 14.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0Z" />
                                </svg>
                            </x-slot:icon>
                            Incomes
                        </x-link>
                    </li>
                    <li>
                        <x-link href="/expenses" :active="request()->is('expenses') || request()->is('expenses/*')"
                            title="Expenses" :typeoflink="'nav-link'">
                            <x-slot:icon>
                                <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                                    viewBox="0 0 24 24">
                                    <path fill-rule="evenodd"
                                        d="M12 14a3 3 0 0 1 3-3h4a2 2 0 0 1 2 2v2a2 2 0 0 1-2 2h-4a3 3 0 0 1-3-3Zm3-1a1 1 0 1 0 0 2h4v-2h-4Z"
                                        clip-rule="evenodd" />
                                    <path fill-rule="evenodd"
                                        d="M12.293 3.293a1 1 0 0 1 1.414 0L16.414 6h-2.828l-1.293-1.293a1 1 0 0 1 0-1.414ZM12.414 6 9.707 3.293a1 1 0 0 0-1.414 0L5.586 6h6.828ZM4.586 7l-.056.055A2 2 0 0 0 3 9v10a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2h-4a5 5 0 0 1 0-10h4a2 2 0 0 0-1.53-1.945L17.414 7H4.586Z"
                                        clip-rule="evenodd" />
                                </svg>
                            </x-slot:icon>
                            Expenses
                        </x-link>
                    </li>
                    <li>
                        <x-link href="/categories" :active="request()->is('categories') || request()->is('categories/*')"
                            title="Categories" :typeoflink="'nav-link'">
                            <x-slot:icon>
                                <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                                    viewBox="0 0 24 24">
                                    <path fill-rule="evenodd"
                                        d="M3 6a2 2 0 0 1 2-2h5.532a2 2 0 0 1 1.536.72l1.9 2.28H3V6Zm0 3v10a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V9H3Z"
                                        clip-rule="evenodd" />
                                </svg>
                            </x-slot:icon>
                            Categories
                        </x-link>
                    </li>
                    <li>
                        <x-link href="/limits" :active="request()->is('limits') || request()->is('limits/*')"
                            title="Limits" :typeoflink="'nav-link'">
                            <x-slot:icon>
                                <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                                    viewBox="0 0 24 24">
                                    <path fill-rule="evenodd"
                                        d="M2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10S2 17.523 2 12Zm11-4a1 1 0 1 0-2 0v5a1 1 0 1 0 2 0V8Zm-1 7a1 1 0 1 0 0 2h.01a1 1 0 1 0 0-2H12Z"
                                        clip-rule="evenodd" />
                                </svg>
                            </x-slot:icon>
                            Expense Limits
                        </x-link>
                    </li>
                </ul>
            </div>
        </aside>

        <div {{ $attributes->merge(['class' => 'p-4 mt-14 sm:ml-64 ml-0']) }}>
            <header>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{ $header ?? '' }}
                </h2>
                @if(isset($header))
                    <hr class="h-px my-2 bg-gray-100 border-0 dark:bg-gray-700">
                @endif
            </header>
            <main class="mt-2">
                {{ $slot }}
            </main>
        </div>
    @endauth

</body>

</html>