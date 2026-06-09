<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $profile->name ?? 'Portfolio' }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500&family=Playfair+Display:ital,wght@0,400;0,600;1,400&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/lucide@latest"></script>
    <style>
        body { 
            background-color: #0c0c0c; 
            color: #EAE8E3; 
            font-family: 'Inter', sans-serif; 
            overflow-x: hidden;
        }
        .font-serif { font-family: 'Playfair Display', serif; }
        .text-accent { color: #B2A79E; }
        .bg-accent { background-color: #B2A79E; }
        
        /* Huge Typography Utilities */
        .text-hero { font-size: clamp(3rem, 12vw, 10rem); line-height: 0.9; letter-spacing: -0.02em; }
        .text-huge { font-size: clamp(2.5rem, 8vw, 6rem); line-height: 1; letter-spacing: -0.01em; }
    </style>
</head>
<body class="selection:bg-[#EAE8E3] selection:text-[#0c0c0c]">
    <!-- Film Grain Overlay -->
    <div class="film-grain"></div>
    
    <!-- Custom Cursor -->
    <div class="custom-cursor hidden md:block"></div>
    
    <!-- Preloader -->
    <div id="preloader" class="fixed inset-0 z-[9999] bg-[#0c0c0c] flex justify-center items-center text-[#EAE8E3]">
        <div class="text-hero font-serif overflow-hidden">
            <span id="loader-count" class="inline-block">0</span><span class="inline-block">%</span>
        </div>
    </div>

<!-- Navigation -->
<nav class="fixed w-full z-50 p-6 md:p-10 text-[#EAE8E3] font-light text-sm tracking-wide uppercase flex justify-between items-center pointer-events-none">
    <div class="pointer-events-auto hover:opacity-50 transition-opacity mix-blend-difference magnetic"><a href="#">Natz</a></div>
    <div class="pointer-events-auto flex gap-8 mix-blend-difference items-center">
        <button id="audio-toggle" class="hover:opacity-50 transition-opacity magnetic inline-block uppercase tracking-wide">Sound: OFF</button>
        <a href="#work" class="hover:opacity-50 transition-opacity magnetic inline-block">Work</a>
        <a href="#about" class="hover:opacity-50 transition-opacity magnetic inline-block">About</a>
        @if(isset($profile->github_link))
        <a href="{{ $profile->github_link }}" target="_blank" class="hover:opacity-50 transition-opacity magnetic inline-block">Github</a>
        @endif
    </div>
</nav>

<main>
    <!-- Hero Section -->
    <section class="min-h-screen flex flex-col justify-end p-6 md:p-10 pb-20 relative overflow-hidden">
        <!-- 3D Video Background -->
        <div class="absolute inset-0 z-0 opacity-50 pointer-events-none">
            <video autoplay loop muted playsinline class="w-full h-full object-cover">
                <source src="{{ asset('videos/gabimaru-hollow-flame.1920x1080.mp4') }}" type="video/mp4">
            </video>
        </div>

        <div class="max-w-screen-2xl mx-auto w-full relative z-10">
            <h1 class="text-hero font-serif font-normal text-white uppercase mb-4">
                <div class="clip-mask reveal-text"><span>Creative</span></div><br>
                <div class="clip-mask reveal-text text-accent italic"><span>Developer</span></div>
            </h1>
            <div class="flex flex-col md:flex-row justify-between items-start md:items-end mt-12 md:mt-24">
                <p class="max-w-sm text-lg font-light text-accent reveal-text clip-mask">
                    <span>{{ $profile->title ?? 'Front End Developer' }}</span><br>
                    <span>Based in the Digital World.</span>
                </p>
                <div class="mt-8 md:mt-0 reveal-text clip-mask">
                    <span class="text-xs uppercase tracking-widest text-accent">[ Scroll to explore ]</span>
                </div>
            </div>
        </div>
    </section>

    <!-- Work Section -->
    <section id="work" class="py-32 md:py-48 bg-[#0a0a0a]">
        <div class="max-w-screen-2xl mx-auto px-6 md:px-10">
            <h2 class="text-huge font-serif text-white mb-24 reveal-text clip-mask"><span>Selected Works.</span></h2>
            
            <div class="space-y-48">
                @foreach($projects ?? [] as $index => $project)
                <article class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-24 items-center">
                    <!-- Image -->
                    <div class="lg:col-span-7 {{ $index % 2 !== 0 ? 'lg:order-2' : '' }} overflow-hidden">
                        <div class="aspect-[4/3] w-full bg-[#151515] overflow-hidden group">
                            @if($project->image)
                                <img src="{{ asset($project->image) }}" alt="{{ $project->title }}" class="w-full h-full object-cover reveal-image grayscale hover:grayscale-0 transition-all duration-1000">
                            @else
                                <div class="w-full h-full flex items-center justify-center reveal-image bg-[#111]">
                                    <span class="font-serif italic text-accent text-2xl opacity-50">No Image</span>
                                </div>
                            @endif
                        </div>
                    </div>
                    
                    <!-- Text Info -->
                    <div class="lg:col-span-5 {{ $index % 2 !== 0 ? 'lg:order-1' : '' }} flex flex-col justify-center project-trigger cursor-pointer" data-title="{{ $project->title }}" data-desc="{{ $project->description }}">
                        <div class="mb-4 fade-up text-xs font-light tracking-widest text-accent uppercase">0{{ $index + 1 }}</div>
                        <h3 class="text-5xl md:text-6xl font-serif text-white mb-8 fade-up">{{ $project->title }}</h3>
                        <p class="text-lg text-accent font-light leading-relaxed mb-10 fade-up max-w-md">{{ $project->description }}</p>
                        
                        <div class="flex flex-wrap gap-4 mb-12 fade-up">
                            @foreach($project->tech_stack as $tech)
                            <span class="text-sm font-light text-white border border-[#333] px-4 py-1 rounded-full">{{ $tech }}</span>
                            @endforeach
                        </div>
                        
                        <div class="flex gap-8 fade-up">
                            @if($project->github_link)
                            <a href="{{ $project->github_link }}" target="_blank" class="group relative overflow-hidden inline-flex items-center gap-3 text-sm tracking-widest uppercase pb-2">
                                <span class="relative z-10">Source Code</span>
                                <i data-lucide="arrow-up-right" class="w-4 h-4 relative z-10 group-hover:translate-x-1 group-hover:-translate-y-1 transition-transform"></i>
                                <span class="absolute bottom-0 left-0 w-full h-[1px] bg-accent transform origin-left scale-x-100 group-hover:scale-x-0 transition-transform duration-500"></span>
                            </a>
                            @endif
                            
                            @if($project->live_link)
                            <a href="{{ $project->live_link }}" target="_blank" class="group relative overflow-hidden inline-flex items-center gap-3 text-sm tracking-widest uppercase pb-2">
                                <span class="relative z-10">Live Site</span>
                                <i data-lucide="arrow-up-right" class="w-4 h-4 relative z-10 group-hover:translate-x-1 group-hover:-translate-y-1 transition-transform"></i>
                                <span class="absolute bottom-0 left-0 w-full h-[1px] bg-accent transform origin-left scale-x-100 group-hover:scale-x-0 transition-transform duration-500"></span>
                            </a>
                            @endif
                        </div>
                    </div>
                </article>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Marquee Section -->
    <section class="py-12 md:py-24 border-y border-[#333] overflow-hidden bg-[#0c0c0c] flex items-center">
        <div class="marquee-container flex whitespace-nowrap">
            <div class="marquee-content text-4xl md:text-8xl font-serif text-[#EAE8E3] opacity-20 uppercase tracking-tighter">
                <span>CREATIVE DEVELOPER &mdash; LARAVEL &mdash; VUE &mdash; REACT &mdash; GSAP &mdash; TAILWIND CSS &mdash; </span>
                <span>CREATIVE DEVELOPER &mdash; LARAVEL &mdash; VUE &mdash; REACT &mdash; GSAP &mdash; TAILWIND CSS &mdash; </span>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section id="about" class="py-32 md:py-48">
        <div class="max-w-screen-2xl mx-auto px-6 md:px-10">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-16">
                <div class="lg:col-span-5">
                    <h2 class="text-huge font-serif text-white mb-12 reveal-text clip-mask"><span>About.</span></h2>
                    <div class="text-xl md:text-2xl text-accent font-light leading-relaxed mb-16 reveal-text clip-mask">
                        <span>{{ $profile->bio ?? '' }}</span>
                    </div>
                </div>
                
                <div class="lg:col-span-6 lg:col-start-7 lg:mt-32">
                    <h3 class="text-xs uppercase tracking-widest text-accent mb-8 fade-up border-b border-[#333] pb-4">Experience</h3>
                    <div class="space-y-12 mb-24">
                        @foreach($experiences ?? [] as $experience)
                        <div class="fade-up">
                            <div class="flex justify-between items-baseline mb-2">
                                <h4 class="text-2xl font-serif text-white">{{ $experience->role }}</h4>
                                <span class="text-sm font-light text-accent">
                                    {{ \Carbon\Carbon::parse($experience->start_date)->format('Y') }} — {{ $experience->end_date ? \Carbon\Carbon::parse($experience->end_date)->format('Y') : 'PRESENT' }}
                                </span>
                            </div>
                            <p class="text-accent text-lg font-light italic">{{ $experience->company_or_organization }}</p>
                        </div>
                        @endforeach
                    </div>
                    
                    <h3 class="text-xs uppercase tracking-widest text-accent mb-8 fade-up border-b border-[#333] pb-4">Capabilities</h3>
                    <div class="flex flex-wrap gap-x-12 gap-y-6 fade-up">
                        @foreach($skills ?? [] as $category => $categorySkills)
                            @foreach($categorySkills as $skill)
                                <span class="text-lg text-white font-light">{{ $skill->name }}</span>
                            @endforeach
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Massive Contact Banners -->
    <section class="border-y border-[#333] divide-y divide-[#333]">
        <a href="https://wa.me/6281910789541" target="_blank" class="block w-full py-12 md:py-24 group relative overflow-hidden bg-[#0c0c0c]">
            <div class="absolute inset-0 bg-[#EAE8E3] transform translate-y-full group-hover:translate-y-0 transition-transform duration-700 ease-[cubic-bezier(0.76,0,0.24,1)] z-0 pointer-events-none"></div>
            <div class="relative z-10 flex justify-between items-center px-6 md:px-10 mix-blend-difference text-[#EAE8E3]">
                <span class="text-4xl sm:text-5xl md:text-8xl font-serif uppercase tracking-tighter group-hover:italic transition-all duration-700">WhatsApp</span>
                <i data-lucide="arrow-up-right" class="w-10 h-10 md:w-20 md:h-20 transform group-hover:rotate-45 transition-transform duration-700"></i>
            </div>
        </a>
        
        <a href="mailto:muhamadnajwan@gmail.com" class="block w-full py-12 md:py-24 group relative overflow-hidden bg-[#0c0c0c]">
            <div class="absolute inset-0 bg-[#EAE8E3] transform translate-y-full group-hover:translate-y-0 transition-transform duration-700 ease-[cubic-bezier(0.76,0,0.24,1)] z-0 pointer-events-none"></div>
            <div class="relative z-10 flex justify-between items-center px-6 md:px-10 mix-blend-difference text-[#EAE8E3]">
                <span class="text-4xl sm:text-5xl md:text-8xl font-serif uppercase tracking-tighter group-hover:italic transition-all duration-700">Email Me</span>
                <i data-lucide="arrow-up-right" class="w-10 h-10 md:w-20 md:h-20 transform group-hover:rotate-45 transition-transform duration-700"></i>
            </div>
        </a>
    </section>
</main>

<footer class="py-12 px-6 md:px-10 border-t border-[#1a1a1a] flex justify-between items-center">
    <p class="text-sm font-light text-accent uppercase tracking-widest">&copy; {{ date('Y') }} {{ $profile->name ?? '' }}</p>
    <a href="#top" class="text-sm font-light text-accent uppercase tracking-widest hover:text-white transition-colors magnetic inline-block">Back to top</a>
</footer>

<!-- Background Audio -->
<audio id="bg-audio" loop preload="none">
    <source src="/audio/Tejano Blue - Cigarettes After Sex - (256 Kbps).mp3" type="audio/mpeg">
</audio>

<!-- Project Detail Modal -->
<div id="project-modal" class="fixed inset-0 z-[1000] bg-[#0c0c0c] text-[#EAE8E3] translate-y-full flex flex-col pointer-events-none">
    <div class="flex justify-between items-center p-6 md:p-10 border-b border-[#333]">
        <h3 id="modal-title" class="text-2xl md:text-4xl font-serif">Project Title</h3>
        <button id="close-modal" class="text-sm font-light tracking-widest uppercase hover:opacity-50 magnetic inline-block pointer-events-auto">Close [X]</button>
    </div>
    <div class="flex-1 overflow-y-auto p-6 md:p-10 pointer-events-auto">
        <div class="max-w-4xl mx-auto">
            <p id="modal-desc" class="text-lg md:text-2xl font-light text-[#B2A79E] mb-12">Project description goes here.</p>
            <div id="modal-image" class="w-full aspect-video bg-[#1a1a1a] rounded overflow-hidden"></div>
        </div>
    </div>
</div>

<script>
    lucide.createIcons();
</script>
</body>
</html>
