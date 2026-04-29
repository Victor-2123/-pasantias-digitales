<x-app-layout>
    <div class="py-12" x-data="{ activeTab: 'pending', reviewModal: false, reviewId: null, reviewForm: { status: 'approved', score: '', feedback: '' } }">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="grid lg:grid-cols-12 gap-8">

                <!-- Main Content -->
                <div class="lg:col-span-8 space-y-8">
                    <!-- Welcome Hero -->
                    <div class="p-10 rounded-[2rem] bg-stitch-primary text-white relative overflow-hidden shadow-2xl">
                        <div class="relative z-10 space-y-4">
                            <h1 class="font-lexend text-4xl font-bold">¡Hola, {{ explode(' ', auth()->user()->name)[0] ?? 'Mentor' }}!</h1>
                            <p class="text-lg text-white/80 max-w-md">
                                Panel de revisión de desafíos. Tienes
                                <strong class="text-white">{{ $pending->count() }}</strong>
                                {{ $pending->count() === 1 ? 'entrega pendiente' : 'entregas pendientes' }} de calificación.
                            </p>
                        </div>
                        <!-- Abstract decoration -->
                        <div class="absolute -right-10 -bottom-10 w-64 h-64 bg-stitch-secondary/20 rounded-full blur-3xl"></div>
                        <div class="absolute right-10 top-10 w-24 h-24 border-4 border-white/10 rounded-full"></div>
                    </div>

                    <!-- Quick Stats -->
                    <div class="grid grid-cols-3 gap-4">
                        <div class="bg-white p-6 rounded-stitch border border-stitch-outline/10 shadow-sm flex items-center gap-4 hover:-translate-y-1 transition-transform">
                            <div class="w-12 h-12 rounded-full flex items-center justify-center shrink-0" style="background-color: #FEE2E2; color: #111827;">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            </div>
                            <div>
                                <p class="text-xs text-stitch-on-surface-variant font-medium">Pendientes</p>
                                <h3 class="text-xl font-bold text-stitch-primary">{{ $pending->count() }}</h3>
                            </div>
                        </div>
                        <div class="bg-white p-6 rounded-stitch border border-stitch-outline/10 shadow-sm flex items-center gap-4 hover:-translate-y-1 transition-transform">
                            <div class="w-12 h-12 rounded-full flex items-center justify-center shrink-0" style="background-color: #DCFCE7; color: #111827;">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            </div>
                            <div>
                                <p class="text-xs text-stitch-on-surface-variant font-medium">Aprobadas</p>
                                <h3 class="text-xl font-bold text-stitch-primary">{{ $reviewed->where('status','approved')->count() }}</h3>
                            </div>
                        </div>
                        <div class="bg-white p-6 rounded-stitch border border-stitch-outline/10 shadow-sm flex items-center gap-4 hover:-translate-y-1 transition-transform">
                            <div class="w-12 h-12 rounded-full flex items-center justify-center shrink-0" style="background-color: #F3E5F5; color: #111827;">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/></svg>
                            </div>
                            <div>
                                <p class="text-xs text-stitch-on-surface-variant font-medium">Calificadas (hoy)</p>
                                <h3 class="text-xl font-bold text-stitch-primary">{{ $reviewed->count() }}</h3>
                            </div>
                        </div>
                    </div>

                    <!-- Tabs -->
                    <div class="bg-white rounded-stitch border border-stitch-outline/10 shadow-sm overflow-hidden">
                        <div class="flex border-b border-stitch-outline/10">
                            <button @click="activeTab = 'pending'"
                                    :class="activeTab === 'pending' ? 'border-b-2 border-stitch-primary text-stitch-primary font-bold' : 'text-stitch-on-surface-variant'"
                                    class="flex-1 py-4 px-6 text-sm font-semibold transition-colors relative">
                                Pendientes
                                @if($pending->count() > 0)
                                    <span class="ml-2 inline-flex items-center justify-center w-5 h-5 bg-red-500 text-white rounded-full text-xs font-bold">{{ $pending->count() }}</span>
                                @endif
                            </button>
                            <button @click="activeTab = 'reviewed'"
                                    :class="activeTab === 'reviewed' ? 'border-b-2 border-stitch-primary text-stitch-primary font-bold' : 'text-stitch-on-surface-variant'"
                                    class="flex-1 py-4 px-6 text-sm font-semibold transition-colors">
                                Calificadas recientemente
                            </button>
                        </div>

                        <!-- Pending Tab -->
                        <div x-show="activeTab === 'pending'" class="divide-y divide-stitch-outline/10">
                            @forelse($pending as $submission)
                                <div class="p-6 flex flex-col sm:flex-row sm:items-center gap-4 hover:bg-stitch-background/50 transition-colors">
                                    <div class="flex items-center gap-4 flex-1 min-w-0">
                                        <div class="w-10 h-10 rounded-full bg-stitch-secondary/10 text-stitch-secondary flex items-center justify-center font-bold font-lexend text-sm flex-shrink-0">
                                            {{ strtoupper(substr($submission->user->name, 0, 1)) }}
                                        </div>
                                        <div class="min-w-0">
                                            <p class="font-bold text-stitch-primary text-sm leading-tight">{{ $submission->user->name }}</p>
                                            <p class="text-xs text-stitch-on-surface-variant truncate">{{ $submission->challenge->title ?? 'Reto' }}</p>
                                            <p class="text-xs text-stitch-on-surface-variant mt-0.5">{{ $submission->created_at->diffForHumans() }}</p>
                                        </div>
                                    </div>
                                    <div class="flex items-center gap-3 flex-shrink-0">
                                        <a href="{{ asset('storage/' . $submission->file_path) }}"
                                           target="_blank"
                                           class="text-xs font-bold text-stitch-secondary hover:underline flex items-center gap-1">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                                            {{ $submission->original_name ?? 'Ver archivo' }}
                                        </a>
                                        <button
                                            @click="reviewId = {{ $submission->id }}; reviewModal = true"
                                            class="px-4 py-2 bg-stitch-primary text-white text-xs font-bold rounded-stitch hover:bg-stitch-primary/90 transition-colors">
                                            Calificar
                                        </button>
                                    </div>
                                </div>
                            @empty
                                <div class="p-12 text-center">
                                    <div class="w-16 h-16 bg-green-50 rounded-full flex items-center justify-center mx-auto mb-4 text-3xl">✅</div>
                                    <p class="font-bold text-stitch-primary">¡Sin pendientes!</p>
                                    <p class="text-stitch-on-surface-variant text-sm mt-1">Todas las entregas han sido calificadas.</p>
                                </div>
                            @endforelse
                        </div>

                        <!-- Reviewed Tab -->
                        <div x-show="activeTab === 'reviewed'" class="divide-y divide-stitch-outline/10">
                            @forelse($reviewed as $submission)
                                <div class="p-6 flex flex-col sm:flex-row sm:items-center gap-4 hover:bg-stitch-background/50 transition-colors">
                                    <div class="flex items-center gap-4 flex-1 min-w-0">
                                        <div class="w-10 h-10 rounded-full bg-stitch-secondary/10 text-stitch-secondary flex items-center justify-center font-bold font-lexend text-sm flex-shrink-0">
                                            {{ strtoupper(substr($submission->user->name, 0, 1)) }}
                                        </div>
                                        <div class="min-w-0">
                                            <p class="font-bold text-stitch-primary text-sm">{{ $submission->user->name }}</p>
                                            <p class="text-xs text-stitch-on-surface-variant truncate">{{ $submission->challenge->title ?? 'Reto' }}</p>
                                        </div>
                                    </div>
                                    <div class="flex items-center gap-4 flex-shrink-0">
                                        @if($submission->score !== null)
                                            <span class="text-sm font-bold text-stitch-primary">{{ $submission->score }}/100</span>
                                        @endif
                                        @if($submission->status === 'approved')
                                            <span class="px-3 py-1 rounded-full text-xs font-bold" style="background-color: #DCFCE7; color: #15803D;">✓ Aprobada</span>
                                        @else
                                            <span class="px-3 py-1 rounded-full text-xs font-bold" style="background-color: #FEE2E2; color: #B91C1C;">✗ Rechazada</span>
                                        @endif
                                        {{-- Pencil edit button to re-grade --}}
                                        <button
                                            @click="reviewId = {{ $submission->id }}; reviewForm.status = '{{ $submission->status }}'; reviewForm.score = '{{ $submission->score }}'; reviewForm.feedback = {{ json_encode($submission->feedback ?? '') }}; reviewModal = true"
                                            class="p-2 rounded-lg transition-colors" style="color: #9CA3AF;" onmouseover="this.style.color='#1E3A5F'" onmouseout="this.style.color='#9CA3AF'"
                                            title="Modificar calificación">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/>
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            @empty
                                <div class="p-12 text-center">
                                    <p class="text-stitch-on-surface-variant italic text-sm">No hay calificaciones recientes.</p>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>

                <!-- Sidebar -->
                <div class="lg:col-span-4 space-y-8 sticky top-8 self-start">
                    <div class="bg-white p-8 rounded-stitch border border-stitch-outline/10 shadow-sm">
                        <div class="flex items-center justify-between mb-6">
                            <h2 class="font-lexend text-xl font-bold text-stitch-primary">Entregas Pendientes</h2>
                            <span class="bg-[#FEE2E2] text-[#DC2626] text-xs font-bold px-2 py-1 rounded-full">{{ $pending->count() }} nuevas</span>
                        </div>
                        @forelse($pending->take(5) as $sub)
                            <div class="flex items-center gap-3 py-3 border-b border-stitch-outline/10 last:border-0">
                                <div class="w-8 h-8 rounded-full bg-stitch-secondary/10 text-stitch-secondary flex items-center justify-center font-bold text-xs flex-shrink-0">
                                    {{ strtoupper(substr($sub->user->name, 0, 1)) }}
                                </div>
                                <div class="min-w-0">
                                    <p class="text-xs font-bold text-stitch-primary truncate">{{ $sub->user->name }}</p>
                                    <p class="text-xs text-stitch-on-surface-variant">{{ $sub->created_at->format('d/m H:i') }}</p>
                                </div>
                            </div>
                        @empty
                            <p class="text-stitch-on-surface-variant italic text-sm text-center py-4">No hay pendientes.</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>

        {{-- ── Review Modal ── --}}
        <div x-show="reviewModal"
             class="fixed inset-0 z-50 overflow-y-auto"
             x-transition:enter="ease-out duration-200"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             style="display: none;">
            <div class="flex items-center justify-center min-h-screen px-4 py-8">
                <div class="fixed inset-0 bg-gray-900/40 backdrop-blur-sm" @click="reviewModal = false"></div>
                <div class="relative bg-white rounded-[2rem] shadow-2xl w-full max-w-lg border border-stitch-outline/10 z-10"
                     x-transition:enter="ease-out duration-300"
                     x-transition:enter-start="opacity-0 scale-95"
                     x-transition:enter-end="opacity-100 scale-100">
                    <div class="p-8">
                        <h3 class="font-lexend text-xl font-bold text-stitch-primary mb-6 flex items-center gap-3">
                            <span class="text-2xl">📝</span> Calificar Entrega
                        </h3>

                        <template x-if="reviewId">
                            {{-- Inner Alpine component owns veredicto state --}}
                            <div x-data="{ veredicto: reviewForm.status || '' }">
                                <form :action="`/submissions/${reviewId}/review`" method="POST">
                                    @csrf
                                    @method('PATCH')

                                    {{-- Hidden input carries veredicto value to backend on submit --}}
                                    <input type="hidden" name="status" x-model="veredicto" required>

                                    <!-- Veredicto -->
                                    <div class="mb-5">
                                        <label class="block text-sm font-bold text-stitch-primary mb-3">
                                            Veredicto <span class="text-red-500">*</span>
                                        </label>
                                        <div class="grid grid-cols-2 gap-3">
                                            <button
                                                type="button"
                                                @click="veredicto = 'approved'"
                                                :style="veredicto === 'approved'
                                                    ? 'border-color: #22C55E; background-color: #F0FDF4; color: #15803D; box-shadow: 0 1px 2px rgba(0,0,0,0.05)'
                                                    : 'border-color: #E5E7EB; background-color: #FFFFFF; color: #6B7280'"
                                                class="border-2 rounded-stitch p-4 text-center font-bold text-sm transition-all duration-150 w-full">
                                                ✓ Aprobada
                                            </button>
                                            <button
                                                type="button"
                                                @click="veredicto = 'rejected'"
                                                :style="veredicto === 'rejected'
                                                    ? 'border-color: #EF4444; background-color: #FEF2F2; color: #B91C1C; box-shadow: 0 1px 2px rgba(0,0,0,0.05)'
                                                    : 'border-color: #E5E7EB; background-color: #FFFFFF; color: #6B7280'"
                                                class="border-2 rounded-stitch p-4 text-center font-bold text-sm transition-all duration-150 w-full">
                                                ✗ Rechazada
                                            </button>
                                        </div>
                                        <p x-show="veredicto === ''" class="mt-2 text-xs text-red-500 font-medium">
                                            Selecciona un veredicto antes de guardar.
                                        </p>
                                    </div>

                                    <!-- Puntaje -->
                                    <div class="mb-5">
                                        <label class="block text-sm font-bold text-stitch-primary mb-2" for="score">
                                            Puntaje <span class="text-red-500">*</span>
                                            <span class="text-gray-400 font-normal text-xs">(0 – 100)</span>
                                        </label>
                                        <input type="number" name="score" id="score" min="0" max="100"
                                               required
                                               x-model="reviewForm.score"
                                               value="{{ old('score', '') }}"
                                               placeholder="ej. 85"
                                               class="w-full border border-gray-200 rounded-stitch px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-stitch-primary/30 focus:border-stitch-primary transition">
                                    </div>

                                    <!-- Retroalimentación -->
                                    <div class="mb-6">
                                        <label class="block text-sm font-bold text-stitch-primary mb-2" for="feedback">
                                            Retroalimentación <span class="text-red-500">*</span>
                                        </label>
                                        <textarea name="feedback" id="feedback" rows="4"
                                                  required
                                                  x-model="reviewForm.feedback"
                                                  placeholder="Escribe comentarios constructivos para el estudiante..."
                                                  class="w-full border border-gray-200 rounded-stitch px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-stitch-primary/30 focus:border-stitch-primary transition resize-none">{{ old('feedback', '') }}</textarea>
                                    </div>

                                    <div class="flex gap-3">
                                        <button type="submit"
                                                :disabled="veredicto === ''"
                                                :class="veredicto === '' ? 'opacity-50 cursor-not-allowed' : 'hover:bg-stitch-primary/90 cursor-pointer'"
                                                class="flex-1 py-3 bg-stitch-primary text-white font-bold rounded-stitch transition-colors text-sm">
                                            Guardar Calificación
                                        </button>
                                        <button type="button" @click="reviewModal = false"
                                                class="px-6 py-3 border border-gray-200 text-gray-700 font-bold rounded-stitch hover:bg-gray-50 transition-colors text-sm">
                                            Cancelar
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </template>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
