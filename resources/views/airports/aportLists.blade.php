<ul id="aport-list">
    @foreach($airports as $airport)
        <li>
            {{ $airport->apname }}
        </li>
    @endforeach
</ul>