<x-layout>
    <x-slot:title>Add limit | SpentLog</x-slot:title>

    <x-slot:header>
        Set limit on category
    </x-slot:header>

    <div
        class="p-4 bg-white border border-gray-200 rounded-lg shadow-sm sm:p-6 md:p-8 dark:bg-gray-800 dark:border-gray-700">

        <div class="mb-4">
            <span class="text-red-500">* </span><span class="text-gray-500"><i>
                By setting limit on a category, you will be notified if the limit is exceeded </span>

            </i>
        </div>
        
        <form class="w-full max-w-lg flex flex-col gap-4" action="{{ route('limits.store') }}" method="POST">
            @csrf

            <div>
                <label for="category"
                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Category</label>
                <select id="category" name="category"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <option selected>-- Select a category --</option>
                    @foreach ($categories as $category)
                        <option value="{{$category->id}}">{{ucfirst($category->name)}}</option>
                    @endforeach
                </select>
                <x-form.error name="category" />
            </div>

            <div>
                <label for="limit_amount"
                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Amount</label>

                <input type="text" name="limit_amount" id="limit_amount"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                    placeholder="e.g. 1000" />
                <x-form.error name="limit_amount" />
            </div>

            <button type="submit"
                class="flex self-start text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Add</button>
        </form>
    </div>
</x-layout>