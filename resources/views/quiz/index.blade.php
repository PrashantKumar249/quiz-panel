<h2>All Quizzes</h2>

<a href="/quiz/create">Create New Quiz</a>

<hr>

@foreach($quizzes as $quiz)
    <div style="border:1px solid #ccc; padding:10px; margin-bottom:10px;">
        <h3>{{ $quiz->title }}</h3>
        <p>{{ $quiz->description }}</p>

        <a href="/questions/{{ $quiz->id }}">Manage Questions</a>
    </div>
@endforeach