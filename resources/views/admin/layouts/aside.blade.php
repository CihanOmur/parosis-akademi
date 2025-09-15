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
                    <button type="button"
                        class="cursor-pointer flex items-center w-full p-3 text-gray-900 transition duration-75 rounded-lg group hover:bg-[#ECECEC] text-sm {{ Route::is('class.*') ? 'bg-[#ECECEC]' : '' }}"
                        aria-controls="dropdown-education-sidebar-item"
                        data-collapse-toggle="dropdown-education-sidebar-item">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-width="2" stroke-linejoin="round"
                                d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                        </svg>
                        <span class="flex-1 ms-3 text-left whitespace-nowrap">Eğitim</span>
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 10 6">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                                d="m1 1 4 4 4-4" />
                        </svg>
                    </button>
                    <ul id="dropdown-education-sidebar-item" class="hidden py-2 space-y-2">
                        <li>
                            <a href="{{ route('class.index') }}"
                                class="flex items-center text-sm w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:text-[#4F46E5]">Sınıflar</a>
                        </li>
                        <li>
                            <a href="{{ route('students.index') }}"
                                class="flex items-center text-sm w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:text-[#4F46E5]">Öğrenciler</a>
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
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-width="2" stroke-linejoin="round"
                                d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                        </svg>

                        <span class="ms-3">Kullanıcılar</span>
                    </a>
                </li>

            </div>


        </ul>

    </div>
</aside>
