<?php
/**
 * Template Name: Accessible Design Guide
 * Description: A comprehensive guide on accessible web design based on WCAG principles.
 *
 * @package Tuning_Mania
 */

get_header();
?>

<main class="min-h-screen bg-[#050505] relative overflow-hidden">

    <!-- Background Ambience -->
    <div class="fixed inset-0 pointer-events-none">
        <div class="absolute top-0 right-0 w-[500px] h-[500px] bg-blue-500/10 rounded-full blur-[100px]"></div>
        <div class="absolute bottom-0 left-0 w-[500px] h-[500px] bg-purple-500/10 rounded-full blur-[100px]"></div>
    </div>

    <div class="container mx-auto px-4 py-12 relative z-10">

        <!-- Breadcrumbs -->
        <div class="mb-8">
            <?php if (function_exists('tm_breadcrumbs')) tm_breadcrumbs(); ?>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12">

            <!-- Sidebar Navigation (Sticky) -->
            <aside class="hidden lg:block lg:col-span-3">
                <div class="sticky top-24 p-6 rounded-2xl bg-[#0f1219]/90 border border-white/10 backdrop-blur-md">
                    <h3 class="text-xl font-bold text-white mb-4 uppercase tracking-wider font-display">Table of Contents</h3>
                    <nav class="space-y-2">
                        <a href="#intro" class="block text-gray-400 hover:text-white hover:underline decoration-lime-400 underline-offset-4 transition-colors">Introduction</a>
                        <a href="#chap1" class="block text-gray-400 hover:text-white hover:underline decoration-lime-400 underline-offset-4 transition-colors">1. Color Schemes</a>
                        <a href="#chap2" class="block text-gray-400 hover:text-white hover:underline decoration-lime-400 underline-offset-4 transition-colors">2. Website Architecture</a>
                        <a href="#chap3" class="block text-gray-400 hover:text-white hover:underline decoration-lime-400 underline-offset-4 transition-colors">3. User-Friendly Content</a>
                        <a href="#chap4" class="block text-gray-400 hover:text-white hover:underline decoration-lime-400 underline-offset-4 transition-colors">4. Universal Design</a>
                        <a href="#chap5" class="block text-gray-400 hover:text-white hover:underline decoration-lime-400 underline-offset-4 transition-colors">5. Link Accessibility</a>
                        <a href="#chap6" class="block text-gray-400 hover:text-white hover:underline decoration-lime-400 underline-offset-4 transition-colors">6. Multimedia</a>
                        <a href="#chap7" class="block text-gray-400 hover:text-white hover:underline decoration-lime-400 underline-offset-4 transition-colors">7. Documents</a>
                    </nav>
                </div>
            </aside>

            <!-- Main Content -->
            <article class="col-span-1 lg:col-span-9 prose prose-invert prose-lg max-w-none">

                <!-- Hero Header -->
                <header class="mb-16 border-b border-white/10 pb-12">
                    <h1 class="text-5xl md:text-6xl font-black text-transparent bg-clip-text bg-gradient-to-r from-white to-gray-400 mb-6 font-display italic">
                        A Comprehensive Guide on <span class="text-lime-400">Accessible Web Design</span>
                    </h1>
                    <p class="text-xl text-gray-400 leading-relaxed font-light">
                        Accessible Web Design & Development: Why it matters. A deep dive into creating inclusive digital experiences for everyone.
                    </p>
                </header>

                <!-- Introduction -->
                <section id="intro" class="mb-16 bg-[#0f1219] p-8 rounded-2xl border border-white/5 shadow-2xl">
                    <h2 class="text-3xl font-bold text-white mb-6 border-l-4 border-lime-400 pl-4">Accessible Web Design & Development: Why it matters</h2>
                    <p class="text-gray-300 mb-4">
                        There are a myriad of web design how-to guides that offer tips on everything from choosing a web host to finding the right e-commerce platform. But the majority of these resources don’t discuss website accessibility — a critical piece in building a successful business online.
                    </p>
                    <p class="text-gray-300 mb-4">
                        One of the reasons for that is because accessibility is often associated with brick-and-mortar businesses and physical accommodations. But as online shopping becomes the norm, business owners have to meet the same customer expectations and legal requirements as they would with physical stores.
                    </p>
                    <div class="bg-blue-500/10 border-l-4 border-blue-500 p-6 my-8">
                        <p class="text-white italic m-0">
                            "In order to meet the Americans with Disabilities Act (ADA) requirements, a business website must be accessible to people who rely on assistive technologies, such as screen readers, to browse the internet."
                        </p>
                    </div>
                </section>

                <!-- Chapter 1 -->
                <section id="chap1" class="mb-16">
                    <h2 class="text-4xl font-black text-white mb-8 border-b border-white/10 pb-4">Chapter 1: <span class="text-lime-400">Color Schemes</span></h2>
                    <div class="bg-[#151922] p-8 rounded-xl border border-white/5">
                        <h3 class="text-2xl font-bold text-white mb-4">What Are Color Schemes? Why Are They Important?</h3>
                        <p class="text-gray-400 mb-6">
                            A color scheme is a combination of hues that are implemented in specific design contexts. Web color accessibility uses contrasting colors to make content accessible to people with visual impairments.
                        </p>

                        <div class="grid md:grid-cols-2 gap-8 my-8">
                            <div class="bg-black/50 p-6 rounded-lg">
                                <h4 class="text-xl font-bold text-white mb-3">Color Contrast for Websites</h4>
                                <p class="text-gray-400 text-sm">
                                    A color contrast ratio determines how bright or dark colors appear. WCAG recommends using <strong class="text-lime-400">4.5:1</strong> as the minimum ratio for text.
                                </p>
                            </div>
                            <div class="bg-black/50 p-6 rounded-lg">
                                <h4 class="text-xl font-bold text-white mb-3">Do's & Don'ts</h4>
                                <ul class="text-sm list-disc pl-5 space-y-2 text-gray-400">
                                    <li><strong class="text-green-400">DO</strong> aim for more white space.</li>
                                    <li><strong class="text-green-400">DO</strong> use varying saturations.</li>
                                    <li><strong class="text-red-400">DON'T</strong> use low-contrast text.</li>
                                    <li><strong class="text-red-400">DON'T</strong> use pure black on pure white (causes eye strain).</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- Chapter 2 -->
                <section id="chap2" class="mb-16">
                    <h2 class="text-4xl font-black text-white mb-8 border-b border-white/10 pb-4">Chapter 2: <span class="text-lime-400">Website Architecture</span></h2>
                    <div class="bg-[#151922] p-8 rounded-xl border border-white/5">
                        <p class="text-gray-300 mb-6">
                            Website architecture is how a site’s pages are structured and linked together. Proper architecture ensures that end-users and search engine crawlers can effectively navigate to the information they are looking for.
                        </p>

                        <h3 class="text-2xl font-bold text-white mb-4">Semantic Markup</h3>
                        <p class="text-gray-400 mb-4">
                            Use semantic markup (HTML5 tags like <code class="text-lime-400">&lt;nav&gt;</code>, <code class="text-lime-400">&lt;footer&gt;</code>, <code class="text-lime-400">&lt;section&gt;</code>) to make your menu accessible to users, search engines, and assistive technologies.
                        </p>

                        <div class="bg-blue-500/10 p-6 rounded-lg my-6">
                            <h4 class="text-lg font-bold text-white">Sitemaps</h4>
                            <p class="text-gray-300 text-sm">
                                <strong>XML Sitemap:</strong> Coded specifically for web crawlers.<br>
                                <strong>HTML Sitemap:</strong> Coded for humans to find content.
                            </p>
                        </div>
                    </div>
                </section>

                <!-- Chapter 3 -->
                <section id="chap3" class="mb-16">
                    <h2 class="text-4xl font-black text-white mb-8 border-b border-white/10 pb-4">Chapter 3: <span class="text-lime-400">User-Friendly Web Page Content</span></h2>
                    <div class="bg-[#151922] p-8 rounded-xl border border-white/5">
                        <h3 class="text-2xl font-bold text-white mb-4">Semantic HTML & Headings</h3>
                        <p class="text-gray-400 mb-6">
                            Semantic HTML introduces the actual meaning of content. For example, using <code class="text-lime-400">&lt;h1&gt;</code> through <code class="text-lime-400">&lt;h6&gt;</code> strictly for hierarchy, not for sizing.
                        </p>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="bg-black/30 p-4 rounded border border-white/5">
                                <span class="block text-4xl font-bold text-white mb-2">H1</span>
                                <span class="text-gray-500 text-sm uppercase">Main Title of Page</span>
                            </div>
                            <div class="bg-black/30 p-4 rounded border border-white/5">
                                <span class="block text-2xl font-bold text-white mb-2">H2</span>
                                <span class="text-gray-500 text-sm uppercase">Major Sections</span>
                            </div>
                        </div>

                        <h3 class="text-2xl font-bold text-white mt-8 mb-4">Typography Best Practices</h3>
                        <ul class="space-y-3 text-gray-400 list-disc pl-5">
                            <li><strong>Font Size:</strong> Start at 18px for body text.</li>
                            <li><strong>Line Length:</strong> 45-90 characters per line.</li>
                            <li><strong>Line Height:</strong> At least 1.5 for body text.</li>
                            <li><strong>Alignment:</strong> Left-aligned text is easiest to read.</li>
                        </ul>
                    </div>
                </section>

                <!-- Chapter 4 -->
                <section id="chap4" class="mb-16">
                    <h2 class="text-4xl font-black text-white mb-8 border-b border-white/10 pb-4">Chapter 4: <span class="text-lime-400">Seven Principles of Universal Design</span></h2>
                    <div class="bg-[#151922] p-8 rounded-xl border border-white/5">
                        <p class="text-gray-300 mb-6">
                            Universal design aims to serve everyone, regardless of ability.
                        </p>
                        <ol class="list-decimal pl-6 space-y-4 text-gray-400">
                            <li><strong>Equitable Use:</strong> Provide the same means for all users.</li>
                            <li><strong>Flexibility in Use:</strong> Accommodate preferences (e.g., right/left handed).</li>
                            <li><strong>Simple and Intuitive Use:</strong> Eliminate complexity.</li>
                            <li><strong>Perceptible Information:</strong> Communicate clearly (captions, contrast).</li>
                            <li><strong>Tolerance for Error:</strong> Prevent errors and provide warnings.</li>
                            <li><strong>Low Physical Effort:</strong> Minimize repetitive actions.</li>
                            <li><strong>Size and Space:</strong> Appropriate space for interaction.</li>
                        </ol>
                    </div>
                </section>

                <!-- Chapter 5 -->
                <section id="chap5" class="mb-16">
                    <h2 class="text-4xl font-black text-white mb-8 border-b border-white/10 pb-4">Chapter 5: <span class="text-lime-400">Link Accessibility</span></h2>
                    <div class="bg-[#151922] p-8 rounded-xl border border-white/5">
                        <h3 class="text-2xl font-bold text-white mb-4">Write Clear Anchor Text</h3>
                        <p class="text-gray-400 mb-4">
                            Avoid "Click Here". Link text should describe the destination.
                        </p>
                        <div class="p-4 bg-red-500/10 border border-red-500/20 rounded mb-4">
                            <strong class="text-red-400">Incorrect:</strong> To learn more, <a href="#" class="underline">click here</a>.
                        </div>
                        <div class="p-4 bg-green-500/10 border border-green-500/20 rounded mb-6">
                            <strong class="text-green-400">Correct:</strong> Learn more about <a href="#" class="underline text-lime-400">user-friendly web page content</a>.
                        </div>

                        <h3 class="text-2xl font-bold text-white mb-4">Touch Targets</h3>
                        <p class="text-gray-400">
                            Buttons and links should be at least <strong>44x44 CSS pixels</strong> to be easily tappable on mobile devices.
                        </p>
                    </div>
                </section>

                <!-- Chapter 6 -->
                <section id="chap6" class="mb-16">
                    <h2 class="text-4xl font-black text-white mb-8 border-b border-white/10 pb-4">Chapter 6: <span class="text-lime-400">Multimedia Accessibility</span></h2>
                    <div class="bg-[#151922] p-8 rounded-xl border border-white/5">
                        <h3 class="text-2xl font-bold text-white mb-4">Alt Text Best Practices</h3>
                        <ul class="list-disc pl-5 space-y-2 text-gray-400 mb-6">
                            <li>Don't use "image of" or "picture of".</li>
                            <li>Be descriptive in content and context.</li>
                            <li>Limit alt text to 150 characters.</li>
                            <li>Use <code class="text-lime-400">alt=""</code> for decorative images.</li>
                        </ul>

                        <h3 class="text-2xl font-bold text-white mb-4">Video & Audio</h3>
                        <p class="text-gray-400">
                            Ensure all video content includes <strong>Closed Captions (CC)</strong> and, where necessary, audio descriptions for visual content.
                        </p>
                    </div>
                </section>

                <!-- Chapter 7 -->
                <section id="chap7" class="mb-16">
                    <h2 class="text-4xl font-black text-white mb-8 border-b border-white/10 pb-4">Chapter 7: <span class="text-lime-400">Document Accessibility</span></h2>
                    <div class="bg-[#151922] p-8 rounded-xl border border-white/5">
                        <p class="text-gray-300 mb-4">
                            PDFs and Word documents must also be accessible.
                        </p>
                        <ul class="list-disc pl-5 space-y-2 text-gray-400">
                            <li>Use proper Heading styles in Word before converting.</li>
                            <li>Add Alt text to images in documents.</li>
                            <li>Tag PDFs properly (Headings, Lists, Tables) using Adobe Acrobat Pro.</li>
                        </ul>
                    </div>
                </section>

            </article>

        </div>
    </div>
</main>

<?php get_footer(); ?>
