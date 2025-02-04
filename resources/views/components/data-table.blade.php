<div class="overflow-x-auto shadow-md sm:rounded-lg">
  <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
    <thead class="text-xs text-gray-700 uppercase bg-gray-100 dark:bg-gray-900 dark:text-gray-400">
      <tr>
        {{ $column }}
      </tr>
    </thead>
    <tbody class="bg-white border-b dark:bg-gray-800 dark:border-gray-800 text-nowrap">
      {{ $slot }}
    </tbody>
  </table>
</div>