{{--
  Template Name: Social Share Demo Template
--}}

@extends('page')

@section('content')
    <div class="text-center py-10" style="background:var(--emerson--clinic-grey)">
        @include('partials.page-header')

        @if (!get_field('hide_social-share'))
            <x-social-share />
        @endif
    </div>
@endsection
