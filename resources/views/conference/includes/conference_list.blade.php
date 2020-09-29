<div class="containter col-md-12">
    <ul class="nav navbar-nav side-nav">
        @foreach ($conferenceList as $item)
            @php /** @var \App\Models\Conference $item **/  @endphp

            <li>
                <a href="{{ route('conference.show', $item->id) }}">
                    <span class="font-weight-bold">{{ $item->name }}</span>
                </a>
                <span class="font-weight-light font-italic d-none">
                    {{ $item->start_time }}
                </span>
            </li>
        @endforeach
    </ul>
</div>
