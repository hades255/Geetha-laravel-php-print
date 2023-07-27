<!-- Cookie Box -->
<div id="cookieBox">
    <div class="web-cookies" class="fixed lg:w-2/5 py-4 px-6 bg-white border-t lg:border-r lg:rounded lg:shadow">
        <h2 class="text-2xl mb-2 font-semibold font-heading">{{ __('Cookie Policy') }}</h2>
        <small class="mb-4 text-gray-400 leading-relaxed">{{ __('We use cookies to personalise content, to provide social media
            features and to analyse our traffic. We also share information about your use of our site with our social
            media, advertising and analytics partners. If you want to change your cookie setting, please see the ‘how to
            reject cookies section of our') }} <a class="text-purple-600 hover:underline"
                href="#">{{ __('Cookie Policy') }}</a>.
            {{ __('Otherwise, if you agree to our use of cookies, please continue to use our website.') }}</small>
        <a onclick="closeCookie()"
            class="inline-block mt-3 py-4 px-8 leading-none text-white bg-purple-600 hover:bg-purple-700 font-semibold rounded shadow"
            href="#">{{ __('I accept cookies') }}</a>
    </div>
</div>