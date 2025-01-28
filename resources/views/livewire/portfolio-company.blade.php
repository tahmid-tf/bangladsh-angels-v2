<div class="w-[1/3] m-6">
    <article class="overflow-hidden rounded-lg shadow transition hover:shadow-lg">
        <img
          alt=""
          src="{{$deal->getCoverUrl()}}"
          class="h-56 w-full object-cover"
        />
      
        <div class="bg-white p-4 sm:p-6">
          <time datetime="2022-10-10" class="block text-xs text-gray-500"> {{$deal->created_at->diffForHumans()}} </time>
      
          <a href="#">
            <h3 class="mt-0.5 text-lg text-gray-900">{{$deal->title}}</h3>
          </a>
      
          <p class="mt-2 line-clamp-3 text-sm/relaxed text-gray-500">{{ $deal->description }}</p>
        </div>
  </article>
</div>