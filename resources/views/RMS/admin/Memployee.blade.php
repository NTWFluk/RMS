@include('RMS..employee.navi')
<div class=" block w-screen mt-16 justify-center">
    <div class=" flex justify-end w-4/5 mt-5">
        <a href="{{ route('addemployee') }}" class=" text-lg bg-blue-300 px-4 py-2 rounded-lg"><i class="fa-solid fa-plus"></i> เพิ่มพนักงาน</a>
    </div>
    <div class="container mx-auto py-10">
        <div class="grid grid-cols-4 gap-6 mb-4">
            @foreach ($employees as $employee)
            <div class="max-w-sm max-h-sm p-6 bg-white border border-gray-200 text-center rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 mx-4">
                <div class=" flex justify-center mb-4 h-32"><img src="{{asset($employee->img_file)}}"></div>
                <p class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{{$employee->prefix}} {{$employee->frist_name}} {{$employee->last_name}}</p>
                {{-- <p class="mb-2 text-lg tracking-tight text-gray-900 dark:text-white">{{$employee->name}}</p> --}}
                <a href=" {{ url('/editemployee/'.$employee->em_id)}}" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-black bg-yellow-400 rounded-lg hover:bg-yellow-500 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
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