<!DOCTYPE html>
<html>
<head>
    <title>Cek CSRF</title>
</head>
<body>

    <h2>TEST CSRF SIPANDAI</h2>

    <form action="/cek-csrf" method="POST">

        @csrf

        <button type="submit">
            TEST POST
        </button>

    </form>

</body>
</html>