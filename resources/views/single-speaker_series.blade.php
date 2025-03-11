@extends('page')

{{-- @section('hero')
    @includeFirst(['partials.hero-' . get_post_type(), 'partials.hero'])
@endsection --}}

@section('content')
    @while (have_posts())
        @php(the_post())
        @includeFirst(['partials.content-single-' . get_post_type(), 'partials.content'])
    @endwhile
@endsection
