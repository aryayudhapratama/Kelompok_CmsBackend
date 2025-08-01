{{-- <!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('assets2/img/apple-icon.png') }}" />
    <link rel="icon" type="image/png" href="{{ asset('assets2/img/favicon.png') }}" />
    <title>Reporter - Dashboard</title>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <link href="{{ asset('assets2/css/nucleo-icons.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets2/css/nucleo-svg.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets2/css/argon-dashboard-tailwind.css?v=1.0.1') }}" rel="stylesheet" />
</head>

<body
    class="m-0 font-sans text-base antialiased font-normal dark:bg-slate-900 leading-default bg-gray-50 text-slate-500">
    <div class="absolute w-full bg-blue-500 dark:hidden min-h-75"></div>

    <!-- Sidebar -->
    <aside
        class="fixed inset-y-0 flex-wrap items-center justify-between block w-full p-0 my-4 overflow-y-auto antialiased transition-transform duration-200 -translate-x-full bg-white border-0 shadow-xl dark:shadow-none dark:bg-slate-850 max-w-64 ease-nav-brand z-990 xl:ml-6 rounded-2xl xl:left-0 xl:translate-x-0"
        aria-expanded="false">
        <div class="h-19">
            <i class="absolute top-0 right-0 p-4 opacity-50 cursor-pointer fas fa-times dark:text-white text-slate-400 xl:hidden"
                sidenav-close></i>
            <a class="block px-8 py-6 m-0 text-sm whitespace-nowrap dark:text-white text-slate-700" href="javascript:;">
                <img src="{{ asset('assets2/img/logo-ct-dark.png') }}"
                    class="inline h-full max-w-full transition-all duration-200 dark:hidden ease-nav-brand max-h-8"
                    alt="main_logo" />
                <img src="{{ asset('assets2/img/logo-ct.png') }}"
                    class="hidden h-full max-w-full transition-all duration-200 dark:inline ease-nav-brand max-h-8"
                    alt="main_logo" />
                <span class="ml-1 font-semibold transition-all duration-200 ease-nav-brand">REPORTER PANEL</span>
            </a>
        </div>

        <hr
            class="h-px mt-0 bg-transparent bg-gradient-to-r from-transparent via-black/40 to-transparent dark:bg-gradient-to-r dark:from-transparent dark:via-white dark:to-transparent" />

        <div class="items-center block w-auto max-h-screen overflow-auto h-sidenav grow basis-full">
            <ul class="flex flex-col pl-0 mb-0">
                <li class="mt-0.5 w-full">
                    <a class="py-2.7 bg-blue-500/13 dark:text-white dark:opacity-80 text-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap rounded-lg px-4 font-semibold text-slate-700 transition-colors"
                        href="{{ route('reporter.dashboard') }}">
                        <div
                            class="mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5">
                            <i class="relative top-0 text-sm leading-normal text-blue-500 ni ni-tv-2"></i>
                        </div>
                        <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">Dashboard</span>
                    </a>
                </li>
                <li class="mt-0.5 w-full">
                    <a class="dark:text-white dark:opacity-80 py-2.7 text-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap px-4 transition-colors"
                        href="{{ route('reporter.berita') }}">
                        <div
                            class="mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5">
                            <i class="relative top-0 text-sm leading-normal text-orange-500 ni ni-calendar-grid-58"></i>
                        </div>
                        <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">Kelola Berita</span>
                    </a>
                </li>
                <li class="mt-0.5 w-full">
                    <form action="/logout" method="POST" class="m-0 p-0">
                        @csrf
                        <button type="submit"
                            class="dark:text-white dark:opacity-80 py-2.7 text-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap px-4 transition-colors w-full text-left">
                            <div
                                class="mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5">
                                <i class="relative top-0 text-sm leading-normal text-red-500 ni ni-button-power"></i>
                            </div>
                            <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">Logout</span>
                        </button>
                    </form>
                </li>
            </ul>
        </div>
    </aside>

    <!-- Main content -->
    <main class="relative h-full max-h-screen transition-all duration-200 ease-in-out xl:ml-68 rounded-xl">
        <!-- Navbar -->
        <nav class="relative flex flex-wrap items-center justify-between px-0 py-2 mx-6 transition-all ease-in shadow-none duration-250 rounded-2xl lg:flex-nowrap lg:justify-start"
            navbar-main navbar-scroll="false">
            <div class="flex items-center justify-between w-full px-4 py-1 mx-auto flex-wrap-inherit">
                <nav>
                    <ol class="flex flex-wrap pt-1 mr-12 bg-transparent rounded-lg sm:mr-16">
                        <li class="text-sm leading-normal"><a class="text-white opacity-50"
                                href="javascript:;">Pages</a></li>
                        <li class="text-sm pl-2 capitalize leading-normal text-white before:float-left before:pr-2 before:text-white before:content-['/']"
                            aria-current="page">Dashboard</li>
                    </ol>
                    <h6 class="mb-0 font-bold text-white capitalize">Dashboard</h6>
                </nav>
            </div>
        </nav>

        <!-- Dashboard Content -->
        <div class="w-full px-6 py-6 mx-auto">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
                <!-- Approved -->
                <div class="bg-white shadow p-4 rounded border-t-4 border-green-500">
                    <p class="text-gray-600">Approved</p>
                    <h2 class="text-2xl font-bold text-green-700">{{ $approvedCount }}</h2>
                </div>

                <!-- Waiting -->
                <div class="bg-white shadow p-4 rounded border-t-4 border-yellow-500">
                    <p class="text-gray-600">Waiting</p>
                    <h2 class="text-2xl font-bold text-yellow-600">{{ $waitingCount }}</h2>
                </div>

                <!-- Rejected -->
                <div class="bg-white shadow p-4 rounded border-t-4 border-red-500">
                    <p class="text-gray-600">Rejected</p>
                    <h2 class="text-2xl font-bold text-red-600">{{ $rejectedCount }}</h2>
                </div>

                <!-- User Guide -->
                <div class="bg-white shadow p-4 rounded border-t-4 border-blue-500">
                    <p class="text-gray-600">User Guide</p>
                    <a href="#" class="text-blue-700 underline">Download</a>
                </div>
            </div>

            <!-- Input Area -->
            <div class="bg-white p-5 rounded-xl shadow">
                <input type="text" placeholder="What letter would you want to create today?"
                    class="w-full px-4 py-3 border border-blue-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-400 bg-blue-50 placeholder-blue-500" />
            </div>
        </div>
    </main>
</body>

</html> --}}

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('assets2/img/apple-icon.png') }}" />
    <link rel="icon" type="image/png" href="{{ asset('assets2/img/favicon.png') }}" />
    <title>REPORTER - DASHBOARD</title>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <link href="{{ asset('assets2/css/nucleo-icons.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets2/css/nucleo-svg.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets2/css/argon-dashboard-tailwind.css?v=1.0.1') }}" rel="stylesheet" />
</head>

<body
    class="m-0 font-sans text-base antialiased font-normal dark:bg-slate-900 leading-default bg-gray-50 text-slate-500">
    <div class="absolute w-full bg-blue-500 dark:hidden min-h-75"></div>

    <!-- Sidebar -->
    <aside
        class="fixed inset-y-0 flex-wrap items-center justify-between block w-full p-0 my-4 overflow-y-auto antialiased transition-transform duration-200 -translate-x-full bg-white border-0 shadow-xl dark:shadow-none dark:bg-slate-850 max-w-64 ease-nav-brand z-990 xl:ml-6 rounded-2xl xl:left-0 xl:translate-x-0"
        aria-expanded="false">
        <div class="h-19">
            <i class="absolute top-0 right-0 p-4 opacity-50 cursor-pointer fas fa-times dark:text-white text-slate-400 xl:hidden"
                sidenav-close></i>
            <a class="block px-8 py-6 m-0 text-sm whitespace-nowrap dark:text-white text-slate-700" href="javascript:;">
                <img src="{{ asset('assets2/img/logo-ct-dark.png') }}"
                    class="inline h-full max-w-full transition-all duration-200 dark:hidden ease-nav-brand max-h-8"
                    alt="main_logo" />
                <img src="{{ asset('assets2/img/logo-ct.png') }}"
                    class="hidden h-full max-w-full transition-all duration-200 dark:inline ease-nav-brand max-h-8"
                    alt="main_logo" />
                <span class="ml-1 font-semibold transition-all duration-200 ease-nav-brand">REPORTER PANEL</span>
            </a>
        </div>

        <hr
            class="h-px mt-0 bg-transparent bg-gradient-to-r from-transparent via-black/40 to-transparent dark:bg-gradient-to-r dark:from-transparent dark:via-white dark:to-transparent" />

        <div class="items-center block w-auto max-h-screen overflow-auto h-sidenav grow basis-full">
            <ul class="flex flex-col pl-0 mb-0">
                <li class="mt-0.5 w-full">
                    <a class="py-2.7 bg-blue-500/13 dark:text-white dark:opacity-80 text-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap rounded-lg px-4 font-semibold text-slate-700 transition-colors"
                        href="{{ route('reporter.dashboard') }}">
                        <div
                            class="mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5">
                            <i class="relative top-0 text-sm leading-normal text-blue-500 ni ni-tv-2"></i>
                        </div>
                        <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">Dashboard</span>
                    </a>
                </li>
                <li class="mt-0.5 w-full">
                    <a class="dark:text-white dark:opacity-80 py-2.7 text-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap px-4 transition-colors"
                        href="{{ route('reporter.berita') }}">
                        <div
                            class="mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5">
                            <i class="relative top-0 text-sm leading-normal text-orange-500 ni ni-calendar-grid-58"></i>
                        </div>
                        <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">Kelola Berita</span>
                    </a>
                </li>
                <li class="mt-0.5 w-full">
                    <form action="/logout" method="POST" class="m-0 p-0">
                        @csrf
                        <button type="submit"
                            class="dark:text-white dark:opacity-80 py-2.7 text-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap px-4 transition-colors w-full text-left">
                            <div
                                class="mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5">
                                <i class="relative top-0 text-sm leading-normal text-red-500 ni ni-button-power"></i>
                            </div>
                            <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">Logout</span>
                        </button>
                    </form>
                </li>
            </ul>
        </div>
    </aside>

    <main class="relative h-full max-h-screen transition-all duration-200 ease-in-out xl:ml-68 rounded-xl">
        <!-- Navbar -->
        <nav class="relative flex flex-wrap items-center justify-between px-0 py-2 mx-6 transition-all ease-in shadow-none duration-250 rounded-2xl lg:flex-nowrap lg:justify-start"
            navbar-main navbar-scroll="false">
            <div class="flex items-center justify-between w-full px-4 py-1 mx-auto flex-wrap-inherit">
                <nav>
                    <ol class="flex flex-wrap pt-1 mr-12 bg-transparent rounded-lg sm:mr-16">
                        <li class="text-sm leading-normal"><a class="text-white opacity-50"
                                href="javascript:;">Pages</a></li>
                        <li class="text-sm pl-2 capitalize leading-normal text-white before:float-left before:pr-2 before:text-white before:content-['/']"
                            aria-current="page">Dashboard</li>
                    </ol>
                    <h6 class="mb-0 font-bold text-white capitalize">Dashboard</h6>
                </nav>
            </div>
        </nav>

        <!-- Dashboard Content -->
        <div class="w-full px-6 py-6 mx-auto">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
                <!-- Approved -->
                <div class="bg-white shadow p-4 rounded border-t-4 border-green-500">
                    <p class="text-gray-600">Approved</p>
                    <h2 class="text-2xl font-bold text-green-700">{{ $approvedCount }}</h2>
                </div>

                <!-- Waiting -->
                <div class="bg-white shadow p-4 rounded border-t-4 border-yellow-500">
                    <p class="text-gray-600">Waiting</p>
                    <h2 class="text-2xl font-bold text-yellow-600">{{ $waitingCount }}</h2>
                </div>

                <!-- Rejected -->
                <div class="bg-white shadow p-4 rounded border-t-4 border-red-500">
                    <p class="text-gray-600">Rejected</p>
                    <h2 class="text-2xl font-bold text-red-600">{{ $rejectedCount }}</h2>
                </div>

                <!-- User Guide -->
                <div class="bg-white shadow p-4 rounded border-t-4 border-blue-500">
                    <p class="text-gray-600">User Guide</p>
                    <a href="#" class="text-blue-700 underline">Download</a>
                </div>
            </div>

            <!-- Input Area -->
            <div class="bg-white p-5 rounded-xl shadow">
                <input type="text" placeholder="What letter would you want to create today?"
                    class="w-full px-4 py-3 border border-blue-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-400 bg-blue-50 placeholder-blue-500" />
            </div>
        </div>
    </main>
</body>

</html>
