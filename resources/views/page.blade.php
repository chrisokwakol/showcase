@extends('layouts.app')

@section('content')
    @while (have_posts())
        @php(the_post())
        @includeFirst(['partials.content-page', 'partials.content'])
    @endwhile
@endsection

@section('navigation')
    @include('partials.navigation.primary')
@endsection
