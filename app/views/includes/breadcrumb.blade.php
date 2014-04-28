<ol class="breadcrumb">
    @foreach($breadcrumbs as $breadcrumb)
        @if($breadcrumb['link'] != '')
            <li>
                <a href="{{ $breadcrumb['link'] }}">{{ $breadcrumb['text'] }}</a>
            </li>
        @else
            <li class="active">{{ $breadcrumb['text'] }}</li>
        @endif
    @endforeach
</ol>
