@extends('layouts.web', ['nav' => true, 'banner' => false, 'footer' => true, 'cookie' => true, 'setting' => true,
'title' => __('About us')])

@section('content')
<div>
    <section class="text-gray-700">
        <div class="container px-5 py-24 mx-auto">
            <div class="mb-16">
                <h1 class="text-5xl font-bold font-large title-font text-gray-900 mb-2 pl-5">
                    {{ __($aboutPage[0]->section_content) }}
                </h1>
            </div>

            <div class="flex flex-wrap lg:w-full sm:mx-auto sm:mb-2">
                <div class="w-full lg:w-full">
                    <div class="px-3 lg:px-5 lg:-mt-4 mb-5 lg:mb-0">
                        <p
                            class="mb-5 primary-color-blackish-blue text-xl 2xl:text-4xl font-semibold px-4 lg:px-0 -mt-2 lg:-mt-0">
                            {{ __($aboutPage[1]->section_content) }}</p>
                        <p
                            class="mb-2 primary-color-blackish-blue-opacity font-medium md:text-sm 2xl:text-3xl px-4 lg:px-0 2xl:px-4 lg:pr-3 mt-2 lg:-mt-1 2xl:mt-2 2xl:pb-64">
                            {{ __($aboutPage[2]->section_content) }}</p>
                        <p
                            class="mb-2 primary-color-blackish-blue-opacity font-medium md:text-sm 2xl:text-3xl px-4 lg:px-0 2xl:px-4 lg:pr-3 mt-2 lg:-mt-1 2xl:mt-2 2xl:pb-64">
                            {{ __($aboutPage[3]->section_content) }}
                        </p>
                        <p
                            class="mb-5 primary-color-blackish-blue-opacity font-medium md:text-sm 2xl:text-3xl px-4 lg:px-0 2xl:px-4 lg:pr-3 mt-2 lg:-mt-1 2xl:mt-2 2xl:pb-64">
                            {{ __($aboutPage[4]->section_content) }}</p>

                        <p
                            class="primary-color-blackish-blue text-xl 2xl:text-4xl font-semibold px-4 lg:px-0 -mt-2 lg:-mt-0">
                            {{ __($aboutPage[5]->section_content) }}
                        </p>
                        <br />
                        <p
                            class="mb-2 primary-color-blackish-blue-opacity font-medium md:text-sm 2xl:text-3xl px-4 lg:px-0 2xl:px-4 lg:pr-3 mt-2 lg:-mt-1 2xl:mt-2 2xl:pb-64">
                            {{ __($aboutPage[6]->section_content) }}</p>
                        <p
                            class="mb-2 primary-color-blackish-blue-opacity font-medium md:text-sm 2xl:text-3xl px-4 lg:px-0 2xl:px-4 lg:pr-3 mt-2 lg:-mt-1 2xl:mt-2 2xl:pb-64">
                            {{ __($aboutPage[7]->section_content) }}
                        </p>

                        <p
                            class="mb-2 primary-color-blackish-blue-opacity font-medium md:text-sm 2xl:text-3xl px-4 lg:px-0 2xl:px-4 lg:pr-3 mt-2 lg:-mt-1 2xl:mt-2 2xl:pb-64">
                            {{ __($aboutPage[8]->section_content) }}
                        </p>
                        <br />
                        <p
                            class="mb-2 primary-color-blackish-blue-opacity font-medium md:text-sm 2xl:text-3xl px-4 lg:px-0 2xl:px-4 lg:pr-3 mt-2 lg:-mt-1 2xl:mt-2 2xl:pb-64">
                            {{ __($aboutPage[9]->section_content) }}
                        </p>

                        <p
                            class="mb-2 primary-color-blackish-blue-opacity font-medium md:text-sm 2xl:text-3xl px-4 lg:px-0 2xl:px-4 lg:pr-3 mt-2 lg:-mt-1 2xl:mt-2 2xl:pb-64">
                            {{ __($aboutPage[10]->section_content) }}</p>
                        <br />
                        <p
                            class="mb-2 primary-color-blackish-blue-opacity font-medium md:text-sm 2xl:text-3xl px-4 lg:px-0 2xl:px-4 lg:pr-3 mt-2 lg:-mt-1 2xl:mt-2 2xl:pb-64">
                            {{ __($aboutPage[11]->section_content) }}
                        </p>
                        <p
                            class="mb-2 primary-color-blackish-blue-opacity font-medium md:text-sm 2xl:text-3xl px-4 lg:px-0 2xl:px-4 lg:pr-3 mt-2 lg:-mt-1 2xl:mt-2 2xl:pb-64">
                            {{ __($aboutPage[12]->section_content) }}</p>

                        <p
                            class="mb-2 primary-color-blackish-blue-opacity font-medium md:text-sm 2xl:text-3xl px-4 lg:px-0 2xl:px-4 lg:pr-3 mt-2 lg:-mt-1 2xl:mt-2 2xl:pb-64">
                            {{ __($aboutPage[13]->section_content) }}</p>
                        <p
                            class="mb-5 primary-color-blackish-blue-opacity font-medium md:text-sm 2xl:text-3xl px-4 lg:px-0 2xl:px-4 lg:pr-3 mt-2 lg:-mt-1 2xl:mt-2 2xl:pb-64">
                            {{ __($aboutPage[14]->section_content) }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <section>
</div>
@endsection