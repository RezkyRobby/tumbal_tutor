<nav x-data="{ open: false }" class="bg-white absolute top-0 w-full z-50 border-y border-black">
    <div class="max-w-screen-xl mx-auto flex items-center justify-between p-4">
        <!-- Logo -->
            <a href="{{ route('dashboard') }}" class="flex ms-2 md:me-24">
                <span class="self-center text-xl font-semibold sm:text-2xl whitespace-nowrap dark:text-black">
                    <p>Welcome, {{ auth()->user()->username ?? 'User' }}!</p>
                </span>
            </a>
                            
            <form class="hidden lg:block w-full max-w-lg lg:max-w-md mx-auto ">
                <label for="default-search" class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Search</label>
                <div class="relative mr-2">
                  
                    <!-- Search Input -->
                    <input type="search" id="default-search" class="block w-full p-4 ps-12 text-sm text-black border border-black rounded-lg bg-white focus:ring-0 focus:outline-none focus:border-violet-600" placeholder="Search Course..." required />
                    <button type="submit" class="text-white absolute end-2.5 bottom-2.5 bg-black hover:bg-violet-600 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2">Search</button>
                </div>
            </form>
            
            
            

        
        <!-- Navbar Links -->
        <div class="hidden md:flex items-center space-x-6">
            <a href="{{ route('courses.showAll') }}" class="text-black hover:text-violet-600 transition">All Courses</a>
            @if(auth()->user()->role === 'Teacher')
            <a href="{{ route('courses.index') }}" class="text-black hover:text-violet-600 transition">Make Courses</a>
            @endif
            @if(auth()->user()->role === 'Teacher')
            <a href="{{ route('contents.index') }}" class="text-black hover:text-violet-600 transition">Make Content</a>
            @endif
            @if(auth()->user()->role === 'Student')
            <a href="{{ route('enrollments.index') }}" class="text-black hover:text-violet-600 transition">Joined Course</a>
            @endif
            @if(auth()->user()->role === 'Student')
            <a href="{{ route('certificates.index') }}" class="text-black hover:text-violet-600 transition">
                <button class="w-12 h-12 flex items-center justify-center cursor-pointer group">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 fill-current group-hover:text-violet-600 transition-colors duration-300" viewBox="0 0 16 16">
                        <path d="M2.5.5A.5.5 0 0 1 3 0h10a.5.5 0 0 1 .5.5q0 .807-.034 1.536a3 3 0 1 1-1.133 5.89c-.79 1.865-1.878 2.777-2.833 3.011v2.173l1.425.356c.194.048.377.135.537.255L13.3 15.1a.5.5 0 0 1-.3.9H3a.5.5 0 0 1-.3-.9l1.838-1.379c.16-.12.343-.207.537-.255L6.5 13.11v-2.173c-.955-.234-2.043-1.146-2.833-3.012a3 3 0 1 1-1.132-5.89A33 33 0 0 1 2.5.5m.099 2.54a2 2 0 0 0 .72 3.935c-.333-1.05-.588-2.346-.72-3.935m10.083 3.935a2 2 0 0 0 .72-3.935c-.133 1.59-.388 2.885-.72 3.935M3.504 1q.01.775.056 1.469c.13 2.028.457 3.546.87 4.667C5.294 9.48 6.484 10 7 10a.5.5 0 0 1 .5.5v2.61a1 1 0 0 1-.757.97l-1.426.356a.5.5 0 0 0-.179.085L4.5 15h7l-.638-.479a.5.5 0 0 0-.18-.085l-1.425-.356a1 1 0 0 1-.757-.97V10.5A.5.5 0 0 1 9 10c.516 0 1.706-.52 2.57-2.864.413-1.12.74-2.64.87-4.667q.045-.694.056-1.469z"></path>
                    </svg>
                </button>
            </a>
            @endif
            @if(auth()->user()->role === 'Student')
            <a href="{{ route('notifications.index') }}" class="text-black hover:text-violet-600 transition">
                <button class="w-12 h-12 flex items-center justify-center cursor-pointer group">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 fill-current group-hover:text-violet-600 transition-colors duration-300" viewBox="0 0 16 16">
                        <path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2zm2-1a1 1 0 0 0-1 1v.217l7 4.2 7-4.2V4a1 1 0 0 0-1-1zm13 2.383-4.708 2.825L15 11.105zm-.034 6.876-5.64-3.471L8 9.583l-1.326-.795-5.64 3.47A1 1 0 0 0 2 13h12a1 1 0 0 0 .966-.741M1 11.105l4.708-2.897L1 5.383z"></path>
                    </svg>
                </button>
            </a>
            @endif
            
             

            <!-- Settings Dropdown -->
            <div class="relative">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-white bg-black hover:text-gray-200 hover:bg-violet-600 focus:outline-none transition ease-in-out duration-150">
                            <div>{{ Auth::user()->name }}</div>
                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>
                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Profile') }}
                        </x-dropdown-link>
                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>
        </div>

        <!-- Hamburger Menu -->
        <div class="-me-2 flex items-center md:hidden">
            <button @click="open = !open" class="inline-flex items-center justify-center p-2 rounded-md text-white hover:text-gray-200 hover:bg-violet-700 focus:outline-none transition duration-150 ease-in-out">
                <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                    <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{ 'block': open, 'hidden': !open }" class="hidden md:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <a href="{{ route('notifications.index') }}" class="block px-4 py-2 text-white hover:bg-violet-700 rounded-md transition">
                Inbox
                <span class="inline-flex items-center justify-center w-3 h-3 p-3 ms-3 text-sm font-medium text-blue-800 bg-blue-100 rounded-full dark:bg-blue-900 dark:text-blue-300">3</span>
            </a>
            <a href="#" class="block px-4 py-2 text-white hover:bg-violet-700 rounded-md transition">All Courses</a>
            <a href="#" class="block px-4 py-2 text-white hover:bg-violet-700 rounded-md transition">About Us</a>
            <a href="#" class="block px-4 py-2 text-white hover:bg-violet-700 rounded-md transition">Contact</a>
        </div>
        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-100">
            <div class="px-4">
                <div class="font-medium text-base text-white">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-gray-200">{{ Auth::user()->email }}</div>
            </div>
            <div class="mt-3 space-y-1">
                <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-white hover:bg-violet-700 rounded-md transition">
                    {{ __('Profile') }}
                </a>
                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <a href="{{ route('logout') }}" class="block px-4 py-2 text-white hover:bg-violet-700 rounded-md transition" onclick="event.preventDefault(); this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </a>
                </form>
            </div>
        </div>
    </div>
</nav>