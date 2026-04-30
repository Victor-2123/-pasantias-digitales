<x-app-layout>
    <div class="py-16">
        <div class="max-w-5xl mx-auto px-6 lg:px-8 space-y-10">

            <div class="text-center mb-8">
                <h1 class="font-lexend text-4xl font-bold text-stitch-primary">Mi Ruta de Aprendizaje</h1>
                <p class="text-stitch-on-surface-variant mt-2">Sigue tu progreso a través de los desafíos de cada ruta.</p>
            </div>

            @if($paths->isEmpty())
                <div class="text-center py-20 bg-white rounded-[2rem] border border-gray-100 shadow-sm">
                    <div class="text-6xl mb-4">🗺️</div>
                    <p class="text-stitch-on-surface-variant italic">Aún no hay rutas de aprendizaje disponibles.</p>
                </div>
            @else
                @foreach($paths as $path)
                    @php
                        $colorMap = [
                            'blue'   => ['bg' => '#EFF6FF', 'text' => '#1E3A5F', 'bar' => '#1E3A5F', 'ring' => 'border-blue-200'],
                            'green'  => ['bg' => '#F0FDF4', 'text' => '#15803D', 'bar' => '#16A34A', 'ring' => 'border-green-200'],
                            'violet' => ['bg' => '#F5F3FF', 'text' => '#6D28D9', 'bar' => '#7C3AED', 'ring' => 'border-violet-200'],
                            'amber'  => ['bg' => '#FFFBEB', 'text' => '#B45309', 'bar' => '#D97706', 'ring' => 'border-amber-200'],
                        ];
                        $c = $colorMap[$path->color] ?? $colorMap['blue'];
                    @endphp
                    <div class="bg-white rounded-[1.75rem] border {{ $c['ring'] }} shadow-sm overflow-hidden">
                        <div class="p-8">
                            <div class="flex items-center gap-4 mb-5">
                                <div class="w-14 h-14 rounded-2xl flex items-center justify-center text-3xl"
                                     style="background-color: {{ $c['bg'] }}; color: {{ $c['text'] }};">
                                    {{ $path->icon }}
                                </div>
                                <div class="flex-1">
                                    <h2 class="font-lexend text-xl font-bold" style="color: {{ $c['text'] }};">{{ $path->title }}</h2>
                                    @if($path->description)
                                        <p class="text-xs text-gray-500 mt-0.5">{{ $path->description }}</p>
                                    @endif
                                </div>
                                @if($path->is_complete)
                                    <span class="px-3 py-1.5 text-xs font-bold rounded-full"
                                          style="background-color: {{ $c['bg'] }}; color: {{ $c['text'] }};">
                                        🏆 ¡Completada!
                                    </span>
                                @endif
                            </div>

                            {{-- Progress bar --}}
                            <div class="mb-2 flex justify-between text-xs font-semibold">
                                <span style="color: {{ $c['text'] }};">Progreso</span>
                                <span style="color: {{ $c['text'] }};">{{ $path->approved_count }} / {{ $path->total_challenges }} desafíos</span>
                            </div>
                            <div class="w-full bg-gray-100 rounded-full h-3 overflow-hidden">
                                <div class="h-3 rounded-full transition-all duration-700"
                                     style="width: {{ $path->progress_pct }}%; background-color: {{ $c['bar'] }};"></div>
                            </div>
                            <p class="text-right text-xs mt-1 font-bold" style="color: {{ $c['text'] }};">{{ $path->progress_pct }}%</p>

                            {{-- Challenges list --}}
                            @if($path->challenges->isNotEmpty())
                                <div class="mt-6 space-y-3">
                                    @foreach($path->challenges as $challenge)
                                        @php
                                            $approved = $challenge->submissions
                                                ->where('user_id', auth()->id())
                                                ->where('status', 'approved')
                                                ->isNotEmpty();
                                        @endphp
                                        <div class="flex items-center gap-3 p-3 rounded-xl"
                                             style="background-color: {{ $approved ? $c['bg'] : '#F9FAFB' }};">
                                            <div class="w-7 h-7 rounded-full flex items-center justify-center text-sm flex-shrink-0"
                                                 style="{{ $approved ? 'background-color: '.$c['bar'].'; color: #fff;' : 'background-color: #E5E7EB; color: #9CA3AF;' }}">
                                                {{ $approved ? '✓' : $loop->iteration }}
                                            </div>
                                            <p class="text-sm font-semibold {{ $approved ? 'line-through opacity-60' : '' }}"
                                               style="color: {{ $c['text'] }};">
                                                {{ $challenge->title }}
                                            </p>
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
</x-app-layout>
