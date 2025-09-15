<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'E-Commerce')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>

<body class="h-screen relative bg-[#FAFAFB]" style="font-family: plus-jakarta-sans, sans-serif;">

    <div class="bg-white flex justify-center items-center w-full h-full p-4">
        <!-- Left -->
        <div class="w-full lg:w-5/12 flex flex-col gap-6 items-center h-full pt-2 px-6">
            <!-- Logo -->

            <div class="h-full flex items-center justify-center w-full max-w-[356px] pb-[15%]">
                <form action="{{ route('loginPost') }}" method="POST" class="flex flex-col items-center gap-6 w-full">
                    @csrf
                    <div class="flex flex-col gap-2 items-center">
                        <!-- icon -->
                        <img class="w-32 h-20" src="https://vnc.parosis.com/asset/general/parosis-logo-1.svg"
                            alt="">


                        <!-- Head -->
                        <div class="flex flex-col gap-1 items-start">
                            <h1 class="text-2xl font-medium text-[#0e121b] text-center w-full">
                                Robotik Sistemler Arge
                            </h1>
                            <p class="text-sm text-[#525866] text-center">
                                Gerekli bilgileri doldurarak giriş yapabilirsin.
                            </p>
                        </div>
                    </div>

                    <hr class="h-[1px] w-full bg-[#E1E4EA] border-0">

                    <div class="flex flex-col items-start gap-3 w-full">

                        <div class="flex flex-col items-start gap-1 w-full">
                            <label for="email" class="text-sm text-[#0e121b] text-left">
                                Email
                            </label>
                            <input type="email" name="email" id="email" maxlength=""
                                class=" pl-3 py-[10px] pr-[10px] rounded-[10px] border border-[#E1E4EA] bg-white hover:bg-weak-50 hover:text-sub-600 hover:placeholder:text-sub-600 shadow-sm placeholder:text-soft-400 placeholder:paragraph-sm paragraph-sm focus:ring-0 focus:outline-none focus:border-primary-darker transition duration-200 w-full "
                                placeholder="Email Giriniz" value="" step="">
                            @if ($errors->has('email'))
                                <span class="text-sm text-red-600">{{ $errors->first('email') }}</span>
                            @endif

                        </div>

                        <div class="flex flex-col items-start gap-1 w-full">
                            <label for="password" class="text-sm text-[#0e121b] text-left">
                                Şifre
                            </label>
                            <div class="relative w-full flex items-center passwordContainer" id="">
                                <svg class="absolute left-3" xmlns="http://www.w3.org/2000/svg" width="20"
                                    height="20" viewBox="0 0 20 20" fill="none">
                                    <path
                                        d="M5.5 7V6.25C5.5 5.05653 5.97411 3.91193 6.81802 3.06802C7.66193 2.22411 8.80653 1.75 10 1.75C11.1935 1.75 12.3381 2.22411 13.182 3.06802C14.0259 3.91193 14.5 5.05653 14.5 6.25V7H16C16.1989 7 16.3897 7.07902 16.5303 7.21967C16.671 7.36032 16.75 7.55109 16.75 7.75V16.75C16.75 16.9489 16.671 17.1397 16.5303 17.2803C16.3897 17.421 16.1989 17.5 16 17.5H4C3.80109 17.5 3.61032 17.421 3.46967 17.2803C3.32902 17.1397 3.25 16.9489 3.25 16.75V7.75C3.25 7.55109 3.32902 7.36032 3.46967 7.21967C3.61032 7.07902 3.80109 7 4 7H5.5ZM15.25 8.5H4.75V16H15.25V8.5ZM9.25 12.799C8.96404 12.6339 8.74054 12.3791 8.61418 12.074C8.48782 11.7689 8.46565 11.4307 8.55111 11.1117C8.63657 10.7928 8.82489 10.5109 9.08686 10.3099C9.34882 10.1089 9.6698 9.99996 10 9.99996C10.3302 9.99996 10.6512 10.1089 10.9131 10.3099C11.1751 10.5109 11.3634 10.7928 11.4489 11.1117C11.5344 11.4307 11.5122 11.7689 11.3858 12.074C11.2595 12.3791 11.036 12.6339 10.75 12.799V14.5H9.25V12.799ZM7 7H13V6.25C13 5.45435 12.6839 4.69129 12.1213 4.12868C11.5587 3.56607 10.7956 3.25 10 3.25C9.20435 3.25 8.44129 3.56607 7.87868 4.12868C7.31607 4.69129 7 5.45435 7 6.25V7Z"
                                        fill="#99A0AE"></path>
                                </svg>
                                <input type="password" name="password" id="password"
                                    class="py-[10px] rounded-[10px] border border-[#E1E4EA] bg-white hover:bg-weak-50 hover:text-sub-600 hover:placeholder:text-sub-600 shadow-sm placeholder:text-soft-400 placeholder:paragraph-sm paragraph-sm focus:ring-0 focus:outline-none focus:border-primary-darker transition duration-200 w-full pl-10 pr-[38px]"
                                    placeholder="• • • • • • • • • • " value="">
                                <button type="button" class="toggle-password absolute right-[10px]">
                                    <svg class="open" xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                        viewBox="0 0 20 20" fill="none">
                                        <path
                                            d="M10.001 3.25C14.045 3.25 17.4095 6.16 18.1152 10C17.4102 13.84 14.045 16.75 10.001 16.75C5.95697 16.75 2.59247 13.84 1.88672 10C2.59172 6.16 5.95697 3.25 10.001 3.25ZM10.001 15.25C11.5306 15.2497 13.0148 14.7301 14.2106 13.7764C15.4065 12.8226 16.2431 11.4912 16.5837 10C16.2419 8.50998 15.4047 7.18 14.2089 6.22752C13.0132 5.27504 11.5297 4.7564 10.001 4.7564C8.47224 4.7564 6.98874 5.27504 5.793 6.22752C4.59727 7.18 3.76004 8.50998 3.41822 10C3.75879 11.4912 4.59547 12.8226 5.79133 13.7764C6.98718 14.7301 8.47137 15.2497 10.001 15.25ZM10.001 13.375C9.10586 13.375 8.24742 13.0194 7.61448 12.3865C6.98155 11.7535 6.62597 10.8951 6.62597 10C6.62597 9.10489 6.98155 8.24645 7.61448 7.61351C8.24742 6.98058 9.10586 6.625 10.001 6.625C10.8961 6.625 11.7545 6.98058 12.3875 7.61351C13.0204 8.24645 13.376 9.10489 13.376 10C13.376 10.8951 13.0204 11.7535 12.3875 12.3865C11.7545 13.0194 10.8961 13.375 10.001 13.375ZM10.001 11.875C10.4983 11.875 10.9752 11.6775 11.3268 11.3258C11.6784 10.9742 11.876 10.4973 11.876 10C11.876 9.50272 11.6784 9.02581 11.3268 8.67417C10.9752 8.32254 10.4983 8.125 10.001 8.125C9.50369 8.125 9.02677 8.32254 8.67514 8.67417C8.32351 9.02581 8.12597 9.50272 8.12597 10C8.12597 10.4973 8.32351 10.9742 8.67514 11.3258C9.02677 11.6775 9.50369 11.875 10.001 11.875Z"
                                            fill="#99A0AE"></path>
                                    </svg>
                                    <!-- offline -->
                                    <svg class="close hidden" xmlns="http://www.w3.org/2000/svg" width="20"
                                        height="20" viewBox="0 0 25 24" fill="none">
                                        <path
                                            d="M17.7938 18.5667C16.2109 19.5707 14.3745 20.1024 12.5 20.0994C7.64724 20.0994 3.60984 16.6074 2.76294 11.9994C3.14997 9.90307 4.20441 7.98803 5.76894 6.54002L2.95284 3.72663L4.22634 2.45312L22.0454 20.2731L20.7719 21.5457L17.7929 18.5667H17.7938ZM7.04154 7.81442C5.81844 8.92646 4.96642 10.3873 4.60074 11.9994C4.8818 13.2292 5.44608 14.3765 6.24864 15.3498C7.05121 16.3231 8.0699 17.0956 9.22364 17.6058C10.3774 18.116 11.6343 18.3499 12.8943 18.2887C14.1544 18.2276 15.3827 17.8732 16.4816 17.2536L14.6564 15.4284C13.8795 15.9179 12.9592 16.1287 12.0467 16.0264C11.1341 15.9241 10.2834 15.5147 9.63405 14.8654C8.98473 14.2161 8.57534 13.3654 8.47304 12.4528C8.37075 11.5402 8.58161 10.62 9.07104 9.84303L7.04154 7.81442ZM13.3226 14.0946L10.4048 11.1768C10.2447 11.5845 10.207 12.03 10.2964 12.4587C10.3858 12.8875 10.5984 13.2808 10.908 13.5905C11.2177 13.9002 11.6111 14.1128 12.0398 14.2022C12.4686 14.2916 12.9141 14.2539 13.3217 14.0937L13.3226 14.0946ZM20.4263 16.1322L19.1384 14.8452C19.7401 13.9878 20.1684 13.0211 20.3993 11.9994C20.1548 10.9282 19.6949 9.91786 19.0477 9.02987C18.4005 8.14188 17.5795 7.39478 16.6345 6.83397C15.6896 6.27316 14.6405 5.91036 13.551 5.76761C12.4615 5.62487 11.3543 5.70517 10.2968 6.00362L8.87664 4.58343C9.99894 4.14243 11.222 3.89942 12.5 3.89942C17.3528 3.89942 21.3902 7.39143 22.2371 11.9994C21.9614 13.4986 21.3415 14.9132 20.4263 16.1322ZM12.2507 7.95662C12.8236 7.92122 13.3974 8.00798 13.9342 8.21116C14.471 8.41434 14.9585 8.72928 15.3643 9.13513C15.7702 9.54098 16.0851 10.0284 16.2883 10.5652C16.4915 11.102 16.5782 11.6759 16.5428 12.2487L12.2498 7.95662H12.2507Z"
                                            fill="#99A0AE"></path>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>


                    <button
                        class=" p-[10px] inline-flex justify-center items-center gap-1 rounded-[10px] text-white label-sm transition-all duration-200 ease-out w-full border border-[rgba(255,255,255,0.12)]
         [background:linear-gradient(180deg,rgba(255,255,255,0.16)_0%,rgba(255,255,255,0)_100%),#BC00DD]
         shadow-[0_1px_2px_0_rgba(14,18,27,0.24),0_0_0_1px_#BC00DD] cursor-pointer hover:shadow-[0_4px_8px_0_rgba(14,18,27,0.24),0_0_0_1px_#BC00DD] active:shadow-[inset_0_1px_2px_0_rgba(14,18,27,0.24),0_0_0_1px_#BC00DD] focus:outline-none focus:ring-2 focus:ring-[#BC00DD] focus:ring-offset-2 focus:ring-offset-white disabled:cursor-not-allowed disabled:opacity-50">
                        Giriş Yap
                    </button>



                </form>
            </div>
            <!-- Bottom -->
            <div class="flex justify-between items-start w-full px-10 mb-6">
                <p class="paragraph-sm text-sub-600">
                    © 2024 Corwus
                </p>

                <div>
                    <p class="paragraph-sm">
                        TR
                    </p>
                </div>
            </div>
        </div>

    </div>

    @yield('scripts')

</body>

</html>
