@include('RMS.employee.navi')
<div class=" none justify-center w-screen h-screen bg-black items-center bg-opacity-20 fixed" id="addcustomer">
    <div class="rounded-lg w-2/6 py-4 bg-white">
        <div class=" flex justify-end">
            <button class=" text-2xl mr-6" onclick="closeaddunit()"><i class="fa-solid fa-xmark"></i></button>
        </div>
        <form action="{{ route('qrcode') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class=" flex justify-center">
                <p class=" text-4xl" id="table_name">เพิ่มหน่วย</p>
            </div>
            <div class=" w-full my-4 px-12">
                <p class=" text-xl ml-2">จำนวนคน</p>
                <input class=" flex  text-lg border-solid rounded-lg border-2 border-gray-700 w-full my-2 py-2 px-3" type="number" name="count">
                <p class=" text-xl ml-2">พนักงาน</p>
                <select class=" flex text-lg border-solid rounded-lg border-2 border-gray-700 w-full my-2 py-2 px-3" name="em_id">
                    @foreach ($employees as $employee)
                        <option value="{{$employee->em_id}}">{{$employee->frist_name}} {{$employee->last_name}}</option>
                    @endforeach
                </select>
                <div class=" flex justify-center">
                    <input type="hidden" id="table_id" name="table_id">
                    <button class=" flex justify-center text-lg border-solid rounded-lg border-2 border-gray-700 w-1/2 my-2 py-2 px-3" type="submit">เพิ่มข้อมูล</button>
                </div>
            </div>
        </form>
    </div>
</div>
<div class="container mx-auto mt-16 bg-slate-200 py-10">
    <div class="grid grid-cols-4 bg-slate-200 gap-6 mb-4">
        @foreach ($tables as $table)
            @if ($table->is_active == 3)
                
            @else
                <button onclick="add(this)" value="{{$table->table_id}}">
                    <div class="max-w-sm p-6 bg-white border border-gray-200 text-center rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 mx-4 mb-6">
                        <div class=" flex justify-center"><img src="{{asset("/img/table.png")}}" class=" h-32"></div>
                        <p class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">โต๊ะที่ {{$table->table_id}}</p>
                        @switch($table->is_active)
                            @case($table->is_active == 1)
                                <p class="mb-2 text-lg tracking-tight text-gray-900 dark:text-white">สถานะการใช้งาน : พร้อมใช้งาน</p>
                                @break
                            @case($table->is_active == 2)
                                <p class="mb-2 text-lg tracking-tight text-gray-900 dark:text-white">สถานะการใช้งาน : มีลูกค้า</p>
                                @break
                            @default
                        @endswitch  
                    </div>
                </button>
            @endif
        @endforeach
    </div>
</div>
</div>
<script src="https://kit.fontawesome.com/97a4ddb345.js" crossorigin="anonymous"></script>

<script>
    // function info(data){
    //     const value = data.value;
    //     window.location.href = "{{ url('/qrcode/') }}/" + value;
    // }
    function add(data) {
        const add = document.getElementById("addcustomer");
        const value = data.value;
        add.style.display = "flex";
        document.getElementById("table_name").innerText = "โต๊ะที่ : " + value;
        document.getElementById("table_id").value = value;
    }
    function closeaddunit() {
        const add = document.getElementById("addcustomer");
        add.style.display = "none";
    }
</script>
</body>
</html>