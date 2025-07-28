@extends('layouts.user')
@php
use Illuminate\Support\Str;
@endphp

@section('content')
<div class="min-h-screen bg-gradient-to-br from-indigo-50 via-white to-purple-50">
    <div class="container mx-auto px-4 py-16">
        <!-- Header Section -->
        <div class="text-center mb-16">
            <div class="inline-flex items-center justify-center w-20 h-20 bg-gradient-to-r from-indigo-500 to-purple-600 rounded-full mb-6">
                <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3v6m0 0l4-2m-4 2L9 9"></path>
                </svg>
            </div>
            <h1 class="text-5xl font-bold bg-gradient-to-r from-indigo-600 to-purple-600 bg-clip-text text-transparent mb-4">
                Tin Tức & Blog
            </h1>
            <p class="text-xl text-gray-600 max-w-2xl mx-auto">
                Khám phá những câu chuyện thú vị và thông tin hữu ích từ cộng đồng
            </p>
            <div class="w-24 h-1 bg-gradient-to-r from-indigo-500 to-purple-600 mx-auto mt-6 rounded-full"></div>
        </div>

        <!-- Blog Grid -->
        <div class="max-w-5xl mx-auto">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 justify-items-center mb-16">
                @foreach ($blogs as $blog)
                <div class="group w-full max-w-sm">
                    <div class="bg-white rounded-3xl shadow-lg hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2 overflow-hidden border border-gray-100 h-full">
                        <a href="{{ route('blogs.show', $blog->slug) }}" class="block h-full flex flex-col">
                            <!-- Image Container -->
                            <div class="relative overflow-hidden">
                                <img src="{{ asset('storage/' . $blog->img_avt) }}"
                                     alt="{{ $blog->title }}"
                                     class="w-full h-48 object-cover transition-transform duration-700 group-hover:scale-110">
                                <div class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>

                                <!-- Floating Badge -->
                                <div class="absolute top-4 right-4">
                                    <div class="bg-white/90 backdrop-blur-sm px-3 py-1 rounded-full text-sm font-medium text-indigo-600 flex items-center space-x-1">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                        </svg>
                                        <span>{{ $blog->view }}</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Content -->
                            <div class="p-5 flex-1 flex flex-col">
                                <h3 class="text-lg font-bold text-gray-800 mb-2 group-hover:text-indigo-600 transition-colors duration-300 line-clamp-2">
                                    {{ $blog->title }}
                                </h3>

                                <p class="text-gray-600 mb-3 line-clamp-2 leading-relaxed text-sm flex-1">
                                    {{ Str::limit($blog->short_description, 80) }}
                                </p>

                                <!-- Bottom Section -->
                                <div class="flex items-center justify-between pt-3 border-t border-gray-100 mt-auto">
                                    <div class="flex items-center space-x-2 text-sm text-gray-500">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        <span>{{ $blog->created_at ? $blog->created_at->diffForHumans() : 'Chưa có thời gian' }}</span>
                                    </div>

                                    <div class="flex items-center text-indigo-600 font-medium text-sm group-hover:text-indigo-700">
                                        <span>Đọc thêm</span>
                                        <svg class="w-4 h-4 ml-1 transform group-hover:translate-x-1 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                        </svg>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        <!-- Pagination Section -->
        <div class="flex justify-center">
            <div class="bg-white rounded-2xl shadow-lg px-8 py-6 border border-gray-100">
                {{ $blogs->links('pagination::tailwind', [
                    'class' => 'flex items-center space-x-2'
                ]) }}
            </div>
        </div>
    </div>
</div>

<!-- Custom Styles -->
<style>
    .line-clamp-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .line-clamp-3 {
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    /* Custom Pagination Styles */
    .pagination {
        @apply flex items-center space-x-1;
    }

    .pagination .page-link {
        @apply px-4 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 rounded-lg hover:bg-indigo-50 hover:text-indigo-600 hover:border-indigo-300 transition-all duration-200;
    }

    .pagination .page-item.active .page-link {
        @apply bg-gradient-to-r from-indigo-500 to-purple-600 text-white border-indigo-500 shadow-md;
    }

    .pagination .page-item.disabled .page-link {
        @apply text-gray-300 cursor-not-allowed hover:bg-white hover:text-gray-300 hover:border-gray-300;
    }

    /* Smooth Animations */
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .group {
        animation: fadeInUp 0.6s ease-out forwards;
    }

    .group:nth-child(1) { animation-delay: 0.1s; }
    .group:nth-child(2) { animation-delay: 0.2s; }
    .group:nth-child(3) { animation-delay: 0.3s; }
    .group:nth-child(4) { animation-delay: 0.4s; }
    .group:nth-child(5) { animation-delay: 0.5s; }
    .group:nth-child(6) { animation-delay: 0.6s; }
</style>
@endsection
