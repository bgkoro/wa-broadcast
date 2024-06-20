@props(['id','name'])
<div class="flex items-center">
    <input {{ $attributes->class([$errors->has($name) ?
    'border-danger-500 bg-danger-50 focus:border-danger-600 focus:ring-danger-600' : 'border-dark-300 bg-light-50
    focus:ring-primary-600 dark:border-dark-600',])->merge(['class' => 'needs-validation w-4 h-4 border-2 focus:ring-2
    dark:bg-dark-900 dark:ring-offset-dark-700 checked:bg-primary-600 disabled:checked:bg-primary-600
    disabled:bg-light-100 dark:disabled:bg-dark-700 peer', 'type' => 'radio', 'id' => $id, 'name' => $name, 'checked' =>
    old($name)]) }}
    >
    <label for="{{ $id }}"
        class="ms-3 text-sm font-medium text-dark-900 peer-disabled:text-dark-400 dark:text-light-50">{{ $slot
        }}</label>
</div>