<div class="flex items-center w-full justify-start md:justify-center py-4 md:py-0 px-4 text-lg text-white bg-sky-800 h-20">
    <div class="flex flex-col sm:flex-row">
        <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
            {{ __('Главная') }}
        </x-nav-link>
        <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
            {{ __('Об авторе') }}
        </x-nav-link>
        <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
            {{ __('Отзывы и предложения') }}
        </x-nav-link>
    </div>
</div>
