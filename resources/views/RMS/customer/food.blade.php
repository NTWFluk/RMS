<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ url('custom.css') }}">
    @vite('resources/css/app.css')
    <title>{{$index}}</title>
</head>
<body class=" bg-slate-200">
<div class="fixed top-0">
    <div class=" w-screen flex justify-between bg-red-600 py-4 px-4">
        <p class=" text-white text-base">รายการอาหาร</p>
        <p class=" text-white text-base">โต๊ะที่ : {{$table}}</p>
    </div>
</div>
<div class=" flex my-16">
    {{-- <div class=" w-1/4 py-4"></div> --}}
    <div class=" w-full grid grid-cols-1 py-4">
        @foreach ($foods as $food)
            <div class=" bg-white my-1 mx-4 py-2 px-4 rounded-lg">
                <div class=" flex h-24">
                    <img src="{{asset($food->img_file)}}">
                    <div class=" w-full relative">
                        <p class=" text-black text-base mx-4 absolute top-0">{{$food->name}}</p>
                        <div class=" flex">
                            <p class=" text-black text-base mx-4 absolute bottom-0">จำนวน {{$food->count}} ที่</p>
                            <a href="{{ url('/del/').'/'.$table.'/'.$receipt.'/'.$food->food_id}}" class=" absolute bottom-0 right-0  px-3 py-2 text-sm font-medium text-center text-black bg-red-400 rounded-lg hover:bg-red-600 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"><i class="fa-solid fa-trash"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
        <form action="{{ route('addorder')}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class=" flex justify-center mb-4">
                <input type="hidden" name="table_id" value="{{$table}}">
                <input type="hidden" name="receipt_id" value="{{$receipt}}">
                <button class=" flex justify-center text-base border-solid rounded-lg text-white bg-red-600 w-1/2 my-2 py-2 px-3" type="submit">สั่งอาหาร</button>
            </div>
        </form> 
    </div>
    
</div>
<div class="fixed bottom-0">
    <div class=" w-screen flex justify-between bg-slate-400 py-2 px-4">
        <p class=" text-white text-base w-1/2 text-center">ทั้งราคา</p>
        <a href="{{ url('/viewcart/').'/'.$table.'/'.$receipt}}" class=" text-white text-base w-1/2 text-center">ตรวจสอบรายการ</a>
    </div>
    <div class=" w-screen flex justify-between bg-red-600 py-4 px-4">
        <a href="{{ url('/home/').'/'.$table.'/'.$receipt}}" class=" text-white text-base w-1/2 text-center">เมนูอาหาร</a>
        <a class=" text-white text-base w-1/2 text-center">รายการที่สั่ง</a>
    </div>
</div>
</body>
<script src="https://kit.fontawesome.com/97a4ddb345.js" crossorigin="anonymous"></script>
<script>
</script>
</html>