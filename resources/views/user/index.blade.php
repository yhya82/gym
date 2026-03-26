

@extends('layouts.app')
@section('content')
    <div class="mt-10 lg:mt-16">
   <p class="text-4xl lg:text-6xl font-serif">User List</p> 
    <a href="{{route('users.create')}}" class="text-2xl lg:text-3xl text-blue-500">create new user</a>
    </div>
    <div class="overflow-x-auto mt-10 lg:mt-16 px-4">
   <table class="min-w-full border border-gray-700 px-2">
        <thead class="bg-blue-900 text-2xl lg:text-4xl text-white p-2 lg:p-4">
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Role</th>
                <th>Phone</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody class="text-center text-xl lg:text-2xl">
            @foreach($users as $user)
            <tr>
                <td>{{$user->name}}</td>
                <td>{{$user->email}}</td>
                <td>{{$user->role}}</td>
                <td>{{$user->phone}}</td>
                <td class="flex gap-2 items-center lg:gap-4">
                    <a href="{{route('users.edit',$user->id)}}" class="hover:underline hover:text-blue-500">Edit</a>
                    <form action="{{route('users.destroy',$user->id)}}" Method="POST" style="display:inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="hover:underline hover:text-blue-500">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>

   </table>
   </div>
   @endsection
