
@extends('layouts.app')
@section('content')
    <div class="mt-10 lg:mt-16">
        <p class="text-4xl lg:text-6xl font-serif">Create User</p>
    </div>
    <form action="{{route('users.store')}}" method="POST">
        @csrf
        <a href="{{route('users.index')}}" class="text-2xl lg:text-3xl text-blue-500">view user</a><br>
        <div class="flex flex-col mt-10 lg:mt-16">
        <label class="text-3xl lg:text-4xl">Name</label>
        <input type="text" name="name" placeholder="Enter name" required class="placeholder:text-xl lg:placeholder:text-3xl w-1/2 mt-2 lg:mt-4 lg:h-16">
        </div>
        <div class="flex flex-col mt-4 lg:mt-6">
        <label class="text-3xl lg:text-4xl">Email</label>
        <input type="email" name="email" placeholder="Enter email" required  class="placeholder:text-xl lg:placeholder:text-3xl w-1/2 mt-2 lg:mt-4 lg:h-16">
        @error('email')
        <p style="color:red">{{$message}}</p>
        @enderror
        </div>
        <div class="flex flex-col mt-4 lg:mt-6">
        <label class="text-3xl lg:text-4xl">Password</label>
        <input type="password" name="password" placeholder="Enter passoword" required class="placeholder:text-xl lg:placeholder:text-3xl w-1/2 mt-2 lg:mt-4 lg:h-16">
        </div>
        <select name="role" class=" mt-4 lg:mt-6 w-1/2">
            <option value="">Select Role</option>
            <option value="owner"> Owner</option>
            <option value="admin">admin</option>
        </select>
        <div class="flex flex-col mt-4 lg:mt-6">
        <label  class="text-3xl lg:text-4xl">Phone</label>
        <input type="text" name="phone" placeholder="Enter " required class="placeholder:text-xl lg:placeholder:text-3xl w-1/2 mt-2 lg:mt-4 lg:h-16">
        </div>
        <div class="mt-4 lg:mt-6">
        <button type="submit" class="bg-blue-900 text-white text-2xl lg:text-4xl font-bold p-2 lg:p-4 rounded-2xl w-1/4 hover:bg-blue-500">Add user</button>
        </div>
    </form>
@endsection