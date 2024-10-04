@include('RMS..employee.navi')
<div class=" block w-screen mt-16 justify-center">
    <div class="container mx-auto my-8">
        <div class="grid grid-cols-4 gap-6">
            @foreach ($orders as $order)
            <div class="max-w-sm p-6 bg-white border border-gray-200 text-center rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                {{-- <p class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">รายการ {{$order->order_id}}</p> --}}
                <p class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">โต๊ะหมายเลข: {{$order->table_id}}</p>
                {{-- <div class=" flex justify-between"> --}}
                <p class="mb-2 text-xl tracking-tight text-gray-900 dark:text-white">ชื่อเมนู: {{$order->name}}</p>
                {{-- </div> --}}
                <p class="mb-2 text-xl tracking-tight text-gray-900 dark:text-white">จำนวนที่สั่ง {{$order->count}} ที่</p>
                <a href="{{ url('/submitorder/'.$order->order_id) }}" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-black bg-yellow-400 rounded-lg hover:bg-yellow-500 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    <i class="fa-solid fa-pen-to-square"></i>
                </a>
            </div>
            @endforeach
        </div>
    </div>
</div>
</div>
<script src="https://kit.fontawesome.com/97a4ddb345.js" crossorigin="anonymous"></script>
<script>
    setTimeout(function(){
        window.location.reload(1);
    }, 5000);
</script>
</body>
</html>