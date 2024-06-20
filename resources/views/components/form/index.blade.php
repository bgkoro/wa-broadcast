@props(['space' => true])
<form {{ $attributes->class(['space-y-4 md:space-y-6' => $space == true])}}>
    @if ($attributes->has('method'))
    @csrf
    @endif
    {{ $slot }}
</form>