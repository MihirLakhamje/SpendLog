<x-layout>
	<x-slot:title>Home | SpentLog</x-slot:title>
	<x-slot:header>Home</x-slot:header>

	<div class="grid grid-cols-2  sm:grid-cols-4 gap-4">
		<!-- Income Card -->
		<div class="p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
			<p class="text-gray-600 dark:text-gray-400">Income</p>
			<h2 class="text-3xl font-bold text-green-600">₹ {{ $this_month_incomes }}</h2>
			<span class="text-xs text-gray-500">Overall: ₹ {{ $incomes }}</span>
		</div>

		<!-- Expense Card -->
		<div class="p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
			<p class="text-gray-600 dark:text-gray-400">Expenses</p>
			<h2 class="text-3xl font-bold text-red-600">₹ {{ $this_month_expenses }}</h2>
			<span class="text-xs text-gray-500">Overall: ₹ {{ $expenses }}</span>
		</div>

		<!-- Savings Card -->
		<div class="p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
			<p class="text-gray-600 dark:text-gray-400">Savings</p>
			<h2 class="text-3xl font-bold text-blue-600">₹ {{ $this_month_savings ?? 0 }}</h2>
			<span class="text-xs text-gray-500">Overall: ₹ {{ $savings ?? 0 }}</span>
		</div>

		<!-- Exceeded Limits Card -->
		<div class="p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
			<p class="text-gray-600 dark:text-gray-400">Limits Exceeded</p>
			<h2 class="text-3xl font-bold text-orange-600">{{ $exceedingLimitsCount ?? 0 }}</h2>
			<span class="text-xs text-gray-500">Categories</span>
		</div>
	</div>

</x-layout>