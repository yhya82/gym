@extends('layouts.app')
@section('content')
    <div class="mt-10 lg:mt-16">
        <p class="text-4xl lg:text-6xl font-serif">Update User</p>
    </div>
    <form action="{{route('users.update',$user->id)}}" method="POST">
        @csrf
        @method('PUT')
        <div class="flex flex-col mt-10 lg:mt-16">
        <label class="text-3xl lg:text-4xl">Name</label>
        <input type="text" name="name" value="{{$user->name}}" class=" w-1/2 mt-2 lg:mt-4 lg:h-16">
        </div>
        <div class="flex flex-col mt-4 lg:mt-6">
        <label class="text-3xl lg:text-4xl">Email</label>
        <input type="email" name="email" value="{{$user->email}}" class=" w-1/2 mt-2 lg:mt-4 lg:h-16" >
        </div>
        <div class="flex flex-col mt-4 lg:mt-6">
        <label class="text-3xl lg:text-4xl">Password</label>
        <input type="password" name="password" placeholder="Enter new password" class=" w-1/2 mt-2 lg:mt-4 lg:h-16" >
        </div>
        <select name="role"  class="w-1/2 mt-4 lg:mt-6">
            <option value="">Select Role</option>
            <option value="owner"  {{$user->role == 'owner' ? 'selected' : '' }}> Owner</option>
            <option value="admin" {{$user->role =='admin' ? 'selected' : '' }} >admin</option>
        </select>
        <div class="flex flex-col mt-4 lg:mt-6">
        <label class="text-3xl lg:text-4xl">Phone</label>
        <input type="text" name="phone" value="{{$user->phone}}" class=" w-1/2 mt-2 lg:mt-4 lg:h-16">
        </div>
        <div class="mt-4 lg:mt-6">
        <button type="submit" class="bg-blue-900 text-white text-2xl lg:text-4xl font-bold p-2 lg:p-4 rounded-2xl w-1/4 hover:bg-blue-500">Update user</button>
        </div>
    </form>
@endsection