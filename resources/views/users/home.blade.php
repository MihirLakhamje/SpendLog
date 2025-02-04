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
			<p class="text-gray-600 dark:text-gray-400">Exceeded</p>
			<h2 class="text-3xl font-bold text-orange-600">{{ $exceedingLimitsCount ?? 0 }}</h2>
			<span class="text-xs text-gray-500">Limit</span>
		</div>
	</div>


	<div class="mt-4 w-full bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 p-6">
		<div class="flex justify-between border-gray-200 border-b dark:border-gray-700 pb-3">
			<dl>
				<dt class="text-base font-normal text-gray-500 dark:text-gray-400 pb-1">Yearly savings</dt>
				<dd class="leading-none text-3xl font-bold text-gray-900 dark:text-white">₹ {{ $savings ?? 0 }}</dd>
			</dl>
		</div>

		<div class="grid grid-cols-2 py-3">
			<dl>
				<dt class="text-base font-normal text-gray-500 dark:text-gray-400 pb-1">Income</dt>
				<dd class="leading-none text-xl font-bold text-green-500 dark:text-green-400">₹ {{ $incomes }}</dd>
			</dl>
			<dl>
				<dt class="text-base font-normal text-gray-500 dark:text-gray-400 pb-1">Expense</dt>
				<dd class="leading-none text-xl font-bold text-red-600 dark:text-red-500">₹ {{ $expenses }}</dd>
			</dl>
		</div>

		<div id="bar-chart"></div>
	</div>

	<script>
		let expenses = [], incomes = [];
		async function getStats() {
			const res = await fetch('/stats', {
				method: 'GET',
				headers: {
					'Content-Type': 'application/json',
					'Accept': 'application/json',
					'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
				}
			});
			const data = await res.json();
			return data;
		}

		getStats().then(data => {
			data.expenses.forEach(expense => {
				expenses.push(expense);
			});
			data.incomes.forEach(income => {
				incomes.push(income);
			});
		}).catch(err => console.log(err));

		const options = {
			series: [
				{
					name: "Income",
					color: "#31C48D",
					data: incomes,
				},
				{
					name: "Expense",
					color: "#F05252",
					data: expenses,
				}
			],
			chart: {
				sparkline: {
					enabled: false,
				},
				type: "bar",
				width: "100%",
				height: 400,
				toolbar: {
					show: false,
				}
			},
			fill: {
				opacity: 1,
			},
			plotOptions: {
				bar: {
					horizontal: true,
					columnWidth: "100%",
					borderRadiusApplication: "end",
					borderRadius: 2,
					dataLabels: {
						position: "top",
					},
				},
			},
			legend: {
				show: true,
				position: "bottom",
			},
			dataLabels: {
				enabled: false,
			},
			tooltip: {
				shared: true,
				intersect: false,
				formatter: function (value) {
					return "₹" + value
				}
			},
			xaxis: {
				labels: {
					show: true,
					style: {
						fontFamily: "Inter, sans-serif",
						cssClass: 'text-xs font-normal fill-gray-500 dark:fill-gray-400'
					},
					formatter: function (value) {
						return "₹" + value
					}
				},
				categories: [
					"Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"
				],
				axisTicks: {
					show: false,
				},
				axisBorder: {
					show: true,
				},
			},
			yaxis: {
				labels: {
					show: true,
					style: {
						fontFamily: "Inter, sans-serif",
						cssClass: 'text-xs font-normal fill-gray-500 dark:fill-gray-400'
					}
				}
			},
			grid: {
				show: true,
				strokeDashArray: 4,
				padding: {
					left: 2,
					right: 2,
					top: -20
				},
			},
			fill: {
				opacity: 1,
			}
		}

		if (document.getElementById("bar-chart") && typeof ApexCharts !== 'undefined') {
			const chart = new ApexCharts(document.getElementById("bar-chart"), options);
			chart.render();

			getStats().then(data => {
				chart.updateSeries([
					{
						name: "Income",
						color: "#31C48D",
						data: data.incomes,
					},
					{
						name: "Expense",
						color: "#F05252",
						data: data.expenses,
					}
				]);
			}).catch(err => console.log(err));
		}
	</script>


</x-layout>