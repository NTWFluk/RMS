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
    <div class=" none justify-center w-screen h-screen bg-black items-center bg-opacity-20 fixed" id="addunit">
        <div class="rounded-lg w-2/6 py-4 bg-white">
            <div class=" flex justify-end">
                <button class=" text-2xl mr-6" onclick="closeaddunit()"><i class="fa-solid fa-xmark"></i></button>
            </div>
            <form action="{{ route('yesaddstockunit') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class=" flex justify-center">
                    <p class=" text-4xl">เพิ่มหน่วย</p>
                </div>
                <div class=" w-full my-4 px-12">
                    <p class=" text-xl ml-2">ชื่อหน่วย</p>
                    <input class=" flex  text-lg border-solid rounded-lg border-2 border-gray-700 w-full my-2 py-2 px-3" type="text" name="s_unit_id">
                    <div class=" flex justify-center">
                        <button class=" flex justify-center text-lg border-solid rounded-lg border-2 border-gray-700 w-1/2 my-2 py-2 px-3" type="submit">เพิ่มข้อมูล</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class=" none justify-center w-screen h-screen bg-black items-center bg-opacity-20 fixed" id="delunit">
        <div class="rounded-lg w-2/6 py-4 bg-white">
            <div class=" flex justify-end">
                <button class=" text-2xl mr-6" onclick="closedelunit()"><i class="fa-solid fa-xmark"></i></button>
            </div>
            <form action="{{ route('yesdelstockunit') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class=" flex justify-center">
                    <p class=" text-4xl">ลบประเภทของเมนู</p>
                </div>
                <div class=" w-full my-4 px-12">
                    <p class=" text-xl ml-2">ชื่อประเภทของเมนู</p>
                    @foreach ($stock_units as $unit)
                        <div class=" flex items-center pl-4">
                            <input type="checkbox" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" name="s_unit_id[]" value="{{$unit->s_unit_id}}" id="{{$unit->s_unit_id}}">
                            <label for="{{$unit->s_unit_id}}" class=" text-xl ml-2">{{$unit->name}}</label>
                        </div>
                    @endforeach
                    <div class=" flex justify-center">
                        <button class=" flex justify-center text-lg border-solid rounded-lg border-2 border-gray-700 w-1/2 my-2 py-2 px-3" type="submit">ลบข้อมูล</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class=" none justify-center w-screen h-screen bg-black items-center bg-opacity-20 fixed" id="addtype">
        <div class="rounded-lg w-2/6 py-4 bg-white">
            <div class=" flex justify-end">
                <button class=" text-2xl mr-6" onclick="closeaddtype()"><i class="fa-solid fa-xmark"></i></button>
            </div>
            <form action="{{ route('yesaddstocktype') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class=" flex justify-center">
                    <p class=" text-4xl">เพิ่มประเภทของวัตถุดิบ</p>
                </div>
                <div class=" w-full my-4 px-12">
                    <p class=" text-xl ml-2">ชื่อประเภทของเมนู</p>
                    <input class=" flex  text-lg border-solid rounded-lg border-2 border-gray-700 w-full my-2 py-2 px-3" type="text" name="s_type_id">
                    <div class=" flex justify-center">
                        <button class=" flex justify-center text-lg border-solid rounded-lg border-2 border-gray-700 w-1/2 my-2 py-2 px-3" type="submit">เพิ่มข้อมูล</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class=" none justify-center w-screen h-screen bg-black items-center bg-opacity-20 fixed" id="deltype">
        <div class="rounded-lg w-2/6 py-4 bg-white">
            <div class=" flex justify-end">
                <button class=" text-2xl mr-6" onclick="closedeltype()"><i class="fa-solid fa-xmark"></i></button>
            </div>
            <form action="{{ route('yesdelstocktype') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class=" flex justify-center">
                    <p class=" text-4xl">ลบประเภทของเมนู</p>
                </div>
                <div class=" w-full my-4 px-12">
                    <p class=" text-xl ml-2">ชื่อประเภทของเมนู</p>
                    @foreach ($stock_types as $type)
                        <div class=" flex items-center pl-4">
                            <input type="checkbox" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" name="s_type_id[]" value="{{$type->s_type_id}}" id="{{$type->s_type_id}}">
                            <label for="{{$type->s_type_id}}" class=" text-xl ml-2">{{$type->name}}</label>
                        </div>
                    @endforeach
                    <div class=" flex justify-center">
                        <button class=" flex justify-center text-lg border-solid rounded-lg border-2 border-gray-700 w-1/2 my-2 py-2 px-3" type="submit">ลบข้อมูล</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <form class=" w-1/2 p-4 shadow-2xl rounded-lg border-2 border-solid" action="{{ route('yesaddstock') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class=" flex justify-center">
            <p class=" text-4xl">เพิ่มวัตถุดิบ</p>
        </div>
        <div class=" w-full my-4">
            <p class=" text-xl ml-2">ชื่อวัตถุดิบ</p>
            <input class=" flex  text-lg border-solid rounded-lg border-2 border-gray-700 w-full my-2 py-2 px-3" type="text" name="name">
        </div>
        <div class=" w-full my-4">
            <p class=" text-xl ml-2">จำนวน</p>
            <input class=" flex text-lg border-solid rounded-lg border-2 border-gray-700 w-full my-2 py-2 px-3" type="number" step="0.01" name="amount">
            <p class=" text-xl ml-2">หน่วย</p>
            <select class=" flex text-lg border-solid rounded-lg border-2 border-gray-700 w-full my-2 py-2 px-3" name="s_unit_id">
                @foreach ($stock_units as $unit)
                    <option value="{{$unit->s_unit_id}}">{{$unit->name}}</option>
                @endforeach
            </select>
            <div class="flex justify-between px-10 pb-2">
                <p class=" text-lg ml-2 py-2 px-4 cursor-pointer rounded-lg bg-green-400" onclick="addunit()">เพิ่มหน่วย</p>
                <p class=" text-lg ml-2 py-2 px-4 cursor-pointer rounded-lg bg-red-400" onclick="delunit()">ลบหน่วย</p>
            </div>
            <p class=" text-xl ml-2">ประเภทของวัตถุดิบ</p>
            <select class=" flex text-lg border-solid rounded-lg border-2 border-gray-700 w-full my-2 py-2 px-3" name="s_type_id">
                @foreach ($stock_types as $type)
                    <option value="{{$type->s_type_id}}">{{$type->name}}</option>
                @endforeach
            </select>
            <div class="flex justify-between px-10 pb-2">
                <p class=" text-lg ml-2 py-2 px-4 cursor-pointer rounded-lg bg-green-400" onclick="addtype()">เพิ่มประเภทของวัตถุดิบ</p>
                <p class=" text-lg ml-2 py-2 px-4 cursor-pointer rounded-lg bg-red-400" onclick="deltype()">ลบประเภทของวัตถุดิบ</p>
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
    function addunit() {
        const add = document.getElementById("addunit");
        add.style.display = "flex";
    }
    function closeaddunit() {
        const add = document.getElementById("addunit");
        add.style.display = "none";
    }
    function delunit() {
        const add = document.getElementById("delunit");
        add.style.display = "flex";
    }
    function closedelunit() {
        const add = document.getElementById("delunir");
        add.style.display = "none";
    }
    function addtype() {
        const add = document.getElementById("addtype");
        add.style.display = "flex";
    }
    function closeaddtype() {
        const add = document.getElementById("addtype");
        add.style.display = "none";
    }
    function deltype() {
        const add = document.getElementById("deltype");
        add.style.display = "flex";
    }
    function closedeltype() {
        const add = document.getElementById("deltype");
        add.style.display = "none";
    }
</script>
</html>