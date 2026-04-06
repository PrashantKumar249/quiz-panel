<form method="POST" action="/quiz/store">
    @csrf

    <input type="text" name="title" placeholder="Quiz Title"><br><br>

    <textarea name="description" placeholder="Description"></textarea><br><br>

    <input type="number" name="time_limit" placeholder="Time (minutes)"><br><br>

    <button type="submit">Create Quiz</button>
</form>