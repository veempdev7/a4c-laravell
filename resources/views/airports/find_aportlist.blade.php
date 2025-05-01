<ul>
    @forelse($jracodes as $code)
        <li>{{ $code->jracode }}</li>
    @empty
        <li>No data found.</li>
    @endforelse
</ul>