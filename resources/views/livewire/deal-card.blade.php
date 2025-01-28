<div class="flex flex-col justify-between bg-white rounded-lg shadow-md overflow-hidden">
    <div class="flex flex-col p-4">
        
        @auth
        <a href="{{ route('deal.view', $deal->id) }}">
            <img src="{{ $deal->getCoverUrl() }}" alt="Deal Image" class="w-full h-40 object-cover">
        </a>
        @endauth
        @guest
            <a href="{{ route('deal.public.view', $deal->id) }}">
                <img src="{{ $deal->getCoverUrl() }}" alt="Deal Image" class="w-full h-40 object-cover">
            </a>
        @endguest
        <div class="flex items-center mt-6 justify-between">
            <h2 class="text-lg font-bold">{{ $deal->title }}</h2>
            <span class="bg-gray-200 text-xs px-2 py-1 rounded-full">{{ ucfirst($deal->sector) }}</span>
        </div>
        <p class="text-gray-500 text-sm mt-2">
            {{ $deal->description }}
        </p>
        <div class="flex justify-between items-center mt-4 text-sm">
            <div class="text-center">
                <p class="text-gray-400">Investment Stage</p>
                <p class="font-semibold">{{ $deal->investment_stage }}</p>
            </div>
            <div class="text-center">
                <p class="text-gray-400">Amount Seeking</p>
                <p class="font-semibold">$ {{ $deal->amountSeeking() }}</p>
            </div>
        </div>
    </div>
    
    <div class="flex border-box p-4 w-full">
        @auth
        <a href="{{ ($deal->type!=="review") ? route('deal.view',$deal->id) : $deal->groupchat_invite_link }}" class="px-6 w-full text-center cursor-pointer mt-6 py-3 bg-green-600 text-white font-semibold rounded-lg hover:bg-green-700 transition">{{
                
            ($deal->type!=="review") ? ucfirst($deal->type) : "Join WhatsApp Group"
        
        }}</a>
        @endauth
        @guest
        <a href="{{ route('deal.public.view',$deal->id) }}" class="px-6 w-full text-center cursor-pointer mt-6 py-3 bg-green-600 text-white font-semibold rounded-lg hover:bg-green-700 transition">{{
                
            ($deal->type!=="review") ? ucfirst($deal->type) : "Join WhatsApp Group"
        
        }}</a>
        @endguest
        
        
            
        </form>
    </div>
</div>