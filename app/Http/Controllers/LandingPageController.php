<?php

namespace App\Http\Controllers;

use App\Plan;
use App\User;
use App\Setting;
use App\Currency;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use Artesaos\SEOTools\Facades\JsonLd;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\SEOTools;
use Artesaos\SEOTools\Facades\OpenGraph;
use Illuminate\Support\Facades\Redirect;
use App\AdPageSlot;

class LandingPageController extends Controller
{
    public function index()
    {
        $path = storage_path('installed');
        // if (file_exists($path)) {
            $homePage = DB::table('pages')->where('page_name', 'home')->get();
            $supportPage = DB::table('pages')->where('page_name', 'footer support email')->orWhere('page_name', 'footer')->get();
            $plans = Plan::orderBy('plan_order', 'ASC')->where('status', 1)->where('customized_for', NULL)->get();
            $settings = Setting::where('status', 1)->first();
            $config = DB::table('config')->get();
            $currency = Currency::where('code', $config['1']->config_value)->first();
            
            if(!empty($settings)){
                SEOTools::setTitle($settings->site_name);
                SEOTools::setDescription($settings->seo_meta_description);
    
                SEOMeta::setTitle($settings->site_name);
                SEOMeta::setDescription($settings->seo_meta_description);
                SEOMeta::addMeta('article:section', $settings->seo_site, 'property');
                SEOMeta::addKeyword([$settings->seo_keywords]);
    
                OpenGraph::setTitle($settings->site_name);
                OpenGraph::setDescription($settings->seo_meta_description);
                OpenGraph::setUrl(URL::to('/') . '/');
                OpenGraph::addImage([URL::to('/') . $settings->site_logo, 'size' => 300]);
    
                JsonLd::setTitle($settings->site_name);
                JsonLd::setDescription($settings->seo_meta_description);
                JsonLd::addImage(URL::to('/') . $settings->site_logo);
            }
            

			$adPageSlots = AdPageSlot::page('landing_page')
						->select('ad_page_slots.*')
						->inRandomOrder()
                        ->limit(2)
						->get();
						
			$data = DB::table('site_settings')->first()->landingPage_settings;
            $data = json_decode($data,true);
        
            return view('web', compact('homePage', 'supportPage', 'plans', 'settings', 'currency', 'config', 'adPageSlots','data'));
       
    }

    public function faq()
    {
        $data = DB::table('site_settings')->first()->landingPage_settings;
        $data = json_decode($data,true);
        if(empty($data['faq']) || $data['faq'] == 0){
            return back();
        }
            
        $faqPage = DB::table('pages')->where('page_name', 'faq')->get();
        $supportPage = DB::table('pages')->where('page_name', 'footer support email')->orWhere('page_name', 'footer')->get();
        $config = DB::table('config')->get();
        $settings = Setting::where('status', 1)->first();

        return view('pages/faq', compact('faqPage', 'supportPage', 'settings', 'config'));
    }

    public function privacyPolicy()
    {
        $privacyPage = DB::table('pages')->where('page_name', 'privacy')->get();
        $supportPage = DB::table('pages')->where('page_name', 'footer support email')->orWhere('page_name', 'footer')->get();
        $config = DB::table('config')->get();
        $settings = Setting::where('status', 1)->first();

        return view('pages/privacy', compact('privacyPage', 'supportPage', 'settings', 'config'));
    }

    public function refundPolicy()
    {
        $refundPage = DB::table('pages')->where('page_name', 'refund')->get();
        $supportPage = DB::table('pages')->where('page_name', 'footer support email')->orWhere('page_name', 'footer')->get();
        $config = DB::table('config')->get();
        $settings = Setting::where('status', 1)->first();

        return view('pages/refund', compact('refundPage', 'supportPage', 'settings', 'config'));
    }

    public function termsAndConditions()
    {
        $termsPage = DB::table('pages')->where('page_name', 'terms')->get();
        $supportPage = DB::table('pages')->where('page_name', 'footer support email')->orWhere('page_name', 'footer')->get();
        $config = DB::table('config')->get();
        $settings = Setting::where('status', 1)->first();

        return view('pages/terms', compact('termsPage', 'supportPage', 'settings', 'config'));
    }
    
    public function referralCode($referral_code)
    {
        if (User::where('your_ref_code', '=', $referral_code)->exists()) {
            // user found
            return redirect()->route('register', ['referral_code' => $referral_code]);
        }else{
            return redirect()->route('register');
        }
    }
    
    public function about()
    {
        $data = DB::table('site_settings')->first()->landingPage_settings;
        $data = json_decode($data,true);
        if(empty($data['about']) || $data['about'] == 0){
            return back();
        }
          
        $aboutPage = DB::table('pages')->where('page_name', 'about')->get();
        $supportPage = DB::table('pages')->where('page_name', 'footer support email')->orWhere('page_name', 'footer')->get();
        $config = DB::table('config')->get();
        $settings = Setting::where('status', 1)->first();
        
        return view('pages/about', compact('aboutPage', 'supportPage', 'settings', 'config'));
    }
    
    public function contact()
    {
        $data = DB::table('site_settings')->first()->landingPage_settings;
        $data = json_decode($data,true);
        if(empty($data['contact']) || $data['contact'] == 0){
            return back();
        }
          
          
        $contactPage = DB::table('pages')->where('page_name', 'contact')->get();
        $supportPage = DB::table('pages')->where('page_name', 'footer support email')->orWhere('page_name', 'footer')->get();
        $config = DB::table('config')->get();
        $settings = Setting::where('status', 1)->first();
        
        return view('pages/contact', compact('contactPage', 'supportPage', 'settings', 'config'));
    }
}
