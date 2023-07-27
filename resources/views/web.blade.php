@extends('layouts.web', ['nav' => true, 'banner' => true, 'footer' => true, 'cookie' => true, 'setting' => true, 'config' => $config])

@section('content')

@if(!empty($data['how_it_works']) && $data['how_it_works'] == 1)
<section id="how-it-works">
    <div class="skew skew-top mr-for-radius">
        <svg class="h-8 md:h-12 lg:h-20 w-full text-gray-50" viewbox="0 0 10 10" preserveaspectratio="none">
            <polygon fill="currentColor" points="0 0 10 10 0 10"></polygon>
        </svg>
    </div>
    <div class="skew skew-top ml-for-radius">
        <svg class="h-8 md:h-12 lg:h-20 w-full text-gray-50" viewbox="0 0 10 10" preserveaspectratio="none">
            <polygon fill="currentColor" points="0 10 10 0 10 10"></polygon>
        </svg>
    </div>
    <div class="py-20 bg-gray-50 radius-for-skewed">
        <div class="container mx-auto px-4">

            <div class="flex flex-wrap items-center">
                <div class="w-full lg:w-1/2 mb-12 lg:mb-0">
                    <div class="max-w-md lg:mx-auto">
                        <span class="text-{{ $config[11]->config_value }}-600 font-bold">{{ __($homePage[6]->section_content) }}</span>
                        <h2 class="my-2 text-4xl lg:text-5xl font-bold font-heading">
                            {{ __($homePage[7]->section_content) }}</h2>
                        <p class="mb-6 text-gray-500 leading-loose">
                            {{ __($homePage[8]->section_content) }}
                        </p>

                        <ul class="text-gray-500 font-bold">
                            <li class="flex mb-4">
                                <svg class="mr-2 w-6 h-6 text-{{ $config[11]->config_value }}-700" xmlns="http://www.w3.org/2000/svg"
                                    viewbox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                        clip-rule="evenodd"></path>
                                </svg>
                                <span>{{ __($homePage[9]->section_content) }}</span>
                            </li>
                            <li class="flex mb-4">
                                <svg class="mr-2 w-6 h-6 text-{{ $config[11]->config_value }}-700" xmlns="http://www.w3.org/2000/svg"
                                    viewbox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                        clip-rule="evenodd"></path>
                                </svg>
                                <span>{{ __($homePage[10]->section_content) }}</span>
                            </li>
                            <li class="flex mb-4">
                                <svg class="mr-2 w-6 h-6 text-{{ $config[11]->config_value }}-700" xmlns="http://www.w3.org/2000/svg"
                                    viewbox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                        clip-rule="evenodd"></path>
                                </svg>
                                <span>{{ __($homePage[11]->section_content) }}</span>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="w-full lg:w-1/2 flex flex-wrap -mx-4">
                    <div class="mb-8 lg:mb-0 w-full md:w-1/2 px-4">
                        <div class="mb-8 py-6 pl-6 pr-4 shadow rounded bg-white">
                            <span class="mb-4 inline-block p-3 rounded-lg bg-{{ $config[11]->config_value }}-100">
                                <svg class="w-8 h-8 text-{{ $config[11]->config_value }}-600" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                            </span>
                            <h4 class="mb-2 text-2xl font-bold font-heading">{{ __($homePage[12]->section_content) }}</h4>
                            <p class="text-gray-500 leading-loose">
                                {{ __($homePage[13]->section_content) }}</p>
                        </div>
                        <div class="py-6 pl-6 pr-4 shadow rounded bg-white">
                            <span class="mb-4 inline-block p-3 rounded-lg bg-{{ $config[11]->config_value }}-100">
                                <svg class="w-10 h-10 text-{{ $config[11]->config_value }}-600" xmlns="http://www.w3.org/2000/svg"
                                    viewbox="0 0 20 20" fill="currentColor">
                                    <path
                                        d="M3 1a1 1 0 000 2h1.22l.305 1.222a.997.997 0 00.01.042l1.358 5.43-.893.892C3.74 11.846 4.632 14 6.414 14H15a1 1 0 000-2H6.414l1-1H14a1 1 0 00.894-.553l3-6A1 1 0 0017 3H6.28l-.31-1.243A1 1 0 005 1H3zM16 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM6.5 18a1.5 1.5 0 100-3 1.5 1.5 0 000 3z">
                                    </path>
                                </svg>
                            </span>
                            <h4 class="mb-2 text-2xl font-bold font-heading">{{ __($homePage[14]->section_content) }}</h4>
                            <p class="text-gray-500 leading-loose">
                                {{ __($homePage[15]->section_content) }}
                            </p>
                        </div>
                    </div>
                    <div class="w-full md:w-1/2 lg:mt-20 px-4">
                        <div class="mb-8 py-6 pl-6 pr-4 shadow rounded-lg bg-white">
                            <span class="mb-4 inline-block p-3 rounded bg-{{ $config[11]->config_value }}-100">
                                <svg class="w-10 h-10 text-{{ $config[11]->config_value }}-600" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewbox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M16 4v12l-4-2-4 2V4M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                    </path>
                                </svg>
                            </span>
                            <h4 class="mb-2 text-2xl font-bold font-heading">{{ __($homePage[16]->section_content) }}</h4>
                            <p class="text-gray-500 leading-loose">
                                {{ __($homePage[17]->section_content) }}</p>
                        </div>
                        <div class="py-6 pl-6 pr-4 shadow rounded-lg bg-white">
                            <span class="mb-4 inline-block p-3 rounded bg-{{ $config[11]->config_value }}-100">
                                <svg class="w-10 h-10 text-{{ $config[11]->config_value }}-600" xmlns="http://www.w3.org/2000/svg"
                                    viewbox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M6 6V5a3 3 0 013-3h2a3 3 0 013 3v1h2a2 2 0 012 2v3.57A22.952 22.952 0 0110 13a22.95 22.95 0 01-8-1.43V8a2 2 0 012-2h2zm2-1a1 1 0 011-1h2a1 1 0 011 1v1H8V5zm1 5a1 1 0 011-1h.01a1 1 0 110 2H10a1 1 0 01-1-1z"
                                        clip-rule="evenodd"></path>
                                    <path
                                        d="M2 13.692V16a2 2 0 002 2h12a2 2 0 002-2v-2.308A24.974 24.974 0 0110 15c-2.796 0-5.487-.46-8-1.308z">
                                    </path>
                                </svg>
                            </span>
                            <h4 class="mb-2 text-2xl font-bold font-heading">{{ __($homePage[18]->section_content) }}</h4>
                            <p class="text-gray-500 leading-loose">
                                {{ __($homePage[19]->section_content) }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="skew skew-bottom mr-for-radius">
        <svg class="h-8 md:h-12 lg:h-20 w-full text-gray-50" viewbox="0 0 10 10" preserveaspectratio="none">
            <polygon fill="currentColor" points="0 0 10 0 0 10"></polygon>
        </svg>
    </div>
    <div class="skew skew-bottom ml-for-radius">
        <svg class="h-8 md:h-12 lg:h-20 w-full text-gray-50" viewbox="0 0 10 10" preserveaspectratio="none">
            <polygon fill="currentColor" points="0 0 10 0 10 10"></polygon>
        </svg>
    </div>
</section>
@endif


@if(!empty($data['features']) && $data['features'] == 1)
<section id="features">
    <div class="skew skew-top mr-for-radius">
        <svg class="h-8 md:h-12 lg:h-20 w-full text-gray-50" viewBox="0 0 10 10" preserveAspectRatio="none">
            <polygon fill="currentColor" points="0 0 10 10 0 10"></polygon>
        </svg>
    </div>
    <div class="skew skew-top ml-for-radius">
        <svg class="h-8 md:h-12 lg:h-20 w-full text-gray-50" viewBox="0 0 10 10" preserveAspectRatio="none">
            <polygon fill="currentColor" points="0 10 10 0 10 10"></polygon>
        </svg>
    </div>
    <div class="py-20 bg-gray-50 radius-for-skewed">
        <div class="container mx-auto px-4">
            <div class="mb-16 max-w-md mx-auto text-center">
                <span class="text-{{ $config[11]->config_value }}-600 font-bold">{{ __($homePage[20]->section_content) }}</span>
                <h2 class="text-4xl md:text-5xl font-bold">{{ __($homePage[21]->section_content) }}</h2>
            </div>
            <div class="flex flex-wrap -mx-4 shadow">
                <div class="mb-12 lg:mb-0 w-full md:w-1/2 lg:w-1/4 px-4 py-6 bg-white rounded ">
                    <span class="mb-4 md:mb-6 inline-block bg-{{ $config[11]->config_value }}-100 p-3 text-{{ $config[11]->config_value }}-500 rounded">
                        <svg class="w-8 h-8" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                        </svg>
                    </span>
                    <h4 class="mb-4 text-2xl font-bold font-heading">{{ __($homePage[22]->section_content) }}</h4>
                    <p class="text-gray-500 leading-loose">
                        {{ __($homePage[23]->section_content) }}</p>
                </div>
                <div class="mb-12 lg:mb-0 w-full md:w-1/2 lg:w-1/4 px-4 py-6 bg-white rounded ">
                    <span class="mb-4 md:mb-6 inline-block bg-{{ $config[11]->config_value }}-100 p-3 text-{{ $config[11]->config_value }}-500 rounded">
                        <svg class="w-8 h-8" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                    </span>
                    <h4 class="mb-4 text-2xl font-bold font-heading">{{ __($homePage[24]->section_content) }}</h4>
                    <p class="text-gray-500 leading-loose">
                        {{ __($homePage[25]->section_content) }}
                    </p>
                </div>
                <div class="mb-12 lg:mb-0 w-full md:w-1/2 lg:w-1/4 px-4 py-6 bg-white rounded ">
                    <span class="mb-4 md:mb-6 inline-block bg-{{ $config[11]->config_value }}-100 p-3 text-{{ $config[11]->config_value }}-500 rounded">

                        <svg class="w-8 h-8" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>

                    </span>
                    <h4 class="mb-4 text-2xl font-bold font-heading">{{ __($homePage[26]->section_content) }}</h4>
                    <p class="text-gray-500 leading-loose">
                        {{ __($homePage[27]->section_content) }}</p>
                </div>
                <div class="w-full md:w-1/2 lg:w-1/4 px-4 py-6 bg-white rounded ">
                    <span class="mb-4 md:mb-6 inline-block bg-{{ $config[11]->config_value }}-100 p-3 text-{{ $config[11]->config_value }}-500 rounded">

                        <svg class="w-8 h-8" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                        </svg>

                    </span>
                    <h4 class="mb-4 text-2xl font-bold font-heading">{{ __($homePage[28]->section_content) }}</h4>
                    <p class="text-gray-500 leading-loose">
                        {{ __($homePage[29]->section_content) }}</p>
                </div>
            </div>


            <div class="flex flex-wrap my-3 shadow -mx-4">
                <div class="mb-12 lg:mb-0 w-full md:w-1/2 lg:w-1/4 px-4 py-6 bg-white rounded">
                    <span class="mb-4 md:mb-6 inline-block bg-{{ $config[11]->config_value }}-100 p-3 text-{{ $config[11]->config_value }}-500 rounded">

                        <svg class="w-8 h-8" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>

                    </span>
                    <h4 class="mb-4 text-2xl font-bold font-heading">{{ __($homePage[30]->section_content) }}</h4>
                    <p class="text-gray-500 leading-loose">
                        {{ __($homePage[31]->section_content) }}
                    </p>
                </div>
                <div class="mb-12 lg:mb-0 w-full md:w-1/2 lg:w-1/4 px-4 py-6 bg-white rounded">
                    <span class="mb-4 md:mb-6 inline-block bg-{{ $config[11]->config_value }}-100 p-3 text-{{ $config[11]->config_value }}-500 rounded">

                        <svg class="w-8 h-8" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>

                    </span>
                    <h4 class="mb-4 text-2xl font-bold font-heading">{{ __($homePage[32]->section_content) }}</h4>
                    <p class="text-gray-500 leading-loose">
                        {{ __($homePage[33]->section_content) }}</p>
                </div>


                <div class="mb-12 lg:mb-0 w-full md:w-1/2 lg:w-1/4 px-4 py-6 bg-white rounded">
                    <span class="mb-4 md:mb-6 inline-block bg-{{ $config[11]->config_value }}-100 p-3 text-{{ $config[11]->config_value }}-500 rounded">

                        <svg class="w-8 h-8" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7" />
                        </svg>

                    </span>
                    <h4 class="mb-4 text-2xl font-bold font-heading">{{ __($homePage[34]->section_content) }}</h4>
                    <p class="text-gray-500 leading-loose">
                        {{ __($homePage[35]->section_content) }}
                    </p>
                </div>


                <div class="w-full md:w-1/2 lg:w-1/4 px-4 py-6 bg-white rounded ">
                    <span class="mb-4 md:mb-6 inline-block bg-{{ $config[11]->config_value }}-100 p-3 text-{{ $config[11]->config_value }}-500 rounded">

                        <svg class="w-8 h-8" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                        </svg>


                    </span>
                    <h4 class="mb-4 text-2xl font-bold font-heading">{{ __($homePage[36]->section_content) }}</h4>
                    <p class="text-gray-500 leading-loose">
                        {{ __($homePage[37]->section_content) }}
                    </p>
                </div>
            </div>



            <div class="flex flex-wrap my-3 shadow -mx-4">
                <div class="mb-12 lg:mb-0 w-full md:w-1/2 lg:w-1/4 px-4 py-6 bg-white rounded ">
                    <span class="mb-4 md:mb-6 inline-block bg-{{ $config[11]->config_value }}-100 p-3 text-{{ $config[11]->config_value }}-500 rounded">

                        <svg class="w-8 h-8" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01" />
                        </svg>

                    </span>
                    <h4 class="mb-4 text-2xl font-bold font-heading">{{ __($homePage[38]->section_content) }}</h4>
                    <p class="text-gray-500 leading-loose">
                        {{ __($homePage[39]->section_content) }}</p>
                </div>


                <div class="mb-12 lg:mb-0 w-full md:w-1/2 lg:w-1/4 px-4 py-6 bg-white rounded ">
                    <span class="mb-4 md:mb-6 inline-block bg-{{ $config[11]->config_value }}-100 p-3 text-{{ $config[11]->config_value }}-500 rounded">

                        <svg class="w-8 h-8" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>

                    </span>
                    <h4 class="mb-4 text-2xl font-bold font-heading">{{ __($homePage[40]->section_content) }}</h4>
                    <p class="text-gray-500 leading-loose">
                        {{ __($homePage[41]->section_content) }}</p>
                </div>
                <div class="mb-12 lg:mb-0 w-full md:w-1/2 lg:w-1/4 px-4 py-6 bg-white rounded ">
                    <span class="mb-4 md:mb-6 inline-block bg-{{ $config[11]->config_value }}-100 p-3 text-{{ $config[11]->config_value }}-500 rounded">

                        <svg class="w-8 h-8" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 10V3L4 14h7v7l9-11h-7z" />
                        </svg>

                    </span>
                    <h4 class="mb-4 text-2xl font-bold font-heading">{{ __($homePage[42]->section_content) }}</h4>
                    <p class="text-gray-500 leading-loose">
                        {{ __($homePage[43]->section_content) }}
                    </p>
                </div>
                <div class="w-full md:w-1/2 lg:w-1/4 px-4 py-6 bg-white rounded">
                    <span class="mb-4 md:mb-6 inline-block bg-{{ $config[11]->config_value }}-100 p-3 text-{{ $config[11]->config_value }}-500 rounded">

                        <svg class="w-8 h-8" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1" />
                        </svg>

                    </span>
                    <h4 class="mb-4 text-2xl font-bold font-heading">{{ __($homePage[44]->section_content) }}</h4>
                    <p class="text-gray-500 leading-loose">
                        {{ __($homePage[45]->section_content) }}
                    </p>
                </div>
            </div>

        </div>
    </div>
    <div class="skew skew-bottom mr-for-radius">
        <svg class="h-8 md:h-12 lg:h-20 w-full text-gray-50" viewBox="0 0 10 10" preserveAspectRatio="none">
            <polygon fill="currentColor" points="0 0 10 0 0 10"></polygon>
        </svg>
    </div>
    <div class="skew skew-bottom ml-for-radius">
        <svg class="h-8 md:h-12 lg:h-20 w-full text-gray-50" viewBox="0 0 10 10" preserveAspectRatio="none">
            <polygon fill="currentColor" points="0 0 10 0 10 10"></polygon>
        </svg>
    </div>
</section>
@endif



@if(!empty($data['pricing']) && $data['pricing'] == 1)
<section id="pricing">
    <div class="skew skew-top mr-for-radius">
        <svg class="h-8 md:h-12 lg:h-20 w-full text-gray-50" viewbox="0 0 10 10" preserveaspectratio="none">
            <polygon fill="currentColor" points="0 0 10 10 0 10"></polygon>
        </svg>
    </div>
    <div class="skew skew-top ml-for-radius">
        <svg class="h-8 md:h-12 lg:h-20 w-full text-gray-50" viewbox="0 0 10 10" preserveaspectratio="none">
            <polygon fill="currentColor" points="0 10 10 0 10 10"></polygon>
        </svg>
    </div>
    <div class="py-20 bg-gray-50 radius-for-skewed">
        <div class="container mx-auto px-4">
            <div class="max-w-2xl mx-auto text-center mb-16">
                <span class="text-{{ $config[11]->config_value }}-600 font-bold">{{ __($homePage[46]->section_content) }}</span>
                <h2 class="mb-2 text-4xl lg:text-5xl font-bold font-heading">{{ __($homePage[47]->section_content) }}</h2>
                <p class="mb-6 text-gray-500">{{ __($homePage[48]->section_content) }}</p>
            </div>

            <div class="flex flex-wrap -mx-4">
                @foreach ($plans as $plan)
                <div class="w-full md:w-1/2 lg:w-1/3 px-4 mb-8 lg:mb-2">
                    <div class="p-8 bg-{{ $plan->recommended == '1' ? $config[11]->config_value.'-600' : 'white' }} shadow rounded">
                        <h4
                            class="mb-2 text-2xl font-bold {{ $plan->recommended == '1' ? 'text-white' : 'font-heading' }}">
                            {{ $plan->plan_name }}</h4>
                        <span
                            class="text-6xl font-bold {{ $plan->recommended == '1' ? 'text-white' : '' }}">{{ $plan->plan_price == '0' ? '' : $currency->symbol }}{{ $plan->plan_price == '0' ? 'Free' : $plan->plan_price }}</span>
                        <span class="{{ $plan->recommended == '1' ? 'text-gray-50' : 'text-gray-500' }} text-xs">
                            @if ($plan->validity == '9999')
                            {{ __('/') }}{{ __('Forever') }}</span>
                            @endif
                            @if ($plan->validity == '31')
                            {{ __('/') }}{{ __('Monthly') }}</span>
                            @endif
                            @if ($plan->validity == '366')
                            {{ __('/') }}{{ __('Yearly') }}</span>
                            @endif
                            @if ($plan->validity > '1' && $plan->validity != '31' && $plan->validity != '366' && $plan->validity != '9999')
                            {{ '/'.$plan->validity.' '.__('Days') }}</span>
                            @endif
                        <p
                            class="mt-3 mb-6 {{ $plan->recommended == '1' ? 'text-gray-50' : 'text-gray-500' }} leading-loose">
                            {{ $plan->plan_description }}</p>
                        <ul class="mb-6 {{ $plan->recommended == '1' ? 'text-gray-50' : 'text-gray-500' }}">
                            <li class="mb-2 flex">
                                <svg class="mr-2 w-5 h-5 {{ $plan->recommended == '1' ? 'text-'.$config[11]->config_value.'-400' : 'text-'.$config[11]->config_value.'-600'}}"
                                    xmlns="http://www.w3.org/2000/svg" viewbox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                        clip-rule="evenodd"></path>
                                </svg>
                                <span>{{ $plan->no_of_vcards == '999' ? 'Unlimited' : $plan->no_of_vcards }}
                                    {{ __('vCards') }}</span>
                            </li>
                            <li class="mb-2 flex">
                                <svg class="mr-2 w-5 h-5 {{ $plan->recommended == '1' ? 'text-'.$config[11]->config_value.'-400' : 'text-'.$config[11]->config_value.'-600'}}"
                                    xmlns="http://www.w3.org/2000/svg" viewbox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                        clip-rule="evenodd"></path>
                                </svg>
                                <span>{{ $plan->no_of_services == '999' ? 'Unlimited' : $plan->no_of_services }}
                                    {{ __('Services/Products') }}</span>
                            </li>
                            <li class="mb-2 flex">
                                <svg class="mr-2 w-5 h-5 {{ $plan->recommended == '1' ? 'text-'.$config[11]->config_value.'-400' : 'text-'.$config[11]->config_value.'-600'}}"
                                    xmlns="http://www.w3.org/2000/svg" viewbox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                        clip-rule="evenodd"></path>
                                </svg>
                                <span>{{ $plan->no_of_galleries == '999' ? 'Unlimited' : $plan->no_of_galleries }}
                                    {{ __('Galleries') }}</span>
                            </li>
                            <li class="mb-2 flex">
                                <svg class="mr-2 w-5 h-5 {{ $plan->recommended == '1' ? 'text-'.$config[11]->config_value.'-400' : 'text-'.$config[11]->config_value.'-600'}}"
                                    xmlns="http://www.w3.org/2000/svg" viewbox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                        clip-rule="evenodd"></path>
                                </svg>
                                <span>{{ $plan->no_of_features == '999' ? 'Unlimited' : $plan->no_of_features }}
                                    {{ __('Card Features') }}</span>
                            </li>
                            <li class="mb-2 flex">
                                <svg class="mr-2 w-5 h-5 {{ $plan->recommended == '1' ? 'text-'.$config[11]->config_value.'-400' : 'text-'.$config[11]->config_value.'-600'}}"
                                    xmlns="http://www.w3.org/2000/svg" viewbox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                        clip-rule="evenodd"></path>
                                </svg>
                                <span>{{ $plan->no_of_payments == '999' ? 'Unlimited' : $plan->no_of_payments }}
                                    {{ __('Payment Listed') }}</span>
                            </li>
                            <li class="mb-2 flex">
                                <svg class="mr-2 w-5 h-5 {{ $plan->recommended == '1' ? 'text-'.$config[11]->config_value.'-400' : 'text-'.$config[11]->config_value.'-600' }}"
                                    xmlns="http://www.w3.org/2000/svg" viewbox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                        clip-rule="evenodd"></path>
                                </svg>
                                <span>{{ $plan->personalized_link == '0' ? 'No' : '' }} {{ __('Personalized Link') }}
                                    {{ $plan->personalized_link == '1' ? 'Available' : '' }}</span>
                            </li>
                            <li class="mb-2 flex">
                                <svg class="mr-2 w-5 h-5 {{ $plan->recommended == '1' ? 'text-'.$config[11]->config_value.'-400' : 'text-'.$config[11]->config_value.'-600'}}"
                                    xmlns="http://www.w3.org/2000/svg" viewbox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                        clip-rule="evenodd"></path>
                                </svg>
                                <span>{{ $plan->hide_branding == '0' ? 'No' : '' }} {{ __('Hide Branding') }}
                                    {{ $plan->hide_branding == '1' ? 'Available' : '' }}</span>
                            </li>
                            <li class="mb-2 flex">
                                <svg class="mr-2 w-5 h-5 {{ $plan->recommended == '1' ? 'text-'.$config[11]->config_value.'-400' : 'text-'.$config[11]->config_value.'-600'}}"
                                    xmlns="http://www.w3.org/2000/svg" viewbox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                        clip-rule="evenodd"></path>
                                </svg>
                                <span>{{ $plan->free_setup == '0' ? 'No' : '' }} {{ __('Free Setup') }}
                                    {{ $plan->free_setup == '1' ? 'Available' : '' }}</span>
                            </li>
                            <li class="mb-2 flex">
                                <svg class="mr-2 w-5 h-5 {{ $plan->recommended == '1' ? 'text-'.$config[11]->config_value.'-400' : 'text-'.$config[11]->config_value.'-600'}}"
                                    xmlns="http://www.w3.org/2000/svg" viewbox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                        clip-rule="evenodd"></path>
                                </svg>
                                <span>{{ $plan->free_support == '0' ? 'No' : '' }} {{ __('Free Support') }}
                                    {{ $plan->free_support == '1' ? 'Available' : '' }}</span>
                            </li>
                            <li class="mb-2 flex">
                                <svg class="mr-2 w-5 h-5 {{ $plan->is_show_ad == '1' ? 'text-'.$config[11]->config_value.'-400' : 'text-'.$config[11]->config_value.'-600'}}"
                                    xmlns="http://www.w3.org/2000/svg" viewbox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                        clip-rule="evenodd"></path>
                                </svg>
                                <span>{{ $plan->is_show_ad == '1' ? __('With Advertisement') : __('No Advertisement') }}</span>
                            </li>
                            <li class="mb-2 flex">
                                <svg class="mr-2 w-5 h-5 {{ $plan->with_sample_card == '1' ? 'text-'.$config[11]->config_value.'-400' : 'text-'.$config[11]->config_value.'-600'}}"
                                    xmlns="http://www.w3.org/2000/svg" viewbox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                        clip-rule="evenodd"></path>
                                </svg>
                                <span>{{ $plan->with_sample_card == '1' ? __('With Sample Card') : __('No Sample Card') }}</span>
                            </li>
                        </ul>
                        <a class="inline-block text-center py-2 px-4 w-full rounded-l-xl rounded-t-xl {{ $plan->recommended == '1' ? 'bg-white hover:bg-gray-100' : 'bg-'.$config[11]->config_value.'-600 hover:bg-'.$config[11]->config_value.'-700 text-white'}} font-bold leading-loose transition duration-200"
                            href="">{{ __('Get Started') }}</a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    <div class="skew skew-bottom mr-for-radius">
        <svg class="h-8 md:h-12 lg:h-20 w-full text-gray-50" viewbox="0 0 10 10" preserveaspectratio="none">
            <polygon fill="currentColor" points="0 0 10 0 0 10"></polygon>
        </svg>
    </div>
    <div class="skew skew-bottom ml-for-radius">
        <svg class="h-8 md:h-12 lg:h-20 w-full text-gray-50" viewbox="0 0 10 10" preserveaspectratio="none">
            <polygon fill="currentColor" points="0 0 10 0 10 10"></polygon>
        </svg>
    </div>
</section>
@endif

@include('layouts.partials.adsense')
@endsection
