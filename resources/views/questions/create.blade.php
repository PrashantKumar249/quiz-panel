<h2>Add Question</h2>

@if(session('success'))
    <p style="color:green;">{{ session('success') }}</p>
@endif

<form method="POST" action="/questions/store">
    @csrf

    <input type="hidden" name="quiz_id" value="{{ $quiz_id }}">

    <p>Question:</p>
    <input type="text" name="question"><br><br>

    <p>Option A:</p>
    <input type="text" name="option_a"><br>

    <p>Option B:</p>
    <input type="text" name="option_b"><br>

    <p>Option C:</p>
    <input type="text" name="option_c"><br>

    <p>Option D:</p>
    <input type="text" name="option_d"><br><br>

    <p>Correct Answer:</p>
    <select name="correct_answer">
        <option value="A">A</option>
        <option value="B">B</option>
        <option value="C">C</option>
        <option value="D">D</option>
    </select><br><br>

    <button type="submit">Add Question</button>
</form>