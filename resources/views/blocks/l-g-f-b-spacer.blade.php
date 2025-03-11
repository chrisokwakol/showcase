@if(!empty($space))
    <div class="lgfb-spacer @if($hide_for) @foreach($hide_for as $hideSize) hide-for-{{$hideSize}}-only @endforeach @endif" style="margin:{{ $space }}px 0 0"></div>
@endif