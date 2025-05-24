<!DOCTYPE html>
<html lang="en">
<meta charset="UTF-8">
<title>KDA Demo</title>
<meta name="viewport" content="width=device-width,initial-scale=1">
<body>
        <h1>KDA interview demo example</h1>
        <div>
            <button>Random</button>
        </div>
        <br>
        <br>
        <form action="api.php" method="POST">
            <label>Navn:</label>
            <input type="text"></input>
            <input type="submit" value="Get info">
        </form>
</body>
<script>
    let button = document.querySelector('button');
    button.addEventListener('click', async () => {
        const response = await fetch('api.php', {
            method: 'GET',
        });
    });
</script>
</html>
