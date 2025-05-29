<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Admin Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
                        <div class="col-span-1">
                            <h3 class="font-bold text-lg mb-4">Admin Navigation</h3>
                            <nav>
                                <ul>
                                    <li class="mb-2">
                                        <a href="{{ route('admin.dashboard') }}" class="text-blue-600 hover:text-blue-800 {{ request()->routeIs('admin.dashboard') ? 'font-semibold' : '' }}">Dashboard</a>
                                    </li>
                                    <li class="mb-2">
                                        <a href="{{ route('admin.quizzes.index') }}" class="text-blue-600 hover:text-blue-800 {{ request()->routeIs('admin.quizzes.*') ? 'font-semibold' : '' }}">Quizzes</a>
                                    </li>
                                    <li class="mb-2">
                                        <a href="{{ route('admin.questions.index') }}" class="text-blue-600 hover:text-blue-800 {{ request()->routeIs('admin.questions.*') ? 'font-semibold' : '' }}">Questions</a>
                                    </li>
                                    <li class="mb-2">
                                        <a href="{{ route('admin.answers.index') }}" class="text-blue-600 hover:text-blue-800 {{ request()->routeIs('admin.answers.*') ? 'font-semibold' : '' }}">Answers</a>
                                    </li>
                                    <li class="mb-2">
                                        <a href="{{ route('admin.tutorials.index') }}" class="text-blue-600 hover:text-blue-800 {{ request()->routeIs('admin.tutorials.*') ? 'font-semibold' : '' }}">Tutorials</a>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                        <div class="col-span-3">
                            @if (session('success'))
                                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                                    <span class="block sm:inline">{{ session('success') }}</span>
                                </div>
                            @endif
                            @if (session('error'))
                                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                                    <span class="block sm:inline">{{ session('error') }}</span>
                                </div>
                            @endif
                            {{ $slot }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>