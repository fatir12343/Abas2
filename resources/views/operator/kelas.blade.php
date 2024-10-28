@extends('layouts.main')

@section('content')
    <div class="flex h-screen bg-gray-50 dark:bg-gray-900" :class="{ 'overflow-hidden': isSideMenuOpen }">
        <!-- Desktop sidebar -->
        <aside class="z-20 hidden w-64 overflow-y-auto bg-white dark:bg-gray-800 md:block flex-shrink-0">
            <div class="py-4 text-gray-500 dark:text-gray-400">
                <a
                  class="ml-6 text-lg font-bold text-gray-800 dark:text-gray-200"
                  href="#"
                >
                  ABAS
                </a>
                <ul class="mt-6">
                  <li class="relative px-6 py-3">
                    <span
                      class="absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg rounded-br-lg"
                      aria-hidden="true"
                    ></span>
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
                               href="{{route('walisiswa')}}">
                                  <svg class="w-5 h-5" aria-hidden="true" fill="none" stroke-linecap="round"
                                      stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                                      <path d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z"></path>
                                      <path d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z"></path>
                                  </svg>
                                  <span class="ml-4">Wali Siswa</span>
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
                <div class="px-6 my-6">
                  <button
                    class="flex items-center justify-between w-full px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"
                  >
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
                <a
                  class="ml-6 text-lg font-bold text-gray-800 dark:text-gray-200"
                  href="#"
                >
                  ABAS
                </a>
                <ul class="mt-6">
                  <li class="relative px-6 py-3">
                    <span
                      class="absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg rounded-br-lg"
                      aria-hidden="true"
                    ></span>
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
                                 href="{{route('walisiswa')}}">
                                  <svg class="w-5 h-5" aria-hidden="true" fill="none" stroke-linecap="round"
                                      stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                                      <path d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z"></path>
                                      <path d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z"></path>
                                  </svg>
                                  <span class="ml-4">Wali Siswa</span>
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
                <div class="px-6 my-6">
                  <button
                    class="flex items-center justify-between w-full px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"
                  >
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
                      List DaftarKelas
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


                    {{-- <button id="add-wali-btn"class="mt-4 px-2 py-2 bg-green-500 text-white rounded-md hover:bg-green-700">Add</button> --}}

                    <!-- New Table -->
                    {{-- <button id="add-kelas-btn"
                        class="mt-4 px-2 py-2 bg-green-500 text-white rounded-md hover:bg-green-700">Tambah Kelas</button> --}}

                    <!-- New Table -->

                    <!-- New Table -->
                    <div class="container mx-auto mt-8">
                        <div class="flex justify-end mb-4">
                            <button id="open-modal-btn" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">Tambah Kelas</button>

                            <button class="bg-red-500 text-white font-bold py-2 px-4 rounded" onclick="openModal()">
                                Import
                            </button>
                            {{-- <button id="add-kelas-btn" class="px-4 py-2 bg-green-500 text-white rounded-md hover:bg-green-700">Tambah Kelas</button> --}}
                        </div>
                        <!-- New Table -->
                        <div class="w-full overflow-hidden rounded-lg shadow-xs">
                            <div class="w-full overflow-x-auto">
                                <table class="w-full whitespace-no-wrap">
                                    <thead>
                                        <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                                            <th class="px-4 py-3">ID</th>
                                            <th class="px-4 py-3">Jurusan</th>
                                            <th class="px-4 py-3">Nomor Kelas</th>
                                            <th class="px-4 py-3">NIP</th>
                                            <th class="px-4 py-3">Tingkat</th>
                                            <th class="px-4 py-3">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody id="kelas-tbody" class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                                        @foreach ($kelas as $item)
                                        <tr class="text-gray-700 dark:text-gray-400">
                                            <td class="px-4 py-3 text-sm">{{ $item->id_kelas }}</td>
                                            <td class="px-4 py-3 text-sm">{{ $item->jurusan->id_jurusan }}</td>
                                            <td class="px-4 py-3 text-sm">{{ $item->nomor_kelas }}</td>
                                            <td class="px-4 py-3 text-sm">{{ $item->nip }}</td>
                                            <td class="px-4 py-3 text-sm">{{ $item->tingkat }}</td>
                                            <td class="px-4 py-3 text-sm">
                                                <div class="flex items-center space-x-4 text-sm">
                                                    <button
                                                        class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-purple-600 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray"
                                                        aria-label="Edit"
                                                        onclick="toggleEditModal('{{ $item->id_kelas }}')"
                                                    >
                                                        <svg
                                                            class="w-5 h-5"
                                                            aria-hidden="true"
                                                            fill="currentColor"
                                                            viewBox="0 0 20 20"
                                                        >
                                                            <path
                                                                d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"
                                                            ></path>
                                                        </svg>
                                                    </button>
                                                    <button
                                                        class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-purple-600 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray"
                                                        aria-label="Delete"
                                                        onclick="toggleDeleteModal('{{ $item->id_kelas }}')"
                                                    >
                                                        <svg
                                                            class="w-5 h-5"
                                                            aria-hidden="true"
                                                            fill="currentColor"
                                                            viewBox="0 0 20 20"
                                                        >
                                                            <path
                                                                fill-rule="evenodd"
                                                                d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                                                                clip-rule="evenodd"
                                                            ></path>
                                                        </svg>
                                                    </button>

                                                       <a href="{{ route('siswa', $item->id_kelas) }}"
                                                        class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-gray-500 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray"
                                                        aria-label="Detail"
                                                    >
                                                        <svg
                                                            class="w-5 h-5"
                                                            viewBox="0 0 24 24"
                                                            stroke-width="2"
                                                            stroke="currentColor"
                                                            fill="none"
                                                            stroke-linecap="round"
                                                            stroke-linejoin="round"
                                                        >
                                                            <path stroke="none" d="M0 0h24v24H0z" />
                                                            <circle cx="12" cy="12" r="2" />
                                                            <path d="M2 12l1.5 2a11 11 0 0 0 17 0l1.5 -2" />
                                                            <path d="M2 12l1.5 -2a11 11 0 0 1 17 0l1.5 2" />
                                                        </svg>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        @foreach ($kelas as $item)
                        <div id="delete-modal-{{ $item->id_kelas }}" class="fixed inset-0 z-50 hidden overflow-y-auto">
                            <div class="flex items-center justify-center min-h-screen px-4">
                                <div class="bg-white rounded-lg overflow-hidden shadow-xl transform transition-all max-w-lg w-full">
                                    <div class="bg-gray-100 px-4 py-2 flex justify-between items-center">
                                        <h5 class="text-lg font-bold">Peringatan!!</h5>
                                        <button class="text-gray-500" onclick="toggleDeleteModal('{{ $item->id_kelas }}')">&times;</button>
                                    </div>
                                    <div class="px-4 py-6">
                                        Apakah anda yakin ingin menghapus ini?
                                    </div>
                                    <div class="bg-gray-100 px-4 py-3 flex justify-end space-x-2">
                                        <button class="bg-gray-500 text-white px-4 py-2 rounded" onclick="toggleDeleteModal('{{ $item->id_kelas }}')">Tidak</button>
                                        <button class="bg-red-500 text-white px-4 py-2 rounded" onclick="event.preventDefault(); document.getElementById('destroy-form{{ $item->id_kelas }}').submit();">Yakin</button>
                                    </div>
                                    <form id="destroy-form{{ $item->id_kelas }}" action="{{ route('kelas.destroy', $item->id_kelas) }}" method="POST" class="hidden">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                </div>
                            </div>
                        </div>



                        <!-- Modal -->
                        <!-- Modal Structure -->
                        <div id="kelas-modal" class="fixed inset-0 z-10 hidden overflow-y-auto bg-gray-500 bg-opacity-75 transition-opacity">
                            <div class="flex items-center justify-center min-h-screen p-4">
                                <div class="bg-white rounded-lg overflow-hidden shadow-xl transform transition-all sm:max-w-lg sm:w-full">
                                    <div class="px-4 py-5 sm:p-6">
                                        <h3 id="modal-title" class="text-lg font-medium text-gray-900">Tambah Kelas</h3>
                                        <div class="mt-2">
                                            <form id="kelas-form-element" action="{{ route('kelas.store') }}" method="POST">
                                                @csrf
                                                <!-- Hidden Inputs if necessary -->
                                                <input type="hidden" id="form-id" name="form-id">
                                                <input type="hidden" id="form-mode" name="form-mode">

                                                <!-- Jurusan -->
                                                <div class="mb-4">
                                                    <label for="id_jurusan" class="block text-sm font-medium text-gray-700">Jurusan</label>
                                                    <select id="id_jurusan" name="id_jurusan" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50" required>
                                                        @foreach ($jurusan as $jur)
                                                            <option value="{{ $jur->id_jurusan }}">{{ $jur->id_jurusan }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>



                                                <!-- Nomor Kelas -->
                                                <div class="mb-4">
                                                    <label for="nomor_kelas" class="block text-sm font-medium text-gray-700">Nomor Kelas</label>
                                                    <input type="text" id="nomor_kelas" name="nomor_kelas" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50" required>
                                                </div>

                                                <div class="mb-4">
                                                    <label for="nip" class="block text-sm font-medium text-gray-700">NUPTK</label>
                                                    <select id="nip" name="nip" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50" required>
                                                        @foreach ($walikelas as $wali)
                                                            <option value="{{ $wali->nip }}">{{ $wali->nip}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <!-- Tingkat -->
                                                <div class="mb-4">
                                                    <label for="tingkat" class="block text-sm font-medium text-gray-700">Tingkat</label>
                                                    <input type="text" id="tingkat" name="tingkat" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50" required>
                                                </div>

                                                <!-- Buttons -->
                                                <div class="flex gap-2">
                                                    <button type="submit" id="submit-btn" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">Submit</button>
                                                    <button type="button" id="cancel-btn" class="px-4 py-2 bg-gray-300 text-black rounded-md hover:bg-gray-400">Cancel</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div id="edit-kelas-{{$item->id_kelas}}" class="fixed inset-0 z-10 hidden overflow-y-auto bg-gray-500 bg-opacity-75 transition-opacity">
                            <div class="flex items-center justify-center min-h-screen p-4">
                                <div class="bg-white rounded-lg overflow-hidden shadow-xl transform transition-all sm:max-w-lg sm:w-full">
                                    <div class="px-4 py-5 sm:p-6">
                                        <h3 class="text-lg font-medium text-gray-900">Edit Kelas</h3>
                                        <div class="mt-2">
                                            <form id="edit-kelas-form-{{$item->id_kelas}}" action="{{ route('kelas.update', ['kelas' => $item->id_kelas]) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <input type="hidden" name="id_kelas" value="{{$item->id_kelas}}">

                                                <!-- Jurusan -->
                                                <div class="mb-4">
                                                    <label for="edit_id_jurusan_{{$item->id_kelas}}" class="block text-sm font-medium text-gray-700">Jurusan</label>
                                                    <select id="edit_id_jurusan_{{$item->id_kelas}}" name="id_jurusan" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50">
                                                        @foreach ($jurusan as $jur)
                                                            <option value="{{ $jur->id_jurusan }}" {{ $item->id_jurusan == $jur->id_jurusan ? 'selected' : '' }}>
                                                                {{ $jur->id_jurusan }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <!-- Nomor Kelas -->
                                                <div class="mb-4">
                                                    <label for="edit_nomor_kelas_{{$item->id_kelas}}" class="block text-sm font-medium text-gray-700">Nomor Kelas</label>
                                                    <input type="text" id="edit_nomor_kelas_{{$item->id_kelas}}" name="nomor_kelas" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50" value="{{$item->nomor_kelas}}">
                                                </div>

                                                <!-- NUPTK -->
                                                <div class="mb-4">
                                                    <label for="edit_nip_{{$item->id_kelas}}" class="block text-sm font-medium text-gray-700">NUPTK</label>
                                                    <select id="nip" name="nip" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50" required>
                                                        @foreach ($walikelas as $wali)
                                                            <option value="{{ $wali->nip }}">{{ $wali->nip}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <!-- Tingkat -->
                                                <div class="mb-4">
                                                    <label for="edit_tingkat_{{$item->id_kelas}}" class="block text-sm font-medium text-gray-700">Tingkat</label>
                                                    <input type="text" id="edit_tingkat_{{$item->id_kelas}}" name="tingkat" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50" value="{{$item->tingkat}}" required>
                                                </div>

                                                <!-- Buttons -->
                                                <div class="flex gap-2">
                                                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">Submit</button>
                                                    <button type="button" onclick="closeEditModal({{$item->id_kelas}})" class="px-4 py-2 bg-gray-300 text-black rounded-md hover:bg-gray-400">Cancel</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                      <div id="importModal" class="fixed z-10 inset-0 overflow-y-auto hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true">
                        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                            <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>

                            <!-- Modal Content -->
                            <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                            <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                                <div class="sm:flex sm:items-start">
                                <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-blue-100 sm:mx-0 sm:h-10 sm:w-10">
                                    <!-- Icon Import -->
                                    <svg class="h-6 w-6 text-blue-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                    </svg>
                                </div>
                                <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                                    <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">Import Data Kelas</h3>
                                    <div class="mt-2">
                                    <form action="{{ route('kelas.import') }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="mb-4">
                                        <label class="block text-sm font-medium text-gray-700">Pilih File (.xlsx atau .csv)</label>
                                        <input type="file" name="importFile" accept=".xlsx, .csv" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                        </div>
                                        <div class="flex justify-end">
                                        <button type="button" class="mr-3 bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded" onclick="closeModal()">Batal</button>
                                        <button type="submit" class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded">Import</button>
                                        </div>
                                    </form>
                                    </div>
                                </div>
                                </div>
                            </div>
                            </div>
                        </div>
                        </div>

                        <!-- Tailwind Script for Modal Interaction -->
                        <script>
                        function openModal() {
                            document.getElementById('importModal').classList.remove('hidden');
                        }

                        function closeModal() {
                            document.getElementById('importModal').classList.add('hidden');
                        }
                        </script>
                        <script>
                            function closeEditModal(id) {
                                document.getElementById('edit-kelas-' + id).classList.add('hidden');
                            }
                        </script>

                        @endforeach



                        <script>
                            function toggleDeleteModal(id) {
                                const modal = document.getElementById(`delete-modal-${id}`);
                                modal.classList.toggle('hidden');
                            }
                                // Function to show the modal
                            function showModal() {
                                document.getElementById('kelas-modal').classList.remove('hidden');
                            }

                            function toggleEditModal(id) {
                                const modal = document.getElementById(`edit-kelas-${id}`);
                                modal.classList.toggle('hidden');
                            }


                            // Function to hide the modal
                            function hideModal() {
                                document.getElementById('kelas-modal').classList.add('hidden');
                            }

                            // Event listener for the cancel button
                            document.getElementById('cancel-btn').addEventListener('click', hideModal);

                            // Example usage: Show the modal when a button is clicked
                            document.getElementById('open-modal-btn').addEventListener('click', showModal);

                            // function editKelas(id, jurusan, wali, nomor, tingkat) {
                            //     document.getElementById('edit-kelas-form').action = `/kelas/${id}`;
                            //     document.getElementById('edit-form-id').value = id;
                            //     document.getElementById('edit_id_jurusan').value = jurusan;
                            //     document.getElementById('edit_NUPTK').value = wali;
                            //     document.getElementById('edit_nomor_kelas').value = nomor;
                            //     document.getElementById('edit_tingkat').value = tingkat;
                            //     showModal('edit-kelas-modal');
                            // }

                            document.getElementById('add-cancel-btn').addEventListener('click', () => hideModal('add-kelas-modal'));
                            document.getElementById('edit-cancel-btn').addEventListener('click', () => hideModal('edit-kelas-modal'));
                        </script>
                    </div>
                    <div class="grid px-4 py-3 text-xs font-semibold tracking-wide text-gray-500 uppercase border-t dark:border-gray-700 bg-gray-50 sm:grid-cols-9 dark:text-gray-400 dark:bg-gray-800">
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
                                        <button
                                            class="px-3 py-1 rounded-md focus:outline-none focus:shadow-outline-purple">
                                            1
                                        </button>
                                    </li>
                                    <li>
                                        <button
                                            class="px-3 py-1 rounded-md focus:outline-none focus:shadow-outline-purple">
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
                                        <button
                                            class="px-3 py-1 rounded-md focus:outline-none focus:shadow-outline-purple">
                                            4
                                        </button>
                                    </li>
                                    <li>
                                        <span class="px-3 py-1">...</span>
                                    </li>
                                    <li>
                                        <button
                                            class="px-3 py-1 rounded-md focus:outline-none focus:shadow-outline-purple">
                                            8
                                        </button>
                                    </li>
                                    <li>
                                        <button
                                            class="px-3 py-1 rounded-md focus:outline-none focus:shadow-outline-purple">
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
