<x-layout>
    <x-slot:title>Profile | SpendLog</x-slot:title>

    <x-slot:header>
        Hello! {{ ucfirst(explode(' ', auth()->user()->name)[0]) }}🤝
    </x-slot:header>


    <div class="flex flex-col gap-4 mt-4">
        <div
            class="p-4 bg-white border border-gray-200 rounded-lg shadow-sm sm:p-6 md:p-8 dark:bg-gray-800 dark:border-gray-700">
            <form class="w-full max-w-lg flex flex-col gap-4" action="/profile-update" method="POST">
                @csrf
                @method('PATCH')
                <h3 class="text-xl font-medium text-gray-900 dark:text-white">Personal information</h3>
                
                <div class="mt-1" style="margin-top: 0;">
                    <label for="email"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
                    @if(auth()->user()->google_id)
                        <input type="text"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white cursor-not-allowed"
                            value="{{ auth()->user()->email }}" disabled />
                    @else
                        <input type="email" name="email" id="email"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                            placeholder="name@company.com" value="{{ auth()->user()->email }}" required />
                        @if(session()->has('error'))
                            <p class="text-red-500 text-xs">{{ session()->get('error') }}</p>
                        @endif
                    @endif
                </div>

                <div class="mt-1" style="margin-top: 0;">
                    <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Name</label>

                    <input type="text" name="name" id="name"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                        placeholder="John Doe" value="{{ auth()->user()->name }}" required />
                </div>

                <button type="submit"
                    class="flex-1 self-start px-3 py-2 text-xs font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">save</button>

            </form>
        </div>
        <div
            class="p-4 bg-white border border-gray-200 rounded-lg shadow-sm sm:p-6 md:p-8 dark:bg-gray-800 dark:border-gray-700">
            <form class="w-full max-w-lg flex flex-col gap-4" action="{{ route('password.update') }}" method="POST">
                @csrf
                <h3 class="text-xl font-medium text-gray-900 dark:text-white">Update password</h3>
                <div class="mt-1" style="margin-top: 0;">
                    <label for="password"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password</label>
                    <input type="password" name="password" id="password"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                        placeholder="atlease 6 characters" required />
                </div>
                <div class="mt-1" style="margin-top: 0;">
                    <label for="password_confirmation"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Confirm password</label>
                    <input type="password" name="password_confirmation" id="password_confirmation"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                        required />
                </div>

                <button type="submit"
                    class="flex-1 self-start px-3 py-2 text-xs font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">save</button>

            </form>
        </div>
        <div
            class="p-4 bg-white border border-gray-200 rounded-lg shadow-sm sm:p-6 md:p-8 dark:bg-gray-800 dark:border-gray-700">
            <form class="w-full max-w-xl flex flex-col gap-4" action="#">
                <h3 class="text-xl font-medium text-gray-900 dark:text-white">Delete account</h3>
                <p class="text-sm text-gray-700 dark:text-gray-400">Are you sure you want to delete your account? These action cannot be undone and your progress will be
                    lost.
                </p>

                <button type="submit"
                    class="flex-1 self-start px-3 py-2 text-xs font-medium text-center text-white bg-red-700 rounded-lg hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">Delete
                    Account</button>

            </form>
        </div>
    </div>



</x-layout>