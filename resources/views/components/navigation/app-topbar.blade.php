<nav class="fixed z-30 w-full bg-light-50 border-light-200 dark:bg-dark-900 dark:border-dark-800">
    <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
        <x-application-logo />
        <div class="flex justify-end items-center md:order-2">

            @if(config('custom.dark_mode'))
                {{-- toggle theme btn --}}
                <x-button.icon type="button" id="toggle-theme" class="p-1.5 rounded-lg">
                    <svg id="theme-toggle-dark-icon" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                         xmlns="http://www.w3.org/2000/svg">
                        <path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"></path>
                    </svg>
                    <svg id="theme-toggle-light-icon" class="hidden w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                         xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z"
                            fill-rule="evenodd" clip-rule="evenodd"></path>
                    </svg>
                </x-button.icon>
            @endif
            <button type="button"
                class="flex ms-3 text-sm bg-gray-800 rounded-full md:mr-0 focus:ring-4 focus:ring-gray-300 dark:focus:ring-gray-600"
                id="user-profile-menu-button" aria-expanded="false" data-dropdown-toggle="dropdown-user-profile">
                <span class="sr-only">Open user menu</span>
                <img class="w-8 h-8 rounded-full" src="{{ Auth::user()->image_profile }}" alt="user photo">
            </button>
            {{-- Dropdown menu user --}}
            <x-dropdown class="z-50 w-56" id="dropdown-user-profile">
                <div class="py-3 px-4">
                    <span class="block text-sm font-semibold text-dark-900 dark:text-white">{{ Auth::user()->name
                        }}</span>
                    <span class="block text-sm text-dark-600 truncate dark:text-light-300">{{ Auth::user()->email
                        }}</span>
                </div>
                <x-dropdown.menu>
                    <li>
                        <x-dropdown.menu-item-button href="{{ route('profile.edit') }}">Profile
                        </x-dropdown.menu-item-button>
                    </li>
                    <li>
                        <x-form method="POST" action="{{ route('logout') }}" space="{{ false }}">
                            <x-dropdown.menu-item-button type="submit">Sign out</x-dropdown.menu-item-button>
                        </x-form>
                    </li>
                </x-dropdown.menu>
            </x-dropdown>
            <x-button.icon class="p-1 rounded ms-4 md:hidden" data-collapse-toggle="navbar">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                </svg>
            </x-button.icon>
        </div>
        <div class="items-center justify-between hidden w-full md:flex md:w-auto md:order-1" id="navbar">
            <ul
                class="flex flex-col font-medium p-4 md:p-0 mt-4 border border-dark-100 rounded-lg bg-light-50 md:space-x-8 md:flex-row md:mt-0 md:border-0 dark:bg-dark-800 md:dark:bg-dark-900 dark:border-dark-700">
                {{-- Home --}}
                <li>
                    <a href="{{ route('dashboard') }}" @class(['block py-2 px-3 rounded md:bg-transparent md:p-0',
                        request()->is('dashboard') ? 'bg-primary-700 text-light-50 md:text-primary-700' : 'text-dark-900
                        dark:text-light-50'])
                        aria-current="page">Home</a>
                </li>

                @can('has-permission', [['manage_campaigns', 'manage_self_campaigns']])
                {{-- Broadcast List --}}
                <li>
                    <a href="{{ route('campaign.index') }}" @class(['block py-2 px-3 rounded md:bg-transparent md:p-0',
                    request()->is('campaign') ? 'bg-primary-700 text-light-50 md:text-primary-700' : 'text-dark-900
                    dark:text-light-50'])
                    aria-current="page">Campaign</a>
                </li>
                @endcan
                @can('has-permission', 'manage_self_campaigns')
                {{-- Send Broadcast --}}
                <li>
                    <a href="{{ route('campaign.create') }}" @class(['block py-2 px-3 rounded md:bg-transparent md:p-0',
                        request()->is('campaign/create') ? 'bg-primary-700 text-light-50 md:text-primary-700'
                        :
                        'text-dark-900
                        dark:text-light-50'])
                        aria-current="page">Send SMS</a>
                </li>
                @endcan

                {{-- Manage User --}}
                @can('has-permission', [['manage_users','manage_roles', 'manage_permissions']])
                <li>
                    <button id="users-menu-button" data-dropdown-toggle="dropdown-users"
                        data-dropdown-offset-distance="20" @class(['flex items-center justify-between w-full py-2 px-3
                        rounded md:bg-transparent md:p-0', request()->is('user*') ? 'bg-primary-700 text-light-50
                        md:text-primary-700' : 'text-dark-900
                        dark:text-light-50'])>Users
                        <svg class="w-2.5 h-2.5 ms-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            fill="none" viewBox="0 0 10 6">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 4 4 4-4" />
                        </svg>
                    </button>
                    <x-dropdown class="z-50 w-56" id="dropdown-users">
                        <x-dropdown.menu>
                            @can('has-permission', 'manage_users')
                            <x-dropdown.menu-item>
                                <x-dropdown.menu-item-button href="{{ route('user.index') }}">All Users
                                </x-dropdown.menu-item-button>
                            </x-dropdown.menu-item>
                            @endcan

                            @can('has-permission', 'manage_roles')
                            <x-dropdown.menu-item>
                                <x-dropdown.menu-item-button href="{{ route('role.index') }}">Role
                                </x-dropdown.menu-item-button>
                            </x-dropdown.menu-item>
                            @endcan

                            @can('has-permission', 'manage_permissions')
                            <x-dropdown.menu-item>
                                <x-dropdown.menu-item-button href="{{ route('permission.index') }}">Permissions
                                </x-dropdown.menu-item-button>
                            </x-dropdown.menu-item>
                            @endcan
                        </x-dropdown.menu>
                    </x-dropdown>
                </li>

                {{-- Manage Creditst --}}
                @can('has-permission', 'manage_credits')
                <li>
                    <a href="{{ route('credit.index') }}" @class(['block py-2 px-3 rounded md:bg-transparent md:p-0',
                        request()->is('credit*') ? 'bg-primary-700 text-light-50 md:text-primary-700' : 'text-dark-900
                        dark:text-light-50'])
                        aria-current="page">Credits</a>
                </li>
                @endcan
                @endcan
            </ul>
        </div>
    </div>
</nav>
