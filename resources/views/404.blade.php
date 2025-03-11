@extends('page')

@section('content')
  @while ($errorPage->have_posts())
    @php($errorPage->the_post())
    @includeFirst(['partials.content-page', 'partials.content'])
  @endwhile
@endsection
