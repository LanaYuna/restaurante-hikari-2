@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'bg-zinc-800 text-white border-zinc-700 rounded-md shadow-sm']) }}>
