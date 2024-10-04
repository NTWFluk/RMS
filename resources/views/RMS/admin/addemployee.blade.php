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
<div class=" flex w-screen relative justify-center items-center">
    <form class=" w-1/2 p-4 shadow-2xl mt-4 rounded-lg border-2 border-solid" action="{{ route('yesaddemployee') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class=" flex justify-center">
            <p class=" text-4xl">เพิ่มพนักงาน</p>
        </div>
        <div class=" w-full my-4">
            <p class=" text-xl ml-2">ชื่อ-นามสกุล</p>
            <div class=" flex">
                <input class=" flex text-lg border-solid rounded-lg border-2 border-gray-700 w-1/4 my-2 py-2 px-3 mr-1" placeholder="นาย" type="text" name="prefix">
                <input class=" flex text-lg border-solid rounded-lg border-2 border-gray-700 w-1/2 my-2 py-2 px-3 mr-3" placeholder="ชื่อ" type="text" name="frist_name">
                <input class=" flex text-lg border-solid rounded-lg border-2 border-gray-700 w-full my-2 py-2 px-3" placeholder="นามสกุล" type="text" name="last_name">
            </div>
        </div>
        <div class=" w-full my-4">
            <p class=" text-xl ml-2">ชื่อผู้ใข้งาน</p>
            <input class=" flex  text-lg border-solid rounded-lg border-2 border-gray-700 w-full my-2 py-2 px-3" placeholder="ชื่อผู้ใช้งาน" type="text" name="username">
        </div>
        <div class=" w-full my-4">
            <p class=" text-xl ml-2">รหัสผ่าน</p>
            <input class=" flex text-lg border-solid rounded-lg border-2 border-gray-700 w-full my-2 py-2 px-3" placeholder="รหัสผ่าน" type="password" name="password">
        </div>
        <div class=" w-full my-4">
            <p class=" text-xl ml-2">ที่อยู่</p>
            <textarea class=" flex text-lg border-solid rounded-lg border-2 border-gray-700 w-full my-2 py-2 px-3" placeholder="ที่อยู่" name="address" rows="2"></textarea>
        </div>
        <div class=" w-full my-4">
            <p class=" text-xl ml-2">Line ID</p>
            <input class=" flex text-lg border-solid rounded-lg border-2 border-gray-700 w-full my-2 py-2 px-3" placeholder="รหัสผ่าน" type="text" name="line_id">
        </div>
        <div class=" w-full my-4">
            <p class=" text-xl ml-2">Facebook</p>
            <input class=" flex text-lg border-solid rounded-lg border-2 border-gray-700 w-full my-2 py-2 px-3" placeholder="Facebook" type="text" name="facebook">
        </div>
        <div class=" w-full my-4">
            <p class=" text-xl ml-2">E-Mail</p>
            <input class=" flex text-lg border-solid rounded-lg border-2 border-gray-700 w-full my-2 py-2 px-3" placeholder="E-Mail" type="email" name="email">
        </div>
        <div class=" w-full my-4">
            <p class=" text-xl ml-2">วันเกิด</p>
            <input class=" flex text-lg border-solid rounded-lg border-2 border-gray-700 w-full my-2 py-2 px-3" type="date" name="birthday">
        </div>
        <div class=" w-full my-4">
            <p class=" text-xl ml-2">เพศ</p>
            <input class=" flex text-lg border-solid rounded-lg border-2 border-gray-700 w-full my-2 py-2 px-3" placeholder="เพศ" type="text" name="gender">
        </div>
        <div class=" w-full my-4">
            <p class=" text-xl ml-2">รูปพนักงาน</p>
            <input class=" flex text-lg border-solid rounded-lg border-2 border-gray-700 w-full my-2 py-2 px-3" type="file" name="img_file">
        </div>
        <div class=" w-full my-4">
            <p class=" text-xl ml-2">เบอร์โทรศัพท์</p>
            <input class=" flex text-lg border-solid rounded-lg border-2 border-gray-700 w-full my-2 py-2 px-3" placeholder="เบอร์โทรศัพท์" type="text" name="phone_number">
        </div>
        <div class=" w-full my-4">
            <p class=" text-xl ml-2">ตำแหน่ง</p>
            <input class=" flex text-lg border-solid rounded-lg border-2 border-gray-700 w-full my-2 py-2 px-3" placeholder="ตำแหน่ง" type="text" name="position">
            <input type="hidden" name="id" value=".$id">
        </div>
        <div class=" flex justify-center">
            <button class=" flex justify-center text-lg border-solid rounded-lg border-2 border-gray-700 w-1/2 my-2 py-2 px-3" type="submit">เพิ่มข้อมูล</button>
        </div>
    </form>
</div>
</body>
</html>