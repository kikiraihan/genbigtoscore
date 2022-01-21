@props(['label'])
<style>
  /* CHECKBOX TOGGLE SWITCH */
  /* @apply rules for documentation, these do not work as inline style */
  .toggle-checkbox:checked {
    @apply: right-0 border-green-400;
    right: 0;
    border-color: #68D391;
  }
  .toggle-checkbox:checked + .toggle-label {
    @apply: bg-green-400;
    background-color: #68D391;
  }
</style>

<div class="relative inline-block w-10 mr-2 align-middle select-none transition duration-200 ease-in">
  {{$slot}}
  <label for="toggle" class="toggle-label block overflow-hidden h-6 rounded-full bg-gray-300 cursor-pointer"></label>
</div>
<label for="toggle" class="text-xs text-gray-700 hidden sm:inline">
  {{$label}}
</label>