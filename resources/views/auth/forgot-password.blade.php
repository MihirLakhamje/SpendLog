<x-layout>
    <x-slot:metaDescription>Send password reset link through email.</x-slot:metaDescription>

    <form class="max-w-sm mx-auto mt-24" action="{{ route('password.email') }}" method="POST">
        <h1 class="text-2xl font-bold mb-5 dark:text-gray-200">Send a reset password link</h1>
        @csrf
        @if (session('status'))
            <p class="mb-4 text-sm text-gray-600 dark:text-gray-400">{{ session('status') }}</p>
        @endif
        <div class="mb-5">
            <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
            <input type="email" id="email" name="email"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                placeholder="name@example.com" required />
            <x-form.error name="email" />
        </div>
        <button type="submit"
            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Continue</button>
    </form>
</x-layout>