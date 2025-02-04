<x-layout>
	<x-slot:title>Expenses | SpentLog</x-slot:title>
	<x-slot:metaDescription>Track and manage your daily expenses efficiently in SpendLog.</x-slot:metaDescription>

	<x-slot:header>Expenses</x-slot:header>

	<section class="flex flex-col gap-2">
		<div class="my-2">
			<a href="{{ route('expenses.create') }}"
				class="text-white bg-blue-700 hover:bg-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none">
				Add expense
			</a>
		</div>

		<x-data-table>
			<x-slot:column>
				<th scope="col" class="px-6 py-3">
					Date
				</th>
				<th scope="col" class="px-6 py-3">
					Title
				</th>
				<th scope="col" class="px-6 py-3">
					Category
				</th>
				<th scope="col" class="px-6 py-3">
					Amount
				</th>
				<th scope="col" class="px-6 py-3">
					Action
				</th>
			</x-slot:column>

			@foreach ($expenses as $expense)
				<tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 text-nowrap">
					<td class="px-6 py-4 ">
						{{ date('d-M-Y', strtotime($expense->expense_date)) }}
					</td>
					<td class="px-6 py-4">{{ $expense->title }} </td>
					<td class="px-6 py-4">{{ $expense->category->name ?? 'N/A' }} </td>
					<td class="px-6 py-4">&#8377; {{ $expense->expense_amount }} </td>
					<td class="px-6 py-4">
						<div class="flex space-x-2 items-center">
							<x-link :typeoflink="'link'" href="{{ route('expenses.edit', $expense->id) }}"
								class="text-green-600 dark:text-green-500">
								Edit
							</x-link>
							<span class="mx-1">|</span>
							<form action="{{ route('expenses.delete', $expense->id) }}" method="post">
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

			@if($expenses->isEmpty())
				<tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 text-nowrap">
					<td class="px-6 py-4">No expense records found </td>
				</tr>
			@endif
		</x-data-table>

		<div class="mt-4">
			{{ $expenses->links() }}
		</div>

	</section>


</x-layout>