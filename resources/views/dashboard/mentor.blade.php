<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="grid lg:grid-cols-12 gap-8">
                
                <!-- Left Column: Pending Evaluations -->
                <div class="lg:col-span-4 space-y-8">
                    <div class="bg-white p-8 rounded-stitch border border-stitch-outline/10 shadow-sm">
                        <h2 class="font-lexend text-2xl font-bold text-stitch-primary mb-6">Evaluaciones Pendientes</h2>
                        <p class="text-sm text-stitch-on-surface-variant mb-8">Revisa las entregas recientes de tus alumnos.</p>
                        
                        <div class="space-y-4">
                            <!-- Student 1 -->
                            <div class="p-4 rounded-stitch bg-stitch-background border border-transparent hover:border-stitch-secondary transition-colors cursor-pointer group">
                                <div class="flex items-center gap-3 mb-2">
                                    <div class="w-8 h-8 rounded-full bg-blue-100 flex items-center justify-center text-stitch-primary font-bold text-xs">CM</div>
                                    <h4 class="font-bold text-stitch-primary text-sm group-hover:text-stitch-secondary transition-colors">Carlos Mendoza</h4>
                                </div>
                                <p class="text-xs text-stitch-on-surface-variant italic">UX/UI Design Challenge</p>
                            </div>

                            <!-- Student 2 -->
                            <div class="p-4 rounded-stitch bg-stitch-background border border-transparent hover:border-stitch-secondary transition-colors cursor-pointer group">
                                <div class="flex items-center gap-3 mb-2">
                                    <div class="w-8 h-8 rounded-full bg-teal-100 flex items-center justify-center text-stitch-secondary font-bold text-xs">AR</div>
                                    <h4 class="font-bold text-stitch-primary text-sm group-hover:text-stitch-secondary transition-colors">Ana Ramirez</h4>
                                </div>
                                <p class="text-xs text-stitch-on-surface-variant italic">Data Analysis Module 3</p>
                            </div>

                            <!-- Student 3 -->
                            <div class="p-4 rounded-stitch bg-stitch-background border border-transparent hover:border-stitch-secondary transition-colors cursor-pointer group">
                                <div class="flex items-center gap-3 mb-2">
                                    <div class="w-8 h-8 rounded-full bg-slate-200 flex items-center justify-center text-stitch-primary font-bold text-xs">JP</div>
                                    <h4 class="font-bold text-stitch-primary text-sm group-hover:text-stitch-secondary transition-colors">Juan Perez</h4>
                                </div>
                                <p class="text-xs text-stitch-on-surface-variant italic">Frontend React App</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Column: Current Evaluation Detail -->
                <div class="lg:col-span-8 space-y-8">
                    <div class="bg-white p-10 rounded-stitch border border-stitch-outline/10 shadow-sm">
                        <div class="flex items-start justify-between mb-10">
                            <div>
                                <h1 class="font-lexend text-3xl font-bold text-stitch-primary mb-2">UX/UI Design Challenge</h1>
                                <p class="text-stitch-secondary font-bold">FinTech App Redesign</p>
                            </div>
                            <div class="px-4 py-2 bg-stitch-secondary/10 text-stitch-secondary rounded-full text-xs font-bold">
                                EN REVISIÓN
                            </div>
                        </div>

                        <div class="grid md:grid-cols-2 gap-10">
                            <!-- Delivery Info -->
                            <div class="space-y-8">
                                <div>
                                    <h4 class="text-xs font-bold text-stitch-on-surface-variant uppercase tracking-widest mb-4">Archivos Adjuntos</h4>
                                    <div class="space-y-3">
                                        <a href="#" class="flex items-center gap-3 p-3 rounded-stitch border border-stitch-outline/10 hover:bg-stitch-background transition-colors">
                                            <svg class="w-6 h-6 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path></svg>
                                            <span class="text-sm font-medium text-stitch-primary">investigacion_usuarios.pdf</span>
                                        </a>
                                        <a href="#" class="flex items-center gap-3 p-3 rounded-stitch border border-stitch-outline/10 hover:bg-stitch-background transition-colors">
                                            <svg class="w-6 h-6 text-stitch-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"></path></svg>
                                            <span class="text-sm font-medium text-stitch-primary">Figma Prototype</span>
                                        </a>
                                    </div>
                                </div>

                                <div>
                                    <h4 class="text-xs font-bold text-stitch-on-surface-variant uppercase tracking-widest mb-4">Comentarios del Alumno</h4>
                                    <p class="text-sm text-stitch-on-surface leading-relaxed p-4 bg-stitch-background rounded-stitch italic">
                                        "He priorizado el flujo de onboarding para nuevos usuarios, enfocándome en la simplicidad y la confianza mediante el uso de micro-interacciones..."
                                    </p>
                                </div>
                            </div>

                            <!-- Evaluation Form -->
                            <div class="space-y-8 bg-stitch-background/50 p-8 rounded-stitch border border-stitch-outline/5">
                                <h4 class="text-xs font-bold text-stitch-on-surface-variant uppercase tracking-widest">Tu Evaluación</h4>
                                
                                <div class="space-y-6">
                                    <div>
                                        <label class="block text-sm font-bold text-stitch-primary mb-2">Habilidades Técnicas</label>
                                        <div class="flex gap-2">
                                            @for($i = 1; $i <= 5; $i++)
                                                <button class="w-8 h-8 rounded-full border border-stitch-outline/20 flex items-center justify-center hover:bg-stitch-primary hover:text-white transition-colors">
                                                    {{ $i }}
                                                </button>
                                            @endfor
                                        </div>
                                    </div>

                                    <div>
                                        <label class="block text-sm font-bold text-stitch-primary mb-2">Feedback Detallado</label>
                                        <textarea class="w-full rounded-stitch border-stitch-outline/20 text-sm p-4 focus:ring-stitch-secondary focus:border-stitch-secondary" rows="4" placeholder="Escribe tus observaciones aquí..."></textarea>
                                    </div>

                                    <button class="w-full py-4 bg-stitch-primary text-white rounded-stitch font-bold hover:shadow-lg transition-all">
                                        Enviar Evaluación
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
