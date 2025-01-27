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
      <nav class="bg-white dark:bg-gray-900 fixed w-full z-20 top-0 start-0 border-b border-gray-200 dark:border-gray-600">
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
               <button data-drawer-target="logo-sidebar" data-drawer-toggle="logo-sidebar" aria-controls="logo-sidebar"
                 type="button"
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
                     <a href="#"
                        class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Account</a>
                   </li>
                   <li>
                     <a href="#"
                        class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Settings</a>
                   </li>
                 </ul>
                 <div class="py-2">
                   <button type="button"
                     class="block text-left w-full px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Logout</button>
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
                   <div class="truncate font-thin text-xs" title="{{ Auth::user()->email }}">{{ Auth::user()->email }}</div>
                 </div>
                 <ul class="py-2 text-sm text-gray-700 dark:text-gray-200"
                   aria-labelledby="dropdownInformdropdownAvatarNameButtonationButton">
                   <li>
                     <a href="#"
                        class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Account</a>
                   </li>
                   <li>
                     <a href="#"
                        class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Settings</a>
                   </li>
                 </ul>
                 <div class="py-2">
                   <button type="button"
                     class="block text-left w-full px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Logout</button>
                 </div>
               </div>
            </div>
          </div>
        </div>
      </nav>

      <aside id="logo-sidebar"
        class="fixed top-0 left-0 z-40 w-64 h-screen pt-20 transition-transform -translate-x-full bg-white border-r border-gray-200 sm:translate-x-0 dark:bg-gray-800 dark:border-gray-700"
        aria-label="Sidebar">
        <div class="h-full px-3 pb-4 overflow-y-auto bg-white dark:bg-gray-800">
          <ul class="space-y-2 font-medium">
            <li>
               <x-button.nav-link :active="request()->is('home')" :href="route('users.home')">
                 <x-slot:icon>
                   <svg
                     class="w-5 h-5 text-gray-900 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"
                     aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 21">
                     <path
                        d="M16.975 11H10V4.025a1 1 0 0 0-1.066-.998 8.5 8.5 0 1 0 9.039 9.039.999.999 0 0 0-1-1.066h.002Z" />
                     <path
                        d="M12.5 0c-.157 0-.311.01-.565.027A1 1 0 0 0 11 1.02V10h8.975a1 1 0 0 0 1-.935c.013-.188.028-.374.028-.565A8.51 8.51 0 0 0 12.5 0Z" />
                   </svg>
                 </x-slot:icon>
                 <x-slot:title>Home</x-slot:title>
               </x-button.nav-link>
            </li>
          </ul>
        </div>
      </aside>

      <main {{ $attributes->merge(['class' => 'p-4 mt-14 sm:ml-64 ml-0']) }}>
        {{ $slot }}
      </main>
   @endauth

</body>

</html>