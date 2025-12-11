<?php
/**
 * Template Name: Fileservice Page
 * Premium Professional Fileservice Landing Page
 *
 * @package Tuning_Mania
 */

get_header();
?>

<main id="primary" class="site-main bg-[#050505] text-white min-h-screen pt-20 overflow-x-hidden">

    <!-- Breadcrumbs -->
    <?php if (function_exists('tm_breadcrumbs')) tm_breadcrumbs(); ?>

    <!-- ============================================
         HERO SECTION - Premium with Particles
         ============================================ -->
    <section class="relative min-h-[85vh] flex items-center justify-center overflow-hidden">
        <!-- Animated Background Gradient -->
        <div class="absolute inset-0 z-0">
            <div class="absolute inset-0 bg-gradient-to-br from-[#050505] via-[#0a1a0a] to-[#050505]"></div>

            <!-- Animated Grid Pattern -->
            <div class="absolute inset-0 opacity-20"
                 style="background-image: linear-gradient(rgba(204,255,0,0.03) 1px, transparent 1px), linear-gradient(90deg, rgba(204,255,0,0.03) 1px, transparent 1px); background-size: 60px 60px;"></div>

            <!-- Floating Orbs -->
            <div class="absolute top-20 left-10 w-[400px] h-[400px] bg-lime-400/10 rounded-full blur-[120px] animate-pulse" style="animation-duration: 4s;"></div>
            <div class="absolute bottom-20 right-10 w-[300px] h-[300px] bg-[#00ff66]/10 rounded-full blur-[100px] animate-pulse" style="animation-duration: 6s;"></div>
            <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[600px] h-[600px] bg-lime-400/5 rounded-full blur-[150px]"></div>

            <!-- Animated Lines -->
            <div class="absolute top-0 left-1/4 w-px h-full bg-gradient-to-b from-transparent via-lime-400/20 to-transparent"></div>
            <div class="absolute top-0 right-1/4 w-px h-full bg-gradient-to-b from-transparent via-lime-400/10 to-transparent"></div>
        </div>

        <div class="container mx-auto px-4 relative z-10 text-center">
            <!-- Badge -->
            <div class="inline-flex items-center gap-2 px-4 py-2 bg-lime-400/10 border border-lime-400/30 rounded-full mb-8 animate-pulse">
                <span class="w-2 h-2 bg-lime-400 rounded-full animate-ping"></span>
                <span class="text-lime-400 text-sm font-bold uppercase tracking-widest">B2B Tuning Platform</span>
            </div>

            <!-- Main Title -->
            <h1 class="text-5xl md:text-7xl lg:text-8xl font-black italic uppercase tracking-tighter mb-6">
                <span class="block text-transparent bg-clip-text bg-gradient-to-r from-white via-gray-200 to-gray-400 drop-shadow-2xl">Professional</span>
                <span class="block text-transparent bg-clip-text bg-gradient-to-r from-lime-400 via-[#b8e600] to-[#00ff66] drop-shadow-[0_0_30px_rgba(204,255,0,0.5)]">Fileservice</span>
            </h1>

            <!-- Subtitle with Typing Effect -->
            <p class="text-xl md:text-2xl text-gray-300 max-w-3xl mx-auto mb-12 font-light leading-relaxed">
                The <span class="text-lime-400 font-semibold">#1 Choice</span> for professional tuners worldwide.
                <br class="hidden md:block">Fast turnaround. Dyno-tested files. 24/7 availability.
            </p>

            <!-- CTA Buttons -->
            <div class="flex flex-col sm:flex-row gap-4 justify-center mb-16">
                <a href="https://portal.tunerfileslab.com/register"
                   class="group relative inline-flex items-center justify-center gap-3 px-10 py-5 bg-gradient-to-r from-lime-400 via-[#b8e600] to-[#00ff66] text-black font-black uppercase tracking-widest rounded-xl overflow-hidden transition-all duration-300 hover:scale-105 shadow-[0_0_40px_rgba(204,255,0,0.3)]">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path></svg>
                    <span>Start Free Trial</span>
                    <!-- Shine effect -->
                    <div class="absolute inset-0 -translate-x-full group-hover:translate-x-full transition-transform duration-700 bg-gradient-to-r from-transparent via-white/30 to-transparent"></div>
                </a>
                <a href="https://portal.tunerfileslab.com/login"
                   class="group inline-flex items-center justify-center gap-3 px-10 py-5 bg-white/5 backdrop-blur-md border-2 border-lime-400/50 text-lime-400 font-bold uppercase tracking-widest rounded-xl hover:bg-lime-400 hover:text-black transition-all duration-300">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path></svg>
                    <span>Dealer Login</span>
                </a>
            </div>

            <!-- Trust Badges -->
            <div class="flex flex-wrap justify-center gap-8 opacity-60">
                <div class="flex items-center gap-2 text-sm text-gray-400">
                    <svg class="w-5 h-5 text-lime-400" fill="currentColor" viewBox="0 0 24 24"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
                    <span>SSL Encrypted</span>
                </div>
                <div class="flex items-center gap-2 text-sm text-gray-400">
                    <svg class="w-5 h-5 text-lime-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    <span>24/7 Support</span>
                </div>
                <div class="flex items-center gap-2 text-sm text-gray-400">
                    <svg class="w-5 h-5 text-lime-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    <span>100% Safe Files</span>
                </div>
            </div>
        </div>

        <!-- Scroll Down Indicator -->
        <div class="absolute bottom-8 left-1/2 -translate-x-1/2 animate-bounce">
            <svg class="w-8 h-8 text-lime-400/50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"/>
            </svg>
        </div>
    </section>

    <!-- ============================================
         STATS SECTION - Animated Counters
         ============================================ -->
    <section class="py-16 relative border-y border-white/5 bg-white/[0.02]">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
                <!-- Stat 1 -->
                <div class="text-center group">
                    <div class="text-4xl md:text-5xl font-black text-lime-400 mb-2 group-hover:scale-110 transition-transform">15K+</div>
                    <div class="text-sm text-gray-400 uppercase tracking-widest">Files Delivered</div>
                </div>
                <!-- Stat 2 -->
                <div class="text-center group">
                    <div class="text-4xl md:text-5xl font-black text-lime-400 mb-2 group-hover:scale-110 transition-transform">&lt;30</div>
                    <div class="text-sm text-gray-400 uppercase tracking-widest">Minutes Avg</div>
                </div>
                <!-- Stat 3 -->
                <div class="text-center group">
                    <div class="text-4xl md:text-5xl font-black text-lime-400 mb-2 group-hover:scale-110 transition-transform">500+</div>
                    <div class="text-sm text-gray-400 uppercase tracking-widest">Active Dealers</div>
                </div>
                <!-- Stat 4 -->
                <div class="text-center group">
                    <div class="text-4xl md:text-5xl font-black text-lime-400 mb-2 group-hover:scale-110 transition-transform">24/7</div>
                    <div class="text-sm text-gray-400 uppercase tracking-widest">Availability</div>
                </div>
            </div>
        </div>
    </section>

    <!-- ============================================
         HOW IT WORKS - Timeline Design
         ============================================ -->
    <section class="py-24 relative overflow-hidden">
        <!-- Background Glow -->
        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[800px] h-[800px] bg-lime-400/5 rounded-full blur-[200px]"></div>

        <div class="container mx-auto px-4 relative z-10">
            <div class="text-center mb-20">
                <span class="text-lime-400 text-sm font-bold uppercase tracking-widest mb-4 block">Simple Process</span>
                <h2 class="text-4xl md:text-6xl font-black italic uppercase mb-6">
                    How It <span class="text-transparent bg-clip-text bg-gradient-to-r from-lime-400 to-[#00ff66]">Works</span>
                </h2>
                <p class="text-gray-400 text-lg max-w-2xl mx-auto">From upload to download in just 3 simple steps. Our automated system ensures lightning-fast delivery.</p>
            </div>

            <!-- Timeline -->
            <div class="relative max-w-5xl mx-auto">
                <!-- Connection Line -->
                <div class="hidden md:block absolute top-1/2 left-0 right-0 h-1 bg-gradient-to-r from-transparent via-lime-400/30 to-transparent -translate-y-1/2"></div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-8 md:gap-12">
                    <!-- Step 1 -->
                    <div class="group relative">
                        <div class="relative p-8 bg-gradient-to-br from-white/[0.08] to-white/[0.02] backdrop-blur-xl border border-white/10 rounded-2xl hover:border-lime-400/50 transition-all duration-500 hover:scale-105 hover:shadow-[0_0_50px_rgba(204,255,0,0.15)]">
                            <!-- Step Number Badge -->
                            <div class="absolute -top-5 left-1/2 -translate-x-1/2 w-10 h-10 bg-lime-400 rounded-full flex items-center justify-center font-black text-black shadow-[0_0_20px_rgba(204,255,0,0.5)]">01</div>

                            <!-- Icon -->
                            <div class="w-20 h-20 mx-auto mb-6 mt-4 bg-lime-400/10 rounded-2xl flex items-center justify-center group-hover:bg-lime-400/20 transition-colors">
                                <svg class="w-10 h-10 text-lime-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
                                </svg>
                            </div>

                            <h3 class="text-xl font-bold uppercase text-center mb-3">Create Account</h3>
                            <p class="text-gray-400 text-center text-sm leading-relaxed">Register in under 2 minutes. Get instant access to our professional portal.</p>

                            <!-- Time Badge -->
                            <div class="mt-4 flex justify-center">
                                <span class="px-3 py-1 bg-lime-400/10 rounded-full text-lime-400 text-xs font-bold">⏱ 2 min</span>
                            </div>
                        </div>
                    </div>

                    <!-- Step 2 -->
                    <div class="group relative md:mt-12">
                        <div class="relative p-8 bg-gradient-to-br from-white/[0.08] to-white/[0.02] backdrop-blur-xl border border-white/10 rounded-2xl hover:border-lime-400/50 transition-all duration-500 hover:scale-105 hover:shadow-[0_0_50px_rgba(204,255,0,0.15)]">
                            <div class="absolute -top-5 left-1/2 -translate-x-1/2 w-10 h-10 bg-lime-400 rounded-full flex items-center justify-center font-black text-black shadow-[0_0_20px_rgba(204,255,0,0.5)]">02</div>

                            <div class="w-20 h-20 mx-auto mb-6 mt-4 bg-lime-400/10 rounded-2xl flex items-center justify-center group-hover:bg-lime-400/20 transition-colors">
                                <svg class="w-10 h-10 text-lime-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path>
                                </svg>
                            </div>

                            <h3 class="text-xl font-bold uppercase text-center mb-3">Upload ECU File</h3>
                            <p class="text-gray-400 text-center text-sm leading-relaxed">Drag & drop your original file. Select your tuning options.</p>

                            <div class="mt-4 flex justify-center">
                                <span class="px-3 py-1 bg-lime-400/10 rounded-full text-lime-400 text-xs font-bold">⏱ 5 min</span>
                            </div>
                        </div>
                    </div>

                    <!-- Step 3 -->
                    <div class="group relative">
                        <div class="relative p-8 bg-gradient-to-br from-white/[0.08] to-white/[0.02] backdrop-blur-xl border border-white/10 rounded-2xl hover:border-lime-400/50 transition-all duration-500 hover:scale-105 hover:shadow-[0_0_50px_rgba(204,255,0,0.15)]">
                            <div class="absolute -top-5 left-1/2 -translate-x-1/2 w-10 h-10 bg-lime-400 rounded-full flex items-center justify-center font-black text-black shadow-[0_0_20px_rgba(204,255,0,0.5)]">03</div>

                            <div class="w-20 h-20 mx-auto mb-6 mt-4 bg-lime-400/10 rounded-2xl flex items-center justify-center group-hover:bg-lime-400/20 transition-colors">
                                <svg class="w-10 h-10 text-lime-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                                </svg>
                            </div>

                            <h3 class="text-xl font-bold uppercase text-center mb-3">Download & Flash</h3>
                            <p class="text-gray-400 text-center text-sm leading-relaxed">Receive your tuned file. Flash it and enjoy the gains.</p>

                            <div class="mt-4 flex justify-center">
                                <span class="px-3 py-1 bg-lime-400/10 rounded-full text-lime-400 text-xs font-bold">⚡ 30 min avg</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ============================================
         FEATURES GRID - Premium Cards
         ============================================ -->
    <section class="py-24 relative bg-gradient-to-b from-[#050505] via-[#080a0d] to-[#050505]">
        <div class="container mx-auto px-4">
            <div class="text-center mb-20">
                <span class="text-lime-400 text-sm font-bold uppercase tracking-widest mb-4 block">Why TunerFilesLab?</span>
                <h2 class="text-4xl md:text-6xl font-black italic uppercase mb-6">
                    Premium <span class="text-transparent bg-clip-text bg-gradient-to-r from-lime-400 to-[#00ff66]">Features</span>
                </h2>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- Feature 1 -->
                <div class="group p-8 bg-gradient-to-br from-white/[0.05] to-transparent backdrop-blur-sm border border-white/5 rounded-2xl hover:border-lime-400/30 transition-all duration-500 hover:transform hover:-translate-y-2">
                    <div class="w-14 h-14 bg-gradient-to-br from-lime-400/20 to-lime-400/5 rounded-xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                        <svg class="w-7 h-7 text-lime-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold uppercase mb-3 group-hover:text-lime-400 transition-colors">Dyno-Tested Files</h3>
                    <p class="text-gray-400 leading-relaxed">Every file is tested on our in-house dynamometer for guaranteed performance and reliability.</p>
                </div>

                <!-- Feature 2 -->
                <div class="group p-8 bg-gradient-to-br from-white/[0.05] to-transparent backdrop-blur-sm border border-white/5 rounded-2xl hover:border-lime-400/30 transition-all duration-500 hover:transform hover:-translate-y-2">
                    <div class="w-14 h-14 bg-gradient-to-br from-lime-400/20 to-lime-400/5 rounded-xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                        <svg class="w-7 h-7 text-lime-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold uppercase mb-3 group-hover:text-lime-400 transition-colors">Lightning Fast</h3>
                    <p class="text-gray-400 leading-relaxed">Average turnaround time under 30 minutes. Rush delivery available 24/7.</p>
                </div>

                <!-- Feature 3 -->
                <div class="group p-8 bg-gradient-to-br from-white/[0.05] to-transparent backdrop-blur-sm border border-white/5 rounded-2xl hover:border-lime-400/30 transition-all duration-500 hover:transform hover:-translate-y-2">
                    <div class="w-14 h-14 bg-gradient-to-br from-lime-400/20 to-lime-400/5 rounded-xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                        <svg class="w-7 h-7 text-lime-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold uppercase mb-3 group-hover:text-lime-400 transition-colors">Expert Support</h3>
                    <p class="text-gray-400 leading-relaxed">Direct access to our tuning engineers via ticket system. We speak your language.</p>
                </div>

                <!-- Feature 4 -->
                <div class="group p-8 bg-gradient-to-br from-white/[0.05] to-transparent backdrop-blur-sm border border-white/5 rounded-2xl hover:border-lime-400/30 transition-all duration-500 hover:transform hover:-translate-y-2">
                    <div class="w-14 h-14 bg-gradient-to-br from-lime-400/20 to-lime-400/5 rounded-xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                        <svg class="w-7 h-7 text-lime-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold uppercase mb-3 group-hover:text-lime-400 transition-colors">Flexible Credits</h3>
                    <p class="text-gray-400 leading-relaxed">Pay-as-you-go credit system. EVC and Alientech credits also accepted.</p>
                </div>

                <!-- Feature 5 -->
                <div class="group p-8 bg-gradient-to-br from-white/[0.05] to-transparent backdrop-blur-sm border border-white/5 rounded-2xl hover:border-lime-400/30 transition-all duration-500 hover:transform hover:-translate-y-2">
                    <div class="w-14 h-14 bg-gradient-to-br from-lime-400/20 to-lime-400/5 rounded-xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                        <svg class="w-7 h-7 text-lime-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 3v2m6-2v2M9 19v2m6-2v2M5 9H3m2 6H3m18-6h-2m2 6h-2M7 19h10a2 2 0 002-2V7a2 2 0 00-2-2H7a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold uppercase mb-3 group-hover:text-lime-400 transition-colors">Massive Database</h3>
                    <p class="text-gray-400 leading-relaxed">Over 10,000 ECU types supported. Cars, bikes, trucks, tractors, boats, and more.</p>
                </div>

                <!-- Feature 6 -->
                <div class="group p-8 bg-gradient-to-br from-white/[0.05] to-transparent backdrop-blur-sm border border-white/5 rounded-2xl hover:border-lime-400/30 transition-all duration-500 hover:transform hover:-translate-y-2">
                    <div class="w-14 h-14 bg-gradient-to-br from-lime-400/20 to-lime-400/5 rounded-xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                        <svg class="w-7 h-7 text-lime-400" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold uppercase mb-3 group-hover:text-lime-400 transition-colors">100% Secure</h3>
                    <p class="text-gray-400 leading-relaxed">SSL encryption, secure file transfer, and GDPR compliant data handling.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- ============================================
         TUNING OPTIONS - Service Cards
         ============================================ -->
    <section class="py-24 relative overflow-hidden">
        <!-- Background -->
        <div class="absolute inset-0 bg-gradient-to-b from-[#0a1a0a]/50 to-[#050505]"></div>

        <div class="container mx-auto px-4 relative z-10">
            <div class="text-center mb-16">
                <span class="text-lime-400 text-sm font-bold uppercase tracking-widest mb-4 block">Our Services</span>
                <h2 class="text-4xl md:text-6xl font-black italic uppercase mb-6">
                    Tuning <span class="text-transparent bg-clip-text bg-gradient-to-r from-lime-400 to-[#00ff66]">Options</span>
                </h2>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 max-w-6xl mx-auto">
                <!-- Stage 1 -->
                <div class="group relative p-6 bg-gradient-to-br from-lime-400/10 to-lime-400/5 border border-lime-400/30 rounded-2xl overflow-hidden hover:shadow-[0_0_40px_rgba(204,255,0,0.2)] transition-all duration-500">
                    <div class="absolute top-0 right-0 w-20 h-20 bg-lime-400/20 rounded-full blur-2xl"></div>
                    <span class="text-lime-400 text-xs font-bold uppercase tracking-widest">Most Popular</span>
                    <h3 class="text-2xl font-black mt-2 mb-4">Stage 1</h3>
                    <ul class="space-y-2 text-sm text-gray-300 mb-6">
                        <li class="flex items-center gap-2"><svg class="w-4 h-4 text-lime-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg> +20-40% Power</li>
                        <li class="flex items-center gap-2"><svg class="w-4 h-4 text-lime-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg> Better Fuel Economy</li>
                        <li class="flex items-center gap-2"><svg class="w-4 h-4 text-lime-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg> Safe & Reliable</li>
                    </ul>
                    <div class="text-lime-400 font-bold text-lg">From €79</div>
                </div>

                <!-- Stage 2 -->
                <div class="group relative p-6 bg-gradient-to-br from-white/[0.05] to-transparent border border-white/10 rounded-2xl hover:border-lime-400/30 transition-all duration-500">
                    <span class="text-gray-500 text-xs font-bold uppercase tracking-widest">Performance</span>
                    <h3 class="text-2xl font-black mt-2 mb-4">Stage 2</h3>
                    <ul class="space-y-2 text-sm text-gray-400 mb-6">
                        <li class="flex items-center gap-2"><svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg> +40-60% Power</li>
                        <li class="flex items-center gap-2"><svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg> Hardware Required</li>
                        <li class="flex items-center gap-2"><svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg> Aggressive Curves</li>
                    </ul>
                    <div class="text-white font-bold text-lg">From €129</div>
                </div>

                <!-- DPF/EGR -->
                <div class="group relative p-6 bg-gradient-to-br from-white/[0.05] to-transparent border border-white/10 rounded-2xl hover:border-lime-400/30 transition-all duration-500">
                    <span class="text-gray-500 text-xs font-bold uppercase tracking-widest">Solutions</span>
                    <h3 class="text-2xl font-black mt-2 mb-4">DPF/EGR</h3>
                    <ul class="space-y-2 text-sm text-gray-400 mb-6">
                        <li class="flex items-center gap-2"><svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg> DPF Delete</li>
                        <li class="flex items-center gap-2"><svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg> EGR Off</li>
                        <li class="flex items-center gap-2"><svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg> AdBlue Delete</li>
                    </ul>
                    <div class="text-white font-bold text-lg">From €49</div>
                </div>

                <!-- Special -->
                <div class="group relative p-6 bg-gradient-to-br from-white/[0.05] to-transparent border border-white/10 rounded-2xl hover:border-lime-400/30 transition-all duration-500">
                    <span class="text-gray-500 text-xs font-bold uppercase tracking-widest">Extras</span>
                    <h3 class="text-2xl font-black mt-2 mb-4">Special</h3>
                    <ul class="space-y-2 text-sm text-gray-400 mb-6">
                        <li class="flex items-center gap-2"><svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg> Pop & Bangs</li>
                        <li class="flex items-center gap-2"><svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg> Vmax Off</li>
                        <li class="flex items-center gap-2"><svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg> Launch Control</li>
                    </ul>
                    <div class="text-white font-bold text-lg">From €39</div>
                </div>
            </div>
        </div>
    </section>

    <!-- ============================================
         LIVE PORTAL PREVIEW
         ============================================ -->
    <section class="py-24 relative overflow-hidden">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
                <!-- Text Content -->
                <div>
                    <span class="text-lime-400 text-sm font-bold uppercase tracking-widest mb-4 block">Professional Portal</span>
                    <h2 class="text-4xl md:text-5xl font-black italic uppercase mb-8">
                        Built for <span class="text-lime-400">Efficiency</span>
                    </h2>
                    <p class="text-gray-400 text-lg mb-8 leading-relaxed">
                        Our intuitive portal is designed by tuners, for tuners. Upload files, track orders, manage credits, and communicate with our team - all in one place.
                    </p>

                    <ul class="space-y-4 mb-10">
                        <li class="flex items-start gap-4">
                            <div class="w-8 h-8 bg-lime-400/10 rounded-lg flex items-center justify-center flex-shrink-0 mt-1">
                                <svg class="w-4 h-4 text-lime-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                            </div>
                            <div>
                                <h4 class="font-bold text-white">Drag & Drop Upload</h4>
                                <p class="text-gray-400 text-sm">Simply drop your ECU file and we handle the rest.</p>
                            </div>
                        </li>
                        <li class="flex items-start gap-4">
                            <div class="w-8 h-8 bg-lime-400/10 rounded-lg flex items-center justify-center flex-shrink-0 mt-1">
                                <svg class="w-4 h-4 text-lime-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                            </div>
                            <div>
                                <h4 class="font-bold text-white">Real-time Notifications</h4>
                                <p class="text-gray-400 text-sm">Get notified instantly when your file is ready.</p>
                            </div>
                        </li>
                        <li class="flex items-start gap-4">
                            <div class="w-8 h-8 bg-lime-400/10 rounded-lg flex items-center justify-center flex-shrink-0 mt-1">
                                <svg class="w-4 h-4 text-lime-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                            </div>
                            <div>
                                <h4 class="font-bold text-white">Order History</h4>
                                <p class="text-gray-400 text-sm">Access all your files and redownload anytime.</p>
                            </div>
                        </li>
                    </ul>

                    <a href="https://portal.tunerfileslab.com/register" class="inline-flex items-center gap-3 px-8 py-4 bg-lime-400 text-black font-bold uppercase tracking-widest rounded-xl hover:bg-white transition-colors">
                        <span>Try It Free</span>
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                    </a>
                </div>

                <!-- Portal Mockup -->
                <div class="relative">
                    <!-- Glow Effect -->
                    <div class="absolute -inset-4 bg-lime-400/20 blur-[60px] rounded-3xl"></div>

                    <!-- Browser Frame -->
                    <div class="relative bg-[#0d1117] border border-white/10 rounded-2xl overflow-hidden shadow-2xl">
                        <!-- Browser Top Bar -->
                        <div class="flex items-center gap-3 px-4 py-3 bg-[#161b22] border-b border-white/5">
                            <div class="flex gap-2">
                                <div class="w-3 h-3 rounded-full bg-[#ff5f56]"></div>
                                <div class="w-3 h-3 rounded-full bg-[#ffbd2e]"></div>
                                <div class="w-3 h-3 rounded-full bg-[#27c93f]"></div>
                            </div>
                            <div class="flex-1 px-4 py-1.5 bg-[#0d1117] rounded-lg text-xs text-gray-500 font-mono">
                                portal.tunerfileslab.com
                            </div>
                        </div>

                        <!-- Portal Interface -->
                        <div class="p-6 space-y-6">
                            <!-- Header -->
                            <div class="flex justify-between items-center">
                                <div class="h-8 w-32 bg-lime-400/20 rounded-lg"></div>
                                <div class="flex gap-3">
                                    <div class="h-8 w-8 bg-white/5 rounded-full"></div>
                                    <div class="h-8 w-20 bg-white/5 rounded-lg"></div>
                                </div>
                            </div>

                            <!-- Upload Zone -->
                            <div class="h-40 border-2 border-dashed border-lime-400/30 rounded-xl flex flex-col items-center justify-center bg-lime-400/5 hover:bg-lime-400/10 transition-colors cursor-pointer">
                                <svg class="w-12 h-12 text-lime-400/50 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/>
                                </svg>
                                <span class="text-gray-400 text-sm">Drop ECU file here or click to browse</span>
                            </div>

                            <!-- Options Grid -->
                            <div class="grid grid-cols-3 gap-3">
                                <div class="p-3 bg-lime-400/10 border border-lime-400/30 rounded-lg text-center">
                                    <span class="text-lime-400 text-xs font-bold">Stage 1</span>
                                </div>
                                <div class="p-3 bg-white/5 border border-white/10 rounded-lg text-center">
                                    <span class="text-gray-400 text-xs">DPF Off</span>
                                </div>
                                <div class="p-3 bg-white/5 border border-white/10 rounded-lg text-center">
                                    <span class="text-gray-400 text-xs">EGR Off</span>
                                </div>
                            </div>

                            <!-- Submit Button -->
                            <div class="flex justify-end gap-3">
                                <div class="px-6 py-3 bg-white/5 rounded-lg text-sm text-gray-400">Cancel</div>
                                <div class="px-6 py-3 bg-lime-400 rounded-lg text-sm text-black font-bold">Submit Request</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ============================================
         CTA SECTION - Final Push
         ============================================ -->
    <section class="py-24 relative overflow-hidden">
        <!-- Background -->
        <div class="absolute inset-0 bg-gradient-to-t from-lime-400/10 via-transparent to-transparent"></div>
        <div class="absolute bottom-0 left-1/2 -translate-x-1/2 w-[1000px] h-[600px] bg-lime-400/10 rounded-full blur-[150px]"></div>

        <div class="container mx-auto px-4 relative z-10 text-center">
            <h2 class="text-4xl md:text-6xl lg:text-7xl font-black italic uppercase mb-8">
                Ready to <span class="text-lime-400">Level Up?</span>
            </h2>
            <p class="text-xl text-gray-400 max-w-2xl mx-auto mb-12">
                Join 500+ professional tuners who trust TunerFilesLab for their daily operations. Start your free trial today.
            </p>

            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="https://portal.tunerfileslab.com/register"
                   class="group relative inline-flex items-center justify-center gap-3 px-12 py-6 bg-gradient-to-r from-lime-400 via-[#b8e600] to-[#00ff66] text-black font-black uppercase tracking-widest text-lg rounded-2xl overflow-hidden transition-all duration-300 hover:scale-105 shadow-[0_0_60px_rgba(204,255,0,0.4)]">
                    <span>Get Started Free</span>
                    <svg class="w-6 h-6 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                    </svg>
                    <div class="absolute inset-0 -translate-x-full group-hover:translate-x-full transition-transform duration-700 bg-gradient-to-r from-transparent via-white/40 to-transparent"></div>
                </a>
            </div>

            <p class="text-sm text-gray-500 mt-6">No credit card required • Free trial includes 1 file credit</p>
        </div>
    </section>

</main>

<?php get_footer(); ?>
