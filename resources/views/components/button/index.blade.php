@props(['type' => 'button', 'color' => 'primary', 'href', 'size' => 'base'])

@if (isset($href))
<a {{ $attributes->class([
    'text-light-50 bg-primary-600 hover:bg-primary-800 focus:ring-primary-300 dark:focus:ring-primary-900' => $color ==
    'primary',
    'text-light-50 bg-secondary-600 hover:bg-secondary-800 focus:ring-secondary-300 dark:focus:ring-secondary-900' =>
    $color == 'secondary',
    'text-light-50 bg-danger-600 hover:bg-danger-800 focus:ring-danger-300 dark:focus:ring-danger-900' => $color ==
    'danger',
    'text-light-50 bg-warning-600 hover:bg-warning-800 focus:ring-warning-300 dark:focus:ring-warning-900' => $color ==
    'warning',
    'text-light-50 bg-success-600 hover:bg-success-800 focus:ring-success-300 dark:focus:ring-success-900' => $color ==
    'success',
    'text-dark-900 border border-dark-300 dark:border-dark-600 hover:bg-dark-100 focus:ring-dark-100
    dark:text-light-50
    dark:border-dark-700
    dark:hover:bg-dark-700 dark:focus:ring-dark-800' => $color ==
    'netral',
    'px-3 py-2 text-xs' => $size == 'extra-small',
    'px-3 py-2 text-sm' => $size == 'small',
    'px-5 py-2.5 text-sm' => $size == 'base',
    'px-5 py-3 text-base' => $size == 'large',
    'px-6 py-3.5 text-base'=>$size == 'extra-large'])->merge([
    'type' => $type,
    'href' => $href,
    'class' => 'inline-flex justify-center items-center font-medium text-center rounded-lg focus:ring-4']) }}>{{
    $slot }} </a>
@else
<button {{ $attributes->class([
    'text-light-50 bg-primary-600 hover:bg-primary-800 focus:ring-primary-300 dark:focus:ring-primary-900' => $color ==
    'primary',
    'text-light-50 bg-secondary-600 hover:bg-secondary-800 focus:ring-secondary-300 dark:focus:ring-secondary-900' =>
    $color == 'secondary',
    'text-light-50 bg-danger-600 hover:bg-danger-800 focus:ring-danger-300 dark:focus:ring-danger-900' => $color ==
    'danger',
    'text-light-50 bg-warning-600 hover:bg-warning-800 focus:ring-warning-300 dark:focus:ring-warning-900' => $color ==
    'warning',
    'text-light-50 bg-success-600 hover:bg-success-800 focus:ring-success-300 dark:focus:ring-success-900' => $color ==
    'success',
    'text-dark-900 border border-dark-300 dark:border-dark-600 hover:bg-dark-100 focus:ring-dark-100
    dark:text-light-50
    dark:border-dark-700
    dark:hover:bg-dark-700 dark:focus:ring-dark-800' => $color ==
    'netral',
    'px-3 py-2 text-xs' => $size == 'extra-small',
    'px-3 py-2 text-sm' => $size == 'small',
    'px-5 py-2.5 text-sm' => $size == 'base',
    'px-5 py-3 text-base' => $size == 'large',
    'px-6 py-3.5 text-base'=>$size == 'extra-large'])->merge([
    'type' => $type,
    'class' => 'inline-flex justify-center items-center font-medium text-center rounded-lg focus:ring-4']) }}>
    {{ $slot }}
</button>
@endif