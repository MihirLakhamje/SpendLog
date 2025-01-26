@props(['name'])

@error($name)
  <p class="text-red-500 fw-semibold">
    {{$message}}
  </p>
@enderror