@extends('layouts.main')

@section('content')
    <div
      class="flex h-screen bg-gray-50 dark:bg-gray-900"
      :class="{ 'overflow-hidden': isSideMenuOpen }"
    >
      <!-- Desktop sidebar -->
      <aside
        class="z-20 hidden w-64 overflow-y-auto bg-white dark:bg-gray-800 md:block flex-shrink-0"
      >
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
              <a
                class="inline-flex items-center w-full text-sm font-semibold text-gray-800 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200 dark:text-gray-100"
                href="{{route('kesiswaan')}}"
              >
                <svg
                  class="w-5 h-5"
                  aria-hidden="true"
                  fill="none"
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="2"
                  viewBox="0 0 24 24"
                  stroke="currentColor"
                >
                  <path
                    d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"
                  ></path>
                </svg>
                <span class="ml-4">Dashboard</span>
              </a>
            </li>
          </ul>
          <ul>
            <li class="relative px-6 py-3">
              <button
                class="inline-flex items-center justify-between w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200"
                @click="togglePagesMenu"
                aria-haspopup="true"
              >
                <span class="inline-flex items-center">
                  <svg
                    class="w-5 h-5"
                    aria-hidden="true"
                    fill="none"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                  >
                    <path
                      d="M4 5a1 1 0 011-1h14a1 1 0 011 1v2a1 1 0 01-1 1H5a1 1 0 01-1-1V5zM4 13a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H5a1 1 0 01-1-1v-6zM16 13a1 1 0 011-1h2a1 1 0 011 1v6a1 1 0 01-1 1h-2a1 1 0 01-1-1v-6z"
                    ></path>
                  </svg>
                  <span class="ml-4">Laporan Absensi</span>
                </span>
                <svg
                  class="w-4 h-4"
                  aria-hidden="true"
                  fill="currentColor"
                  viewBox="0 0 20 20"
                >
                  <path
                    fill-rule="evenodd"
                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                    clip-rule="evenodd"
                  ></path>
                </svg>
              </button>
              <template x-if="isPagesMenuOpen">
                <ul
                  x-transition:enter="transition-all ease-in-out duration-300"
                  x-transition:enter-start="opacity-25 max-h-0"
                  x-transition:enter-end="opacity-100 max-h-xl"
                  x-transition:leave="transition-all ease-in-out duration-300"
                  x-transition:leave-start="opacity-100 max-h-xl"
                  x-transition:leave-end="opacity-0 max-h-0"
                  class="p-2 mt-2 space-y-2 overflow-hidden text-sm font-medium text-gray-500 rounded-md shadow-inner bg-gray-50 dark:text-gray-400 dark:bg-gray-900"
                  aria-label="submenu"
                >
                  <li
                    class="px-2 py-1 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200"
                  >
                    <a class="w-full" href="{{route('kesiswaan.laporankelas')}}">Laporan Kelas</a>
                  </li>
                </ul>
              </template>
            </li>
          </ul>
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
      <div
        x-show="isSideMenuOpen"
        x-transition:enter="transition ease-in-out duration-150"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-in-out duration-150"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        class="fixed inset-0 -z-10 flex items-end bg-black bg-opacity-50 sm:items-center sm:justify-center"
      ></div>
      <aside
        class="fixed inset-y-0 z-20 flex-shrink-0 w-64 mt-16 overflow-y-auto bg-white dark:bg-gray-800 md:hidden"
        x-show="isSideMenuOpen"
        x-transition:enter="transition ease-in-out duration-150"
        x-transition:enter-start="opacity-0 transform -translate-x-20"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-in-out duration-150"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0 transform -translate-x-20"
        @click.away="closeSideMenu"
        @keydown.escape="closeSideMenu"
      >
        <div class="py-4 text-gray-500 dark:text-gray-400">
          <a
            class="ml-6 text-lg font-bold text-gray-800 dark:text-gray-200"
            href="#"
          >
            Windmill
          </a>
          <ul class="mt-6">
            <li class="relative px-6 py-3">
              <span
                class="absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg rounded-br-lg"
                aria-hidden="true"
              ></span>
              <a
                class="inline-flex items-center w-full text-sm font-semibold text-gray-800 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200 dark:text-gray-100"
                href="{{route('kesiswaan')}}"
              >
                <svg
                  class="w-5 h-5"
                  aria-hidden="true"
                  fill="none"
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="2"
                  viewBox="0 0 24 24"
                  stroke="currentColor"
                >
                  <path
                    d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"
                  ></path>
                </svg>
                <span class="ml-4">Dashboard</span>
              </a>
            </li>
          </ul>
          <ul>

            <li class="relative px-6 py-3">
              <button
                class="inline-flex items-center justify-between w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200"
                @click="togglePagesMenu"
                aria-haspopup="true"
              >
                <span class="inline-flex items-center">
                  <svg
                    class="w-5 h-5"
                    aria-hidden="true"
                    fill="none"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                  >
                    <path
                      d="M4 5a1 1 0 011-1h14a1 1 0 011 1v2a1 1 0 01-1 1H5a1 1 0 01-1-1V5zM4 13a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H5a1 1 0 01-1-1v-6zM16 13a1 1 0 011-1h2a1 1 0 011 1v6a1 1 0 01-1 1h-2a1 1 0 01-1-1v-6z"
                    ></path>
                  </svg>
                  <span class="ml-4">Laporan Absensi</span>
                </span>
                <svg
                  class="w-4 h-4"
                  aria-hidden="true"
                  fill="currentColor"
                  viewBox="0 0 20 20"
                >
                  <path
                    fill-rule="evenodd"
                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                    clip-rule="evenodd"
                  ></path>
                </svg>
              </button>
              <template x-if="isPagesMenuOpen">
                <ul
                  x-transition:enter="transition-all ease-in-out duration-300"
                  x-transition:enter-start="opacity-25 max-h-0"
                  x-transition:enter-end="opacity-100 max-h-xl"
                  x-transition:leave="transition-all ease-in-out duration-300"
                  x-transition:leave-start="opacity-100 max-h-xl"
                  x-transition:leave-end="opacity-0 max-h-0"
                  class="p-2 mt-2 space-y-2 overflow-hidden text-sm font-medium text-gray-500 rounded-md shadow-inner bg-gray-50 dark:text-gray-400 dark:bg-gray-900"
                  aria-label="submenu"
                >
                  <li
                    class="px-2 py-1 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200"
                  >
                    <a class="w-full" href="{{route('kesiswaan.laporankelas')}}">Laporan Kelas</a>
                  </li>
                </ul>
              </template>
            </li>
          </ul>
          <div class="px-6 my-6">
            <button
              class="flex items-center justify-between px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"
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
            class="container flex items-center justify-between h-full px-6 mx-auto text-purple-600 dark:text-purple-300"
          >
            <!-- Mobile hamburger -->
            <button
              class="p-1 mr-5 -ml-1 rounded-md md:hidden focus:outline-none focus:shadow-outline-purple"
              @click="toggleSideMenu"
              aria-label="Menu"
            >
              <svg
                class="w-6 h-6"
                aria-hidden="true"
                fill="currentColor"
                viewBox="0 0 20 20"
              >
                <path
                  fill-rule="evenodd"
                  d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z"
                  clip-rule="evenodd"
                ></path>
              </svg>
            </button>
            <!-- Search input -->
            <div class="flex justify-center flex-1 lg:mr-32">
              <div
                class="relative w-full max-w-xl mr-6 focus-within:text-purple-500"
              >
                <div class="absolute inset-y-0 flex items-center pl-2">
                  <svg
                    class="w-4 h-4"
                    aria-hidden="true"
                    fill="currentColor"
                    viewBox="0 0 20 20"
                  >
                    <path
                      fill-rule="evenodd"
                      d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                      clip-rule="evenodd"
                    ></path>
                  </svg>
                </div>
                <input
                  class="w-full pl-8 pr-2 text-sm text-gray-700 placeholder-gray-600 bg-gray-100 border-0 rounded-md dark:placeholder-gray-500 dark:focus:shadow-outline-gray dark:focus:placeholder-gray-600 dark:bg-gray-700 dark:text-gray-200 focus:placeholder-gray-500 focus:bg-white focus:border-purple-300 focus:outline-none focus:shadow-outline-purple form-input"
                  type="text"
                  placeholder="Search for projects"
                  aria-label="Search"
                />
              </div>
            </div>
            <ul class="flex items-center flex-shrink-0 space-x-6">
              <!-- Theme toggler -->
              <li class="flex">
                <button
                  class="rounded-md focus:outline-none focus:shadow-outline-purple"
                  @click="toggleTheme"
                  aria-label="Toggle color mode"
                >
                  <template x-if="!dark">
                    <svg
                      class="w-5 h-5"
                      aria-hidden="true"
                      fill="currentColor"
                      viewBox="0 0 20 20"
                    >
                      <path
                        d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"
                      ></path>
                    </svg>
                  </template>
                  <template x-if="dark">
                    <svg
                      class="w-5 h-5"
                      aria-hidden="true"
                      fill="currentColor"
                      viewBox="0 0 20 20"
                    >
                      <path
                        fill-rule="evenodd"
                        d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z"
                        clip-rule="evenodd"
                      ></path>
                    </svg>
                  </template>
                </button>
              </li>
              <!-- Notifications menu -->
              <li class="relative">
                <button
                  class="relative align-middle rounded-md focus:outline-none focus:shadow-outline-purple"
                  @click="toggleNotificationsMenu"
                  @keydown.escape="closeNotificationsMenu"
                  aria-label="Notifications"
                  aria-haspopup="true"
                >
                  <svg
                    class="w-5 h-5"
                    aria-hidden="true"
                    fill="currentColor"
                    viewBox="0 0 20 20"
                  >
                    <path
                      d="M10 2a6 6 0 00-6 6v3.586l-.707.707A1 1 0 004 14h12a1 1 0 00.707-1.707L16 11.586V8a6 6 0 00-6-6zM10 18a3 3 0 01-3-3h6a3 3 0 01-3 3z"
                    ></path>
                  </svg>
                  <!-- Notification badge -->
                  <span
                    aria-hidden="true"
                    class="absolute top-0 right-0 inline-block w-3 h-3 transform translate-x-1 -translate-y-1 bg-red-600 border-2 border-white rounded-full dark:border-gray-800"
                  ></span>
                </button>
                <template x-if="isNotificationsMenuOpen">
                  <ul
                    x-transition:leave="transition ease-in duration-150"
                    x-transition:leave-start="opacity-100"
                    x-transition:leave-end="opacity-0"
                    @click.away="closeNotificationsMenu"
                    @keydown.escape="closeNotificationsMenu"
                    class="absolute right-0 w-56 p-2 mt-2 space-y-2 text-gray-600 bg-white border border-gray-100 rounded-md shadow-md dark:text-gray-300 dark:border-gray-700 dark:bg-gray-700"
                  >
                    <li class="flex">
                      <a
                        class="inline-flex items-center justify-between w-full px-2 py-1 text-sm font-semibold transition-colors duration-150 rounded-md hover:bg-gray-100 hover:text-gray-800 dark:hover:bg-gray-800 dark:hover:text-gray-200"
                        href="#"
                      >
                        <span>Messages</span>
                        <span
                          class="inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-red-600 bg-red-100 rounded-full dark:text-red-100 dark:bg-red-600"
                        >
                          13
                        </span>
                      </a>
                    </li>
                    <li class="flex">
                      <a
                        class="inline-flex items-center justify-between w-full px-2 py-1 text-sm font-semibold transition-colors duration-150 rounded-md hover:bg-gray-100 hover:text-gray-800 dark:hover:bg-gray-800 dark:hover:text-gray-200"
                        href="#"
                      >
                        <span>Sales</span>
                        <span
                          class="inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-red-600 bg-red-100 rounded-full dark:text-red-100 dark:bg-red-600"
                        >
                          2
                        </span>
                      </a>
                    </li>
                    <li class="flex">
                      <a
                        class="inline-flex items-center justify-between w-full px-2 py-1 text-sm font-semibold transition-colors duration-150 rounded-md hover:bg-gray-100 hover:text-gray-800 dark:hover:bg-gray-800 dark:hover:text-gray-200"
                        href="#"
                      >
                        <span>Alerts</span>
                      </a>
                    </li>
                  </ul>
                </template>
              </li>
              <!-- Profile menu -->
              <li class="relative">
                <button
                  class="align-middle rounded-full focus:shadow-outline-purple focus:outline-none"
                  @click="toggleProfileMenu"
                  @keydown.escape="closeProfileMenu"
                  aria-label="Account"
                  aria-haspopup="true"
                >
                  <img
                    class="object-cover w-8 h-8 rounded-full"
                    src="https://images.unsplash.com/photo-1502378735452-bc7d86632805?ixlib=rb-0.3.5&q=80&fm=jpg&crop=entropy&cs=tinysrgb&w=200&fit=max&s=aa3a807e1bbdfd4364d1f449eaa96d82"
                    alt=""
                    aria-hidden="true"
                  />
                </button>
                <template x-if="isProfileMenuOpen">
                  <ul
                    x-transition:leave="transition ease-in duration-150"
                    x-transition:leave-start="opacity-100"
                    x-transition:leave-end="opacity-0"
                    @click.away="closeProfileMenu"
                    @keydown.escape="closeProfileMenu"
                    class="absolute right-0 w-56 p-2 mt-2 space-y-2 text-gray-600 bg-white border border-gray-100 rounded-md shadow-md dark:border-gray-700 dark:text-gray-300 dark:bg-gray-700"
                    aria-label="submenu"
                  >
                    <li class="flex">
                      <a
                        class="inline-flex items-center w-full px-2 py-1 text-sm font-semibold transition-colors duration-150 rounded-md hover:bg-gray-100 hover:text-gray-800 dark:hover:bg-gray-800 dark:hover:text-gray-200"
                        href="#"
                      >
                        <svg
                          class="w-4 h-4 mr-3"
                          aria-hidden="true"
                          fill="none"
                          stroke-linecap="round"
                          stroke-linejoin="round"
                          stroke-width="2"
                          viewBox="0 0 24 24"
                          stroke="currentColor"
                        >
                          <path
                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"
                          ></path>
                        </svg>
                        <span>Profile</span>
                      </a>
                    </li>
                    <li class="flex">
                      <a
                        class="inline-flex items-center w-full px-2 py-1 text-sm font-semibold transition-colors duration-150 rounded-md hover:bg-gray-100 hover:text-gray-800 dark:hover:bg-gray-800 dark:hover:text-gray-200"
                        href="#"
                      >
                        <svg
                          class="w-4 h-4 mr-3"
                          aria-hidden="true"
                          fill="none"
                          stroke-linecap="round"
                          stroke-linejoin="round"
                          stroke-width="2"
                          viewBox="0 0 24 24"
                          stroke="currentColor"
                        >
                          <path
                            d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"
                          ></path>
                          <path d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                        <span>Settings</span>
                      </a>
                    </li>
                    <li class="flex">
                      <a
                        class="inline-flex items-center w-full px-2 py-1 text-sm font-semibold transition-colors duration-150 rounded-md hover:bg-gray-100 hover:text-gray-800 dark:hover:bg-gray-800 dark:hover:text-gray-200"
                        href="{{ route('logout') }}"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                      >
                        <svg
                          class="w-4 h-4 mr-3"
                          aria-hidden="true"
                          fill="none"
                          stroke-linecap="round"
                          stroke-linejoin="round"
                          stroke-width="2"
                          viewBox="0 0 24 24"
                          stroke="currentColor"
                        >
                          <path
                            d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"
                          ></path>
                        </svg>
                        <span>Logout</span>
                      </a>
                      <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
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
            <h2
              class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200"
            >
              Dashboard
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
            <div class="min-h-full">
                <header class="bg-white shadow">
                    <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
                        <h1 class="text-3xl font-bold tracking-tight text-gray-900">Detail Siswa</h1>
                    </div>
                </header>
                <main>
                    <div class="mx-auto max-w-7xl py-6 sm:px-6 lg:px-8">
                        <!-- Student Info Card -->
                        <div class="bg-white overflow-hidden shadow rounded-lg mb-6">
                            <div class="px-4 py-5 sm:p-6">
                                <div class="flex items-center">
                                    <img src={{ asset('storage/defaultuser/' . Auth::user()->foto) }} style="height: 35px; width: auto;" class="h-20 w-20 rounded-full mr-4">
                                    <div>
                                        <h2 class="text-2xl font-semibold text-gray-900">Name:{{ $studentData['name'] }}</h2>
                                        <p class="mt-1 max-w-2xl text-sm text-gray-500">NIS: {{ $studentData['nis'] }}</p>
                                        <p class="mt-1 max-w-2xl text-sm text-gray-500">Kelas: {{ $studentData['kelas'] }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Date Range Picker -->
                        <div class="bg-white overflow-hidden shadow rounded-lg mb-6">
                            <div class="px-4 py-5 sm:p-6">
                                <h3 class="text-lg font-medium leading-6 text-gray-900 mb-4">Pilih Rentang Tanggal</h3>
                                <form action="{{ route('kesiswaan.detailsiswa', $studentData['nis']) }}" method="GET" class="mt-5 sm:flex sm:items-center">
                                    <div class="w-full sm:max-w-xs mr-2">
                                        <label for="start" class="sr-only">Tanggal Mulai</label>
                                        <input type="date" name="start" id="start" value="{{ $startDate }}" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                    </div>
                                    <div class="w-full sm:max-w-xs mr-2">
                                        <label for="end" class="sr-only">Tanggal Akhir</label>
                                        <input type="date" name="end" id="end" value="{{ $endDate }}" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                    </div>
                                    <button type="submit" class="mt-3 inline-flex w-full items-center justify-center rounded-md border border-transparent bg-indigo-600 px-4 py-2 font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                                        Terapkan
                                    </button>
                                </form>
                            </div>
                        </div>

                        <!-- Attendance Summary -->
                        <div class="mt-8 grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-3">
                            @foreach ($attendanceCounts as $status => $count)
                            <div class="bg-white overflow-hidden shadow rounded-lg">
                                <div class="px-4 py-5 sm:p-6">
                                    <dt class="text-sm font-medium text-gray-500 truncate">{{ $status }}</dt>
                                    <dd class="mt-1 text-3xl font-semibold text-gray-900">{{ $count }}</dd>
                                    <dd class="mt-1 text-sm text-gray-600">{{ number_format($attendancePercentage["percentage".str_replace(['/', ' '], '', $status)], 2) }}%</dd>
                                </div>
                            </div>
                            @endforeach
                        </div>

                        {{-- <!-- Attendance Chart -->
                        <div class="mt-8 bg-white overflow-hidden shadow rounded-lg">
                            <div class="px-4 py-5 sm:p-6">
                                <h3 class="text-lg font-medium leading-6 text-gray-900 mb-4">Grafik Kehadiran</h3>
                                <canvas id="attendanceChart" class="w-full h-64"></canvas>
                            </div>
                        </div> --}}

                        <!-- Attendance Table -->
                        <div class="w-full overflow-hidden rounded-lg shadow-xs">
                            <div class="w-full overflow-x-auto">
                                <table class="w-full whitespace-no-wrap">
                                    <thead>
                                        <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                                            <th class="px-6 py-4">Tanggal</th>
                                            <th class="px-6 py-4">Status</th>
                                            <th class="px-6 py-4">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                                        @foreach ($present as $absensi)
                                        <tr class="text-gray-700 dark:text-gray-400 text-center">
                                            <td class="px-4 py-3 text-sm">{{ $absensi->date }}</td>
                                            <td class="px-4 py-3 text-sm">
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                                {{ $absensi->status == 'Hadir' ? 'bg-green-100 text-green-800' :
                                                ($absensi->status == 'Sakit' || $absensi->status == 'Izin' ? 'bg-yellow-100 text-yellow-800' :
                                                ($absensi->status == 'Alfa' ? 'bg-red-100 text-red-800' :
                                                ($absensi->status == 'Terlambat' ? 'bg-orange-100 text-orange-800' : 'bg-blue-100 text-blue-800'))) }}">
                                                    {{ $absensi->status }}
                                                </span>
                                            </td>
                                            <td class="px-4 py-3">
                                                <button data-modal-target="default-modal-{{ $absensi->id_absensi }}"
                                                    data-modal-toggle="default-modal-{{ $absensi->id_absensi }}"
                                                    class="bg-slate-700 text-white p-2 rounded-md">
                                                    Detail
                                                </button>
                                            </td>
                                        </tr>
                                        <!-- Modal -->
                                        <div id="default-modal-{{ $absensi->id_absensi }}" tabindex="-1" aria-hidden="true"
                                            class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                            <div class="relative p-4 w-full max-w-md max-h-full">
                                                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700 px-7 pb-7">
                                                    <div
                                                        class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                                                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Detail Absen</h3>
                                                        <button type="button"
                                                            data-modal-hide="default-modal-{{ $absensi->id_absensi }}"
                                                            class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white">
                                                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                                                fill="none" viewBox="0 0 14 14">
                                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                                    stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                                            </svg>
                                                            <span class="sr-only">Close modal</span>
                                                        </button>
                                                    </div>
                                                    <div class="pt-3">
                                                        <p><strong>Keterangan:</strong> {{ $absensi->status }}</p>
                                                        <p><strong>Tanggal Absen:</strong> {{ $absensi->date }}</p>
                                                        <p><strong>Jam Masuk:</strong> {{ $absensi->jam_masuk }}</p>
                                                        <p><strong>Jam Pulang:</strong> {{ $absensi->jam_pulang }}</p>
                                                        @if ($absensi->menit_keterlambatan > 0)
                                                        <p><strong>Keterlambatan:</strong> {{ $absensi->menit_keterlambatan }} Menit</p>
                                                        @endif
                                                        @if ($absensi->status == 'Hadir' || $absensi->status == 'Terlambat' || $absensi->status == 'TAP')
                                                        <div class="grid grid-cols-2 gap-2">
                                                            <p><strong>Foto Masuk:</strong>
                                                                @if ($absensi->photo_in > 0)
                                                                <img src="{{ asset('storage/uploads/absensi/' . $absensi->photo_in) }}" alt="">
                                                                @else
                                                                Data Tidak Tersedia
                                                                @endif
                                                            </p>
                                                            <p><strong>Foto Pulang:</strong>
                                                                @if ($absensi->photo_out > 0)
                                                                <img src="{{ asset('storage/uploads/absensi/' . $absensi->photo_out) }}" alt="">
                                                                @else
                                                                Data Tidak Tersedia
                                                                @endif
                                                            </p>
                                                        </div>
                                                        @endif
                                                        @if ($absensi->status == 'Sakit' || $absensi->status == 'Izin')
                                                        <p><strong>Foto Keterangan:</strong>
                                                            @if ($absensi->photo_in > 0)
                                                            <img src="{{ asset('storage/uploads/absensi/' . $absensi->photo_in) }}" alt="">
                                                            @else
                                                            Data Tidak Tersedia
                                                            @endif
                                                        </p>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>


                        <!-- Custom Pagination -->
                        <div class="flex items-center justify-between border-t border-gray-200 bg-white px-4 py-3 sm:px-6">
                            <div class="flex flex-1 justify-between sm:hidden">
                                {{ $present->previousPageUrl() ? '<a href="' . $present->previousPageUrl() . '" class="relative inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50">Previous</a>' : '' }}
                                {{ $present->nextPageUrl() ? '<a href="' . $present->nextPageUrl() . '" class="relative ml-3 inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50">Next</a>' : '' }}
                            </div>
                            <div class="hidden sm:flex sm:flex-1 sm:items-center sm:justify-between">
                                <div>
                                    <p class="text-sm text-gray-700">
                                        Showing
                                        <span class="font-medium">{{ $present->firstItem() }}</span>
                                        to
                                        <span class="font-medium">{{ $present->lastItem() }}</span>
                                        of
                                        <span clasds="font-medium">{{ $present->total() }}</span>
                                        results
                                    </p>
                                </div>
                                <div>
                                    <nav class="isolate inline-flex -space-x-px rounded-md shadow-sm" aria-label="Pagination">
                                        @if ($present->onFirstPage())
                                        <span class="relative inline-flex items-center rounded-l-md px-2 py-2 text-gray-400 ring-1 ring-inset ring-gray-300">
                                            <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd" d="M11.78 5.22a.75.75 0 0 1 0 1.06L8.06 10l3.72 3.72a.75.75 0 1 1-1.06 1.06l-4.25-4.25a.75.75 0 0 1 0-1.06l4.25-4.25a.75.75 0 0 1 1.06 0Z" clip-rule="evenodd" />
                                            </svg>
                                        </span>
                                        @else
                                        <a href="{{ $present->previousPageUrl() }}" class="relative inline-flex items-center rounded-l-md px-2 py-2 text-gray-400 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus:z-20">
                                            <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd" d="M11.78 5.22a.75.75 0 0 1 0 1.06L8.06 10l3.72 3.72a.75.75 0 1 1-1.06 1.06l-4.25-4.25a.75.75 0 0 1 0-1.06l4.25-4.25a.75.75 0 0 1 1.06 0Z" clip-rule="evenodd" />
                                            </svg>
                                        </a>
                                        @endif
                                        <!-- Show numbered pages -->
                                        @foreach ($present->links()->elements as $element)
                                            @if (is_string($element))
                                                <span class="relative inline-flex items-center px-4 py-2 text-sm font-semibold text-gray-700 ring-1 ring-inset ring-gray-300">{{ $element }}</span>
                                            @endif

                                            @if (is_array($element))
                                                @foreach ($element as $page => $url)
                                                    @if ($page == $present->currentPage())
                                                        <span aria-current="page" class="relative z-10 inline-flex items-center bg-indigo-600 px-4 py-2 text-sm font-semibold text-white">{{ $page }}</span>
                                                    @else
                                                        <a href="{{ $url }}" class="relative inline-flex items-center px-4 py-2 text-sm font-semibold text-gray-900 ring-1 ring-inset ring-gray-300 hover:bg-gray-50">{{ $page }}</a>
                                                    @endif
                                                @endforeach
                                            @endif
                                        @endforeach
                                        @if ($present->hasMorePages())
                                        <a href="{{ $present->nextPageUrl() }}" class="relative inline-flex items-center rounded-r-md px-2 py-2 text-gray-400 ring-1 ring-inset ring-gray-300 hover:bg-gray-50">
                                            <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd" d="M8.22 5.22a.75.75 0 0 1 1.06 0l4.25 4.25a.75.75 0 0 1 0 1.06l-4.25 4.25a.75.75 0 0 1-1.06-1.06L11.94 10 8.22 6.28a.75.75 0 0 1 0-1.06Z" clip-rule="evenodd" />
                                            </svg>
                                        </a>
                                        @else
                                        <span class="relative inline-flex items-center rounded-r-md px-2 py-2 text-gray-400 ring-1 ring-inset ring-gray-300">
                                            <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd" d="M8.22 5.22a.75.75 0 0 1 1.06 0l4.25 4.25a.75.75 0 0 1 0 1.06l-4.25 4.25a.75.75 0 0 1-1.06-1.06L11.94 10 8.22 6.28a.75.75 0 0 1 0-1.06Z" clip-rule="evenodd" />
                                            </svg>
                                        </span>
                                        @endif
                                    </nav>
                                </div>
                            </div>
                        </div>
                        {{-- <div>
                            {{ $present->links() }} <!-- Pagination links with the date filters -->
                        </div>                         --}}
                    </div>
                </main>
            </div>

            <script>
                var ctx = document.getElementById('attendanceChart').getContext('2d');
                var myChart = new Chart(ctx, {
                    type: 'pie',
                    data: {
                        labels: {!! json_encode(array_keys($attendanceCounts)) !!},
                        datasets: [{
                            data: {!! json_encode(array_values($attendanceCounts)) !!},
                            backgroundColor: [
                                'rgba(59, 130, 246, 0.8)', // blue-500
                                'rgba(16, 185, 129, 0.8)', // green-500
                                'rgba(245, 158, 11, 0.8)', // yellow-500
                                'rgba(239, 68, 68, 0.8)',  // red-500
                                'rgba(139, 92, 246, 0.8)'  // purple-500
                            ],
                            borderColor: [
                                'rgba(59, 130, 246, 1)',
                                'rgba(16, 185, 129, 1)',
                                'rgba(245, 158, 11, 1)',
                                'rgba(239, 68, 68, 1)',
                                'rgba(139, 92, 246, 1)'
                            ],
                            borderWidth: 1
                        }]
                    },
                    options: {
                        responsive: true,
                        plugins: {
                            legend: {
                                position: 'top',
                            },
                            title: {
                                display: true,
                                text: 'Distribusi Kehadiran'
                            }
                        }
                    }
                });
            </script>

      </div>
    </div>
  </body>
@endsection
