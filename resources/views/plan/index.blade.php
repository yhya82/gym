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
   <h2 class="text-4xl lg:text-6xl  font-serif hover:text-blue-400">Plan List</h2> 
   <a href="{{route('plans.create')}}" class="text-xl lg:text-3xl mt-4 text-blue-500">add new plan</a>
   </div>
   <div class="overflow-x-auto mt-8 lg:mt-16 px-4">
   <table class="min-w-full border border-gray-700 p-2 lg:p-4 ">
    <thead class="bg-blue-900 gap-2">
    <tr>
        <th class="text-white text-2xl lg:text-4xl">Plan Name</th>
        <th class="text-white text-2xl lg:text-4xl">Price</th>
        <th class="text-white text-2xl lg:text-4xl">Duration(days)</th>
        <th class="text-white text-2xl lg:text-4xl">Actions</th>
    </tr>
    </thead>
    <tbody class="text-center  text-2xl lg:text-3xl">
        @foreach($plans as $plan)
        <tr>
            <td>{{$plan->name}}</td>
            <td>{{$plan->price}}</td>
            <td>{{$plan->duration}}</td>
            <td class="flex gap-2">
                <a href="{{route('plans.edit',$plan->id)}}" class="hover:underline hover:text-blue-600">Edit</a>
                <form action="{{route('plans.destroy',$plan->id)}}" method="POST" style='display:inline'>
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="hover:underline hover:text-blue-600">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
   </table>
   </div>
   @endsection
</body>
</html>