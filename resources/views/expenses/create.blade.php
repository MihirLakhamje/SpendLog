<x-layout>
    <x-slot:title>Add expense | SpentLog</x-slot:title>
    <x-slot:metaDescription>Add a new expense to track your spending habits on SpendLog.</x-slot:metaDescription>

    <div class="flex flex-col gap-4 mt-4">


        <div
            class="p-4 bg-white border border-gray-200 rounded-lg shadow-sm sm:p-6 md:p-8 dark:bg-gray-800 dark:border-gray-700">
            <form class="w-full max-w-lg flex flex-col gap-4" action="{{ route('expenses.store') }}" method="POST">
                @csrf
                <h3 class="text-xl font-medium text-gray-900 dark:text-white">Add your expense</h3>
                <div>
                    <label for="expense_date"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Date</label>

                    <input type="date" name="expense_date" id="expense_date"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" />
                    <x-form.error name="expense_date" />
                </div>

                <div>
                    <label for="title"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Title</label>

                    <input type="text" name="title" id="title"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                        placeholder="e.g. I bought a new phone" />
                    <x-form.error name="title" />
                </div>

                <div>
                    <div class="flex justify-between">
                        <label for="category"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Category</label>
                        <button type="button" data-modal-target="crud-modal" data-modal-toggle="crud-modal"
                            class="inline-flex text-sm mb-2 items-center font-medium text-blue-600 dark:text-blue-500 hover:underline">
                            <svg class="w-4 h-4 text-blue-600" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                width="24" height="24" fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="M5 12h14m-7 7V5" />
                            </svg>

                            add new category
                        </button>
                    </div>
                    <select id="category" name="category"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 capitalize">
                        <option selected>-- Select a category --</option>
                        @foreach ($categories as $category)
                            <option value="{{$category->id}}">{{ucfirst($category->name)}}</option>
                        @endforeach
                    </select>
                    <x-form.error name="category" />
                </div>

                <div>
                    <label for="expense_amount"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Amount</label>

                    <input type="text" name="expense_amount" id="expense_amount"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                        placeholder="e.g. 1000" />
                    <x-form.error name="expense_amount" />
                </div>

                <button type="submit"
                    class="flex self-start text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Add</button>
            </form>
        </div>

        <!-- Main modal -->
        <div id="crud-modal" tabindex="-1" aria-hidden="true" aria-hidden="true"
            class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
            <div class="relative p-4 w-full max-w-md max-h-full">
                <!-- Modal content -->
                <div class="relative bg-white rounded-lg shadow-2xl dark:bg-gray-700 border border-gray-300 dark:border-gray-500">
                    <!-- Modal header -->
                    <div
                        class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600 border-gray-200">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                            Add category
                        </h3>
                        <button type="button"
                            class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                            data-modal-toggle="crud-modal">
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                            </svg>
                            <span class="sr-only">Close modal</span>
                        </button>
                    </div>
                    <!-- Modal body -->
                    <form class="p-4 md:p-5" method="POST" id="createCategoryForm" action="{{ route('categories.addcategory') }}">
                        @csrf
                        <div class="flex flex-col gap-4">
                            <div>
                                <label for="name"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Category</label>
                                <input type="text" name="name" id="name"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                    placeholder="e.g. Groceries">
                                <x-form.error name="name" />
                            </div>

                            <button type="submit"
                                class="flex self-start flex-shrink text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-1.5 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">save</button>
                    </form>
                </div>
            </div>
        </div>

        <script>
            const createCategoryForm = document.getElementById('createCategoryForm');
            let categorySelect = document.getElementById('category');
            createCategoryForm.addEventListener('submit', async function (event) {
                event.preventDefault();
                const formData = new FormData(createCategoryForm);
                const response = await fetch(createCategoryForm.action, {
                    method: 'POST',
                    body: formData,
                });

                if (response.ok) {
                    const data = await response.json();
                    const newOption = document.createElement('option');
                    newOption.value = data.category.id;
                    newOption.textContent = data.category.name;
                    document.getElementById('category').appendChild(newOption).selected = true;
                    createCategoryForm.reset();
                    document.getElementById('crud-modal').classList.add('hidden');
                }
            });
        </script>


</x-layout>