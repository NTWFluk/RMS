<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <title>{{$index}}</title>
</head>
<body>
<div class=" flex w-screen h-screen relative justify-center items-center">
    
    <form class=" w-1/2 absolute p-4 shadow-2xl rounded-lg border-2 border-solid" action="{{ route('gologin') }}" method="post">
        @csrf
        <div class=" flex justify-center">
            <p class=" text-4xl">RMS</p>
        </div>
        <div class=" w-full my-4">
            <p class=" text-xl ml-2">ชื่อผู้ใข้งาน</p>
            <input class=" flex text-lg border-solid rounded-lg border-2 border-gray-700 w-full my-2 py-2 px-3" placeholder="กรุณากรอกชื่อผู้ใช้งาน" type="text" name="username">
        </div>
        <div class=" w-full my-4">
            <p class=" text-xl ml-2">รหัสผ่าน</p>
            <input class=" flex text-lg border-solid rounded-lg border-2 border-gray-700 w-full my-2 py-2 px-3" placeholder="กรุณากรอกรหัสผ่าน" type="password" name="password">
        </div>
        <div class=" flex justify-center">
            <button class=" flex justify-center text-lg border-solid rounded-lg border-2 border-gray-700 w-1/2 my-2 py-2 px-3" type="submit">เข้าสู่ระบบ</button>
        </div>
        <div class=" flex justify-center">
            <a href="{{ route('forgetpassword') }}" class=" text-lg">??ลืมรหัสผ่าน??</a>
        </div>
    </form>
</div>
</body>
</html>