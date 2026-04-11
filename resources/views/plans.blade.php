@extends('layouts.guest')
@section('page_title','Subscription Plans | Bangladesh Angels Network')
@section('page_content')
<section class="container mx-auto px-4 py-12">
    @include('partials.subscription-plans', ['tiers' => $tiers])
</section>
@endsection
