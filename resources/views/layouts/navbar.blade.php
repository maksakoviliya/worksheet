<div class="bg-white fixed w-full pl-64 left-0 shadow z-10">
    <div class="container mx-auto px-6">
        <form action="{{ route('logout') }}" method="POST" class="flex items-center justify-end py-3">
            {{ csrf_field() }}
            <div class="mr-4 text-gray-500 text-sm text-right leading-snug border-r border-gray-500 pr-3">
                <div class="font-semibold">{{ Auth::user()->email }}</div>
                <div class="text-gray-400">{{ Auth::user()->roles[0]->title }}</div>
            </div>
            <button type="submit" class="inline-flex items-center text-gray-600 hover:text-gray-900 transition duration-200 ease-in-out focus:outline-none">
                <svg class="w-6 h-6 fill-current" viewBox="0 0 459 459">
                    <path d="M181.05 321.3l35.7 35.7 127.5-127.5L216.75 102l-35.7 35.7 66.3 66.3H0v51h247.35l-66.3 66.3zM408 0H51C22.95 0 0 22.95 0 51v102h51V51h357v357H51V306H0v102c0 28.05 22.95 51 51 51h357c28.05 0 51-22.95 51-51V51c0-28.05-22.95-51-51-51z"/>
                </svg>
                <span class="font-semibold ml-1">Выход</span>
            </button>
        </form>
    </div>
</div>
