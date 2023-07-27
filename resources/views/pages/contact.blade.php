@extends('layouts.web', ['nav' => true, 'banner' => false, 'footer' => true, 'cookie' => true, 'setting' => true,
'title' => __('Contact us')])

@section('content')
<section>
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
                <h2 class="text-4xl font-bold font-heading">{{ __($contactPage[0]->section_content) }}</h2>
                <p class="text-gray-500">{{ __($contactPage[1]->section_content) }}</p>
            </div>
            <div class="flex flex-wrap -mx-4">
                <div class="mb-8 lg:mb-0 w-full lg:w-1/3 px-4">
                    <div class="py-12 lg:py-20 rounded bg-white shadow text-center">
                        <h3 class="mb-8 lg:mb-20 text-3xl font-bold font-heading">{{ __($contactPage[2]->section_content) }}
                        </h3>
                        <p class="text-gray-400">{{ __($contactPage[3]->section_content) }}</p>
                        <p class="text-gray-400">{{ __($contactPage[4]->section_content) }}</p>
                    </div>
                </div>
                <div class="mb-8 lg:mb-0 w-full lg:w-1/3 px-4">
                    <div class="py-12 lg:py-20 rounded bg-white shadow text-center">
                        <h3 class="mb-8 lg:mb-20 text-3xl font-bold font-heading">{{ __($contactPage[5]->section_content) }}
                        </h3>
                        <p class="text-gray-400">{{ __($contactPage[6]->section_content) }}</p>
                        <p class="text-gray-400">{{ __($contactPage[7]->section_content) }}</p>
                    </div>
                </div>
                <div class="w-full lg:w-1/3 px-4 flex items-stretch">
                    <div class="py-12 lg:py-20 w-full rounded bg-white shadow text-center">
                        <h3 class="mb-8 lg:mb-20 text-3xl font-bold font-heading">{{ __($contactPage[8]->section_content) }}
                        </h3>
                        <div class="flex justify-center">
                            <a class="mr-3" href="{{ __($supportPage[1]->section_content) }}" target="_blank">
                                <img class="w-8 h-8" src="{{ asset('frontend/assets/social/facebook.svg') }}" alt="">
                            </a>
                            <a class="mr-3" href="{{ __($supportPage[2]->section_content) }}" target="_blank">
                                <img class="w-8 h-8" src="{{ asset('frontend/assets/social/twitter.svg') }}" alt="">
                            </a>
                            <a href="{{ __($supportPage[3]->section_content) }}" target="_blank">
                                <img class="w-8 h-8" src="{{ asset('frontend/assets/social/instagram.svg') }}" alt="">
                            </a>
                        </div>
                    </div>
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
@endsection