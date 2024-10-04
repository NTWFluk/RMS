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
        <p class=" text-white text-base">โต๊ะที่ : {{$table->table_id}}</p>
    </div>
    <div class=" w-screen flex bg-slate-200 py-2 px-4">
        <input type="text" class=" w-screen rounded-lg px-4 py-2" placeholder="ค้นหาชื่อ">
    </div>
</div>
<div class=" flex my-28">
    <div class=" w-1/4 py-4"></div>
    <div class=" w-3/4 grid grid-cols-1 py-4">
        @foreach ($foods as $food)
            <div class=" bg-white my-1 mx-4 py-2 px-4 rounded-lg">
                <div class=" flex h-24">
                    <img src="{{asset($food->img_file)}}">
                    <div class=" w-full relative">
                        <p class=" text-black text-base mx-4 absolute top-0">{{$food->name}}</p>
                        <div class=" flex justify-end">
                            <button onclick="add(this)" value="{{$food->food_id}}" class=" bg-red-600 text-white rounded-md py-1 px-2 absolute bottom-0">เพิ่มรายการ</button>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    
</div>
<div class="fixed bottom-0">
    <div class=" w-screen flex justify-between bg-slate-400 py-2 px-4">
        <p class=" text-white text-base w-1/2 text-center">ทั้งราคา</p>
        <a href="{{ url('/viewcart/'.$table->table_id.'/'.$customer) }}" class=" text-white text-base w-1/2 text-center">ตรวจสอบรายการ</a>
    </div>
    <div class=" w-screen flex justify-between bg-red-600 py-4 px-4">
        <a href="{{ url('/home/'.$table->table_id.'/'.$customer) }}" class=" text-white text-base w-1/2 text-center">เมนูอาหาร</a>
        <a class=" text-white text-base w-1/2 text-center">รายการที่สั่ง</a>
    </div>
</div>
<div class=" none justify-center w-screen h-screen items-center fixed" id="add">
    <div class="bg-white w-screen fixed bottom-0">
        <div class=" flex justify-end">
            <button class=" text-2xl mr-6" onclick="closeadd()"><i class="fa-solid fa-xmark"></i></button>
        </div>
        <form action="{{ route('addtocart')}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class=" flex justify-center">
                <p class=" text-lg" id="textfood"></p>
            </div>
            <div class=" flex justify-center">
                <input class=" flex text-base border-solid rounded-lg border-2 border-gray-700 w-full my-2 py-2 px-3 mx-8" type="number" value="1" name="count">
                <input type="hidden" name="receipt_id" value="{{$customer}}">
                <input type="hidden" name="food_id" id="food_id">
                <input type="hidden" name="table_id" value="{{$table->table_id}}">
            </div>
            <div class=" flex justify-center mb-4">
               <button class=" flex justify-center text-base border-solid rounded-lg text-white bg-red-600 w-1/2 my-2 py-2 px-3" type="submit">เพิ่มข้อมูล</button>
            </div>
        </form> 
    </div>
</div>
</body>
<script src="https://kit.fontawesome.com/97a4ddb345.js" crossorigin="anonymous"></script>
<script>
    function add(id) {
        const add = document.getElementById("add");
        const value = id.value;
        add.style.display = "block";
        let food = @json($foods);
        food.forEach(function($item){
            if ( value == $item['food_id']) {
            document.getElementById("textfood").innerText = $item['name'];
            document.getElementById("food_id").value = $item['food_id'];
            }
        });
    }
    function closeadd() {
        const add = document.getElementById("add");
        add.style.display = "none";
    }
</script>
</html>