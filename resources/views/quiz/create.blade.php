<!DOCTYPE html>
<html>
<head>
    <title>Create Quiz</title>
</head>
<body>

<h2>Create Quiz</h2>

@if(session('success'))
    <p style="color:green;">{{ session('success') }}</p>
@endif

<form method="POST" action="/quiz/store">
    @csrf

    <label>Quiz Title:</label><br>
    <input type="text" name="title"><br><br>

    <label>Description:</label><br>
    <textarea name="description"></textarea><br><br>

    <label>Time Limit (minutes):</label><br>
    <input type="number" name="time_limit"><br><br>

    <button type="submit">Create Quiz</button>
</form>

</body>
</html>