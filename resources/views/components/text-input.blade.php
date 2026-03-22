@props(['disabled' => false])

<input
    @disabled($disabled)
    {{ $attributes->merge([
        'class' => '
            w-full
            px-4 py-3
            border
            border-gray-300
            rounded-lg
            text-sm
            text-gray-800
            placeholder-gray-400
            shadow-sm
            focus:outline-none
            focus:ring-2
            focus:ring-indigo-500
            focus:border-indigo-500
            transition
            disabled:bg-gray-100
            disabled:cursor-not-allowed
            disabled:opacity-70
        '
    ]) }}
>
