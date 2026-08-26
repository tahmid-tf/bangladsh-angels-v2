<form action="{{route('deal.invest', $deal->id)}}" class="mt-0" method="POST">
    @csrf
    <input type="text" name="user_id" value="{{auth()->id()}}" hidden id="user_id">
    <input type="text" name="deal_id" value="{{$deal->id}}" hidden id="deal_id">
    <input type="submit" value="@php
        if ($deal->type=="review") {
            echo "Join WhatsApp Group";
        } else if($deal->type == "portfolio") {
            echo "View Portfolio";
        } else if ($deal->type === 'invest') {
            echo "Ask for due diligence documents";
        } else if ($deal->type === 'commit') {
            echo "Enter commitment (amount & deadline)";
        } else {
            echo ucfirst($deal->type);
        }
    @endphp" class="px-4 w-full cursor-pointer py-3 bg-[#36b37e] text-white text-sm font-bold rounded-full shadow-md hover:bg-[#2f9e6f] transition leading-snug">
</form>
