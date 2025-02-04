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

                    <input type="text" name="title"" id=" title""
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                        placeholder="e.g. I bought a new phone" />
                    <x-form.error name="title"" />
                </div>

                <div>
                    <label for=" category"
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

        <div
            class="p-4 bg-white border border-gray-200 rounded-lg shadow-sm sm:p-6 md:p-8 dark:bg-gray-800 dark:border-gray-700">
            <form id="update-category-form" class="w-full max-w-lg flex flex-col gap-4"
                action="{{ route('categories.addcategory') }}" method="POST">
                @csrf
                <h3 class="text-xl font-medium text-gray-900 dark:text-white">Add a new category</h3>
                <div>
                    <label for="name"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Category</label>

                    <input type="text" name="name" id="name"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                        placeholder="e.g. Business" />
                    <x-form.error name="name" />
                </div>

                <button type="submit" id="add-category-btn"
                    class="flex self-start text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Add
                    category</button>
            </form>
        </div>
    </div>


    <script>
        const seleteCategory = document.getElementById('category');
        const addCategoryBtn = document.getElementById('add-category-btn');
        const inputCategory = document.getElementById('name');
        document.getElementById('update-category-form').addEventListener('submit', async function (event) {
            event.preventDefault();
            const form = event.target;
            const formData = new FormData(form);
            const actionUrl = form.action;

            try {
                const response = await fetch(actionUrl, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json'
                    },
                    body: formData,
                })

                if (response.ok) {
                    // window.location.reload();
                    const responseData = await response.json();
                    const newOption = document.createElement('option');
                    newOption.value = responseData.category.id ?? '';
                    newOption.textContent = responseData.category.name ?? '';
                    newOption.selected = true; // Mark it as selected

                    seleteCategory.appendChild(newOption);
                    addCategoryBtn.textContent = 'Category added successfully';
                    form.reset();
                    setTimeout(() => {
                        addCategoryBtn.textContent = 'Add category';
                    }, 2000);
                    console.log(responseData);
                } else {
                    console.error('Error:', response.status, response.statusText);
                }
            } catch (error) {
                console.error('Error:', error);

            }
        });
    </script>

</x-layout>