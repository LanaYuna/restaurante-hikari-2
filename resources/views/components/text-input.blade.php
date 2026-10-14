@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'bg-zinc-800 text-white border-zinc-700 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm']) }}>
