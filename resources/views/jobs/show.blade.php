<x-app>

    <a href="{{ route('jobs.index') }}" class="inline-block text-black ml-4 mb-4"
                ><i class="fa-solid fa-arrow-left"></i> Back
            </a>
            <div class="mx-4">
                <div class="bg-gray-50 border border-gray-200 p-10 rounded">
                    <div
                        class="flex flex-col items-center justify-center text-center"
                    >
                        <img
                            class="w-48 mr-6 mb-6"
                            src="{{ $job->logo ? asset('storage/' . $job->logo) : asset('/images/no-image.png') }}"
                            alt=""
                        />

                        <h3 class="text-2xl mb-2">{{ $job->title }}</h3>
                        <div class="text-xl font-bold mb-4">{{ $job->company }}</div>
                        {{-- <ul class="flex">
                            <li
                                class="bg-black text-white rounded-xl px-3 py-1 mr-2"
                            >
                                <a href="#">Laravel</a>
                            </li>
                            <li
                                class="bg-black text-white rounded-xl px-3 py-1 mr-2"
                            >
                                <a href="#">API</a>
                            </li>
                            <li
                                class="bg-black text-white rounded-xl px-3 py-1 mr-2"
                            >
                                <a href="#">Backend</a>
                            </li>
                            <li
                                class="bg-black text-white rounded-xl px-3 py-1 mr-2"
                            >
                                <a href="#">Vue</a>
                            </li>
                        </ul> --}}
                        <x-job-tags :tagsCsv="$job->tags"/>


                        <div class="text-lg my-4">
                            <i class="fa-solid fa-location-dot"></i> {{ $job->location }}
                        </div>
                        <div class="border border-gray-200 w-full mb-6"></div>
                        <div>
                            <h3 class="text-3xl font-bold mb-4">
                                Job Description
                            </h3>
                            <div class="text-lg space-y-6">
                                {{$job->description}}

                                <a
                                    href="mailto:{{ $job->email }}"
                                    class="block bg-laravel text-white mt-6 py-2 rounded-xl hover:opacity-80"
                                    ><i class="fa-solid fa-envelope"></i>
                                    Contact Employer</a
                                >

                                <a
                                    href="{{ $job->website }}"
                                    target="_blank"
                                    class="block bg-black text-white py-2 rounded-xl hover:opacity-80"
                                    ><i class="fa-solid fa-globe"></i> Visit
                                    Website</a
                                >
                                @auth
                                {{-- edit btn --}}
                                    {{-- <div class="mt-4 p-2 flex space-x-6">
                                        <a href="{{ route('jobs.edit', $job->id) }}">
                                            <i class="fa-solid fa-pencil"></i> Edit
                                        </a> --}}
                                        {{-- Delete btn --}}
                                        {{-- <form action="{{ route('jobs.destroy', $job->id) }}" method="POST">

                                            @csrf
                                            @method('DELETE')

                                            <button >
                                                <i class="fa-solid fa-trash"></i> Delete
                                            </button>
                                        </form>
                                    </div> --}}
                                @endauth
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        {{-- <div class="mt-4 p-2 flex space-x-6">
            <a href="{{ route('jobs.edit', $job->id) }}">
                <i class="fa-solid fa-pencil"></i> Edit
            </a>
        </div> --}}

</x-app>
