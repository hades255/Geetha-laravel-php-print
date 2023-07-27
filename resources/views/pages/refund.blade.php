@extends('layouts.web', ['nav' => true, 'banner' => false, 'footer' => true, 'cookie' => true, 'setting' => true,
'title' => 'Refund Policy'])

@section('content')
<div>
    <section class="text-gray-700">
        <div class="container px-5 py-24 mx-auto">
            <div class="text-center mb-20">
                <h1 class="sm:text-3xl text-1xl font-large text-center title-font text-gray-900 mb-4">
                    {{ $refundPage[0]->section_content }}
                </h1>
            </div>

            <div class="flex flex-wrap lg:w-full sm:mx-auto sm:mb-2">
                <div class="w-full lg:w-full">
                    <div class="px-3 lg:px-5 lg:-mt-4 mb-5 lg:mb-0">
                        <p
                            class="mb-3 primary-color-blackish-blue text-xl 2xl:text-4xl font-semibold px-4 lg:px-0 -mt-2 lg:-mt-0">
                            {{ $refundPage[1]->section_content }}</p>
                        <p
                            class="mb-5 primary-color-blackish-blue-opacity font-medium md:text-sm 2xl:text-3xl px-4 lg:px-0 2xl:px-4 lg:pr-3 mt-2 lg:-mt-1 2xl:mt-2 2xl:pb-64">
                            {{ $refundPage[2]->section_content }}</p>

                        <p
                            class="mb-5 primary-color-blackish-blue-opacity font-medium md:text-sm 2xl:text-3xl px-4 lg:px-0 2xl:px-4 lg:pr-3 mt-2 lg:-mt-1 2xl:mt-2 2xl:pb-64">
                            {{ $refundPage[3]->section_content }}
                        </p>

                        <p
                            class="mb-5 primary-color-blackish-blue-opacity font-medium md:text-sm 2xl:text-3xl px-4 lg:px-0 2xl:px-4 lg:pr-3 mt-2 lg:-mt-1 2xl:mt-2 2xl:pb-64">
                            {{ $refundPage[4]->section_content }}</p>
                        <br />
                        <p
                            class="primary-color-blackish-blue text-xl 2xl:text-5xl font-semibold px-4 lg:px-0 -mt-2 lg:-mt-0 mb-4">
                            {{ $refundPage[5]->section_content }}
                        </p>

                        <p
                            class="primary-color-blackish-blue text-xl 2xl:text-4xl font-semibold px-4 lg:px-0 -mt-2 lg:-mt-0">
                            {{ $refundPage[6]->section_content }}</p>
                        <br />
                        <p
                            class="mb-5 primary-color-blackish-blue-opacity font-medium md:text-sm 2xl:text-3xl px-4 lg:px-0 2xl:px-4 lg:pr-3 mt-2 lg:-mt-1 2xl:mt-2 2xl:pb-64">
                            {{ $refundPage[7]->section_content }}
                        </p>
                        <p
                            class="mb-5 =primary-color-blackish-blue text-xl 2xl:text-4xl font-semibold px-4 lg:px-0 -mt-2 lg:-mt-0">
                            {{ $refundPage[8]->section_content }}
                        </p>
                        <p
                            class="mb-5 primary-color-blackish-blue-opacity font-medium md:text-sm 2xl:text-3xl px-4 lg:px-0 2xl:px-4 lg:pr-3 mt-2 lg:-mt-1 2xl:mt-2 2xl:pb-64">
                            {{ $refundPage[9]->section_content }}
                        </p>

                        <p
                            class="mb-2 primary-color-blackish-blue-opacity font-medium md:text-sm 2xl:text-3xl px-4 lg:px-0 2xl:px-4 lg:pr-3 mt-2 lg:-mt-1 2xl:mt-2 2xl:pb-64">
                            {{ $refundPage[10]->section_content }}</p>
                        <p
                            class="mb-2 primary-color-blackish-blue-opacity font-medium md:text-sm 2xl:text-3xl px-4 lg:px-0 2xl:px-4 lg:pr-3 mt-2 lg:-mt-1 2xl:mt-2 2xl:pb-64">
                            {{ $refundPage[11]->section_content }}
                        </p>
                        <p
                            class="mb-2 primary-color-blackish-blue-opacity font-medium md:text-sm 2xl:text-3xl px-4 lg:px-0 2xl:px-4 lg:pr-3 mt-2 lg:-mt-1 2xl:mt-2 2xl:pb-64">
                            {{ $refundPage[12]->section_content }}</p>
                        <p
                            class="mb-2 primary-color-blackish-blue-opacity font-medium md:text-sm 2xl:text-3xl px-4 lg:px-0 2xl:px-4 lg:pr-3 mt-2 lg:-mt-1 2xl:mt-2 2xl:pb-64">
                            {{ $refundPage[13]->section_content }}</p>
                        <p
                            class="mb-2 primary-color-blackish-blue-opacity font-medium md:text-sm 2xl:text-3xl px-4 lg:px-0 2xl:px-4 lg:pr-3 mt-2 lg:-mt-1 2xl:mt-2 2xl:pb-64">
                            {{ $refundPage[14]->section_content }}
                        </p>
                        <p
                            class="mb-2 primary-color-blackish-blue-opacity font-medium md:text-sm 2xl:text-3xl px-4 lg:px-0 2xl:px-4 lg:pr-3 mt-2 lg:-mt-1 2xl:mt-2 2xl:pb-64">
                            {{ $refundPage[15]->section_content }}</p>
                        <br>

                        <p
                            class="mb-5 primary-color-blackish-blue text-xl 2xl:text-4xl font-semibold px-4 lg:px-0 -mt-2 lg:-mt-0">
                            {{ $refundPage[16]->section_content }}</p>
                        <p
                            class="mb-5 primary-color-blackish-blue-opacity font-medium md:text-sm 2xl:text-3xl px-4 lg:px-0 2xl:px-4 lg:pr-3 mt-2 lg:-mt-1 2xl:mt-2 2xl:pb-64">
                            {{ $refundPage[17]->section_content }}
                        </p>
                        <p
                            class="mb-5 primary-color-blackish-blue-opacity font-medium md:text-sm 2xl:text-3xl px-4 lg:px-0 2xl:px-4 lg:pr-3 mt-2 lg:-mt-1 2xl:mt-2 2xl:pb-64">
                            {{ $refundPage[18]->section_content }}
                        </p>
                        <p
                            class="primary-color-blackish-blue-opacity font-medium md:text-sm 2xl:text-3xl px-4 lg:px-0 2xl:px-4 lg:pr-3 mt-2 lg:-mt-1 2xl:mt-2 2xl:pb-64">
                            {{ $refundPage[19]->section_content }}</p>
                        <br />

                        <p
                            class="mb-5 primary-color-blackish-blue-opacity font-medium md:text-sm 2xl:text-3xl px-4 lg:px-0 2xl:px-4 lg:pr-3 mt-2 lg:-mt-1 2xl:mt-2 2xl:pb-64">
                            {{ $refundPage[20]->section_content }}
                        </p>
                        <p
                            class="mb-5 primary-color-blackish-blue-opacity font-medium md:text-sm 2xl:text-3xl px-4 lg:px-0 2xl:px-4 lg:pr-3 mt-2 lg:-mt-1 2xl:mt-2 2xl:pb-64">
                            {{ $refundPage[21]->section_content }}
                        </p>
                        <br>

                        <p
                            class="mb-5 primary-color-blackish-blue text-xl 2xl:text-4xl font-semibold px-4 lg:px-0 -mt-2 lg:-mt-0">
                            {{ $refundPage[22]->section_content }}
                        </p>
                        <p
                            class="mb-5 primary-color-blackish-blue-opacity font-medium md:text-sm 2xl:text-3xl px-4 lg:px-0 2xl:px-4 lg:pr-3 mt-2 lg:-mt-1 2xl:mt-2 2xl:pb-64">
                            {{ $refundPage[23]->section_content }}</p>
                        <p
                            class="mb-5 primary-color-blackish-blue-opacity font-medium md:text-sm 2xl:text-3xl px-4 lg:px-0 2xl:px-4 lg:pr-3 mt-2 lg:-mt-1 2xl:mt-2 2xl:pb-64">
                            {{ $refundPage[24]->section_content }}
                        </p>
                        <p
                            class="mb-5 primary-color-blackish-blue-opacity font-medium md:text-sm 2xl:text-3xl px-4 lg:px-0 2xl:px-4 lg:pr-3 mt-2 lg:-mt-1 2xl:mt-2 2xl:pb-64">
                            {{ $refundPage[25]->section_content }}
                        </p>
                        <p
                            class="mb-5 primary-color-blackish-blue-opacity font-medium md:text-sm 2xl:text-3xl px-4 lg:px-0 2xl:px-4 lg:pr-3 mt-2 lg:-mt-1 2xl:mt-2 2xl:pb-64">
                            {{ $refundPage[26]->section_content }}</p>
                        <p
                            class="mb-5 primary-color-blackish-blue-opacity font-medium md:text-sm 2xl:text-3xl px-4 lg:px-0 2xl:px-4 lg:pr-3 mt-2 lg:-mt-1 2xl:mt-2 2xl:pb-64">
                            {{ $refundPage[27]->section_content }}
                        </p>
                        <p
                            class="mb-5 primary-color-blackish-blue-opacity font-medium md:text-sm 2xl:text-3xl px-4 lg:px-0 2xl:px-4 lg:pr-3 mt-2 lg:-mt-1 2xl:mt-2 2xl:pb-64">
                            {{ $refundPage[28]->section_content }}
                        </p>
                        <p
                            class="mb-5 primary-color-blackish-blue-opacity font-medium md:text-sm 2xl:text-3xl px-4 lg:px-0 2xl:px-4 lg:pr-3 mt-2 lg:-mt-1 2xl:mt-2 2xl:pb-64">
                            {{ $refundPage[29]->section_content }}
                        </p>
                        <p
                            class="mb-5 primary-color-blackish-blue-opacity font-medium md:text-sm 2xl:text-3xl px-4 lg:px-0 2xl:px-4 lg:pr-3 mt-2 lg:-mt-1 2xl:mt-2 2xl:pb-64">
                            {{ $refundPage[30]->section_content }}
                        </p>
                        <p
                            class="mb-5 primary-color-blackish-blue-opacity font-medium md:text-sm 2xl:text-3xl px-4 lg:px-0 2xl:px-4 lg:pr-3 mt-2 lg:-mt-1 2xl:mt-2 2xl:pb-64">
                            {{ $refundPage[31]->section_content }}
                        </p>

                        <p
                            class="primary-color-blackish-blue text-xl 2xl:text-4xl font-semibold px-4 lg:px-0 -mt-2 lg:-mt-0">
                            {{ $refundPage[32]->section_content }}</p>
                        <br />
                        <p
                            class="mb-5 primary-color-blackish-blue-opacity font-medium md:text-sm 2xl:text-3xl px-4 lg:px-0 2xl:px-4 lg:pr-3 mt-2 lg:-mt-1 2xl:mt-2 2xl:pb-64">
                            {{ $refundPage[33]->section_content }}
                        </p>
                        <p
                            class="mb-5 primary-color-blackish-blue-opacity font-medium md:text-sm 2xl:text-3xl px-4 lg:px-0 2xl:px-4 lg:pr-3 mt-2 lg:-mt-1 2xl:mt-2 2xl:pb-64">
                            {{ $refundPage[34]->section_content }}
                        </p>
                        <p
                            class="mb-5 primary-color-blackish-blue-opacity font-medium md:text-sm 2xl:text-3xl px-4 lg:px-0 2xl:px-4 lg:pr-3 mt-2 lg:-mt-1 2xl:mt-2 2xl:pb-64">
                            {{ $refundPage[35]->section_content }}
                        </p>

                        <p
                            class="primary-color-blackish-blue text-xl 2xl:text-4xl font-semibold px-4 lg:px-0 -mt-2 lg:-mt-0">
                            {{ $refundPage[36]->section_content }}</p>
                        <br />
                        <p
                            class="mb-5 primary-color-blackish-blue-opacity font-medium md:text-sm 2xl:text-3xl px-4 lg:px-0 2xl:px-4 lg:pr-3 mt-2 lg:-mt-1 2xl:mt-2 2xl:pb-64">
                            {{ $refundPage[37]->section_content }}
                        </p>
                        <p
                            class="mb-5 primary-color-blackish-blue-opacity font-medium md:text-sm 2xl:text-3xl px-4 lg:px-0 2xl:px-4 lg:pr-3 mt-2 lg:-mt-1 2xl:mt-2 2xl:pb-64">
                            {{ $refundPage[38]->section_content }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <section>
</div>
@endsection
