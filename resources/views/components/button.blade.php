@php
    $baseClasses = 'inline-flex items-center rounded px-3 py-1.5 text-xs font-medium transition';

    $variantClasses = [
        'primary' => 'bg-indigo-600 text-white hover:bg-indigo-700',
        'secondary' => 'bg-amber-500 text-white hover:bg-amber-600',
        'danger' => 'bg-red-600 text-white hover:bg-red-700',
    ];

    $buttonClasses = $variantClasses[$type] ?? $variantClasses['primary'];
    $isLink = $attributes->has('href');
@endphp

@if ($isLink)
    <a {{ $attributes->class([$baseClasses, $buttonClasses]) }}>
        {{ $slot }}
    </a>
@else
    <button {{ $attributes->merge(['type' => $buttonType])->class([$baseClasses, $buttonClasses]) }}>
        {{ $slot }}
    </button>
@endif
