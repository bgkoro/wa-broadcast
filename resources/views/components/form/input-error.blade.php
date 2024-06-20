@props(['name', 'errorBag' => ''])
<p id="{{ 'error' . $name }}" @class(['mt-2 text-sm text-danger-600 dark:text-danger-500', $errors->has($name) ||
    $errors->$errorBag ? 'block'
    :
    'hidden'])>
    @error($name)
    {{ $message }}
    @enderror
    @error($name, $errorBag)
    {{ $message }}
    @enderror
</p>