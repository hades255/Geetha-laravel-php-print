<?php

namespace App\Http\Controllers;

use App\Setting;
use Carbon\Carbon;
use App\BusinessCard;
use App\BusinessField;
use Illuminate\Http\Request;
use Jorenvh\Share\ShareFacade;
use JeroenDesloovere\VCard\VCard;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Auth;
use Artesaos\SEOTools\Facades\JsonLd;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\SEOTools;
use Artesaos\SEOTools\Facades\OpenGraph;
use Illuminate\Support\Facades\Response;
use App\Ad;

class ProfileController extends Controller
{
    // View Card Profile
    public function profile(Request $request, $id)
    {
        $card_details = DB::table('business_cards')->where('card_url', $id)->orWhere('card_id', $id)->where('card_status', 'activated')->first();
        $currentUser = 0;
        
        if(isset($card_details)){
            $currentUser = DB::table('users')->where('user_id', $card_details->user_id)->where('status', 1)
            ->where(function($query1){
                return $query1->whereDate('plan_validity', '>=', Carbon::now())
                ->orWhere('users.role_id',1);
            })->count();
            
            if($currentUser > 0){
                $plan = DB::table('users')->where('user_id', $card_details->user_id)->first();
                $active_plan = json_decode($plan->plan_details);
                $remaining_days = 0;
                
                if($plan->role_id == 1) {
                    $remaining_days = 9999;
                }
               
                
                if (isset($active_plan)) {
                    $plan_validity = date('Y-m-d H:s:i', strtotime($plan->plan_validity));
                    $current_date = Carbon::now();
                    $remaining_days = $current_date->diffInDays($plan_validity, false);
                }
                if($remaining_days > 0 ){
                    if ($currentUser == 1) {
                        if (isset($card_details)) {
                            if($card_details->card_type == "store") {
                                $enquiry_button = '#';
            
                                $business_card_details = DB::table('business_cards')->where('business_cards.card_id', $card_details->card_id)
                                    ->join('users', 'business_cards.user_id', '=', 'users.user_id')
                                    ->select('business_cards.*', 'users.plan_details')
                                    ->first();
            
                                if ($business_card_details) {
            
                                    $products = DB::table('store_products')->where('card_id', $card_details->card_id)->orderBy('id', 'desc')->get();
            
                                    $settings = Setting::where('status', 1)->first();
                                    $config = DB::table('config')->get();
            
                                    App::setLocale($business_card_details->card_lang);
                                    session()->put('locale', $business_card_details->card_lang);
            
                                    SEOTools::setTitle(strip_tags($business_card_details->title));
                                    SEOTools::setDescription(strip_tags($business_card_details->sub_title));
            
                                    SEOMeta::setTitle(strip_tags($business_card_details->title));
                                    SEOMeta::setDescription(strip_tags($business_card_details->sub_title));
                                    SEOMeta::addMeta('article:section', strip_tags($business_card_details->title), 'property');
                                    SEOMeta::addKeyword(["'". strip_tags($business_card_details->title)."'", "'". strip_tags($business_card_details->title)." vcard online'"]);
            
                                    OpenGraph::setTitle(strip_tags($business_card_details->sub_title));
                                    OpenGraph::setDescription(strip_tags($business_card_details->sub_title));
                                    OpenGraph::setUrl(URL::to('/') . '/'.$business_card_details->card_url);
                                    OpenGraph::addImage([URL::to('/') . $business_card_details->profile, 'size' => 300]);
            
                                    JsonLd::setTitle(strip_tags($business_card_details->title));
                                    JsonLd::setDescription(strip_tags($business_card_details->sub_title));
                                    JsonLd::addImage(URL::to('/') . $business_card_details->profile);
            
                                    $plan_details = json_decode($business_card_details->plan_details, true);
                                    $store_details = json_decode($business_card_details->description, true);
            
                                    if ($store_details['whatsapp_no'] != null) {
                                        $enquiry_button = $store_details['whatsapp_no'];
                                    }
            
                                    $whatsapp_msg = $store_details['whatsapp_msg'];
                                    $whatsapp_msg = str_replace('"', '', $whatsapp_msg);
                                    $whatsapp_msg = str_replace("'", '', $whatsapp_msg);
                                    $whatsapp_msg = str_replace("\n", 'NL', $whatsapp_msg);
                                    $whatsapp_msg = str_replace("\r", 'NL', $whatsapp_msg);
                                    $currency = $store_details['currency'];
            
                                    $url = URL::to('/') . "/" . strtolower(preg_replace('/\s+/', '-', $card_details->card_url));
                                    $business_name = strip_tags($card_details->title);
                                    $profile = URL::to('/') . "/" . $business_card_details->cover;
            
                                    $shareContent = $config[30]->config_value;
                                    $shareContent = str_replace("{ business_name }",$business_name,$shareContent);
                                    $shareContent = str_replace("{ business_url }",$url,$shareContent);
                                    $shareContent = str_replace("{ appName }", $config[0]->config_value ,$shareContent);
            
                                    // If branding enabled, then show app name.
            
                                    if($plan_details['hide_branding'] == "1") {
                                        $shareContent = str_replace("{ appName }", $business_name ,$shareContent);
                                    } else {
                                        $shareContent = str_replace("{ appName }", $config[0]->config_value ,$shareContent);
                                    }
            
                                    $url = urlencode($url);
                                    $shareContent = urlencode($shareContent);
            
            
                                    $qr_url = "https://chart.googleapis.com/chart?chs=250x250&cht=qr&chl=".$url;
            
                                    $shareComponent['facebook'] = "https://www.facebook.com/sharer/sharer.php?u=$url&quote=$shareContent";
                                    $shareComponent['twitter'] = "https://twitter.com/intent/tweet?text=$shareContent";
                                    $shareComponent['linkedin'] = "https://www.linkedin.com/shareArticle?mini=true&url=$url";
                                    $shareComponent['telegram'] = "https://telegram.me/share/url?text=$shareContent&url=$url";
                                    $shareComponent['whatsapp'] = "https://api.whatsapp.com/send/?phone&text=$shareContent";
            
                                    $business_card_details->is_show_ad = $active_plan->is_show_ad??0;
                                    
                                    if ($card_details->theme_id == "7ccc432a06ht1") {
                                        return view('vcard.modern-store-light', compact('card_details', 'plan_details', 'store_details', 'business_card_details', 'products', 'settings', 'shareComponent', 'shareContent', 'config', 'enquiry_button', 'whatsapp_msg', 'currency'));
                                    } else if ($card_details->theme_id == "7ccc432a06hju") {
                                        return view('vcard.modern-store-dark', compact('card_details', 'plan_details', 'store_details', 'business_card_details', 'products', 'settings', 'shareComponent', 'shareContent', 'config', 'enquiry_button', 'whatsapp_msg', 'currency'));
                                    } else {
                                        return view('vcard.store', compact('card_details', 'plan_details', 'store_details', 'business_card_details', 'products', 'settings', 'shareComponent', 'shareContent', 'config', 'enquiry_button', 'whatsapp_msg', 'currency'));
                                    }
                                } else {
                                    alert()->error('Sorry, Please fill basic business details.');
                                    return redirect()->route('user.edit.card', $id);
                                }
                            } else {
                                $enquiry_button = null;
                                $business_card_details = DB::table('business_cards')->where('business_cards.card_id', $card_details->card_id)
                                    ->join('users', 'business_cards.user_id', '=', 'users.user_id')
                                    ->select('business_cards.*', 'users.plan_details')
                                    ->first();
            
                                if ($business_card_details) {
            
                                    $feature_details = DB::table('business_fields')->where('card_id', $card_details->card_id)->get();
                                    $service_details = DB::table('services')->where('card_id', $card_details->card_id)->orderBy('id', 'asc')->get();
                                    $galleries_details = DB::table('galleries')->where('card_id', $card_details->card_id)->orderBy('id', 'asc')->get();
                                    $payment_details = DB::table('payments')->where('card_id', $card_details->card_id)->get();
                                    $business_hours = DB::table('business_hours')->where('card_id', $card_details->card_id)->first();
                                    $make_enquiry = DB::table('business_fields')->where('card_id', $card_details->card_id)->where('type', 'wa')->first();
            
                                    if ($make_enquiry != null) {
                                        $enquiry_button = $make_enquiry->content;
                                    }
            
                                    $settings = Setting::where('status', 1)->first();
                                    $config = DB::table('config')->get();
            
                                    App::setLocale($business_card_details->card_lang);
                                    session()->put('locale', $business_card_details->card_lang);
            
                                    SEOTools::setTitle(strip_tags($business_card_details->title));
                                    SEOTools::setDescription(strip_tags($business_card_details->sub_title));
            
                                    SEOMeta::setTitle(strip_tags($business_card_details->title));
                                    SEOMeta::setDescription(strip_tags($business_card_details->sub_title));
                                    SEOMeta::addMeta('article:section', strip_tags($business_card_details->title), 'property');
                                    SEOMeta::addKeyword(["'".strip_tags($business_card_details->title)."'", "'".strip_tags($business_card_details->title)." vcard online'"]);
            
                                    OpenGraph::setTitle(strip_tags($business_card_details->sub_title));
                                    OpenGraph::setDescription(strip_tags($business_card_details->sub_title));
                                    OpenGraph::setUrl(URL::to('/') . '/'.$business_card_details->card_url);
                                    OpenGraph::addImage([URL::to('/') . $business_card_details->profile, 'size' => 300]);
            
                                    JsonLd::setTitle(strip_tags($business_card_details->title));
                                    JsonLd::setDescription(strip_tags($business_card_details->sub_title));
                                    JsonLd::addImage(URL::to('/') . $business_card_details->profile);
            
                                    $plan_details = json_decode($business_card_details->plan_details, true);
            
                                    $url = URL::to('/') . "/" . strtolower(preg_replace('/\s+/', '-', $card_details->card_url));
                                    $business_name = strip_tags($card_details->title);
                                    $profile = URL::to('/') . "/" . $business_card_details->cover;
            
                                    $shareContent = $config[30]->config_value;
                                    $shareContent = str_replace("{ business_name }",$business_name,$shareContent);
                                    $shareContent = str_replace("{ business_url }",$url,$shareContent);
            
                                    // If branding enabled, then show app name.
            
                                    if($plan_details['hide_branding'] == "1") {
                                        $shareContent = str_replace("{ appName }", $business_name ,$shareContent);
                                    } else {
                                        $shareContent = str_replace("{ appName }", $config[0]->config_value ,$shareContent);
                                    }
            
                                    $url = urlencode($url);
                                    $shareContent = urlencode($shareContent);
            
            
                                    $qr_url = "https://chart.googleapis.com/chart?chs=250x250&cht=qr&chl=".$url;
            
                                    $shareComponent['facebook'] = "https://www.facebook.com/sharer/sharer.php?u=$url&quote=$shareContent";
                                    $shareComponent['twitter'] = "https://twitter.com/intent/tweet?text=$shareContent";
                                    $shareComponent['linkedin'] = "https://www.linkedin.com/shareArticle?mini=true&url=$url";
                                    $shareComponent['telegram'] = "https://telegram.me/share/url?text=$shareContent&url=$url";
                                    $shareComponent['whatsapp'] = "https://api.whatsapp.com/send/?phone&text=$shareContent";
            
                                    $business_card_details->is_show_ad = $active_plan->is_show_ad??0;
                                    
                                    if ($card_details->theme_id == "7ccc432a06ca1") {
                                        return view('vcard.modern-vcard-light', compact('card_details', 'plan_details', 'business_card_details', 'feature_details', 'service_details', 'galleries_details', 'payment_details', 'business_hours', 'settings', 'shareComponent', 'shareContent', 'config', 'enquiry_button'));
                                    } else if ($card_details->theme_id == "7ccc432a06vta") {
                                        return view('vcard.modern-vcard-dark', compact('card_details', 'plan_details', 'business_card_details', 'feature_details', 'service_details', 'galleries_details', 'payment_details', 'business_hours', 'settings', 'shareComponent', 'shareContent', 'config', 'enquiry_button'));
                                    } else if ($card_details->theme_id == "7ccc432a06cth") {
                                        return view('vcard.classic-vcard-light', compact('card_details', 'plan_details', 'business_card_details', 'feature_details', 'service_details', 'galleries_details', 'payment_details', 'business_hours', 'settings', 'shareComponent', 'shareContent', 'config', 'enquiry_button'));
                                    } else if ($card_details->theme_id == "7ccc432a06vyw") {
                                        return view('vcard.classic-vcard-dark', compact('card_details', 'plan_details', 'business_card_details', 'feature_details', 'service_details', 'galleries_details', 'payment_details', 'business_hours', 'settings', 'shareComponent', 'shareContent', 'config', 'enquiry_button'));
                                    } else if ($card_details->theme_id == "7ccc432a06ctw") {
                                        return view('vcard.metro-vcard-light', compact('card_details', 'plan_details', 'business_card_details', 'feature_details', 'service_details', 'galleries_details', 'payment_details', 'business_hours', 'settings', 'shareComponent', 'shareContent', 'config', 'enquiry_button'));
                                    } else if ($card_details->theme_id == "7ccc432a06vhd") {
                                        return view('vcard.metro-vcard-dark', compact('card_details', 'plan_details', 'business_card_details', 'feature_details', 'service_details', 'galleries_details', 'payment_details', 'business_hours', 'settings', 'shareComponent', 'shareContent', 'config', 'enquiry_button'));
                                    } else {
                                        return view('vcard.card-white', compact('card_details', 'plan_details', 'business_card_details', 'feature_details', 'service_details', 'galleries_details', 'payment_details', 'business_hours', 'settings', 'shareComponent', 'shareContent', 'config', 'enquiry_button'));
                                    }   
                                } else {
                                    alert()->error('Sorry, Please fill basic business details.');
                                    return redirect()->route('user.edit.card', $id);
                                }
                            }
                        } else {
                            http_response_code(404);
                            return view('errors.404');
                        }
                    } else {
                        return view('vcard.card-expired');
                    }
                }else{
                    alert()->error('Your plan has been expired, Please renew your plan.');
                    return redirect()->route('user.cards');
                }
            }else{
                return view('errors.404');
            }
        }else{
            return view('errors.404');
        }
    }

    public function downloadVcard(Request $request, $id)
    {
        $business_card = BusinessCard::where('card_id', $id)->first();

        if ($business_card == null) {
            return view('errors.404');
        } else {
            $business_card_details = DB::table('business_cards')->where('business_cards.card_id', $id)
                ->join('users', 'business_cards.user_id', '=', 'users.user_id')
                ->select('business_cards.*')
                ->first();
            $features = BusinessField::where('card_id', $id)->get();

            $vcard_url = URL::to('/') . "/" . $business_card_details->card_id;

            // define vcard
            $vcard = new VCard();

            // define variables
            $lastname = '';
            $firstname = strip_tags($business_card_details->title);
            $additional = '';
            $prefix = '';
            $suffix = '';
            $email = '';
            $tel = '';
            $whatsapp = '';


            // add personal data
            $vcard->addName($lastname, $firstname, $additional, $prefix, $suffix);

            foreach ($features as $key => $value)
            {
                if($value->type == "email") {
                    $vcard->addEmail($value->content);
                }
                if($value->type == "tel") {
                    $vcard->addPhoneNumber($value->content, 'WORK');
                }
                if($value->type == "wa") {
                    $vcard->addPhoneNumber($value->content, 'WHATSAPP');
                }
                if($value->type == "url") {
                    $vcard->addURL($value->content);
                }
                if($value->type == "address") {
                    $vcard->addAddress($value->content);
                }
            }

            if ($business_card_details->profile == null) {
                $image = "";
            } else {
                $image = str_replace(' ','%20',public_path($business_card_details->profile));
            }

            // add work data
            $vcard->addJobtitle(strip_tags($business_card_details->sub_title));
            $vcard->addPhoto($image);
            $vcard->addURL($vcard_url);

            return Response::make($vcard->getOutput(),200,$vcard->getHeaders(true));

        }
    }
    
    public function getRandomAd(Request $request, $id)
    {
        $ad_id = "";
        $ad_url = "";
        $ad_link = "";
        
        $ad_page_slot_id = $request->query('ad_page_slot_id')??0;
		
        try{
            $ads = Ad::join('ad_page_slots','ads.ad_page_slot_id','ad_page_slots.id')
            ->join('ad_pages','ad_pages.id','ad_page_slots.ad_page_id')
            ->whereRaw('ads.start_date <= date(now())')
            ->whereRaw('ads.end_date >= date(now())')
            //->where('ads.ad_id', '<>', $id)
            ->where('ads.status', 1)
			->when($ad_page_slot_id > 0, function($query) use($ad_page_slot_id){
				return $query->where('ad_page_slots.id', $ad_page_slot_id);
			})
			->when($ad_page_slot_id == 0, function($query){
			    return $query->where('ad_pages.code','business_card_public_page')
			    ->where('ad_page_slots.slot_no','1');
			})
            ->select('ads.ad_id', 'ads.content','ads.link')
            ->get();
            
            if(count($ads) == 1){
                $ad_id = $ads[0]->ad_id;
                $ad_url = $ads[0]->content;
                $ad_link = $ads[0]->link;
                
            } else if(count($ads) > 0){      
                $tmpAds = [];
                
                foreach($ads as $key => $ad){
                    if($ad->ad_id != $id){
                        $tmpAds[] = $ad;
                    }
                }
                
                $index = rand(0, count($tmpAds)-1);
                
                $ad_id = $tmpAds[$index]->ad_id;
                $ad_url = $tmpAds[$index]->content;
                $ad_link = $tmpAds[$index]->link;
            }
            
            return response()->json([
                'success' => 1,
                'data' => [
                    'ad_id'=>$ad_id,
                    'ad_url'=>$ad_url,
                    'ad_link'=>$ad_link
                ]
            ]);
        }catch(\Exception $e){
            \Log::error($e);
            return response()->json([
                'success' => 0,
                'data' => [
                    'ad_id'=>$ad_id,
                    'ad_url'=>$ad_url,
                    'ad_link'=>$ad_link
                ]
            ]);
        }
        
    }
}
