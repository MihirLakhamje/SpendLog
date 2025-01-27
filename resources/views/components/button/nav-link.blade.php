@props(['active' => false, 'href', 'icon', 'title'])
<a href="{{ $href }}"
  class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group {{ $active ? 'bg-gray-100 dark:bg-gray-700' : '' }}">
  {{ $icon }}
  <span class="ms-3">{{ $title }}</span>
</a>