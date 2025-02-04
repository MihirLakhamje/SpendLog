<x-layout>
	<x-slot:title>Categories | SpentLog</x-slot:title>
	<x-slot:header>Categories for expense</x-slot:header>

	<x-data-table>
		<x-slot:column>
			<th scope="col" class="px-6 py-3">
				Name
			</th>
			<th scope="col" class="px-6 py-3">
				No of expenses
			</th>
			<th scope="col" class="px-6 py-3">
				Creation date
			</th>
			<th scope="col" class="px-6 py-3">
				Action
			</th>
		</x-slot:column>

		<div class="my-2">
			<a href="{{ route('categories.create') }}"
				class="text-white bg-blue-700 hover:bg-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none">
				Add category
			</a>
		</div>

		@foreach ($categories as $category)
			<tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 text-nowrap">
        <td class="px-6 py-4">{{ $category->name }} </td>
				<td class="px-6 py-4">{{ $category->expenses->count() }} </td>
				<td class="px-6 py-4 ">
					{{ date('d-M-Y', strtotime($category->created_at)) }}
				</td>
				<td class="px-6 py-4">
					<div class="flex space-x-2 items-center">
						<x-link :typeoflink="'link'" href="{{ route('categories.edit', $category->id) }}"
							class="text-green-600 dark:text-green-500">
							Edit
						</x-link>
						<span class="mx-1">|</span>
						<form action="{{ route('categories.delete', $category->id) }}" method="post">
							@csrf
							@method('DELETE')
							<x-link :typeoflink="'button'"
								onclick="return confirm('Are you sure? This action cannot be undone.')"
								class="text-red-600 dark:text-red-500">
								Delete
							</x-link>
						</form>
					</div>
				</td>
			</tr>
		@endforeach

		@if($categories->isEmpty())
			<tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 text-nowrap">
				<td class="px-6 py-4">No category records found </td>
			</tr>
		@endif
	</x-data-table>

	<div class="mt-4">
		{{ $categories->links() }}
	</div>

</x-layout>