<x-layout>
	<x-slot:title>Limits | SpentLog</x-slot:title>
	<x-slot:header>Limits for category</x-slot:header>

	<x-data-table>
		<x-slot:column>
			<th scope="col" class="px-6 py-3">
				Date
			</th>
			<th scope="col" class="px-6 py-3">
				Category
			</th>
			<th scope="col" class="px-6 py-3">
				Limiting Amount
			</th>
			<th scope="col" class="px-6 py-3">
				Usage
			</th>
			<th scope="col" class="px-6 py-3">
				Limit Status
			</th>
			<th scope="col" class="px-6 py-3">
				Action
			</th>
		</x-slot:column>

		<div class="my-2">
			<a href="{{ route('limits.create') }}"
				class="text-white bg-blue-700 hover:bg-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none">
				Add limit
			</a>
		</div>

		@foreach ($limits as $limit)
			<tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 text-nowrap">
				<td class="px-6 py-4 ">
					{{ date('d-M-Y', strtotime($limit->created_at)) }}
				</td>
				<td class="px-6 py-4">{{ $limit->category->name }} </td>
				<td class="px-6 py-4">&#8377; {{ $limit->limit_amount }} </td>
				<td class="px-6 py-4">{{ $limit->limit_usage() }} </td>
				<td class="px-6 py-4 {{ $limit->limit_status()['color'] }} font-bold">{{ $limit->limit_status()['status'] }}</td>
				<td class="px-6 py-4">
					<div class="flex space-x-2 items-center">
						<x-link :typeoflink="'link'" href="{{ route('limits.edit', $limit->id) }}"
							class="text-green-600 dark:text-green-500">
							Edit
						</x-link>
						<span class="mx-1">|</span>
						<form action="{{ route('limits.delete', $limit->id) }}" method="post">
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

		@if($limits->isEmpty())
			<tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 text-nowrap">
				<td class="px-6 py-4">No income records found </td>
			</tr>
		@endif
	</x-data-table>

	<div class="mt-4">
		{{ $limits->links() }}
	</div>

</x-layout>