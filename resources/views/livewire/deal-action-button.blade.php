<form action="{{route('deal.invest', $deal->id)}}" class="mt-6" method="POST">
    @csrf
    <input type="text" name="user_id" value="{{auth()->id()}}" hidden id="user_id">
    <input type="text" name="deal_id" value="{{$deal->id}}" hidden id="deal_id">
    <input type="submit" value="{{
    
    ($deal->type!=="review") ? ucfirst($deal->type) : "Join WhatsApp Group"
    
    
    }}" class="px-6 w-full cursor-pointer mt-6 py-3 bg-green-600 text-white font-semibold rounded-lg hover:bg-green-700 transition">
</form>