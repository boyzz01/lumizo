<html lang="en">

<body>

    <p>Dear {{ $user->name }}</p>
    <p>Akun Anda Berhasil Dibuat, Mohon aktivasi menggunakan link dibawah ini</p>
    <p><a href="{{ route('verify', $user->verification_token) }}">
            {{ route('verify', $user->verification_token) }}
        </a></p>
    <p>Thanks</p>

</body>

</html>
