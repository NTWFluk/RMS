@include('RMS..employee.navi')
<div class=" block w-screen mt-16 justify-center">
    <div class=" none justify-center w-screen h-screen bg-black items-center bg-opacity-20 fixed top-0" id="addtable">
        <div class="rounded-lg w-2/6 py-4 bg-white">
            <div class=" flex justify-end">
                <button class=" text-2xl mr-6" onclick="closeaddtable()"><i class="fa-solid fa-xmark"></i></button>
            </div>
            <form action="{{ route('yesaddtable') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class=" flex justify-center">
                    <p class=" text-4xl">เพิ่มโต๊ะ</p>
                </div>
                <div class=" w-full my-4 px-12">
                    <p class=" text-xl ml-2">จำนวนที่นั่ง</p>
                    <input class=" flex  text-lg border-solid rounded-lg border-2 border-gray-700 w-full my-2 py-2 px-3" type="number" name="count">
                    <div class=" flex justify-center">
                        <button class=" flex justify-center text-lg border-solid rounded-lg border-2 border-gray-700 w-1/2 my-2 py-2 px-3" type="submit">เพิ่มข้อมูล</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class=" flex justify-end w-4/5 mt-5">
        <button onclick="addtable()" class=" text-lg bg-blue-300 px-4 py-2 rounded-lg"><i class="fa-solid fa-plus"></i> เพิ่มโต๊ะ</button>
    </div>
    <div class="container mx-auto py-10">
        <div class="grid grid-cols-4 gap-6 mb-4">
            @foreach ($tables as $table)
            <div class="max-w-sm p-6 bg-white border border-gray-200 text-center rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 mx-4">
                <div class=" flex justify-center"><img src="{{asset("/img/table.png")}}" class=" h-32"></div>
                <p class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">โต๊ะหมายเลข {{$table->table_id}}</p>
                <p class="mb-2 text-xl tracking-tight text-gray-900 dark:text-white">จำนวนที่นั่ง {{$table->count}} ที่</p>
                @switch($table->is_active)
                    
                    @case($table->is_active == 1)
                        <p class="mb-2 text-lg tracking-tight text-gray-900 dark:text-white">สถานะการใช้งาน : พร้อมใช้งาน</p>
                        @break
                    @case($table->is_active == 2)
                        <p class="mb-2 text-lg tracking-tight text-gray-900 dark:text-white">สถานะการใช้งาน : มีลูกค้า</p>
                        @break
                    @case($table->is_active == 3)
                        <p class="mb-2 text-lg tracking-tight text-gray-900 dark:text-white">สถานะการใช้งาน : ไม่ใช้งาน</p>
                        @break
                @endswitch
                <button onclick="edittable(this)" value="{{$table->table_id}}" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-black bg-yellow-400 rounded-lg hover:bg-yellow-500 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    <i class="fa-solid fa-pen-to-square"></i>
                </button>
                <div class=" none justify-center w-screen h-screen bg-black items-center bg-opacity-20 fixed top-0 left-0" id="edittable">
                    <div class="rounded-lg w-2/6 py-4 bg-white">
                        <div class=" flex justify-end">
                            <button class=" text-2xl mr-6" onclick="closeedittable()"><i class="fa-solid fa-xmark"></i></button>
                        </div>
                        <form action="{{ route('yesedittable') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class=" flex justify-center">
                                <p class=" text-4xl" id="edittabletext"></p>
                            </div>
                            <div class=" w-full my-4 px-12">
                                <p class=" text-xl ml-2 text-left">จำนวนที่นั่ง</p>
                                <input type="hidden" name="table_id" id="table_id">
                                <input class=" flex  text-lg border-solid rounded-lg border-2 border-gray-700 w-full my-2 py-2 px-3" type="number" name="count" id="count">
                                <div class=" flex justify-center">
                                    <button class=" flex justify-center text-lg border-solid rounded-lg border-2 border-gray-700 w-1/2 my-2 py-2 px-3" type="submit">เพิ่มข้อมูล</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <button onclick="deltabel(this)" value="{{$table->table_id}}" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-black bg-red-400 rounded-lg hover:bg-red-600 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    <i class="fa-solid fa-trash"></i>
                </button>
            </div>
            @endforeach
        </div>
    </div>
</div>
<script src="https://kit.fontawesome.com/97a4ddb345.js" crossorigin="anonymous"></script>
<script>
    function addtable() {
        const add = document.getElementById("addtable");
        add.style.display = "flex";
    }
    function closeaddtable() {
        const add = document.getElementById("addtable");
        add.style.display = "none";
    }
    function edittable(edit) {
        const add = document.getElementById("edittable");
        const value = edit.value;
        add.style.display = "flex";
        let table = @json($tables);
        table.forEach(function($item){
            if ( value == $item['table_id']) {
                document.getElementById("edittabletext").innerText = "จำนวนที่นั่ง " + $item['table_id'];
                document.getElementById("count").value = $item['count'];
                document.getElementById("table_id").value = $item['table_id'];
            }
        });
    }
    function deltabel(del){
        const value = del.value;
        window.location.href = "{{ url('/deltable/') }}/" + value;
    }
    function closeedittable() {
        const add = document.getElementById("edittable");
        add.style.display = "none";
    }
</script>
</body>
</html>