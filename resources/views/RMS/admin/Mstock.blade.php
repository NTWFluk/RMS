@include('RMS..employee.navi')
<div class=" block w-screen mt-16 justify-center">
    <div class=" flex justify-end w-4/5 my-5">
        <a href="{{ route('addstock') }}" class=" text-lg bg-blue-300 px-4 py-2 rounded-lg"><i class="fa-solid fa-plus"></i> เพิ่มวัตถุดิบ</a>
    </div>
    <div class="container mx-auto">
        <div class="grid grid-cols-4 gap-6">
            @foreach ($stocks as $stock)
            <div class="max-w-sm p-6 bg-white border border-gray-200 text-center rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                <p class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">รายการ {{$stock->stock_id}}</p>
                <p class="mb-2 text-lg tracking-tight text-gray-900 dark:text-white">{{$stock->name}}</p>
                <a href=" {{url('/editstock/'.$stock->stock_id)}} " class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-black bg-yellow-400 rounded-lg hover:bg-yellow-500 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    <i class="fa-solid fa-pen-to-square"></i>
                </a>
                <a href="#" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-black bg-red-400 rounded-lg hover:bg-red-600 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    <i class="fa-solid fa-trash"></i>
                </a>
            </div>
            @endforeach
        </div>
    </div>
</div>
@include('RMS.employee.footter')