<!DOCTYPE html>
<html>
<head>
    <title>Редагування інформації про книгу</title>
</head>
<body>
    <form action="process_form.php" method="post">
        <label for="title">Заголовок:</label>
        <input type="text" name="title" id="title" value="">
        <br>

        <label for="author">Автор:</label>
        <input type="text" name="author" id="author" value="">
        <br>

        <label for="publisher">Видавник:</label>
        <input type="text" name="publisher" id="publisher" value="">
        <br>

        <label for="publication_date">Дата публікації:</label>
        <input type="text" name="publication_date" id="publication_date" value="">
        <br>

        <input type="submit" value="Зберегти">
    </form>
</body>
</html>
