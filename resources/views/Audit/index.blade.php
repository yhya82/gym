@extends('layouts.app')

@section('content')
<div class="mt-16">
    <p class="text-4xl lg:text-6xl font-serif px-2">Audit Logs</p>
</div>
<div class="mt-2 lg:mt-10 px-2">
    <p class="text-3xl lg:text-4xl font-bold">Filter by User and Date</p>
</div>
<!--filtering -->
<form action="{{route('audit')}}" method="GET" class="flex gap-2 lg:gap-4 mt-2 lg:mt-4 px-2">
    <div  class="flex flex-col w-24 lg:w-32 ">
        <label class="text-2xl lg:text-3xl">User</label>
        <select name="user_id">
            <option value="">All</option>
            @foreach($users as $user)
            <option value="{{$user->id}}" {{request('user_id') == $user->id ? 'selected':''}}>
                {{$user->name}}
            </option>
            @endforeach
        </select>
    </div>
    <div class="flex flex-col w-24 lg:w-32">
        <label class="text-2xl lg:text-3xl">From</label>
        <input type="date" name="start_date" value="{{request('start_date')}}">
    </div>
        <div class="flex flex-col w-24 lg:w-32 ">
        <label class="text-2xl lg:text-3xl">To</label>
        <input type="date" name="end_date" value="{{request('end_date')}}" >
        </div>
        <div class="flex flex-col items-center justify-center">
            <p class="text-gray-200">yy</p>
        <button type="submit" class="bg-blue-800 text-white font-bold text-2xl lg:text-3xl p-2 lg:p-4 hover:bg-blue-500 rounded-2xl ">Filter</button>
        </div>
</form>


<div class="overflow-x-auto px-2">
<table class="min-w-max border border-gray-700 mt-2 lg:mt-4 "> 
    <thead class="bg-blue-900 text-white text-2xl lg:text-3xl">
        <tr>
            <th>User</th>
            <th>Action</th>
            <th>Target</th>
            <th>Time</th>
        </tr>
    </thead>
    <tbody>
        @foreach($logs as $log)
            <tr class="">
                <td class="p-2 text-center text-xl lg:text-2xl">{{$log->user->name?? 'system'}}</td>
                <td class="p-2 text-center">
                    @if($log->action == "created")
                    <span class="text-xl lg:text-2xl text-green-500 font-semibold">Created</span>
                    @elseif($log->action == "updated")
                     <span class="text-xl lg:text-2xl text-yellow-500 font-semibold">Updateded</span>
                     @elseif($log->action == "deleted")
                     <span class="text-xl lg:text-2xl text-red-500 font-semibold">Deleted</span>
                     @else
                        <span class="text-gray-500">{{ ucfirst($log->action) }}</span>
                    @endif
                </td>
                <td class="p-2 text-center text-xl lg:text-2xl">{{$log->target_type}}</td>
                <td class="p-2 text-center text-xl lg:text-2xl">{{$log->created_at->diffForHumans()}}</td>
            </tr>
            @endforeach
    </tbody>
</table>
</div>
@endsection