 @if (isset($adPageSlots) && count($adPageSlots) > 0) 
	 <div class="bg-white pt-12 lg:pt-5">
        <div class="container mx-auto px-4">
            <div class="flex flex-wrap -mx-4">
                @foreach($adPageSlots as $adPageSlot)
				 <div class="w-full lg:w-1/2 px-4  md:mb-20 lg:mb-0 ">
                    <div class="w-124 h-16 flex items-center justify-center">
                        <div class="max-w-sm mx-auto lg:mx-0 w-full h-16 text-center bg-auto bg-no-repeat bg-center page-adv cursor-pointer" data-ad-page-slot-id="{{$adPageSlot->id}}" data-ad-id="0">
                            
                        </div>
                    </div>
                </div>
				@endforeach				              
            </div>
        </div>
    </div>
	
<script>
$(document).ready(function(){
	autoChangeAd();
	
	window.setInterval(autoChangeAd,{{env('AUTO_REFRESH_AD_INTERVAL_IN_SEC',60)*1000}});
});
function autoChangeAd(){
	$('div.page-adv').each(function(){
		var that = $(this);
		var current_ad_id = $(this).data('ad-id');
		var current_ad_page_slot_id = $(this).data('ad-page-slot-id');
		
		 $.ajax({
			 url: "{{ url('get-random-ad') }}/"+current_ad_id+'?ad_page_slot_id='+current_ad_page_slot_id,
			 method: 'GET',
		 })
		 .done(function(res) {
			 if(res.success==1 ){
				 if(res.data.ad_id !== ''){
					that.data('ad-id', res.data.ad_id);
					that.css('background-image', "url("+res.data.ad_url+")");

					that.off('click');
					
					if(res.data.ad_link != ""){
						that.on('click', function(){
							window.open(res.data.ad_link);
						});
					}
					that.show();
				 } else {
					 that.hide();
				 }
			 }
		 });
		
	});
    	
	
}
</script>

@endif