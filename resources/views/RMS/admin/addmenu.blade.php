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
<body>
<div class=" flex w-screen h-screen relative justify-center items-center">
    <div class=" none justify-center w-screen h-screen bg-black items-center bg-opacity-20 fixed" id="add">
        <div class="rounded-lg w-2/6 py-4 bg-white">
            <div class=" flex justify-end">
                <button class=" text-2xl mr-6" onclick="closeadd()"><i class="fa-solid fa-xmark"></i></button>
            </div>
            <form action="{{ route('yesaddtypemenu') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class=" flex justify-center">
                    <p class=" text-4xl">เพิ่มประเภทของเมนู</p>
                </div>
                <div class=" w-full my-4 px-12">
                    <p class=" text-xl ml-2">ชื่อประเภทของเมนู</p>
                    <input class=" flex  text-lg border-solid rounded-lg border-2 border-gray-700 w-full my-2 py-2 px-3" type="text" name="f_type_id">
                    <div class=" flex justify-center">
                        <button class=" flex justify-center text-lg border-solid rounded-lg border-2 border-gray-700 w-1/2 my-2 py-2 px-3" type="submit">เพิ่มข้อมูล</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class=" none justify-center w-screen h-screen bg-black items-center bg-opacity-20 fixed" id="del">
        <div class="rounded-lg w-2/6 py-4 bg-white">
            <div class=" flex justify-end">
                <button class=" text-2xl mr-6" onclick="closedel()"><i class="fa-solid fa-xmark"></i></button>
            </div>
            <form action="{{ route('yesdeltypemenu') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class=" flex justify-center">
                    <p class=" text-4xl">ลบประเภทของเมนู</p>
                </div>
                <div class=" w-full my-4 px-12">
                    <p class=" text-xl ml-2">ชื่อประเภทของเมนู</p>
                    @foreach ($food_types as $type)
                        <div class=" flex items-center pl-4">
                            <input type="checkbox" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" name="f_type_id[]" value="{{$type->f_type_id}}" id="{{$type->f_type_id}}">
                            <label for="{{$type->f_type_id}}" class=" text-xl ml-2">{{$type->name}}</label>
                        </div>
                    @endforeach
                    <div class=" flex justify-center">
                        <button class=" flex justify-center text-lg border-solid rounded-lg border-2 border-gray-700 w-1/2 my-2 py-2 px-3" type="submit">ลบข้อมูล</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <form class=" w-1/2 p-4 shadow-2xl mt-4 rounded-lg border-2 border-solid" action="{{ route('yesaddmenu') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class=" flex justify-center">
            <p class=" text-4xl">เพิ่มเมนู</p>
        </div>
        <div class=" w-full my-4">
            <p class=" text-xl ml-2">ชื่อเมนู</p>
            <input class=" flex  text-lg border-solid rounded-lg border-2 border-gray-700 w-full my-2 py-2 px-3" type="text" name="name">
            <p class=" text-xl ml-2">ประเภทของเมนู</p>
            <select class=" flex text-lg border-solid rounded-lg border-2 border-gray-700 w-full my-2 py-2 px-3" name="f_type_id">
                <option>กรุณาเลือก</option>
                @foreach ($food_types as $type)
                    <option value="{{$type->f_type_id}}">{{$type->name}}</option>
                @endforeach
            </select>
            <div class="flex justify-between px-10 pb-2">
                <p class=" text-lg ml-2 py-2 px-4 cursor-pointer rounded-lg bg-green-400" onclick="add()">เพิ่มประเภทของเมนู</p>
                <p class=" text-lg ml-2 py-2 px-4 cursor-pointer rounded-lg bg-red-400" onclick="del()">ลบประเภทของเมนู</p>
            </div>
            <p class=" text-xl ml-2">วัตถุดิบที่ใช้</p>
            <select id="stock_id" class=" flex text-lg border-solid rounded-lg border-2 border-gray-700 w-full my-2 py-2 px-3" name="stock_id" onchange="showunit()">
                <option>กรุณาเลือก</option>
                @foreach ($stocks as $stock)
                    <option value="{{$stock->stock_id}}">{{$stock->name}}</option>
                @endforeach
            </select>
            <p class=" text-xl ml-2">รูปเมนูอาหาร</p>
            <input class=" flex text-lg border-solid rounded-lg border-2 border-gray-700 w-full my-2 py-2 px-3" type="file" name="img_file">
            <p class=" text-xl ml-2">น้ำหนัก</p>
            <div class="flex w-full items-center">
                <input class=" flex text-lg border-solid rounded-lg border-2 w-full border-gray-700 my-2 py-2 px-3" type="number" step="0.01" name="amount">
                <p class=" text-xl ml-2" id="unit"></p>
            </div>
        </div>
        <div class=" flex justify-center">
            <button class=" flex justify-center text-lg border-solid rounded-lg border-2 border-gray-700 w-1/2 my-2 py-2 px-3" type="submit">เพิ่มข้อมูล</button>
        </div>
    </form>
</div>
</body>
<script src="https://kit.fontawesome.com/97a4ddb345.js" crossorigin="anonymous"></script>
<script>
    function showunit() {
    const selectElement = document.getElementById("stock_id");
    const selectedValue = selectElement.value;
    let stock = @json($stocks);
    stock.forEach(function(item) {
        if ( selectedValue == item['stock_id']) {
            document.getElementById("unit").innerText = item['suname'];
        }
    });
    }
    function add() {
        const add = document.getElementById("add");
        add.style.display = "flex";
    }
    function closeadd() {
        const add = document.getElementById("add");
        add.style.display = "none";
    }
    function del() {
        const add = document.getElementById("del");
        add.style.display = "flex";
    }
    function closedel() {
        const add = document.getElementById("del");
        add.style.display = "none";
    }
</script>
</html>