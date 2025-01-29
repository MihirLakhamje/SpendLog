<x-layout>
    <x-slot:title>Edit expense | SpentLog</x-slot:title>
    <x-slot:header>
        Add your expense
    </x-slot:header>

    <div
        class="p-4 bg-white border border-gray-200 rounded-lg shadow-sm sm:p-6 md:p-8 dark:bg-gray-800 dark:border-gray-700">
        <form 
            class="w-full max-w-lg flex flex-col gap-4" 
            action="{{ route('expenses.update', $expense->id) }}"
            method="POST">
            @csrf
            @method('PATCH')

            <div>
                <label for="expense_amount"
                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Amount</label>

                <input type="text" name="expense_amount" id="expense_amount" value="{{$expense->expense_amount}}"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                    placeholder="e.g. 1000" />
                <x-form.error name="expense_amount" />
            </div>

            <div>
                <label for="category"
                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Category</label>
                <select 
                    id="category" 
                    name="category" 
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <option selected value="{{$expense->category->name}}">--{{$expense->category->name}}--</option>
                    @foreach ($categories as $category)
                        <option value="{{$category}}">{{ucfirst($category)}}</option>
                    @endforeach
                </select>
                <x-form.error name="category" />
            </div>

            <div>
                <label for="description"
                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Description
                    <span><i>(optional)</i></span></label>

                <input 
                    type="text" 
                    name="description" 
                    id="description" 
                    value="{{$expense->description}}"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                    placeholder="e.g. I bought a new phone" />
                <x-form.error name="description" />
            </div>

            <div>
                <label for="expense_date"
                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Date</label>

                <input 
                    type="date" 
                    name="expense_date" 
                    id="expense_date"
                    value="{{$expense->expense_date}}"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" />
                <x-form.error name="expense_date" />
            </div>

            <button type="submit"
                class="flex self-start text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Save</button>
        </form>
        <form class="mt-4" action="{{ route('expenses.delete', $expense->id) }}" method="post">
                @csrf
                @method('DELETE')
                <button type="submit" class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">Delete income</button>
            </form>
    </div>
</x-layout>