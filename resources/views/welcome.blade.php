<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>SchoolOS</title>
    <style>
        body{
            font-family: Arial, sans-serif;
            background:#f4f6f9;
            display:flex;
            justify-content:center;
            align-items:center;
            height:100vh;
        }

        .card{
            background:white;
            padding:40px;
            border-radius:10px;
            box-shadow:0 0 20px rgba(0,0,0,.1);
            width:350px;
        }

        h1{
            text-align:center;
            color:#1e40af;
        }

        input{
            width:100%;
            padding:10px;
            margin-top:10px;
            margin-bottom:15px;
        }

        button{
            width:100%;
            padding:10px;
            background:#1e40af;
            color:white;
            border:none;
        }
    </style>
</head>
<body>

<div class="card">
    <h1>SchoolOS</h1>

    <form>
        <input type="text" placeholder="Kullanıcı Adı">
        <input type="password" placeholder="Şifre">
        <button type="submit">Giriş Yap</button>
    </form>

</div>

</body>
</html>
