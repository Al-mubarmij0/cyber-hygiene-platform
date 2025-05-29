<x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
    {{ __('Dashboard') }}
</x-nav-link>

{{-- Admin Panel Link --}}
<x-nav-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard')">
    {{ __('Admin Panel') }}
</x-nav-link>

{{-- Guided Learning Link --}}
<x-nav-link :href="route('learn.start')" :active="request()->routeIs('learn.start')">
    {{ __('Start Learning') }}
</x-nav-link>