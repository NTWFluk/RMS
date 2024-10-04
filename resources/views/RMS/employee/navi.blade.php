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
<body class="bg-slate-200">
<div class=" flex w-screen h-screen relative">
    <div class=" flex w-screen h-16 absolute bg-white">
        <div class=" flex justify-between p-4 content-center px-20 w-screen shadow-xl">
            <div class=" flex">
                <a class=" text-xl text-center mr-4 hover:underline-offset-4 hover:underline active:underline active:underline-offset-4" href="{{ route('home') }}">จัดสั่งอาหาร</a>
                <a class=" text-xl text-center mr-4 hover:underline-offset-4 hover:underline active:underline active:underline-offset-4" href="{{ route('order') }}">รายการสั่งอาหาร</a>
                <a class=" text-xl text-center mr-4 hover:underline-offset-4 hover:underline active:underline active:underline-offset-4" href="{{ route('stock') }}">คลังวัตถุดิบ</a>
                <a class=" text-xl text-center mr-4 hover:underline-offset-4 hover:underline active:underline active:underline-offset-4" href="{{ route('Mmember') }}">จัดการสมาชิก</a>
                @if ($name->position == "admin")
                    <div class=" flex dropdown w-48">
                        <p class=" text-xl text-left mr-4 hover:underline-offset-4 hover:underline hover:cursor-pointer">การจัดการ<i class=" ml-2 fa-solid fa-angle-down"></i></p>
                        <div class=" dropdown-active">
                            <a class=" text-xl text-center flex justify-center p-1" href="{{ route('Mtable') }}">จัดการโต๊ะ</a>
                            <a class=" text-xl text-center flex justify-center p-1" href="{{ route('Mmenu') }}">จัดการเมนูอาหาร</a>
                            <a class=" text-xl text-center flex justify-center p-1" href="{{ route('Mstock') }}">จัดการคลังวัตถุดิบ</a>
                            <a class=" text-xl text-center flex justify-center p-1" href="{{ route('Maccount') }}">จัดการบัญชีของร้าน</a>
                            <a class=" text-xl text-center flex justify-center p-1" href="{{ route('Memployee') }}">จัดการข้อมูลพนักงาน</a>
                        </div>
                    </div>
                @endif
            </div>
            <div class=" flex dropdown w-44">
                <p class=" text-xl text-center hover:underline-offset-4 hover:underline hover:cursor-pointer">{{ $name->prefix }}{{ $name->frist_name }} {{$name->last_name}}<i class=" ml-2 fa-solid fa-angle-down"></i></p>
                <div class=" dropdown-active">
                    <a class=" text-xl text-center flex justify-center p-1" href="{{ url('/profile/'.$name->em_id) }}">ประวัติส่วนตัว</a>
                    <a class=" text-xl text-center flex justify-center p-1" href="{{ route('gologout') }}">ออกจากระบบ</a>
                </div>
            </div>
        </div>
    </div>