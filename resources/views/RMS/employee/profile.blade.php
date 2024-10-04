@include('RMS..employee.navi')
<div class=" flex w-screen mt-16 justify-center">
    <div class=" w-4/5 p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 mx-4 mt-4">
        <p class=" font-bold text-4xl text-center my-8">ประวัติส่วนตัว</p>
        <div class=" flex justify-center">
            <img class=" h-56" src="{{asset($name->img_file)}}" alt="">
        </div>
        <div class=" flex mx-44 my-4">
            <p class=" text-lg font-bold">ชื่อ-นามสกุล :</p><p class=" text-lg"> {{$name->prefix}} {{$name->frist_name}} {{$name->last_name}}</p>
        </div>
    </div>
</div>
@include('RMS.employee.footter')