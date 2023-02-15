<x-app>

    @include('layouts.partials._hero')
    @include('layouts.partials._search')

{{-- <h1>All Jobs</h1> --}}

    @if(count($jobs) > 0)

        @foreach ($jobs as $job)

            <x-job-card :job="$job" />

        @endforeach

    @else

        <p>No data Found</p>

    @endif

    <div class="mt-6 p-4">
        {{ $jobs->links() }}
    </div>
</x-app>
