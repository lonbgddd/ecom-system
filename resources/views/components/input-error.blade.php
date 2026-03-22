@props(['messages'])

@if ($messages)
    <ul
        {{ $attributes->merge([
            'class' => '
                mt-2
                space-y-1
                text-sm
                text-red-600
            '
        ]) }}
    >
        @foreach ((array) $messages as $message)
            <li class="flex items-start gap-2">
                <span class="mt-0.5 text-red-500">•</span>
                <span>{{ $message }}</span>
            </li>
        @endforeach
    </ul>
@endif
