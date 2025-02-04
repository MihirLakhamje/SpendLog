<x-layout>
    <x-slot:title>Add income | SpentLog</x-slot:title>
    <x-slot:metaDescription>Record a new income source and track your earnings on SpendLog.</x-slot:metaDescription>

    <x-slot:header>
        Add income
    </x-slot:header>

    <div
        class="p-4 bg-white border border-gray-200 rounded-lg shadow-sm sm:p-6 md:p-8 dark:bg-gray-800 dark:border-gray-700">
        <form class="w-full max-w-lg flex flex-col gap-4" action="{{ route('incomes.store') }}" method="POST">
            @csrf

            <div>
                <label for="income_amount"
                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Amount</label>

                <input type="text" name="income_amount" id="income_amount"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                    placeholder="e.g. 1000" />
                <x-form.error name="income_amount" />
            </div>

            <div>
                <label for="source" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Source of
                    income</label>

                <input type="text" name="source" id="source"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                    placeholder="e.g. Business" />
                <x-form.error name="source" />
            </div>

            <div>
                <label for="income_date"
                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Date</label>

                <input type="date" name="income_date" id="income_date"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" />
                <x-form.error name="income_date" />
            </div>

            <button type="submit"
                class="flex self-start text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Add</button>
        </form>
    </div>
</x-layout>