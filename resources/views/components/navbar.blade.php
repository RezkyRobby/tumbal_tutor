<nav x-data="{ open: false }" class="bg-white absolute top-0 w-full z-50 mt-50 border-y border-black mt-80">
    <div class="max-w-screen-xl mx-auto flex items-center justify-between p-4">
        <!-- Logo -->
        <a href="{{ route('dashboard') }}" class="flex ms-2 md:me-24">
            <span class="self-center text-xl font-semibold sm:text-2xl whitespace-nowrap dark:text-black">
                <p>Welcome, {{ auth()->user()->username ?? 'User' }}!</p>
            </span>
        </a>

        <form action="{{ route('courses.search') }}" method="GET" class="hidden lg:block w-full max-w-lg lg:max-w-md mx-auto ">
            <label for="default-search" class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Search</label>
            <div class="relative mr-2">
                <!-- Search Input -->
                <input type="search" id="default-search" name="search" class="block w-full p-4 ps-12 text-sm text-black border border-black rounded-lg bg-white focus:ring-0 focus:outline-none focus:border-violet-600" placeholder="Search Course..." required />
                <button type="submit" class="text-white absolute end-2.5 bottom-2.5 bg-black hover:bg-violet-600 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2">Search</button>
            </div>
        </form>

        <!-- Navbar Links -->
        <div class="hidden md:flex items-center space-x-6">
            <a href="{{ route('courses.showAll') }}" class="text-black hover:text-violet-600 transition">All Courses</a>
            @if(auth()->user()->role === 'Teacher')
                <a href="{{ route('courses.index') }}" class="text-black hover:text-violet-600 transition">Make Courses</a>
                <a href="{{ route('contents.index') }}" class="text-black hover:text-violet-600 transition">Make Content</a>
            @endif
            @if(auth()->user()->role === 'Student')
                <a href="{{ route('enrollments.index') }}" class="text-black hover:text-violet-600 transition">Joined Course</a>
                <a href="{{ route('certificates.index') }}" class="text-black hover:text-violet-600 transition">Certificates</a>
                <a href="{{ route('notifications.index') }}" class="text-black hover:text-violet-600 transition">Notifications</a>
            @endif

            <!-- Admin Dropdown -->
            @if(auth()->user()->role === 'Admin')
                <div class="relative">
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-white bg-black hover:text-gray-200 hover:bg-violet-600 focus:outline-none transition ease-in-out duration-150">
                                Admin
                                <div class="ms-1">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </button>
                        </x-slot>
                        <x-slot name="content">
                            <x-dropdown-link :href="route('users.index')">
                                {{ __('Manage Users') }}
                            </x-dropdown-link>
                        </x-slot>
                    </x-dropdown>
                </div>
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
            <a href="{{ route('notifications.index') }}" class="block px-4 py-2 text-white hover:bg-violet-700 rounded-md transition">Inbox</a>
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
                <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-white hover:bg-violet-700 rounded-md transition">{{ __('Profile') }}</a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <a href="{{ route('logout') }}" class="block px-4 py-2 text-white hover:bg-violet-700 rounded-md transition" onclick="event.preventDefault(); this.closest('form').submit();">{{ __('Log Out') }}</a>
                </form>
            </div>
        </div>
    </div>
</nav>
