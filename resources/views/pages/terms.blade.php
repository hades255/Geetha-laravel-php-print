@extends('layouts.web', ['nav' => true, 'banner' => false, 'footer' => true, 'cookie' => true, 'setting' => true,
'title' => 'Terms and Conditions'])

@section('content')
<div>
    <section class="text-gray-700">
        <div class="container px-5 py-24 mx-auto">
            <div class="text-center mb-20">
                <h1 class="sm:text-3xl text-1xl font-large text-center title-font text-gray-900 mb-4">
                    {{ $termsPage[0]->section_content }}
                </h1>
            </div>

            <div class="flex flex-wrap lg:w-full sm:mx-auto sm:mb-2">
                <div class="w-full lg:w-full">
                    <div class="px-3 lg:px-5 lg:-mt-4 mb-5 lg:mb-0">
                        <p
                            class="mb-5 primary-color-blackish-blue-opacity font-medium md:text-sm 2xl:text-3xl px-4 lg:px-0 2xl:px-4 lg:pr-3 mt-2 lg:-mt-1 2xl:mt-2 2xl:pb-64">
                            {{ $termsPage[1]->section_content }}</p>
                        <p
                            class="mb-5 primary-color-blackish-blue-opacity font-medium md:text-sm 2xl:text-3xl px-4 lg:px-0 2xl:px-4 lg:pr-3 mt-2 lg:-mt-1 2xl:mt-2 2xl:pb-64">
                            {{ $termsPage[2]->section_content }}</p>
                        <p
                            class="mb-5 primary-color-blackish-blue-opacity font-medium md:text-sm 2xl:text-3xl px-4 lg:px-0 2xl:px-4 lg:pr-3 mt-2 lg:-mt-1 2xl:mt-2 2xl:pb-64">
                            {{ $termsPage[3]->section_content }}
                        </p>
                        <p
                            class="mb-5 primary-color-blackish-blue-opacity font-medium md:text-sm 2xl:text-3xl px-4 lg:px-0 2xl:px-4 lg:pr-3 mt-2 lg:-mt-1 2xl:mt-2 2xl:pb-64">
                            {{ $termsPage[4]->section_content }}</p>

                        <p
                            class="primary-color-blackish-blue text-xl 2xl:text-4xl font-semibold px-4 lg:px-0 -mt-2 lg:-mt-0">
                            {{ $termsPage[5]->section_content }}
                        </p>
                        <br />
                        <p
                            class="mb-5 primary-color-blackish-blue-opacity font-medium md:text-sm 2xl:text-3xl px-4 lg:px-0 2xl:px-4 lg:pr-3 mt-2 lg:-mt-1 2xl:mt-2 2xl:pb-64">
                            {{ $termsPage[6]->section_content }}</p>
                        <p
                            class="mb-5 primary-color-blackish-blue-opacity font-medium md:text-sm 2xl:text-3xl px-4 lg:px-0 2xl:px-4 lg:pr-3 mt-2 lg:-mt-1 2xl:mt-2 2xl:pb-64">
                            {{ $termsPage[7]->section_content }}
                        </p>

                        <p
                            class="primary-color-blackish-blue text-xl 2xl:text-4xl font-semibold px-4 lg:px-0 -mt-2 lg:-mt-0">
                            {{ $termsPage[8]->section_content }}
                        </p>
                        <br />
                        <p
                            class="mb-5 primary-color-blackish-blue-opacity font-medium md:text-sm 2xl:text-3xl px-4 lg:px-0 2xl:px-4 lg:pr-3 mt-2 lg:-mt-1 2xl:mt-2 2xl:pb-64">
                            {{ $termsPage[9]->section_content }}
                        </p>

                        <p
                            class="primary-color-blackish-blue text-xl 2xl:text-4xl font-semibold px-4 lg:px-0 -mt-2 lg:-mt-0">
                            {{ $termsPage[10]->section_content }}</p>
                        <br />
                        <p
                            class="mb-5 primary-color-blackish-blue-opacity font-medium md:text-sm 2xl:text-3xl px-4 lg:px-0 2xl:px-4 lg:pr-3 mt-2 lg:-mt-1 2xl:mt-2 2xl:pb-64">
                            {{ $termsPage[11]->section_content }}
                        </p>
                        <p
                            class="mb-5 primary-color-blackish-blue-opacity font-medium md:text-sm 2xl:text-3xl px-4 lg:px-0 2xl:px-4 lg:pr-3 mt-2 lg:-mt-1 2xl:mt-2 2xl:pb-64">
                            {{ $termsPage[12]->section_content }}</p>

                        <p
                            class="mb-5 primary-color-blackish-blue-opacity font-medium md:text-sm 2xl:text-3xl px-4 lg:px-0 2xl:px-4 lg:pr-3 mt-2 lg:-mt-1 2xl:mt-2 2xl:pb-64">
                            {{ $termsPage[13]->section_content }}</p>
                        <p
                            class="mb-5 primary-color-blackish-blue-opacity font-medium md:text-sm 2xl:text-3xl px-4 lg:px-0 2xl:px-4 lg:pr-3 mt-2 lg:-mt-1 2xl:mt-2 2xl:pb-64">
                            {{ $termsPage[14]->section_content }}
                        </p>
                        <p
                            class="mb-5 primary-color-blackish-blue-opacity font-medium md:text-sm 2xl:text-3xl px-4 lg:px-0 2xl:px-4 lg:pr-3 mt-2 lg:-mt-1 2xl:mt-2 2xl:pb-64">
                            {{ $termsPage[15]->section_content }}</p>

                        <p
                            class="mb-5 primary-color-blackish-blue-opacity font-medium md:text-sm 2xl:text-3xl px-4 lg:px-0 2xl:px-4 lg:pr-3 mt-2 lg:-mt-1 2xl:mt-2 2xl:pb-64">
                            {{ $termsPage[16]->section_content }}</p>
                        <p
                            class="mb-5 primary-color-blackish-blue-opacity font-medium md:text-sm 2xl:text-3xl px-4 lg:px-0 2xl:px-4 lg:pr-3 mt-2 lg:-mt-1 2xl:mt-2 2xl:pb-64">
                            {{ $termsPage[17]->section_content }}
                        </p>
                        <p
                            class="primary-color-blackish-blue text-xl 2xl:text-4xl font-semibold px-4 lg:px-0 -mt-2 lg:-mt-0">
                            {{ $termsPage[18]->section_content }}
                        </p>
                        <br>
                        <p
                            class="mb-5 primary-color-blackish-blue-opacity font-medium md:text-sm 2xl:text-3xl px-4 lg:px-0 2xl:px-4 lg:pr-3 mt-2 lg:-mt-1 2xl:mt-2 2xl:pb-64">
                            {{ $termsPage[19]->section_content }}</p>
                        <p
                            class="mb-5 primary-color-blackish-blue-opacity font-medium md:text-sm 2xl:text-3xl px-4 lg:px-0 2xl:px-4 lg:pr-3 mt-2 lg:-mt-1 2xl:mt-2 2xl:pb-64">
                            {{ $termsPage[20]->section_content }}
                        </p>
                        <p
                            class="mb-5 primary-color-blackish-blue-opacity font-medium md:text-sm 2xl:text-3xl px-4 lg:px-0 2xl:px-4 lg:pr-3 mt-2 lg:-mt-1 2xl:mt-2 2xl:pb-64">
                            {{ $termsPage[21]->section_content }}
                        </p>
                        <p
                            class="mb-5 primary-color-blackish-blue-opacity font-medium md:text-sm 2xl:text-3xl px-4 lg:px-0 2xl:px-4 lg:pr-3 mt-2 lg:-mt-1 2xl:mt-2 2xl:pb-64">
                            {{ $termsPage[22]->section_content }}
                        </p>
                        <p
                            class="mb-5 primary-color-blackish-blue-opacity font-medium md:text-sm 2xl:text-3xl px-4 lg:px-0 2xl:px-4 lg:pr-3 mt-2 lg:-mt-1 2xl:mt-2 2xl:pb-64">
                            {{ $termsPage[23]->section_content }}</p>
                        <p
                            class="mb-5 primary-color-blackish-blue-opacity font-medium md:text-sm 2xl:text-3xl px-4 lg:px-0 2xl:px-4 lg:pr-3 mt-2 lg:-mt-1 2xl:mt-2 2xl:pb-64">
                            {{ $termsPage[24]->section_content }}
                        </p>
                        <p
                            class="mb-5 primary-color-blackish-blue-opacity font-medium md:text-sm 2xl:text-3xl px-4 lg:px-0 2xl:px-4 lg:pr-3 mt-2 lg:-mt-1 2xl:mt-2 2xl:pb-64">
                            {{ $termsPage[25]->section_content }}
                        </p>
                        <p
                            class="mb-5 primary-color-blackish-blue-opacity font-medium md:text-sm 2xl:text-3xl px-4 lg:px-0 2xl:px-4 lg:pr-3 mt-2 lg:-mt-1 2xl:mt-2 2xl:pb-64">
                            {{ $termsPage[26]->section_content }}</p>
                        <p
                            class="mb-5 primary-color-blackish-blue-opacity font-medium md:text-sm 2xl:text-3xl px-4 lg:px-0 2xl:px-4 lg:pr-3 mt-2 lg:-mt-1 2xl:mt-2 2xl:pb-64">
                            {{ $termsPage[27]->section_content }}
                        </p>
                        <p
                            class="mb-5 primary-color-blackish-blue-opacity font-medium md:text-sm 2xl:text-3xl px-4 lg:px-0 2xl:px-4 lg:pr-3 mt-2 lg:-mt-1 2xl:mt-2 2xl:pb-64">
                            {{ $termsPage[28]->section_content }}
                        </p>
                        <p
                            class="mb-5 primary-color-blackish-blue-opacity font-medium md:text-sm 2xl:text-3xl px-4 lg:px-0 2xl:px-4 lg:pr-3 mt-2 lg:-mt-1 2xl:mt-2 2xl:pb-64">
                            {{ $termsPage[29]->section_content }}
                        </p>

                        <p
                            class="primary-color-blackish-blue text-xl 2xl:text-4xl font-semibold px-4 lg:px-0 -mt-2 lg:-mt-0">
                            {{ $termsPage[30]->section_content }}
                        </p>
                        <br>
                        <p
                            class="mb-5 primary-color-blackish-blue-opacity font-medium md:text-sm 2xl:text-3xl px-4 lg:px-0 2xl:px-4 lg:pr-3 mt-2 lg:-mt-1 2xl:mt-2 2xl:pb-64">
                            {{ $termsPage[31]->section_content }}
                        </p>
                        <p
                            class="primary-color-blackish-blue text-xl 2xl:text-4xl font-semibold px-4 lg:px-0 -mt-2 lg:-mt-0">
                            {{ $termsPage[32]->section_content }}</p>
                        <br>
                        <p
                            class="mb-5 primary-color-blackish-blue-opacity font-medium md:text-sm 2xl:text-3xl px-4 lg:px-0 2xl:px-4 lg:pr-3 mt-2 lg:-mt-1 2xl:mt-2 2xl:pb-64">
                            {{ $termsPage[33]->section_content }}
                        </p>

                        <p
                            class="primary-color-blackish-blue text-xl 2xl:text-4xl font-semibold px-4 lg:px-0 -mt-2 lg:-mt-0">
                            {{ $termsPage[34]->section_content }}
                        </p>
                        <br>
                        <p
                            class="mb-5 primary-color-blackish-blue-opacity font-medium md:text-sm 2xl:text-3xl px-4 lg:px-0 2xl:px-4 lg:pr-3 mt-2 lg:-mt-1 2xl:mt-2 2xl:pb-64">
                            {{ $termsPage[35]->section_content }}
                        </p>

                        <p
                            class="primary-color-blackish-blue text-xl 2xl:text-4xl font-semibold px-4 lg:px-0 -mt-2 lg:-mt-0">
                            {{ $termsPage[36]->section_content }}
                        </p>
                        <br>
                        <p
                            class="mb-5 primary-color-blackish-blue-opacity font-medium md:text-sm 2xl:text-3xl px-4 lg:px-0 2xl:px-4 lg:pr-3 mt-2 lg:-mt-1 2xl:mt-2 2xl:pb-64">
                            {{ $termsPage[37]->section_content }}
                        </p>
                        <p
                            class="mb-5 primary-color-blackish-blue-opacity font-medium md:text-sm 2xl:text-3xl px-4 lg:px-0 2xl:px-4 lg:pr-3 mt-2 lg:-mt-1 2xl:mt-2 2xl:pb-64">
                            {{ $termsPage[38]->section_content }}
                        </p>

                        <p
                            class="primary-color-blackish-blue text-xl 2xl:text-4xl font-semibold px-4 lg:px-0 -mt-2 lg:-mt-0">
                            {{ $termsPage[39]->section_content }}
                        </p>
                        <br>
                        <p
                            class="mb-5 primary-color-blackish-blue-opacity font-medium md:text-sm 2xl:text-3xl px-4 lg:px-0 2xl:px-4 lg:pr-3 mt-2 lg:-mt-1 2xl:mt-2 2xl:pb-64">
                            {{ $termsPage[40]->section_content }}
                        </p>
                        <p
                            class="mb-5 primary-color-blackish-blue-opacity font-medium md:text-sm 2xl:text-3xl px-4 lg:px-0 2xl:px-4 lg:pr-3 mt-2 lg:-mt-1 2xl:mt-2 2xl:pb-64">
                            {{ $termsPage[41]->section_content }}</p>
                        <p
                            class="mb-5 primary-color-blackish-blue-opacity font-medium md:text-sm 2xl:text-3xl px-4 lg:px-0 2xl:px-4 lg:pr-3 mt-2 lg:-mt-1 2xl:mt-2 2xl:pb-64">
                            {{ $termsPage[42]->section_content }}
                        </p>
                        <p
                            class="mb-5 primary-color-blackish-blue-opacity font-medium md:text-sm 2xl:text-3xl px-4 lg:px-0 2xl:px-4 lg:pr-3 mt-2 lg:-mt-1 2xl:mt-2 2xl:pb-64">
                            {{ $termsPage[43]->section_content }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <section>
</div>
@endsection
