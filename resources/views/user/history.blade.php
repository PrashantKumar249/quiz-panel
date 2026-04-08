<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            📋 My Quiz History
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">

            {{-- Back Button --}}
            <div class="mb-5">
                <a href="{{ route('dashboard') }}"
                   class="bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-2 px-5 rounded-lg transition text-sm">
                    ← Dashboard par wapas jao
                </a>
            </div>

            @if($history->isEmpty())
                <div class="bg-white rounded-xl shadow-sm p-12 text-center border border-gray-100">
                    <p class="text-5xl mb-3">📭</p>
                    <p class="text-gray-500 text-lg">Abhi tak koi quiz attempt nahi kiya.</p>
                    <a href="{{ route('dashboard') }}" class="mt-4 inline-block text-indigo-600 font-medium hover:underline">
                        Quiz dene jao →
                    </a>
                </div>
            @else
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                    <table class="w-full text-sm">
                        <thead>
                            <tr class="bg-gray-50 border-b border-gray-200">
                                <th class="text-left px-6 py-3 text-gray-600 font-semibold">#</th>
                                <th class="text-left px-6 py-3 text-gray-600 font-semibold">Quiz</th>
                                <th class="text-center px-4 py-3 text-gray-600 font-semibold">Total Q</th>
                                <th class="text-center px-4 py-3 text-gray-600 font-semibold">✅ Correct</th>
                                <th class="text-center px-4 py-3 text-gray-600 font-semibold">❌ Wrong</th>
                                <th class="text-center px-4 py-3 text-gray-600 font-semibold">Score</th>
                                <th class="text-center px-4 py-3 text-gray-600 font-semibold">Date</th>
                                <th class="text-center px-4 py-3 text-gray-600 font-semibold">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($history as $index => $attempt)
                                <tr class="border-b border-gray-100 hover:bg-gray-50 transition">
                                    <td class="px-6 py-4 text-gray-500">{{ $index + 1 }}</td>
                                    <td class="px-6 py-4 font-medium text-gray-800">
                                        {{ $attempt->quiz->title }}
                                    </td>
                                    <td class="px-4 py-4 text-center text-gray-600">
                                        {{ $attempt->total_questions }}
                                    </td>
                                    <td class="px-4 py-4 text-center font-semibold text-green-600">
                                        {{ $attempt->correct_answers }}
                                    </td>
                                    <td class="px-4 py-4 text-center font-semibold text-red-500">
                                        {{ $attempt->wrong_answers }}
                                    </td>
                                    <td class="px-4 py-4 text-center">
                                        <span class="px-3 py-1 rounded-full text-sm font-bold
                                            {{ $attempt->score >= 70 ? 'bg-green-100 text-green-700' : ($attempt->score >= 40 ? 'bg-yellow-100 text-yellow-700' : 'bg-red-100 text-red-700') }}">
                                            {{ $attempt->score }}%
                                        </span>
                                    </td>
                                    <td class="px-4 py-4 text-center text-gray-500 text-xs">
                                        {{ $attempt->created_at->format('d M Y, h:i A') }}
                                    </td>
                                    <td class="px-4 py-4 text-center">
                                        <a href="{{ route('user.quiz.result', $attempt->id) }}"
                                           class="text-indigo-600 hover:underline text-xs font-medium">
                                            View Result
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                {{-- Summary Stats --}}
                <div class="mt-6 grid grid-cols-3 gap-4">
                    <div class="bg-white rounded-xl p-5 shadow-sm border border-gray-100 text-center">
                        <p class="text-3xl font-bold text-indigo-600">{{ $history->count() }}</p>
                        <p class="text-gray-500 text-sm mt-1">Total Attempts</p>
                    </div>
                    <div class="bg-white rounded-xl p-5 shadow-sm border border-gray-100 text-center">
                        <p class="text-3xl font-bold text-green-600">{{ round($history->avg('score')) }}%</p>
                        <p class="text-gray-500 text-sm mt-1">Average Score</p>
                    </div>
                    <div class="bg-white rounded-xl p-5 shadow-sm border border-gray-100 text-center">
                        <p class="text-3xl font-bold text-yellow-600">{{ $history->max('score') }}%</p>
                        <p class="text-gray-500 text-sm mt-1">Best Score</p>
                    </div>
                </div>
            @endif

        </div>
    </div>
</x-app-layout>