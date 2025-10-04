<aside id="logo-sidebar"
    class="fixed top-0 left-0 z-30 w-64 h-screen pt-[86px] transition-transform -translate-x-full bg-[#FAFAFB] sm:translate-x-0 "
    aria-label="Sidebar">
    <div class="h-full px-4 pb-4 overflow-y-auto ">
        <ul class="space-y-6">

            @canany(['class', 'class_delete', 'student', 'student_delete', 'accounting'])
                <div class="space-y-1">
                    <li>
                        <button type="button"
                            class="cursor-pointer flex items-center w-full p-3 text-gray-900 transition duration-75 rounded-lg group hover:bg-[#ECECEC] text-sm {{ Route::is('class.*') || Route::is('students.*') ? 'bg-[#ECECEC]' : '' }}"
                            aria-expanded="{{ Route::is('class.*') || Route::is('students.*') ? 'true' : 'false' }}"
                            aria-controls="dropdown-education-sidebar-item"
                            data-collapse-toggle="dropdown-education-sidebar-item">

                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M4.26 10.147a60.438 60.438 0 0 0-.491 6.347A48.62 48.62 0 0 1 12 20.904a48.62 48.62 0 0 1 8.232-4.41 60.46 60.46 0 0 0-.491-6.347m-15.482 0a50.636 50.636 0 0 0-2.658-.813A59.906 59.906 0 0 1 12 3.493a59.903 59.903 0 0 1 10.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.717 50.717 0 0 1 12 13.489a50.702 50.702 0 0 1 7.74-3.342M6.75 15a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Zm0 0v-3.675A55.378 55.378 0 0 1 12 8.443m-7.007 11.55A5.981 5.981 0 0 0 6.75 15.75v-1.5" />
                            </svg>

                            <span class="flex-1 ms-3 text-left whitespace-nowrap">Eğitim</span>
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 10 6">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                                    d="m1 1 4 4 4-4" />
                            </svg>
                        </button>

                        <ul id="dropdown-education-sidebar-item"
                            class="{{ Route::is('class.*') || Route::is('students.*') ? 'block' : 'hidden' }} py-2 space-y-2">
                            @canany(['class', 'class_delete'])
                                <li>
                                    <a href="{{ route('class.index') }}"
                                        class="flex items-center text-sm w-full p-2 transition duration-75 rounded-lg pl-11 group hover:text-[#4F46E5] {{ Route::is('class.*') ? 'text-[#4F46E5]' : 'text-gray-900 ' }}">Sınıflar</a>
                                </li>
                            @endcanany
                            @canany(['student', 'student_delete', 'accounting'])
                                <li>
                                    <a href="{{ route('students.index') }}"
                                        class="flex items-center text-sm w-full p-2 transition duration-75 rounded-lg pl-11 group hover:text-[#4F46E5] {{ Route::is('students.*') && !Route::is('students.pre.*') ? 'text-[#4F46E5]' : 'text-gray-900 ' }}">Kesin
                                        Kayıtlar</a>
                                </li>
                            @endcanany
                            @canany(['student', 'student_delete'])
                                <li>
                                    <a href="{{ route('students.pre.students') }}"
                                        class="flex items-center text-sm w-full p-2 transition duration-75 rounded-lg pl-11 group hover:text-[#4F46E5] {{ Route::is('students.pre.*') ? 'text-[#4F46E5]' : 'text-gray-900 ' }}">Ön
                                        Kayıtlar</a>
                                </li>
                            @endcanany

                        </ul>
                    </li>
                </div>
            @endcanany

            @canany(['user', 'user_delete'])
                <div class="space-y-1">
                    <li class="">
                        <span class="p-3 text-xs font-medium uppercase text-[#A1A1AA]">Admin</span>
                    </li>

                    <li>
                        <a href="{{ route('users.index') }}"
                            class="flex text-sm items-center p-3 text-gray-900 rounded-lg hover:bg-[#ECECEC] group {{ Route::is('users.*') ? 'bg-[#ECECEC]' : '' }}">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
                            </svg>


                            <span class="ms-3">Kullanıcılar</span>
                        </a>
                    </li>

                </div>
            @endcanany


        </ul>

    </div>
</aside>
