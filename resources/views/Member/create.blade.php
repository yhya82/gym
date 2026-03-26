<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{csrf_token()}}">
    <title>Document</title>
    @vite('resources/js/app.js')
</head>
<body>
    @extends('layouts.app')
    @section('content')
    <div class="flex flex-col mt-10 px-4">
        <p class="text-4xl lg:text-6xl">Create Member</p>
     <a href="{{route('members.index')}}" class="text-2xl lg:text-3xl text-blue-500">view members</a>
     </div>
    <form id="form-data" class="px-4">
        @csrf
      
        <div class="flex flex-col mt-6 lg:mt-8">
        <label class="text-3xl lg:text-4xl">Name</label>
        <input type="text" name="name" placeholder="Enter name" class="placeholder:text-2xl lg:placeholder:text-3xl w-1/2 mt-2 lg:mt-4 lg:h-16" required>
        </div>
        <div class="flex flex-col mt-4 lg:mt-6">
        <label class="text-3xl lg:text-4xl" >Phone</label>
        <input type="text" name="phone" placeholder="Enter phone" class="placeholder:text-2xl lg:placeholder:text-3xl w-1/2 mt-2 lg:mt-4 lg:h-16"required>
        </div>
        <div class="flex flex-col mt-4 lg:mt-6">
            <label class="text-3xl lg:text-4xl">Gender</label>
        <select name="gender" required class="w-1/2">
            <option value="male">Male</option>
            <option value="female">Female</option>

        </select>
        </div>
        <div class="flex flex-col mt-4 lg:mt-6">
        <label class="text-3xl lg:text-4xl" >Join  date</label>
        <input type="date" name="join_date" class="w-1/2 lg:h-16" required>
        </div>
        <div class="flex flex-col mt-4 lg:mt-6">
        <label class="text-3xl lg:text-4xl" >Plan</label>
        <select name="plan_id" required class="w-1/2" >
            <option value="">Select Plan</option>
            @foreach($plans as $plan)
            <option value="{{$plan->id}}">{{$plan->name}}</option>
            @endforeach
        </select>
        </div>
        <div class="flex flex-col mt-4 lg:mt-6">
        <label class="text-3xl lg:text-4xl">Amount</label>
        <input type="text" name="amount" placeholder="Enter Amount" class="placeholder:text-2xl lg:placeholder:text-3xl w-1/2 mt-2 lg:mt-4 lg:h-16" required>
        </div>
        <div class="flex flex-col mt-4 lg:mt-6">
        <label class="text-3xl lg:text-4xl" >Payment Method</label>
        <select name="payment_method" required class="w-1/2">
            <option value="">Select Payment Method</option>
            <option value="cash">Cash</option>
            <option value="wave">Wave</option>
            <option value="aps">Aps</option>
        </select>
        </div>
        <div class="mt-4 lg:mt-6">
        <button type="submit" class="bg-blue-900 text-white text-2xl lg:text-4xl font-bold p-2 lg:p-4 rounded-2xl w-1/4 hover:bg-blue-500"> add Memeber</button>
        </div>
    </form>
@endsection

@section('scripts')
    <script>

        const form = document.getElementById('form-data');
            form.addEventListener('submit', function(e) {
            e.preventDefault();
            
             const token = document.querySelector('input[name="_token"]').value;
            const data = Object.fromEntries(new FormData(e.target));

            fetch(`/api/members`,{
             method:'POST',
             credentials:'include',
             headers:{'Accept':'application/json',
                        'Content-type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
             },
             
             body:JSON.stringify(data),
             
            })
            .then(res => res.json())
            .then(res =>{
                console.log(res);
                alert('Member Created Successfully');
                form.reset(); //reset the form after submission
                form.querySelector('input[name="name"]').focus();
                loadmembers();
            })
            .catch(err => console.log(err));
        })
    </script>

@endsection