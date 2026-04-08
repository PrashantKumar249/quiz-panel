<h2>{{ $quiz->title }} - Questions</h2>

<a href="/questions/create/{{ $quiz->id }}">Add New Question</a>

<hr>

@if(session('success'))
    <p style="color:green;">{{ session('success') }}</p>
@endif

@foreach($quiz->questions as $q)
    <div style="margin-bottom:20px; border:1px solid #ccc; padding:10px;">
        <strong>Q: {{ $q->question }}</strong><br>

        A: {{ $q->option_a }}<br>
        B: {{ $q->option_b }}<br>
        C: {{ $q->option_c }}<br>
        D: {{ $q->option_d }}<br>

        <b>Correct: {{ $q->correct_answer }}</b><br><br>

        <a href="/questions/edit/{{ $q->id }}">Edit</a> |
        <a href="/questions/delete/{{ $q->id }}">Delete</a>
    </div>
@endforeach