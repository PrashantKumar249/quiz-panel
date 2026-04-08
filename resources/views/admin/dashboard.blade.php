<style>
    body {
        font-family: Arial;
        background: #f4f6f9;
        padding: 20px;
    }

    h1 {
        color: #333;
    }

    a {
        display: inline-block;
        padding: 10px 15px;
        background: #3490dc;
        color: white;
        text-decoration: none;
        border-radius: 5px;
        margin-bottom: 10px;
    }

    a:hover {
        background: #2779bd;
    }

    hr {
        margin: 20px 0;
    }
</style>

<h1>Admin Dashboard</h1>

<hr>

<h3>Total Quizzes: {{ $quizCount }}</h3>
<h3>Total Questions: {{ $questionCount }}</h3>

<hr>

<h2>Actions</h2>

<a href="/quiz/create">➕ Create Quiz</a><br><br>
<a href="/quiz/list">📚 View All Quizzes</a><br><br>

<a href="/questions/1">📋 Manage Questions (Quiz 1)</a><br><br>

<form method="POST" action="/logout">
    @csrf
    <button type="submit">Logout</button>
</form>