<div class="flex flex-col justify-between bg-white rounded-lg shadow-md overflow-hidden">
    <div class="relative w-full aspect-[16/9]">
        @auth
            <a href="{{ route('deal.view', $deal->id) }}">
                <img src="{{ $deal->getCoverUrl() }}" alt="Deal Image" class="absolute inset-0 w-full h-full object-cover rounded-t-lg">
            </a>
        @endauth
        @guest
            <a href="{{ route('deal.public.view', $deal->id) }}">
                <img src="{{ $deal->getCoverUrl() }}" alt="Deal Image" class="absolute inset-0 w-full h-full object-cover rounded-t-lg">
            </a>
        @endguest
    </div>

    <div class="flex flex-col p-4">
        <div class="flex items-center mt-6 justify-between">
            @guest
                <a href="{{route('deal.public.view',$deal->id)}}" class="text-lg font-bold">{{ $deal->title }}</a>
            @endguest
            @auth
                <a href="{{route('deal.view',$deal->id)}}" class="text-lg font-bold">{{ $deal->title }}</a>
            @endauth
            <span class="bg-gray-200 text-xs px-2 py-1 rounded-full">{{ ucfirst($deal->sector) }}</span>
        </div>
        
        <p class="text-gray-500 text-sm mt-2">
            {{ $deal->getExcerpt() }}
        </p>
    </div>
    
    <div class="flex flex-col border-box p-4 w-full">

        <div class="flex justify-between items-center mt-4 text-sm">
            @if ($deal->investment_stage)
                <div class="text-center">
                    <p class="text-gray-400">Investment Stage</p>
                    <p class="font-semibold">{{ $deal->investment_stage }}</p>
                </div>    
            @endif
            
            @if ($deal->amount_seeking)
                <div class="text-center">
                    <p class="text-gray-400">Amount Seeking</p>
                    <p class="font-semibold text-green-600">$ {{ $deal->amountSeeking() }}</p>
                </div>
            @endif
        </div>

        @auth
            <a href="{{ ($deal->type!=="review") ? route('deal.view',$deal->id) : $deal->groupchat_invite_link }}" 
               class="px-6 w-full text-center cursor-pointer mt-6 py-3 bg-[#18736a] text-white font-semibold rounded-lg hover:bg-[#20978c] transition">
                @php
                    if ($deal->type=="review") {
                        echo "Join WhatsApp Group";
                    } else if($deal->type == "portfolio") {
                        echo "View Portfolio";
                    } else { 
                        echo ucfirst($deal->type);
                    }
                @endphp
            </a>
        @endauth
        @guest
            <a href="{{ route('deal.public.view',$deal->id) }}" 
               class="px-6 w-full text-center cursor-pointer mt-6 py-3 bg-green-600 text-white font-semibold rounded-lg hover:bg-green-700 transition">
                {{
                    ($deal->type!=="review") ? ucfirst($deal->type) : "Join WhatsApp Group"
                }}
            </a>
        @endguest
    </div>
</div>
