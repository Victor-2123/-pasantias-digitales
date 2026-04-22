<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Pasantías Digitales - Conecta tu ambición con la experiencia real. Cierra la brecha entre la educación y el mundo laboral.">
    <title>Pasantías Digitales | Impulsando la Ambición Guiada</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Lexend:wght@600;700;800&display=swap" rel="stylesheet">
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <style>
        .glass-nav {
            background: rgba(255, 255, 255, 0.6);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.3);
        }
        
        .hero-gradient {
            background: radial-gradient(circle at top right, #e6eeff 0%, #f8f9ff 100%);
        }
        
        .card-shadow {
            box-shadow: 0 20px 40px rgba(0, 53, 95, 0.05);
        }
        
        .btn-primary-float {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        .btn-primary-float:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(0, 53, 95, 0.15);
        }

        .text-balance {
            text-wrap: balance;
        }
    </style>
</head>
<body class="bg-stitch-background font-sans text-stitch-on-surface antialiased">
    <!-- Navigation -->
    <nav class="fixed top-0 w-full z-50 glass-nav">
        <div class="max-w-7xl mx-auto px-6 h-20 flex items-center justify-between">
            <div class="flex items-center gap-2">
                <div class="w-10 h-10 bg-stitch-primary rounded-stitch flex items-center justify-center text-white font-lexend font-bold text-xl">P</div>
                <span class="font-lexend font-bold text-xl tracking-tight text-stitch-primary">Pasantías Digitales</span>
            </div>
            
            <!-- Navigation Links Removed -->
        </div>
    </nav>

    <main>
        <!-- Hero Section -->
        <section class="pt-32 pb-20 hero-gradient min-h-screen flex items-center">
            <div class="max-w-7xl mx-auto px-6 grid md:grid-cols-2 gap-16 items-center">
                <div class="space-y-8">
                    <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-stitch-secondary/10 text-stitch-secondary font-semibold text-sm">
                        <span class="relative flex h-2 w-2">
                            <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-stitch-secondary opacity-75"></span>
                            <span class="relative inline-flex rounded-full h-2 w-2 bg-stitch-secondary"></span>
                        </span>
                        Iniciativa Educativa 2026
                    </div>
                    
                    <h1 class="font-lexend text-5xl md:text-6xl font-extrabold text-stitch-primary leading-tight text-balance">
                        Conecta tu Ambición con la <span class="text-stitch-secondary">Experiencia Real</span>
                    </h1>
                    
                    <p class="text-lg text-stitch-on-surface-variant leading-relaxed text-balance">
                        Pasantías Digitales cierra la brecha entre la educación secundaria y el mundo laboral corporativo. Supera retos reales guiado por mentores expertos.
                    </p>
                    
                    <div class="flex flex-col sm:flex-row gap-4">
                        <a href="{{ route('login') }}" class="px-8 py-4 bg-stitch-primary text-white rounded-stitch font-lexend font-bold text-lg text-center btn-primary-float">
                            Comenzar ahora
                        </a>
                        <a href="#info" class="px-8 py-4 bg-white border border-stitch-outline/20 text-stitch-primary rounded-stitch font-lexend font-bold text-lg text-center hover:bg-stitch-background transition-colors">
                            Saber más
                        </a>
                    </div>
                    
                    <div class="pt-4 flex items-center gap-4 text-sm text-stitch-on-surface-variant">
                        <div class="flex -space-x-2">
                            <div class="w-8 h-8 rounded-full border-2 border-white bg-slate-200"></div>
                            <div class="w-8 h-8 rounded-full border-2 border-white bg-slate-300"></div>
                            <div class="w-8 h-8 rounded-full border-2 border-white bg-slate-400"></div>
                        </div>
                        <span>Únete a más de <strong class="text-stitch-primary">500 estudiantes</strong> ya vinculados</span>
                    </div>
                </div>
                
                <div class="relative">
                    <div class="aspect-square bg-stitch-primary/5 rounded-[3rem] overflow-hidden relative z-10 card-shadow border border-white/50">
                        <img src="https://images.unsplash.com/photo-1522202176988-66273c2fd55f?auto=format&fit=crop&q=80&w=800" alt="Estudiantes colaborando" class="w-full h-full object-cover">
                        
                        <!-- Floating Card -->
                        <div class="absolute bottom-8 left-8 right-8 p-6 glass-nav rounded-stitch border border-white/50 shadow-2xl">
                            <div class="flex items-center gap-4 mb-4">
                                <div class="w-12 h-12 rounded-full bg-stitch-secondary flex items-center justify-center text-white">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                </div>
                                <div>
                                    <h4 class="font-bold text-stitch-primary">Reto Completado</h4>
                                    <p class="text-xs text-stitch-on-surface-variant">Diseño UX/UI App Finanzas</p>
                                </div>
                            </div>
                            <div class="h-2 bg-stitch-background rounded-full overflow-hidden">
                                <div class="h-full bg-stitch-secondary w-full"></div>
                            </div>
                        </div>
                    </div>
                    <!-- Decorative blobs -->
                    <div class="absolute -top-10 -right-10 w-40 h-40 bg-stitch-secondary/20 rounded-full blur-3xl animate-pulse"></div>
                    <div class="absolute -bottom-10 -left-10 w-40 h-40 bg-stitch-primary/10 rounded-full blur-3xl"></div>
                </div>
            </div>
        </section>

        <!-- Features Section -->
        <section id="info" class="py-24 bg-white">
            <div class="max-w-7xl mx-auto px-6">
                <div class="text-center max-w-3xl mx-auto mb-20 space-y-4">
                    <h2 class="font-lexend text-4xl font-bold text-stitch-primary">Aprende Haciendo</h2>
                    <p class="text-stitch-on-surface-variant text-lg">
                        Nuestra metodología se basa en la resolución de problemas reales, apoyada por una red de expertos de la industria.
                    </p>
                </div>

                <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-8">
                    <!-- Feature 1 -->
                    <div class="p-8 rounded-stitch bg-stitch-background border border-stitch-outline/10 hover:border-stitch-secondary/30 transition-all group">
                        <div class="w-14 h-14 bg-white rounded-stitch flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                            <svg class="w-8 h-8 text-stitch-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                        </div>
                        <h3 class="font-lexend font-bold text-lg mb-4 text-stitch-primary">Retos Laborales Reales</h3>
                        <p class="text-stitch-on-surface-variant text-sm leading-relaxed">
                            Enfréntate a desafíos propuestos por empresas top. Trabaja en proyectos que impactan y construye un portafolio sólido antes de graduarte.
                        </p>
                    </div>

                    <!-- Feature 2 -->
                    <div class="p-8 rounded-stitch bg-stitch-background border border-stitch-outline/10 hover:border-stitch-secondary/30 transition-all group">
                        <div class="w-14 h-14 bg-white rounded-stitch flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                            <svg class="w-8 h-8 text-stitch-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                        </div>
                        <h3 class="font-lexend font-bold text-lg mb-4 text-stitch-primary">Mentoría Experta</h3>
                        <p class="text-stitch-on-surface-variant text-sm leading-relaxed">
                            Conecta 1 a 1 con profesionales activos que guiarán tu desarrollo y pulirán tus habilidades.
                        </p>
                    </div>

                    <!-- Feature 3 -->
                    <div class="p-8 rounded-stitch bg-stitch-background border border-stitch-outline/10 hover:border-stitch-secondary/30 transition-all group">
                        <div class="w-14 h-14 bg-white rounded-stitch flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                            <svg class="w-8 h-8 text-stitch-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9"></path></svg>
                        </div>
                        <h3 class="font-lexend font-bold text-lg mb-4 text-stitch-primary">Red de Contactos</h3>
                        <p class="text-stitch-on-surface-variant text-sm leading-relaxed">
                            Inicia tu red profesional temprano. Destaca frente a empresas que buscan talento emergente.
                        </p>
                    </div>

                    <!-- Feature 4 -->
                    <div class="p-8 rounded-stitch bg-stitch-background border border-stitch-outline/10 hover:border-stitch-secondary/30 transition-all group">
                        <div class="w-14 h-14 bg-white rounded-stitch flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                            <svg class="w-8 h-8 text-stitch-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"></path></svg>
                        </div>
                        <h3 class="font-lexend font-bold text-lg mb-4 text-stitch-primary">Certificación</h3>
                        <p class="text-stitch-on-surface-variant text-sm leading-relaxed">
                            Obtienes un registro verificable de las horas trabajadas, los retos superados y las habilidades validadas.
                        </p>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <footer class="bg-stitch-background border-t border-stitch-outline/10 py-12">
        <div class="max-w-7xl mx-auto px-6 flex flex-col md:flex-row justify-between items-center gap-8">
            <div class="flex items-center gap-2">
                <div class="w-8 h-8 bg-stitch-primary rounded-stitch flex items-center justify-center text-white font-lexend font-bold text-lg">P</div>
                <span class="font-lexend font-bold text-lg text-stitch-primary">Pasantías Digitales</span>
            </div>
            
            <div class="flex gap-8 text-sm text-stitch-on-surface-variant">
                <a href="#" class="hover:text-stitch-primary">Privacidad</a>
                <a href="#" class="hover:text-stitch-primary">Términos</a>
                <a href="#" class="hover:text-stitch-primary">Soporte</a>
                <a href="#" class="hover:text-stitch-primary">Empresas</a>
            </div>
            
            <p class="text-sm text-stitch-on-surface-variant">&copy; 2026 Pasantías Digitales. Todos los derechos reservados.</p>
        </div>
    </footer>
</body>
</html>
