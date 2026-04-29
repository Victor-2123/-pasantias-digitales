@php
    $hasTakenTest = auth()->check() && auth()->user()->vocationalTestResult;
@endphp

<a href="{{ route('vocacional.test') }}" {{ $attributes->merge(['class' => 'inline-flex items-center justify-center px-6 py-3 bg-stitch-secondary text-white rounded-stitch font-bold text-sm hover:scale-105 hover:shadow-md transition-all duration-200']) }}>
    {{ $hasTakenTest ? 'Volver a hacer test' : 'Comenzar Test' }}
</a>
