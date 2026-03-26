<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    @extends('layouts.app')
    @section('content')
    <div class="mt-12 lg:mt-12">
        <p class="text-4xl lg:text-6xl  font-serif ">Create Plan</p>
        <a href="{{route('plans.index')}}" class="text-2xl lg:text-4xl  font-serif hover:text-blue-400 ">view plans</a>
    </div>
    <form action="{{route('plans.store')}}" method="POST" class="px-4">
        @csrf
        <div class="flex flex-col mt-10 lg:mt-16">
        <label class="text-3xl lg:text-4xl">Plan name</label>
        <input type="text" name="name" placeholder="Enter  name" class="placeholder:text-xl lg:placeholder:text-3xl w-1/2 mt-2 lg:mt-4 lg:h-16" required>
        </div>
        <div class="flex flex-col mt-4 lg:mt-6">
         <label class="text-3xl lg:text-4xl" >Price</label>
        <input type="text" name="price" placeholder="Enter  price" class="placeholder:text-xl lg:placeholder:text-3xl w-1/2 mt-2 lg:mt-4 lg:h-16" required>
        </div>
        <div class="flex flex-col mt-4 lg:mt-6">
         <label class="text-3xl lg:text-4xl">Duration(nums)</label>
        <input type="text" name="duration" placeholder="Enter duration " class="placeholder:text-xl lg:placeholder:text-3xl w-1/2 mt-2 lg:mt-4 lg:h-16"  required>
        </div>
        <div class="flex flex-col mt-4 lg:mt-6">
        <button type="submit" class="bg-blue-900 text-white text-2xl lg:text-4xl font-bold p-2 lg:p-4 rounded-2xl w-1/4 hover:bg-blue-500" > add plan</button>
        </div>
    </form>
    @endsection
</body>
</html>