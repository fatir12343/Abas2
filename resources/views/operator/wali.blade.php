@extends('layouts.main')

@section('content')
    <div class="flex h-screen bg-gray-50 dark:bg-gray-900" :class="{ 'overflow-hidden': isSideMenuOpen }">
        <!-- Desktop sidebar -->
        <aside class="z-20 hidden w-64 overflow-y-auto bg-white dark:bg-gray-800 md:block flex-shrink-0">
            <div class="py-4 text-gray-500 dark:text-gray-400">
                <a class="ml-6 text-lg font-bold text-gray-800 dark:text-gray-200" href="#">
                    Windmill
                </a>
                <ul class="mt-6">
                    <li class="relative px-6 py-3">
                        <span class="absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg rounded-br-lg"
                            aria-hidden="true"></span>
                            <a class="inline-flex items-center w-full text-sm font-semibold text-gray-800 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200 dark:text-gray-100"
                            href="/operator">
                            <svg class="w-5 h-5" aria-hidden="true" fill="none" stroke-linecap="round"
                                stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                                <path
                                    d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
                                </path>
                            </svg>
                            <span class="ml-4">Dashboard</span>
                        </a>
                    </li>
                </ul>
                <ul>

                    <li class="relative px-6 py-3">
                        <a class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200"
                            href="">
                            <svg class="w-5 h-5" aria-hidden="true" fill="none" stroke-linecap="round"
                                stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                                <path d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z"></path>
                                <path d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z"></path>
                            </svg>
                            <span class="ml-4">Setting Koordinat dan Waktu</span>
                        </a>
                    </li>
                    <li class="relative px-6 py-3">
                        <a class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200"
                            href="/oo">
                            <svg class="w-5 h-5" aria-hidden="true" fill="none" stroke-linecap="round"
                                stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                                <path
                                    d="M15 15l-2 5L9 9l11 4-5 2zm0 0l5 5M7.188 2.239l.777 2.897M5.136 7.965l-2.898-.777M13.95 4.05l-2.122 2.122m-5.657 5.656l-2.12 2.122">
                                </path>
                            </svg>
                            <span class="ml-4">Jurusan</span>
                        </a>
                    </li>
                    <li class="relative px-6 py-3">
                        <a class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200"
                            href="/pp">
                            <svg class="w-5 h-5" aria-hidden="true" fill="none" stroke-linecap="round"
                                stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                                <path
                                    d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z">
                                </path>
                            </svg>
                            <span class="ml-4">Wali Kelas</span>
                        </a>
                    </li>
                    <li class="relative px-6 py-3">
                        <a class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200"
                            href="/qq">
                            <svg class="w-5 h-5" aria-hidden="true" fill="none" stroke-linecap="round"
                                stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                                <path d="M4 6h16M4 10h16M4 14h16M4 18h16"></path>
                            </svg>
                            <span class="ml-4">Kelas</span>
                        </a>
                    </li>

                    <li class="relative px-6 py-3">
                        <a class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200"
                            href="/kesiswaan">
                            <svg class="w-5 h-5" aria-hidden="true" fill="none" stroke-linecap="round"
                                stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                                <path d="M4 6h16M4 10h16M4 14h16M4 18h16"></path>
                            </svg>
                            <span class="ml-4">Kesiswaan</span>
                        </a>
                    </li>
                    <li class="relative px-6 py-3">
                        <a class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200"
                            href="buttons.html">
                            <svg class="w-5 h-5" aria-hidden="true" fill="none" stroke-linecap="round"
                                stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                                <path
                                    d="M15 15l-2 5L9 9l11 4-5 2zm0 0l5 5M7.188 2.239l.777 2.897M5.136 7.965l-2.898-.777M13.95 4.05l-2.122 2.122m-5.657 5.656l-2.12 2.122">
                                </path>
                            </svg>
                            <span class="ml-4">Logout</span>
                        </a>
                    </li>
                </ul>
                <div class="px-6 my-6">
                    <button
                        class="flex items-center justify-between w-full px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                        Create account
                        <span class="ml-2" aria-hidden="true">+</span>
                    </button>
                </div>
            </div>
        </aside>
        <!-- Mobile sidebar -->
        <!-- Backdrop -->
        <div x-show="isSideMenuOpen" x-transition:enter="transition ease-in-out duration-150"
            x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
            x-transition:leave="transition ease-in-out duration-150" x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            class="fixed inset-0 -z-10 flex items-end bg-black bg-opacity-50 sm:items-center sm:justify-center"></div>
        <aside class="fixed inset-y-0 z-20 flex-shrink-0 w-64 mt-16 overflow-y-auto bg-white dark:bg-gray-800 md:hidden"
            x-show="isSideMenuOpen" x-transition:enter="transition ease-in-out duration-150"
            x-transition:enter-start="opacity-0 transform -translate-x-20" x-transition:enter-end="opacity-100"
            x-transition:leave="transition ease-in-out duration-150" x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0 transform -translate-x-20" @click.away="closeSideMenu"
            @keydown.escape="closeSideMenu">
            <div class="py-4 text-gray-500 dark:text-gray-400">
                <a class="ml-6 text-lg font-bold text-gray-800 dark:text-gray-200" href="#">
                    Windmill
                </a>
                <ul class="mt-6">
                    <li class="relative px-6 py-3">
                        <span class="absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg rounded-br-lg"
                            aria-hidden="true"></span>
                        <a class="inline-flex items-center w-full text-sm font-semibold text-gray-800 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200 dark:text-gray-100"
                            href="index.html">
                            <svg class="w-5 h-5" aria-hidden="true" fill="none" stroke-linecap="round"
                                stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                                <path
                                    d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
                                </path>
                            </svg>
                            <span class="ml-4">Dashboard</span>
                        </a>
                    </li>
                </ul>
                <ul>
                    <li class="relative px-6 py-3">
                        <a class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200"
                            href="forms.html">
                            <svg class="w-5 h-5" aria-hidden="true" fill="none" stroke-linecap="round"
                                stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                                <path
                                    d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01">
                                </path>
                            </svg>
                            <h3>Navigation</h3>
                            <span class="ml-4">Forms</span>
                        </a>
                    </li>
                    <li class="relative px-6 py-3">
                        <a class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200"
                            href="cards.html">
                            <svg class="w-5 h-5" aria-hidden="true" fill="none" stroke-linecap="round"
                                stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                                <path
                                    d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10">
                                </path>
                            </svg>
                            <span class="ml-4">Cards</span>
                        </a>
                    </li>
                    <li class="relative px-6 py-3">
                        <a class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200"
                            href="charts.html">
                            <svg class="w-5 h-5" aria-hidden="true" fill="none" stroke-linecap="round"
                                stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                                <path d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z"></path>
                                <path d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z"></path>
                            </svg>
                            <span class="ml-4">Charts</span>
                        </a>
                    </li>
                    <li class="relative px-6 py-3">
                        <a class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200"
                            href="buttons.html">
                            <svg class="w-5 h-5" aria-hidden="true" fill="none" stroke-linecap="round"
                                stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                                <path
                                    d="M15 15l-2 5L9 9l11 4-5 2zm0 0l5 5M7.188 2.239l.777 2.897M5.136 7.965l-2.898-.777M13.95 4.05l-2.122 2.122m-5.657 5.656l-2.12 2.122">
                                </path>
                            </svg>
                            <span class="ml-4">Buttons</span>
                        </a>
                    </li>
                    <li class="relative px-6 py-3">
                        <a class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200"
                            href="modals.html">
                            <svg class="w-5 h-5" aria-hidden="true" fill="none" stroke-linecap="round"
                                stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                                <path
                                    d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z">
                                </path>
                            </svg>
                            <span class="ml-4">Modals</span>
                        </a>
                    </li>
                    <li class="relative px-6 py-3">
                        <a class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200"
                            href="tables.html">
                            <svg class="w-5 h-5" aria-hidden="true" fill="none" stroke-linecap="round"
                                stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                                <path d="M4 6h16M4 10h16M4 14h16M4 18h16"></path>
                            </svg>
                            <span class="ml-4">Tables</span>
                        </a>
                    </li>
                    <li class="relative px-6 py-3">
                        <button
                            class="inline-flex items-center justify-between w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200"
                            @click="togglePagesMenu" aria-haspopup="true">
                            <span class="inline-flex items-center">
                                <svg class="w-5 h-5" aria-hidden="true" fill="none" stroke-linecap="round"
                                    stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                                    <path
                                        d="M4 5a1 1 0 011-1h14a1 1 0 011 1v2a1 1 0 01-1 1H5a1 1 0 01-1-1V5zM4 13a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H5a1 1 0 01-1-1v-6zM16 13a1 1 0 011-1h2a1 1 0 011 1v6a1 1 0 01-1 1h-2a1 1 0 01-1-1v-6z">
                                    </path>
                                </svg>
                                <span class="ml-4">Pages</span>
                            </span>
                            <svg class="w-4 h-4" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                    clip-rule="evenodd"></path>
                            </svg>
                        </button>
                        <template x-if="isPagesMenuOpen">
                            <ul x-transition:enter="transition-all ease-in-out duration-300"
                                x-transition:enter-start="opacity-25 max-h-0"
                                x-transition:enter-end="opacity-100 max-h-xl"
                                x-transition:leave="transition-all ease-in-out duration-300"
                                x-transition:leave-start="opacity-100 max-h-xl" x-transition:leave-end="opacity-0 max-h-0"
                                class="p-2 mt-2 space-y-2 overflow-hidden text-sm font-medium text-gray-500 rounded-md shadow-inner bg-gray-50 dark:text-gray-400 dark:bg-gray-900"
                                aria-label="submenu">
                                <li
                                    class="px-2 py-1 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200">
                                    <a class="w-full" href="pages/login.html">Login</a>
                                </li>
                                <li
                                    class="px-2 py-1 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200">
                                    <a class="w-full" href="pages/create-account.html">
                                        Create account
                                    </a>
                                </li>
                                <li
                                    class="px-2 py-1 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200">
                                    <a class="w-full" href="pages/forgot-password.html">
                                        Forgot password
                                    </a>
                                </li>
                                <li
                                    class="px-2 py-1 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200">
                                    <a class="w-full" href="pages/404.html">404</a>
                                </li>
                                <li
                                    class="px-2 py-1 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200">
                                    <a class="w-full" href="pages/blank.html">Blank</a>
                                </li>
                            </ul>
                        </template>
                    </li>
                </ul>
                <div class="px-6 my-6">
                    <button
                        class="flex items-center justify-between px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                        Create account
                        <span class="ml-2" aria-hidden="true">+</span>
                    </button>
                </div>
            </div>
        </aside>
        <div class="flex flex-col flex-1 w-full">
            <header class="z-10 py-4 bg-white shadow-md dark:bg-gray-800">
                <div
                    class="container flex items-center justify-between h-full px-6 mx-auto text-purple-600 dark:text-purple-300">
                    <!-- Mobile hamburger -->
                    <button class="p-1 mr-5 -ml-1 rounded-md md:hidden focus:outline-none focus:shadow-outline-purple"
                        @click="toggleSideMenu" aria-label="Menu">
                        <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </button>
                    <!-- Search input -->
                    <div class="flex justify-center flex-1 lg:mr-32">
                        <div class="relative w-full max-w-xl mr-6 focus-within:text-purple-500">
                            <div class="absolute inset-y-0 flex items-center pl-2">
                                <svg class="w-4 h-4" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                        clip-rule="evenodd"></path>
                                </svg>
                            </div>
                            <input
                                class="w-full pl-8 pr-2 text-sm text-gray-700 placeholder-gray-600 bg-gray-100 border-0 rounded-md dark:placeholder-gray-500 dark:focus:shadow-outline-gray dark:focus:placeholder-gray-600 dark:bg-gray-700 dark:text-gray-200 focus:placeholder-gray-500 focus:bg-white focus:border-purple-300 focus:outline-none focus:shadow-outline-purple form-input"
                                type="text" placeholder="Search for projects" aria-label="Search" />
                        </div>
                    </div>
                    <ul class="flex items-center flex-shrink-0 space-x-6">
                        <!-- Theme toggler -->
                        <li class="flex">
                            <button class="rounded-md focus:outline-none focus:shadow-outline-purple" @click="toggleTheme"
                                aria-label="Toggle color mode">
                                <template x-if="!dark">
                                    <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"></path>
                                    </svg>
                                </template>
                                <template x-if="dark">
                                    <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z"
                                            clip-rule="evenodd"></path>
                                    </svg>
                                </template>
                            </button>
                        </li>
                        <!-- Notifications menu -->
                        <li class="relative">
                            <button class="relative align-middle rounded-md focus:outline-none focus:shadow-outline-purple"
                                @click="toggleNotificationsMenu" @keydown.escape="closeNotificationsMenu"
                                aria-label="Notifications" aria-haspopup="true">
                                <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                                    <path
                                        d="M10 2a6 6 0 00-6 6v3.586l-.707.707A1 1 0 004 14h12a1 1 0 00.707-1.707L16 11.586V8a6 6 0 00-6-6zM10 18a3 3 0 01-3-3h6a3 3 0 01-3 3z">
                                    </path>
                                </svg>
                                <!-- Notification badge -->
                                <span aria-hidden="true"
                                    class="absolute top-0 right-0 inline-block w-3 h-3 transform translate-x-1 -translate-y-1 bg-red-600 border-2 border-white rounded-full dark:border-gray-800"></span>
                            </button>
                            <template x-if="isNotificationsMenuOpen">
                                <ul x-transition:leave="transition ease-in duration-150"
                                    x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
                                    @click.away="closeNotificationsMenu" @keydown.escape="closeNotificationsMenu"
                                    class="absolute right-0 w-56 p-2 mt-2 space-y-2 text-gray-600 bg-white border border-gray-100 rounded-md shadow-md dark:text-gray-300 dark:border-gray-700 dark:bg-gray-700">
                                    <li class="flex">
                                        <a class="inline-flex items-center justify-between w-full px-2 py-1 text-sm font-semibold transition-colors duration-150 rounded-md hover:bg-gray-100 hover:text-gray-800 dark:hover:bg-gray-800 dark:hover:text-gray-200"
                                            href="#">
                                            <span>Messages</span>
                                            <span
                                                class="inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-red-600 bg-red-100 rounded-full dark:text-red-100 dark:bg-red-600">
                                                13
                                            </span>
                                        </a>
                                    </li>
                                    <li class="flex">
                                        <a class="inline-flex items-center justify-between w-full px-2 py-1 text-sm font-semibold transition-colors duration-150 rounded-md hover:bg-gray-100 hover:text-gray-800 dark:hover:bg-gray-800 dark:hover:text-gray-200"
                                            href="#">
                                            <span>Sales</span>
                                            <span
                                                class="inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-red-600 bg-red-100 rounded-full dark:text-red-100 dark:bg-red-600">
                                                2
                                            </span>
                                        </a>
                                    </li>
                                    <li class="flex">
                                        <a class="inline-flex items-center justify-between w-full px-2 py-1 text-sm font-semibold transition-colors duration-150 rounded-md hover:bg-gray-100 hover:text-gray-800 dark:hover:bg-gray-800 dark:hover:text-gray-200"
                                            href="#">
                                            <span>Alerts</span>
                                        </a>
                                    </li>
                                </ul>
                            </template>
                        </li>
                        <!-- Profile menu -->
                        <li class="relative">
                            <button class="align-middle rounded-full focus:shadow-outline-purple focus:outline-none"
                                @click="toggleProfileMenu" @keydown.escape="closeProfileMenu" aria-label="Account"
                                aria-haspopup="true">
                                <img class="object-cover w-8 h-8 rounded-full"
                                    src="https://images.unsplash.com/photo-1502378735452-bc7d86632805?ixlib=rb-0.3.5&q=80&fm=jpg&crop=entropy&cs=tinysrgb&w=200&fit=max&s=aa3a807e1bbdfd4364d1f449eaa96d82"
                                    alt="" aria-hidden="true" />
                            </button>
                            <template x-if="isProfileMenuOpen">
                                <ul x-transition:leave="transition ease-in duration-150"
                                    x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
                                    @click.away="closeProfileMenu" @keydown.escape="closeProfileMenu"
                                    class="absolute right-0 w-56 p-2 mt-2 space-y-2 text-gray-600 bg-white border border-gray-100 rounded-md shadow-md dark:border-gray-700 dark:text-gray-300 dark:bg-gray-700"
                                    aria-label="submenu">
                                    <li class="flex">
                                        <a class="inline-flex items-center w-full px-2 py-1 text-sm font-semibold transition-colors duration-150 rounded-md hover:bg-gray-100 hover:text-gray-800 dark:hover:bg-gray-800 dark:hover:text-gray-200"
                                            href="#">
                                            <svg class="w-4 h-4 mr-3" aria-hidden="true" fill="none"
                                                stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path
                                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z">
                                                </path>
                                            </svg>
                                            <span>Profile</span>
                                        </a>
                                    </li>
                                    <li class="flex">
                                        <a class="inline-flex items-center w-full px-2 py-1 text-sm font-semibold transition-colors duration-150 rounded-md hover:bg-gray-100 hover:text-gray-800 dark:hover:bg-gray-800 dark:hover:text-gray-200"
                                            href="#">
                                            <svg class="w-4 h-4 mr-3" aria-hidden="true" fill="none"
                                                stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path
                                                    d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z">
                                                </path>
                                                <path d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            </svg>
                                            <span>Settings</span>
                                        </a>
                                    </li>
                                    <li class="flex">
                                        <a class="inline-flex items-center w-full px-2 py-1 text-sm font-semibold transition-colors duration-150 rounded-md hover:bg-gray-100 hover:text-gray-800 dark:hover:bg-gray-800 dark:hover:text-gray-200"
                                            href="{{ route('logout') }}"
                                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                            <svg class="w-4 h-4 mr-3" aria-hidden="true" fill="none"
                                                stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path
                                                    d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1">
                                                </path>
                                            </svg>
                                            <span>Logout</span>
                                        </a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                            class="hidden">
                                            @csrf
                                        </form>
                                    </li>
                                </ul>
                            </template>
                        </li>
                    </ul>
                </div>
            </header>
            <main class="h-full overflow-y-auto">
                <div class="container px-6 mx-auto grid">
                    <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
                      List WaliKelas
                    </h2>
                    <!-- CTA -->
                    {{-- <a
              class="flex items-center justify-between p-4 mb-8 text-sm font-semibold text-purple-100 bg-purple-600 rounded-lg shadow-md focus:outline-none focus:shadow-outline-purple"
              href="https://github.com/estevanmaito/windmill-dashboard"
            >
              <div class="flex items-center">
                <svg
                  class="w-5 h-5 mr-2"
                  fill="currentColor"
                  viewBox="0 0 20 20"
                >
                  <path
                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"
                  ></path>
                </svg>
                <span>Star this project on GitHub</span>
              </div>
              <span>View more &RightArrow;</span>
            </a> --}}
                    <!-- Cards -->




                      <!-- New Table -->

                      <div class="container mx-auto mt-2">
                        <div class="flex justify-end mb-2">
                            <button id="add-wali-btn" class="mt-4 px-4  py-2 bg-blue-500 text-white rounded-md hover:bg-blue-700 m-2">Add</button>
                            <button id="open-modal-btn" class="mt-4 px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700 m-2">Import</button>

                        </div>
                      <!-- New Table -->
                      <div class="w-full overflow-hidden rounded-lg shadow-xs">
                          <div class="w-full overflow-x-auto">
                              <table class="w-full whitespace-no-wrap">
                                  <thead>
                                      <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                                          <th class="px-4 py-3">NUPTK</th>
                                          <th class="px-4 py-3">ID_user</th>
                                          <th class="px-4 py-3">Jenis Kelamin</th>
                                          <th class="px-4 py-3">NIP</th>
                                          <th class="px-4 py-3">Actions</th>
                                      </tr>
                                  </thead>
                                  <tbody id="wali-tbody" class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                                      @foreach ($waliKelas as $wali)
                                          <tr class="text-gray-700 dark:text-gray-400">
                                              <td class="px-4 py-3 text-sm">{{ $wali->nuptk }}</td>
                                              <td class="px-4 py-3 text-sm">{{ $wali->id_user }}</td>
                                              <td class="px-4 py-3 text-sm">{{ $wali->jenis_kelamin }}</td>
                                              <td class="px-4 py-3 text-sm">{{ $wali->nip }}</td>
                                              <td class="px-4 py-3 text-sm">

                                                <button class="bg-red-500 text-white px-4 py-2 rounded" onclick="toggleModal('{{ $wali->id_user }}')">Delete</button>
                                                <button class="bg-blue-600 text-white px-4 py-2 rounded" onclick="toggleModalEdit('{{ $wali->id_user }}')">Edit</button>
                                                    {{-- <button onclick="deleteWali('{{ $wali->nuptk }}')" class="text-red-600 hover:text-red-900 ml-2">
                                                        Delete
                                                    </button> --}}
                                                </td>
                                          </tr>
                                          <div id="modal-edit-{{ $wali->id_user }}" class="fixed inset-0 z-50 hidden overflow-y-auto">
                                            <div class="flex items-center justify-center min-h-screen px-4">
                                                <div class="bg-white rounded-lg overflow-hidden shadow-xl transform transition-all max-w-lg w-full">
                                                    <div class="bg-gray-100 px-4 py-2 flex justify-between items-center">
                                                        <h5 class="text-lg font-bold">Edit Wali Kelas</h5>
                                                        <button class="text-gray-500" onclick="toggleModal('edit-{{ $wali->id_user }}')">&times;</button>
                                                    </div>
                                                    <form action="{{ route('operator.wali.update', $wali->id_user) }}" method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="px-4 py-6">
                                                            <div class="mb-4">
                                                                <label for="nuptk" class="block text-sm font-medium text-gray-700">NUPTK</label>
                                                                <input type="text" id="nuptk" name="nuptk" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required value="{{ $wali->nuptk }}">
                                                            </div>
                                                            <div class="mb-4">
                                                                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                                                                <input type="email" id="email" name="email" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required value="{{ $wali->user}}">
                                                            </div>
                                                            <div class="mb-4">
                                                                <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                                                                <input type="password" id="password" name="password" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" placeholder="Leave blank to keep current password">
                                                            </div>
                                                            <div class="mb-4">
                                                                <label for="jenis_kelamin" class="block text-sm font-medium text-gray-700">Jenis Kelamin</label>
                                                                <select id="jenis_kelamin" name="jenis_kelamin" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
                                                                    <option value="laki laki" {{ $wali->jenis_kelamin == 'laki laki' ? 'selected' : '' }}>Laki Laki</option>
                                                                    <option value="perempuan" {{ $wali->jenis_kelamin == 'perempuan' ? 'selected' : '' }}>Perempuan</option>
                                                                </select>
                                                            </div>
                                                            <div class="mb-4">
                                                                <label for="nip" class="block text-sm font-medium text-gray-700">NIP</label>
                                                                <input type="text" id="nip" name="nip" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required value="{{ $wali->nip }}">
                                                            </div>
                                                        </div>
                                                        <div class="bg-gray-100 px-4 py-3 flex justify-end space-x-2">
                                                            <button type="button" class="bg-gray-500 text-white px-4 py-2 rounded" onclick="toggleModal('edit-{{ $wali->id_user }}')">Batal</button>
                                                            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Simpan</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>

                                          <div id="modal-{{ $wali->id_user }}" class="fixed inset-0 z-50 hidden overflow-y-auto">
                                            <div class="flex items-center justify-center min-h-screen px-4">
                                                <div class="bg-white rounded-lg overflow-hidden shadow-xl transform transition-all max-w-lg w-full">
                                                    <div class="bg-gray-100 px-4 py-2 flex justify-between items-center">
                                                        <h5 class="text-lg font-bold">Peringatan!!</h5>
                                                        <button class="text-gray-500" onclick="toggleModal('{{ $wali->id_user }}')">&times;</button>
                                                    </div>
                                                    <div class="px-4 py-6">
                                                        Apakah anda yakin ingin menghapus ini?
                                                    </div>
                                                    <div class="bg-gray-100 px-4 py-3 flex justify-end space-x-2">
                                                        <button class="bg-gray-500 text-white px-4 py-2 rounded" onclick="toggleModal('{{ $wali->id_user }}')">Tidak</button>
                                                        <button class="bg-red-500 text-white px-4 py-2 rounded" onclick="event.preventDefault(); document.getElementById('destroy-form{{ $wali->id_user }}').submit();">Yakin</button>
                                                    </div>
                                                    <form id="destroy-form{{ $wali->id_user }}" action="{{ route('operator.wali.destroy', $wali->id_user) }}" method="POST" class="hidden">
                                                        @csrf
                                                        @method('DELETE')
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                      @endforeach
                                  </tbody>
                              </table>
                          </div>
                      </div>

                      <!-- Modal Form -->
                      <div id="wali-modal" class="hidden fixed z-10 inset-0 overflow-y-auto">
                          <div class="flex items-center justify-center min-h-screen">
                              <div class="fixed inset-0 transition-opacity">
                                  <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
                              </div>
                              <div class="bg-white rounded-lg overflow-hidden shadow-xl transform transition-all sm:max-w-lg sm:w-full">
                                  <div class="px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                                      <h3 id="modal-title" class="text-lg leading-6 font-medium text-gray-900"></h3>
                                      <div class="mt-2">
                                          <form action="{{route ('operator.wali.store')}}" method="POST">
                                              @csrf
                                              <input type="hidden" id="form-mode">
                                              <input type="hidden" id="form-nuptk">
                                              <div class="mb-4">
                                                  <label for="nuptk" class="block text-sm font-medium text-gray-700">NUPTK</label>
                                                  <input type="text" id="nuptk" name="nuptk" class="mt-1 block w-full" required>
                                              </div>
                                              <div class="mb-4">
                                                <label for="nuptk" class="block text-sm font-medium text-gray-700">Email</label>
                                                <input type="text" id="email" name="email" class="mt-1 block w-full" required>
                                            </div>
                                            <div class="mb-4">
                                                <label for="nuptk" class="block text-sm font-medium text-gray-700">Password</label>
                                                <input type="password" id="password" name="password" class="mt-1 block w-full" required>
                                            </div>
                                             
                                              <div class="mb-4">
                                                  <label for="jenis_kelamin" class="block text-sm font-medium text-gray-700">Jenis Kelamin</label>
                                                  <select id="jenis_kelamin" name="jenis_kelamin" class="mt-1 block w-full" required>
                                                      <option value="laki laki">Laki Laki</option>
                                                      <option value="perempuan">Perempuan</option>
                                                  </select>
                                              </div>
                                              <div class="mb-4">
                                                  <label for="nip" class="block text-sm font-medium text-gray-700">NIP</label>
                                                  <input type="text" id="nip" name="nip" class="mt-1 block w-full" required>
                                              </div>
                                              <div>
                                                  <button type="submit" id="submit-btn" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">Submit</button>
                                                  <button type="button" id="cancel-btn" class="px-4 py-2 bg-gray-300 text-black rounded-md hover:bg-gray-400 ml-2">Cancel</button>
                                              </div>
                                          </form>
                                      </div>
                                  </div>
                              </div>
                          </div>
                      </div>

                      <div id="wali-modal" class="hidden fixed z-10 inset-0 overflow-y-auto">
                        <div class="flex items-center justify-center min-h-screen">
                            <div class="fixed inset-0 transition-opacity">
                                <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
                            </div>
                            <div class="bg-white rounded-lg overflow-hidden shadow-xl transform transition-all sm:max-w-lg sm:w-full">
                                <div class="px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                                    <h3 id="modal-title" class="text-lg leading-6 font-medium text-gray-900"></h3>
                                    <div class="mt-2">
                                        <form action="{{route('operator.wali.update', $wali->nuptk)}}" method="POST">
                                            @csrf
                                            <input type="hidden" id="form-mode">
                                            <input type="hidden" id="form-nuptk">
                                            <div class="mb-4">
                                                <label for="nuptk" class="block text-sm font-medium text-gray-700">NUPTK</label>
                                                <input type="text" id="nuptk" name="nuptk" class="mt-1 block w-full" required>
                                            </div>
                                            <div class="mb-4">
                                                <label for="nama" class="block text-sm font-medium text-gray-700">Nama</label>
                                                <input type="text" id="nama" name="nama" class="mt-1 block w-full" required>
                                            </div>
                                            <div class="mb-4">
                                                <label for="jenis_kelamin" class="block text-sm font-medium text-gray-700">Jenis Kelamin</label>
                                                <select id="jenis_kelamin" name="jenis_kelamin" class="mt-1 block w-full" required>
                                                    <option value="laki laki">Laki Laki</option>
                                                    <option value="perempuan">Perempuan</option>
                                                </select>
                                            </div>
                                            <div class="mb-4">
                                                <label for="nip" class="block text-sm font-medium text-gray-700">NIP</label>
                                                <input type="text" id="nip" name="nip" class="mt-1 block w-full" required>
                                            </div>
                                            <div>
                                                <button type="submit" id="submit-btn" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">Submit</button>
                                                <button type="button" id="cancel-btn" class="px-4 py-2 bg-gray-300 text-black rounded-md hover:bg-gray-400 ml-2">Cancel</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <script>
                        //script by davi
                        function toggleModal(nuptk) {
        const modal = document.getElementById('modal-' + nuptk);
        modal.classList.toggle('hidden');
    }
                        function toggleModalEdit(nuptk) {
        const modal = document.getElementById('modal-edit-' + nuptk);
        modal.classList.toggle('hidden');
    }
                    </script>
                      <script>
                      document.addEventListener('DOMContentLoaded', function() {
                          const waliModal = document.getElementById('wali-modal');
                          const waliFormElement = document.getElementById('wali-form-element');
                          const addWaliBtn = document.getElementById('add-wali-btn');
                          const cancelBtn = document.getElementById('cancel-btn');
                          const submitBtn = document.getElementById('submit-btn');
                          const formMode = document.getElementById('form-mode');
                          const formNuptk = document.getElementById('form-nuptk');
                          const modalTitle = document.getElementById('modal-title');

                          function showModal(mode, nuptk = null) {
                              formMode.value = mode;
                              formNuptk.value = nuptk;
                              waliModal.classList.remove('hidden');
                              if (mode === 'edit') {
                                  document.getElementById('nuptk').disabled = true;
                                  submitBtn.textContent = 'Update';
                                  modalTitle.textContent = 'Edit Wali Kelas';
                                  fetch(`/operator/wali/${nuptk}/edit`)
                                      .then(response => response.json())
                                      .then(wali => {
                                          document.getElementById('nuptk').value = wali.nuptk;
                                          document.getElementById('nama').value = wali.nama;
                                          document.getElementById('jenis_kelamin').value = wali.jenis_kelamin;
                                          document.getElementById('nip').value = wali.nip;
                                      })
                                      .catch(error => console.error('Error fetching wali kelas details:', error));
                              } else {
                                  document.getElementById('nuptk').disabled = false;
                                  submitBtn.textContent = 'Create';
                                  modalTitle.textContent = 'Add New Wali Kelas';
                                  waliFormElement.reset();
                              }
                          }

                          function hideModal() {
                              waliModal.classList.add('hidden');
                              waliFormElement.reset();
                          }

                          addWaliBtn.addEventListener('click', () => showModal('create'));
                          cancelBtn.addEventListener('click', hideModal);

                          waliFormElement.addEventListener('submit', function(e) {
                              e.preventDefault();
                              const formData = new FormData(waliFormElement);
                              const url = formMode.value === 'create' ? '/operator/wali' : `/operator/wali/${formNuptk.value}`;
                              const method = formMode.value === 'create' ? 'POST' : 'PUT';

                              fetch(url, {
                                  method: method,
                                  body: formData,
                                  headers: {
                                      'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
                                  }
                              })
                              .then(response => response.json())
                              .then(() => {
                                  hideModal();
                                  location.reload();
                              })
                              .catch(error => console.error('Error:', error));
                          });

                          window.editWali = function(nuptk) {
                              showModal('edit', nuptk);
                          }

                          window.deleteWali = function(nuptk) {
                              if (confirm('Are you sure you want to delete this Wali Kelas?')) {
                                  fetch(`/operator/wali/${nuptk}`, {
                                      method: 'DELETE',
                                      headers: {
                                          'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
                                      }
                                  })
                                  .then(() => location.reload())
                                  .catch(error => console.error('Error deleting wali kelas:', error));
                              }
                          }

                          // Close modal when clicking outside
                          waliModal.addEventListener('click', function(e) {
                              if (e.target === waliModal) {
                                  hideModal();
                              }
                          });
                      });
                      </script>

                <div
                    class="grid px-4 py-3 text-xs font-semibold tracking-wide text-gray-500 uppercase border-t dark:border-gray-700 bg-gray-50 sm:grid-cols-9 dark:text-gray-400 dark:bg-gray-800">
                    <span class="flex items-center col-span-3">
                        Showing 21-30 of 100
                    </span>
                    <span class="col-span-2"></span>
                    <!-- Pagination -->
                    <span class="flex col-span-4 mt-2 sm:mt-auto sm:justify-end">
                        <nav aria-label="Table navigation">
                            <ul class="inline-flex items-center">
                                <li>
                                    <button
                                        class="px-3 py-1 rounded-md rounded-l-lg focus:outline-none focus:shadow-outline-purple"
                                        aria-label="Previous">
                                        <svg aria-hidden="true" class="w-4 h-4 fill-current" viewBox="0 0 20 20">
                                            <path
                                                d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
                                                clip-rule="evenodd" fill-rule="evenodd"></path>
                                        </svg>
                                    </button>
                                </li>
                                <li>
                                    <button class="px-3 py-1 rounded-md focus:outline-none focus:shadow-outline-purple">
                                        1
                                    </button>
                                </li>
                                <li>
                                    <button class="px-3 py-1 rounded-md focus:outline-none focus:shadow-outline-purple">
                                        2
                                    </button>
                                </li>
                                <li>
                                    <button
                                        class="px-3 py-1 text-white transition-colors duration-150 bg-purple-600 border border-r-0 border-purple-600 rounded-md focus:outline-none focus:shadow-outline-purple">
                                        3
                                    </button>
                                </li>
                                <li>
                                    <button class="px-3 py-1 rounded-md focus:outline-none focus:shadow-outline-purple">
                                        4
                                    </button>
                                </li>
                                <li>
                                    <span class="px-3 py-1">...</span>
                                </li>
                                <li>
                                    <button class="px-3 py-1 rounded-md focus:outline-none focus:shadow-outline-purple">
                                        8
                                    </button>
                                </li>
                                <li>
                                    <button class="px-3 py-1 rounded-md focus:outline-none focus:shadow-outline-purple">
                                        9
                                    </button>
                                </li>
                                <li>
                                    <button
                                        class="px-3 py-1 rounded-md rounded-r-lg focus:outline-none focus:shadow-outline-purple"
                                        aria-label="Next">
                                        <svg class="w-4 h-4 fill-current" aria-hidden="true" viewBox="0 0 20 20">
                                            <path
                                                d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                                clip-rule="evenodd" fill-rule="evenodd"></path>
                                        </svg>
                                    </button>
                                </li>
                            </ul>
                        </nav>
                    </span>
                </div>
        </div>
    </div>
    </main>
    </div>
    </div>
    </body>
@endsection
