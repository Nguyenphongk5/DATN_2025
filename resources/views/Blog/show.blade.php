@extends('layouts.user')

@section('content')
<div class="min-h-screen bg-gray-50">
    <!-- Navigation Bar -->
    <nav class="bg-white border-b border-gray-200 sticky top-0 z-40 backdrop-blur-sm bg-white/95">
        <div class="container mx-auto px-4">
            <div class="flex items-center justify-between h-16">
                <!-- Breadcrumb -->
                <div class="flex items-center space-x-2 text-sm text-gray-500">
                    <a href="{{ route('blogs.index') }}" class="hover:text-red-600 transition-colors font-medium">Tin Tức</a>
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                    <span class="text-gray-800 font-medium">Chi tiết bài viết</span>
                </div>

                <!-- Share buttons in header -->
                <div class="flex items-center space-x-2">
                    <span class="text-sm text-gray-500 hidden sm:block">Chia sẻ:</span>
                    <button onclick="shareOnFacebook()"
                            class="p-2 text-gray-500 hover:text-blue-600 hover:bg-blue-50 rounded-lg transition-all duration-200">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                        </svg>
                    </button>
                    <button onclick="shareOnTwitter()"
                            class="p-2 text-gray-500 hover:text-sky-500 hover:bg-sky-50 rounded-lg transition-all duration-200">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/>
                        </svg>
                    </button>
                    <button onclick="copyToClipboard()"
                            class="p-2 text-gray-500 hover:text-gray-700 hover:bg-gray-100 rounded-lg transition-all duration-200">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"></path>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container mx-auto px-4 py-8 max-w-4xl">
        <!-- Article Header -->
        <header class="mb-8">
            <!-- Category Tag -->
            <div class="flex items-center mb-4">
                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-red-100 text-red-800 border border-red-200">
                    <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                    </svg>
                    TIN TỨC
                </span>
            </div>

            <!-- Title -->
            <h1 class="text-3xl md:text-4xl lg:text-5xl font-bold text-gray-900 leading-tight mb-6 font-serif">
                {{ $blog->title }}
            </h1>

            <!-- Short Description -->
            @if($blog->short_description)
            <div class="text-lg md:text-xl text-gray-600 leading-relaxed mb-6 font-medium">
                {{ $blog->short_description }}
            </div>
            @endif

            <!-- Meta Info -->
            <div class="flex flex-wrap items-center gap-6 text-sm text-gray-500 pb-6 border-b border-gray-200">
                @if($blog->created_at)
                <div class="flex items-center space-x-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <time datetime="{{ $blog->created_at->format('Y-m-d') }}">
                        {{ $blog->created_at->format('d/m/Y H:i') }}
                    </time>
                </div>
                @endif

                <div class="flex items-center space-x-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                    </svg>
                    <span>{{ number_format($blog->view) }} lượt xem</span>
                </div>

                <div class="flex items-center space-x-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                    <span>Tác giả</span>
                </div>
            </div>
        </header>

        <!-- Featured Image -->
        <figure class="mb-8">
            <div class="relative overflow-hidden rounded-lg shadow-lg">
                <img src="{{ asset('storage/' . $blog->img_avt) }}"
                     alt="{{ $blog->title }}"
                     class="w-full h-64 md:h-96 object-cover transition-transform duration-700 hover:scale-105">
                <div class="absolute inset-0 bg-gradient-to-t from-black/20 via-transparent to-transparent opacity-0 hover:opacity-100 transition-opacity duration-300"></div>
            </div>
            @if($blog->title)
            <figcaption class="mt-3 text-sm text-gray-500 text-center italic">
                {{ $blog->title }}
            </figcaption>
            @endif
        </figure>

        <!-- Article Content -->
        <article class="bg-white rounded-lg shadow-sm border border-gray-100">
            <div class="p-6 md:p-8">
                <!-- Main Content -->
                <div class="prose prose-lg max-w-none
                           prose-headings:text-gray-900 prose-headings:font-bold prose-headings:font-serif
                           prose-p:text-gray-700 prose-p:leading-relaxed prose-p:text-justify
                           prose-a:text-red-600 prose-a:no-underline hover:prose-a:underline prose-a:font-medium
                           prose-strong:text-gray-900 prose-strong:font-semibold
                           prose-ul:text-gray-700 prose-ol:text-gray-700
                           prose-li:mb-2
                           prose-blockquote:border-l-red-500 prose-blockquote:bg-red-50 prose-blockquote:rounded-r-lg prose-blockquote:py-4 prose-blockquote:px-6 prose-blockquote:not-italic
                           prose-img:rounded-lg prose-img:shadow-md
                           prose-code:bg-gray-100 prose-code:text-red-600 prose-code:px-2 prose-code:py-1 prose-code:rounded
                           prose-pre:bg-gray-900 prose-pre:rounded-lg
                           prose-table:border-collapse prose-table:w-full
                           prose-th:bg-gray-50 prose-th:font-semibold prose-th:text-left prose-th:border prose-th:border-gray-300 prose-th:px-4 prose-th:py-2
                           prose-td:border prose-td:border-gray-300 prose-td:px-4 prose-td:py-2">
                    {!! $blog->content !!}
                </div>
            </div>
        </article>

        <!-- Article Footer -->
        <footer class="mt-8 pt-6 border-t border-gray-200">
            <!-- Tags (if you have them) -->
            <div class="mb-6">
                <div class="flex flex-wrap gap-2">
                    <!-- Example tags - replace with actual tags if available -->
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-gray-100 text-gray-800 hover:bg-gray-200 transition-colors cursor-pointer">
                        #tintuic
                    </span>
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-gray-100 text-gray-800 hover:bg-gray-200 transition-colors cursor-pointer">
                        #baiviet
                    </span>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
                <a href="{{ route('blogs.index') }}"
                   class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-lg font-medium text-gray-700 hover:bg-gray-50 hover:border-gray-400 transition-all duration-200 shadow-sm hover:shadow-md">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    Quay lại danh sách
                </a>

                <!-- Social Share -->
                <div class="flex items-center space-x-3">
                    <span class="text-sm text-gray-500 font-medium">Chia sẻ bài viết:</span>

                    <div class="flex items-center space-x-2">
                        <button onclick="shareOnFacebook()"
                                class="inline-flex items-center justify-center w-9 h-9 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-all duration-200 shadow-sm hover:shadow-md">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                            </svg>
                        </button>

                        <button onclick="shareOnTwitter()"
                                class="inline-flex items-center justify-center w-9 h-9 bg-sky-500 text-white rounded-lg hover:bg-sky-600 transition-all duration-200 shadow-sm hover:shadow-md">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/>
                            </svg>
                        </button>

                        <button onclick="copyToClipboard()"
                                class="inline-flex items-center justify-center w-9 h-9 bg-gray-600 text-white rounded-lg hover:bg-gray-700 transition-all duration-200 shadow-sm hover:shadow-md">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"></path>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </footer>
    </div>

    <!-- Related Articles Section (Optional) -->
    <section class="bg-white border-t border-gray-200 py-12">
        <div class="container mx-auto px-4 max-w-4xl">
            <h2 class="text-2xl font-bold text-gray-900 mb-8 font-serif">Bài viết liên quan</h2>
            <!-- Add related articles here if available -->
            <div class="text-center text-gray-500">
                <p>Chưa có bài viết liên quan</p>
            </div>
        </div>
    </section>
</div>

<!-- Toast Notification -->
<div id="toast" class="fixed top-4 right-4 transform translate-x-full transition-transform duration-300 ease-in-out z-50">
    <div class="bg-green-500 text-white px-6 py-3 rounded-lg shadow-lg flex items-center space-x-2">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
        </svg>
        <span>Đã sao chép link thành công!</span>
    </div>
</div>

<!-- JavaScript -->
<script>
function shareOnFacebook() {
    const url = encodeURIComponent(window.location.href);
    const title = encodeURIComponent('{{ $blog->title }}');
    window.open(`https://www.facebook.com/sharer/sharer.php?u=${url}`, '_blank', 'width=600,height=400');
}

function shareOnTwitter() {
    const url = encodeURIComponent(window.location.href);
    const title = encodeURIComponent('{{ $blog->title }}');
    window.open(`https://twitter.com/intent/tweet?url=${url}&text=${title}`, '_blank', 'width=600,height=400');
}

function copyToClipboard() {
    navigator.clipboard.writeText(window.location.href).then(function() {
        showToast();
    }).catch(function(err) {
        console.error('Failed to copy: ', err);
    });
}

function showToast() {
    const toast = document.getElementById('toast');
    toast.classList.remove('translate-x-full');
    toast.classList.add('translate-x-0');

    setTimeout(() => {
        toast.classList.remove('translate-x-0');
        toast.classList.add('translate-x-full');
    }, 3000);
}

// Smooth scroll and fade-in animation
document.addEventListener('DOMContentLoaded', function() {
    const elements = document.querySelectorAll('header, figure, article, footer');

    const observer = new IntersectionObserver((entries) => {
        entries.forEach((entry) => {
            if (entry.isIntersecting) {
                entry.target.style.opacity = '1';
                entry.target.style.transform = 'translateY(0)';
            }
        });
    }, {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    });

    elements.forEach((el, index) => {
        el.style.opacity = '0';
        el.style.transform = 'translateY(30px)';
        el.style.transition = `all 0.6s ease-out ${index * 0.1}s`;
        observer.observe(el);
    });

    // Initial load animation
    setTimeout(() => {
        elements.forEach((el) => {
            el.style.opacity = '1';
            el.style.transform = 'translateY(0)';
        });
    }, 100);
});

// Reading progress indicator
window.addEventListener('scroll', function() {
    const article = document.querySelector('article');
    if (!article) return;

    const articleTop = article.offsetTop;
    const articleHeight = article.offsetHeight;
    const windowHeight = window.innerHeight;
    const scrollTop = window.pageYOffset;

    const progress = Math.max(0, Math.min(1, (scrollTop - articleTop + windowHeight) / articleHeight));

    // You can use this progress value to show a reading progress bar
    // Example: document.getElementById('progress-bar').style.width = (progress * 100) + '%';
});
</script>

<style>
/* Google Fonts */
@import url('https://fonts.googleapis.com/css2?family=Crimson+Text:ital,wght@0,400;0,600;0,700;1,400&family=Inter:wght@300;400;500;600;700&display=swap');

/* Font Family Override */
.font-serif {
    font-family: 'Crimson Text', serif;
}

body {
    font-family: 'Inter', sans-serif;
}

/* Enhanced prose styles */
.prose {
    color: #374151;
    line-height: 1.75;
}

.prose h1, .prose h2, .prose h3, .prose h4, .prose h5, .prose h6 {
    margin-top: 2.5rem;
    margin-bottom: 1.25rem;
    font-weight: 700;
    color: #111827;
}

.prose h1 {
    font-size: 2.25rem;
    line-height: 1.2;
}
.prose h2 {
    font-size: 1.875rem;
    line-height: 1.3;
}
.prose h3 {
    font-size: 1.5rem;
    line-height: 1.4;
}

.prose p {
    margin-bottom: 1.75rem;
    text-align: justify;
    hyphens: auto;
}

.prose img {
    margin: 2.5rem auto;
    border-radius: 0.75rem;
    box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.prose img:hover {
    transform: scale(1.02);
    box-shadow: 0 20px 35px -5px rgba(0, 0, 0, 0.15), 0 8px 10px -2px rgba(0, 0, 0, 0.08);
}

.prose blockquote {
    background: linear-gradient(135deg, #fef2f2 0%, #fee2e2 100%);
    border-left: 4px solid #ef4444;
    padding: 1.75rem;
    margin: 2.5rem 0;
    border-radius: 0 0.75rem 0.75rem 0;
    font-style: normal;
    position: relative;
}

.prose blockquote::before {
    content: '"';
    font-size: 4rem;
    color: #ef4444;
    position: absolute;
    top: -0.5rem;
    left: 1rem;
    opacity: 0.3;
    font-family: 'Crimson Text', serif;
}

.prose ul, .prose ol {
    margin: 2rem 0;
    padding-left: 2rem;
}

.prose li {
    margin-bottom: 0.75rem;
    line-height: 1.7;
}

.prose a {
    color: #dc2626;
    font-weight: 500;
    transition: all 0.2s ease;
    text-decoration: none;
    border-bottom: 1px solid transparent;
}

.prose a:hover {
    color: #b91c1c;
    border-bottom-color: #b91c1c;
}

.prose code {
    background: #f1f5f9;
    padding: 0.25rem 0.5rem;
    border-radius: 0.375rem;
    font-size: 0.875rem;
    color: #dc2626;
    font-weight: 500;
}

.prose pre {
    background: #1e293b;
    color: #f8fafc;
    padding: 1.75rem;
    border-radius: 0.75rem;
    overflow-x: auto;
    margin: 2.5rem 0;
    box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1);
}

.prose table {
    width: 100%;
    border-collapse: collapse;
    margin: 2.5rem 0;
    box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
    border-radius: 0.5rem;
    overflow: hidden;
}

.prose th, .prose td {
    border: 1px solid #e5e7eb;
    padding: 1rem;
    text-align: left;
}

.prose th {
    background: #f9fafb;
    font-weight: 600;
    color: #374151;
}

.prose td {
    background: white;
}

.prose tbody tr:nth-child(even) td {
    background: #f9fafb;
}

/* Smooth scrolling */
html {
    scroll-behavior: smooth;
}

/* Selection color */
::selection {
    background-color: #fecaca;
    color: #991b1b;
}

/* Custom scrollbar */
::-webkit-scrollbar {
    width: 8px;
}

::-webkit-scrollbar-track {
    background: #f1f5f9;
}

::-webkit-scrollbar-thumb {
    background: #cbd5e1;
    border-radius: 4px;
}

::-webkit-scrollbar-thumb:hover {
    background: #94a3b8;
}

/* Focus styles */
button:focus,
a:focus {
    outline: 2px solid #dc2626;
    outline-offset: 2px;
}

/* Image lazy loading effect */
img {
    transition: opacity 0.3s ease;
}

img[data-loaded="false"] {
    opacity: 0;
}

img[data-loaded="true"] {
    opacity: 1;
}

/* Print styles */
@media print {
    .no-print {
        display: none !important;
    }

    .prose {
        font-size: 12pt;
        line-height: 1.5;
    }

    .prose h1, .prose h2, .prose h3 {
        page-break-after: avoid;
    }

    .prose p, .prose blockquote, .prose li {
        page-break-inside: avoid;
    }
}

/* Mobile enhancements */
@media (max-width: 640px) {
    .prose {
        font-size: 1rem;
    }

    .prose h1 {
        font-size: 1.875rem;
    }

    .prose h2 {
        font-size: 1.5rem;
    }

    .prose h3 {
        font-size: 1.25rem;
    }

    .prose img {
        margin: 1.5rem auto;
    }

    .prose blockquote {
        padding: 1.25rem;
        margin: 1.5rem 0;
    }
}
</style>
@endsection
