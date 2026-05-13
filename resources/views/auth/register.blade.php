<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Daftar TokoQ</title>
</head>
<body>
    <form method="POST" action="/register">
        @csrf
        <input name="name" type="text" required placeholder="Nama">
        <input name="email" type="email" required placeholder="Email">
        <input name="password" type="password" required placeholder="Password">
        <input name="password_confirmation" type="password" required placeholder="Konfirmasi Password">
        <input name="shop_name" type="text" required placeholder="Nama Toko">
        <button type="submit">Daftar</button>
    </form>
</body>
</html>
