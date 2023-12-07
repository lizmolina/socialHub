@props(['name'])

<div class="mt-6">
    <x-label name="{{ $name }}" />

    <textarea
        class="border border-gray-200 p-2 w-full rounded"
        name="{{ $name }}"
        id="{{ $name }}"
        required
        {{ $attributes }}
    >{{ $slot ?? old($name) }}</textarea>

    <x-error name="{{ $name }}" />
</div>
