{{-- <x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("You're logged in!") }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout> --}}

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight" style="color: #667eea;">
            {{ __('لوحة التحكم') }}
        </h2>
    </x-slot>

    <div class="py-12" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); min-height: 100vh;">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden shadow-sm sm:rounded-lg" style="background: rgba(255,255,255,0.95); backdrop-filter: blur(10px);">
                <div class="p-6" style="color: #333;">
                    <div style="display: flex; justify-content: space-between; align-items: center;">
                        <div>
                            <i class="fas fa-user-circle" style="font-size: 2rem; color: #667eea;"></i>
                            <p class="mt-2" style="font-size: 1.1rem;">
                                {{ __("مرحباً بك") }}, <strong>{{ Auth::user()->name }}</strong>!
                            </p>
                        </div>
                        <div style="text-align: left;">
                            <p style="font-size: 0.9rem; color: #666;">{{ Auth::user()->email }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<!-- إضافة Font Awesome للأيقونات فقط -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">