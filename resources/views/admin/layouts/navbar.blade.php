    <nav class="fixed top-0 z-50 w-full bg-white border-b border-gray-200">
        <div class="px-3 py-3 lg:px-5 lg:pl-3">
            <div class="flex items-center justify-between">
                <div class="flex items-center justify-start rtl:justify-end">
                    <button data-drawer-target="logo-sidebar" data-drawer-toggle="logo-sidebar"
                        aria-controls="logo-sidebar" type="button"
                        class="inline-flex items-center p-2 text-sm text-gray-500 rounded-lg sm:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200  ">
                        <span class="sr-only">Open sidebar</span>
                        <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path clip-rule="evenodd" fill-rule="evenodd"
                                d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z">
                            </path>
                        </svg>
                    </button>
                    <a href="#" class="flex ms-2 md:me-24">
                        <img src="{{ asset('images/corwus-board-logo.svg') }}" class="h-4 me-3" alt="FlowBite Logo" />

                    </a>
                </div>
                <div class="flex items-center">
                <div class="hidden md:block px-3 text-sm text-gray-600 font-semibold">Parosis Arge A.Ş</div>
<div id="avatarButton" type="button" data-dropdown-toggle="userDropdown" data-dropdown-offset-distance="15" data-dropdown-offset-skidding="10" data-dropdown-placement="bottom-start" class="w-10 h-10 rounded-full cursor-pointer relative inline-flex items-center justify-center overflow-hidden bg-gray-600 ">
    <span class="font-medium text-white">
        {{ strtoupper(substr(explode(' ', auth()->user()->name)[0], 0, 1) . (isset(explode(' ', auth()->user()->name)[1]) ? substr(explode(' ', auth()->user()->name)[1], 0, 1) : '')) }}
    </span>
</div>
<!-- Dropdown menu -->
<div id="userDropdown" class="z-10 hidden bg-white divide-y divide-gray-200 rounded-lg border border-gray-200 shadow-sm w-44">
    <div class="px-4 py-3 text-sm text-gray-900">
      <div> {{ auth()->user()->name . ' ' . auth()->user()->surname }} </div>
      <div class="font-medium truncate">{{ auth()->user()->email ?? 'Guest' }}</div>
    </div>
    <div class="py-1">
        <form action="{{ route('logout') }}" method="post" id="logout">@csrf</form>
                <a href="#" onclick="document.getElementById('logout').submit();" role="menuitem" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Çıkış Yap</a>
    </div>
</div>
</div>

                <!-- <div class="flex items-center">
                    <div class="flex items-center ms-3">
                        <div>
                            <button type="button"
                                class="flex text-sm bg-gray-800 rounded-full focus:ring-4 focus:ring-gray-300"
                                aria-expanded="false" data-dropdown-toggle="dropdown-user">
                                <span class="sr-only">Open user menu</span>
                                <img class="w-8 h-8 rounded-full"
                                    src="https://flowbite.com/docs/images/people/profile-picture-5.jpg"
                                    alt="user photo">
                            </button>
                        </div>
                        <div class="z-50 hidden my-4 text-base list-none bg-white divide-y divide-gray-100 rounded-sm shadow-sm "
                            id="dropdown-user">
                            <div class="px-4 py-3" role="none">
                                <p class="text-sm text-gray-400 " role="none">
                                    {{-- {{ auth()->user()->name . ' ' . auth()->user()->surname }} --}} Kullanıcı Adı
                                </p>
                                <p class="text-md  text-gray-900 truncate" role="none">
                                    {{ auth()->user()->email ?? 'Guest' }}
                                </p>
                            </div>
                            <ul class="py-1" role="none">
                                <li>
                                    <form action="{{ route('logout') }}" method="post" id="logout">
                                        @csrf
                                    </form>
                                    <button form="logout" type="submit" 
                                        class="w-full block px-4 py-2 text-sm text-gray-700 hover:bg-gray-200 cursor-pointer"
                                        role="menuitem">Çıkış Yap</butt>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div> -->
            </div>
        </div>
    </nav>
