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
        <div class="mt-10 lg:mt-16">
            <p class="text-4xl lg:text-7xl px-4">Update Plan</p>
        </div>
     <form action="{{route('plans.update',$plan->id)}}" method="POST" class="px-4">
        @csrf
        @method('PUT')
        <div class="flex flex-col mt-8 lg:mt-16">
        <label class="text-3xl lg:text-4xl" >Plan name</label>
        <input type="text" name="name" value={{$plan->name}} class=" w-1/2 mt-2 lg:mt-4 lg:h-16">
        </div>
        <div class="flex flex-col mt-4 lg:mt-6">
         <label class="text-3xl lg:text-4xl">Price</label>
        <input type="text" name="price" value={{$plan->price}} class=" w-1/2 mt-2 lg:mt-4 lg:h-16" >
        </div>
        <div class="flex flex-col mt-4 lg:mt-6">
         <label class="text-3xl lg:text-4xl">Duration</label>
        <input type="text" name="duration" value={{$plan->duration}} class=" w-1/2 mt-2 lg:mt-4 lg:h-16">
        </div class="text-3xl lg:text-4xl mt-4 lg:mt-6">
        <div class=" flex  mt-8 lg:mt-10">
        <button type="submit" class="bg-blue-900 text-white text-2xl lg:text-4xl font-bold p-2 lg:p-4 rounded-2xl w-1/4 hover:bg-blue-500"> update plan</button>
        </div>
    </form>
    @endsection
</body>
</html>