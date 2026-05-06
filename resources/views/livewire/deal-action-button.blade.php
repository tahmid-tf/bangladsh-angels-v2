<form action="{{route('deal.invest', $deal->id)}}" class="mt-6" method="POST">
    @csrf
    <input type="text" name="user_id" value="{{auth()->id()}}" hidden id="user_id">
    <input type="text" name="deal_id" value="{{$deal->id}}" hidden id="deal_id">
    <input type="submit" value="@php
        if ($deal->type=="review") {
            echo "Join WhatsApp Group";
        } else if($deal->type == "portfolio") {
            echo "View Portfolio";
        } else if ($deal->type === 'invest') {
            echo "Commit Investment / Express Interest to Invest";
        } else {
            echo ucfirst($deal->type);
        }
    @endphp" class="px-4 w-full cursor-pointer mt-6 py-3 bg-green-600 text-white text-sm font-semibold rounded-lg hover:bg-green-700 transition leading-snug">
</form>
