<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Quiz List
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <table class="table mt-4 w-full table-view">
                        <thead>
                        <tr>
                            <th class="w-16 bg-gray-50 px-6 py-3 text-left">
                                    <span
                                        class="text-xs font-medium uppercase leading-4 tracking-wider text-gray-500">ID</span>
                            </th>
                            <th class="bg-gray-50 px-6 py-3 text-left">
                                    <span
                                        class="text-xs font-medium uppercase leading-4 tracking-wider text-gray-500">Name</span>
                            </th>
                            <th class="bg-gray-50 px-6 py-3 text-left">
                                    <span
                                        class="text-xs font-medium uppercase leading-4 tracking-wider text-gray-500">Questions</span>
                            </th>
                            <th class="w-40 bg-gray-50 px-6 py-3 text-left">Action</th>
                        </tr>
                        </thead>

                        <tbody class="bg-white divide-y divide-gray-200 divide-solid">
                        @forelse($quizzes as $quiz)
                            <tr class="bg-white">
                                <td class="px-6 py-4 text-sm leading-5 text-gray-900 whitespace-no-wrap">
                                    {{ ++$i }}
                                </td>
                                <td class="px-6 py-4 text-sm leading-5 text-gray-900 whitespace-no-wrap">
                                    {{ $quiz->title }}
                                </td>
                                <td class="px-6 py-4 text-sm leading-5 text-gray-900 whitespace-no-wrap">
                                    {{ $quiz->questions_count }}
                                </td>
                                <td>
                                    @if(in_array($quiz->id, $user_completed_quizzes))
                                        <a href="{{ route('user.results', $quiz->slug) }}"
                                           class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150">
                                            See result
                                        </a>
                                    @else
                                        <a href="{{ route('user.quiz.show', $quiz->slug) }}"
                                           class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150">
                                            Start Quiz
                                        </a>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <div class="mt-2">No record found.</div>
                        @endforelse
                        </tbody>
                    </table>
                    {{ $quizzes->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
