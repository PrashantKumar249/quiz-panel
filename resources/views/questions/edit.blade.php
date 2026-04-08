<h2>Edit Question</h2>

<form method="POST" action="/questions/update/{{ $question->id }}">
    @csrf

    <input type="hidden" name="quiz_id" value="{{ $question->quiz_id }}">

    <p>Question:</p>
    <input type="text" name="question" value="{{ $question->question }}"><br><br>

    <p>Option A:</p>
    <input type="text" name="option_a" value="{{ $question->option_a }}"><br>

    <p>Option B:</p>
    <input type="text" name="option_b" value="{{ $question->option_b }}"><br>

    <p>Option C:</p>
    <input type="text" name="option_c" value="{{ $question->option_c }}"><br>

    <p>Option D:</p>
    <input type="text" name="option_d" value="{{ $question->option_d }}"><br><br>

    <p>Correct Answer:</p>
    <select name="correct_answer">
        <option value="A" {{ $question->correct_answer == 'A' ? 'selected' : '' }}>A</option>
        <option value="B" {{ $question->correct_answer == 'B' ? 'selected' : '' }}>B</option>
        <option value="C" {{ $question->correct_answer == 'C' ? 'selected' : '' }}>C</option>
        <option value="D" {{ $question->correct_answer == 'D' ? 'selected' : '' }}>D</option>
    </select><br><br>

    <button type="submit">Update</button>
</form>