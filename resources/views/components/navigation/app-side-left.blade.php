<aside id="app-side-left"
    class="fixed top-0 left-0 z-40 lg:z-30  w-64 lg:pt-16 h-screen bg-light-50 dark:bg-dark-900 border-r border-gray-200 dark:border-dark-800 transition-transform -translate-x-full lg:translate-x-0"
    aria-label="Sidebar">
    <div class="h-full px-3 mt-4 space-y-4 overflow-y-auto ">
        <x-navigation.menu>

            {{-- dashboard --}}
            <x-navigation.menu-item-link href="{{ route('dashboard') }}" title="Dashboard"
                is-active="{{ request()->is('dashboard') ? true : false }}">
                <x-slot:icon>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor"
                        class="w-5 h-5 text-dark-500 group-hover:text-dark-800 dark:group-hover:text-light-50">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                    </svg>
                </x-slot:icon>
            </x-navigation.menu-item-link>

            {{-- User --}}
            @can('has-permission', 'manage_users')
            <x-navigation.menu-dropdown title="User" data-collapse-toggle="user-dropdown"
                is-active="{{ request()->is('user*') ? true : false }}">
                <x-slot:icon>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor"
                        class="flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
                    </svg>
                </x-slot:icon>

                {{-- Dropdown link items --}} @can('has-permission', 'manage_users')
                <x-navigation.menu-dropdown-item-link href="{{ route('user.index') }}" title="All Users"
                    is-active="{{ request()->is('user') || request()->is('user/*/edit') || request()->is('user/create*') ? true : false }}" />
                @endcan

                @can('has-permission', 'manage_roles')
                <x-navigation.menu-dropdown-item-link href="{{ route('role.index') }}" title="Roles"
                    is-active="{{ request()->is('user/role*') ? true : false }}" />
                @endcan

                @can('has-permission', 'manage_permissions')
                <x-navigation.menu-dropdown-item-link href="{{ route('permission.index') }}" title="Permissions"
                    is-active="{{ request()->is('user/permission*') ? true : false }}" />
                @endcan

            </x-navigation.menu-dropdown>
            @endcan
        </x-navigation.menu>
    </div>
</aside>