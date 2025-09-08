<aside id="logo-sidebar"
    class="fixed top-0 left-0 z-40 w-64 h-screen pt-[86px] transition-transform -translate-x-full bg-[#FAFAFB] sm:translate-x-0 "
    aria-label="Sidebar">
    <div class="h-full px-4 pb-4 overflow-y-auto ">
        <ul class="space-y-6">

            <div class="space-y-1">
                <li>
                    <a href="{{ route('dashboard.index') }}"
                        class="flex text-sm items-center p-3 text-gray-900 rounded-lg hover:bg-[#ECECEC] group {{ Route::is('dashboard.index') ? 'bg-[#ECECEC]' : '' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-width="2" stroke-linejoin="round"
                                d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                        </svg>

                        <span class="ms-3">Başlangıç</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('pages.index') }}"
                        class="flex text-sm items-center p-3 text-gray-900 rounded-lg hover:bg-[#ECECEC] group {{ Route::is('pages.index') ? '' : '' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-width="2" stroke-linejoin="round"
                                d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                        </svg>

                        <span class="ms-3">Sayfalar</span>
                    </a>
                </li>
                <li>
                    <button type="button"
                        class="cursor-pointer flex items-center w-full p-3 text-gray-900 transition duration-75 rounded-lg group hover:bg-[#ECECEC] text-sm {{ Route::is('blogs.*') ? 'bg-[#ECECEC]' : '' }}"
                        aria-controls="dropdown-blogs-sidebar-item" data-collapse-toggle="dropdown-blogs-sidebar-item">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-width="2" stroke-linejoin="round"
                                d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                        </svg>
                        <span class="flex-1 ms-3 text-left whitespace-nowrap">Blog</span>
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 10 6">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                                d="m1 1 4 4 4-4" />
                        </svg>
                    </button>
                    <ul id="dropdown-blogs-sidebar-item" class="hidden py-2 space-y-2">
                        <li>
                            <a href="{{ route('blogs.index') }}"
                                class="flex items-center text-sm w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:text-[#4F46E5]">Tümü</a>
                        </li>
                        <li>
                            <a href="{{ route('blogs.create') }}"
                                class="flex items-center text-sm w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:text-[#4F46E5]">Ekle</a>
                        </li>
                        <li>
                            <a href="{{ route('blogs.categories.index') }}"
                                class="flex items-center text-sm w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:text-[#4F46E5]">Kategoriler</a>
                        </li>
                    </ul>
                </li>

                <li>
                    <button type="button"
                        class="cursor-pointer flex items-center w-full p-3 text-gray-900 transition duration-75 rounded-lg group hover:bg-[#ECECEC] text-sm {{ Route::is('services.*') ? 'bg-[#ECECEC]' : '' }}"
                        aria-controls="dropdown-services-sidebar-item"
                        data-collapse-toggle="dropdown-services-sidebar-item">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-width="2" stroke-linejoin="round"
                                d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                        </svg>
                        <span class="flex-1 ms-3 text-left whitespace-nowrap">Hizmet</span>
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 10 6">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                                d="m1 1 4 4 4-4" />
                        </svg>
                    </button>
                    <ul id="dropdown-services-sidebar-item" class="hidden py-2 space-y-2">
                        <li>
                            <a href="{{ route('services.index') }}"
                                class="flex items-center text-sm w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:text-[#4F46E5]">Tümü</a>
                        </li>
                        <li>
                            <a href="{{ route('services.create') }}"
                                class="flex items-center text-sm w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:text-[#4F46E5]">Ekle</a>
                        </li>
                        <li>
                            <a href="{{ route('services.categories.index') }}"
                                class="flex items-center text-sm w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:text-[#4F46E5]">Kategoriler</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <button type="button"
                        class="cursor-pointer flex items-center w-full p-3 text-gray-900 transition duration-75 rounded-lg group hover:bg-[#ECECEC] text-sm {{ Route::is('projects.*') ? 'bg-[#ECECEC]' : '' }}"
                        aria-controls="dropdown-projects-sidebar-item"
                        data-collapse-toggle="dropdown-projects-sidebar-item">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-width="2" stroke-linejoin="round"
                                d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                        </svg>
                        <span class="flex-1 ms-3 text-left whitespace-nowrap">Proje</span>
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 10 6">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="1" d="m1 1 4 4 4-4" />
                        </svg>
                    </button>
                    <ul id="dropdown-projects-sidebar-item" class="hidden py-2 space-y-2">
                        <li>
                            <a href="{{ route('projects.index') }}"
                                class="flex items-center text-sm w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:text-[#4F46E5]">Tümü</a>
                        </li>
                        <li>
                            <a href="{{ route('projects.create') }}"
                                class="flex items-center text-sm w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:text-[#4F46E5]">Ekle</a>
                        </li>
                        <li>
                            <a href="{{ route('projects.categories.index') }}"
                                class="flex items-center text-sm w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:text-[#4F46E5]">Kategoriler</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <button type="button"
                        class="cursor-pointer flex items-center w-full p-3 text-gray-900 transition duration-75 rounded-lg group hover:bg-[#ECECEC] text-sm {{ Route::is('references.*') ? 'bg-[#ECECEC]' : '' }}"
                        aria-controls="dropdown-references-sidebar-item"
                        data-collapse-toggle="dropdown-references-sidebar-item">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-width="2" stroke-linejoin="round"
                                d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                        </svg>
                        <span class="flex-1 ms-3 text-left whitespace-nowrap">Referanslar</span>
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 10 6">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="1" d="m1 1 4 4 4-4" />
                        </svg>
                    </button>
                    <ul id="dropdown-references-sidebar-item" class="hidden py-2 space-y-2">
                        <li>
                            <a href="{{ route('references.index') }}"
                                class="flex items-center text-sm w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:text-[#4F46E5]">Tümü</a>
                        </li>
                        <li>
                            <a href="{{ route('references.create') }}"
                                class="flex items-center text-sm w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:text-[#4F46E5]">Ekle</a>
                        </li>
                        <li>
                            <a href="{{ route('references.sectors.index') }}"
                                class="flex items-center text-sm w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:text-[#4F46E5]">Sektörler</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <button type="button"
                        class="cursor-pointer flex items-center w-full p-3 text-gray-900 transition duration-75 rounded-lg group hover:bg-[#ECECEC] text-sm {{ Route::is('teams.*') ? 'bg-[#ECECEC]' : '' }}"
                        aria-controls="dropdown-teams-sidebar-item"
                        data-collapse-toggle="dropdown-teams-sidebar-item">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-width="2" stroke-linejoin="round"
                                d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                        </svg>
                        <span class="flex-1 ms-3 text-left whitespace-nowrap">Ekip</span>
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 10 6">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="1" d="m1 1 4 4 4-4" />
                        </svg>
                    </button>
                    <ul id="dropdown-teams-sidebar-item" class="hidden py-2 space-y-2">
                        <li>
                            <a href="{{ route('teams.index') }}"
                                class="flex items-center text-sm w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:text-[#4F46E5]">Tümü</a>
                        </li>
                        <li>
                            <a href="{{ route('teams.create') }}"
                                class="flex items-center text-sm w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:text-[#4F46E5]">Ekle</a>
                        </li>
                        <li>
                            <a href="{{ route('teams.departments.index') }}"
                                class="flex items-center text-sm w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:text-[#4F46E5]">Departmanlar</a>
                        </li>
                        <li>
                            <a href="{{ route('teams.comments.index') }}"
                                class="flex items-center text-sm w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:text-[#4F46E5]">Yorumlar</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="{{ route('contacts.index') }}"
                        class="flex text-sm items-center p-3 text-gray-900 rounded-lg hover:bg-[#ECECEC] group {{ Route::is('contacts.*') ? 'bg-[#ECECEC]' : '' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-width="2" stroke-linejoin="round"
                                d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                        </svg>

                        <span class="ms-3">İletişim</span>
                    </a>
                </li>
                <li>
                    <button type="button"
                        class="cursor-pointer flex items-center w-full p-3 text-gray-900 transition duration-75 rounded-lg group hover:bg-[#ECECEC] text-sm {{ Route::is('faq.*') ? 'bg-[#ECECEC]' : '' }}"
                        aria-controls="dropdown-faq-sidebar-item" data-collapse-toggle="dropdown-faq-sidebar-item">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-width="2" stroke-linejoin="round"
                                d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                        </svg>
                        <span class="flex-1 ms-3 text-left whitespace-nowrap">SSS</span>
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 10 6">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="1" d="m1 1 4 4 4-4" />
                        </svg>
                    </button>
                    <ul id="dropdown-faq-sidebar-item" class="hidden py-2 space-y-2">
                        <li>
                            <a href="{{ route('faq.index') }}"
                                class="flex items-center text-sm w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:text-[#4F46E5]">Tümü</a>
                        </li>
                        <li>
                            <a href="{{ route('faq.create') }}"
                                class="flex items-center text-sm w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:text-[#4F46E5]">Ekle</a>
                        </li>
                        <li>
                            <a href="{{ route('faq.categories.index') }}"
                                class="flex items-center text-sm w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:text-[#4F46E5]">Kategoriler</a>
                        </li>
                    </ul>
                </li>
            </div>


            <div class="space-y-1">
                <li class="">
                    <span class="p-3 text-xs font-medium uppercase text-[#A1A1AA]">Panel</span>
                </li>
                <li>
                    <a href="{{ route('users.index') }}"
                        class="flex text-sm items-center p-3 text-gray-900 rounded-lg hover:bg-[#ECECEC] group {{ Route::is('users.*') ? 'bg-[#ECECEC]' : '' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-width="2" stroke-linejoin="round"
                                d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                        </svg>

                        <span class="ms-3">Kullanıcılar</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('languages.index') }}"
                        class="flex text-sm items-center p-3 text-gray-900 rounded-lg hover:bg-[#ECECEC] group {{ Route::is('languages.*') ? '' : '' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-width="2" stroke-linejoin="round"
                                d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                        </svg>

                        <span class="ms-3">Diller</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('dashboard.index') }}"
                        class="flex text-sm items-center p-3 text-gray-900 rounded-lg hover:bg-[#ECECEC] group {{ Route::is('dashboard.index') ? '' : '' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-width="2" stroke-linejoin="round"
                                d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                        </svg>

                        <span class="ms-3">Ayarlar</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('dashboard.index') }}"
                        class="flex text-sm items-center p-3 text-gray-900 rounded-lg hover:bg-[#ECECEC] group {{ Route::is('dashboard.index') ? '' : '' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-width="2" stroke-linejoin="round"
                                d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                        </svg>

                        <span class="ms-3">Araçlar</span>
                    </a>
                </li>
            </div>


        </ul>

    </div>
</aside>
