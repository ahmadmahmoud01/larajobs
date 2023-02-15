<x-app>

    <div class="bg-gray-50 border border-gray-200 p-10 rounded">
        <header>
            <h1 class="text-3xl text-center font-bold my-6 uppercase">
                Manage Jobs
            </h1>
        </header>

        <table class="w-full table-auto rounded-sm">
            <tbody>
                @if(count($jobs) > 0 )

                    @foreach ($jobs as $job)
                        <tr class="border-gray-300">


                            <td class="px-4 py-8 border-t border-b border-gray-300 text-lg">
                                <a href="show.html">
                                    {{ $job->title }}
                                </a>
                            </td>
                            <td class="px-4 py-8 border-t border-b border-gray-300 text-lg">
                                <a href="{{ route('jobs.edit', $job->id) }}" class="text-blue-400 px-6 py-2 rounded-xl"><i
                                        class="fa-solid fa-pen-to-square"></i>
                                    Edit</a>
                            </td>
                            <td class="px-4 py-8 border-t border-b border-gray-300 text-lg">
                                <form action="{{ route('jobs.destroy', $job->id) }}" method="POST">

                                    @csrf
                                    @method('DELETE')

                                    <button class="text-red-600">
                                        <i class="fa-solid fa-trash-can"></i>
                                        Delete
                                    </button>
                                </form>
                            </td>

                        </tr>
                    @endforeach
                @else

                    <p>No Jobs Found</p>

                @endif

            </tbody>
        </table>
    </div </x-app>
