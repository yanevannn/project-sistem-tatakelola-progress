<!DOCTYPE html>
<html>
<head>
    <title>Selamat Datang</title>
</head>
<body>
    <h1>Selamat Datang, {{ $user->nama }}!</h1>
    <p>
        Terima kasih telah menjadi bagian UKM PROGRESS sebagai {{ $user->role }}.
        Kami berharap Anda memiliki pengalaman yang luar biasa bersama kami.
    </p>

    <p><strong>Informasi Login:</strong></p>
    <p>
        Email: {{ $user->email }}<br>
        Password: {{ $plainPassword }}<br> <!-- Displaying the plain password passed from the controller -->
    </p>

    <p>Jika Anda ingin mengganti password, Anda dapat mengatur ulang password melalui halaman profil Anda.</p>

    <p><strong>Login ke akun Anda:</strong></p>
    <p>
        Klik di <a href="{{ route('login') }}">sini</a> untuk login ke akun Anda.
    </p>

    <p>Salam Hangat,</p>
    <p>Tim Kami</p>
</body>
</html>
