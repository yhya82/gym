<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Document</title>
    @vite('resources/js/app.js')
</head>
<body>
   @extends('layouts.app') 
   @section('content')

     <div class="mt-10 lg:mt-10">
            <p class="text-4xl lg:text-7xl font-bold px-2">Dashboard</p>
        </div>

    <div class="grid grid-cols-2 lg:grid-cols-3 gap-4 lg:gap-6 mt-4 lg:mt-10 px-2">
       
        <div class="flex flex-col items-center p-2 lg:p-4 bg-blue-600">
            <p class="text-3xl lg:text-4xl text-white font-bold">Total Revenue</p>
            <p id="total_revenue" class="text-2xl lg:text-3xl text-white mt-2 lg:mt-4"></p>
        </div>
        <div class='flex flex-col items-center p-2 lg:p-4 bg-gray-100'>
            <p class="text-3xl lg:text-4xl font-bold">Monthly Revenue</p>
            <p id ='monthly_revenue' class="text-2xl lg:text-3xl mt-2 lg:mt-4"></p>
        </div>
        <div class='flex flex-col items-center p-2 lg:p-4 bg-gray-400' >
            <p class="text-3xl lg:text-4xl font-bold">Total Members</p>
            <p id='total_members' class="text-2xl lg:text-3xl mt-2 lg:mt-4"></p>
        </div>
        <div class='flex flex-col items-center p-2 lg:p-4 bg-green-500'>
            <p class="text-3xl lg:text-4xl text-white font-bold">Active Members</p>
            <p id="active_members" class="text-2xl lg:text-3xl text-white mt-2 lg:mt-4"></p>
        </div>
        <div class='flex flex-col items-center p-2 lg:p-4 bg-red-500'>
            <p class="text-3xl lg:text-4xl text-white font-bold">Expired Members</p>
            <p id="expired_members"  class="text-2xl lg:text-3xl text-white mt-2 lg:mt-4"></p>
        </div>
    </div>

@endsection
<script>
    document.addEventListener('DOMContentLoaded', function(){
        //function to loaddashboard
        function loadDashboard(){
        fetch(`/api/dashboard`)
        .then(res => res.json())
        .then(data => {

            document.getElementById('total_revenue').innerText = data.total_revenue;
            document.getElementById('monthly_revenue').innerText = data.monthly_revenue;
            document.getElementById('total_members').innerText = data.total_members;
            document.getElementById('active_members').innerText = data.active_members;
            document.getElementById('expired_members').innerText = data.expired_members;

        })

        .catch(err => console.error(err));

    }
        //load dashboard
        loadDashboard();
    
    //listen to meembers expired
        Echo.private('members')
            .subscribed(() => console.log('✅ Subscribed to members channel!'))
            .listen('member.created', (e) => {
            loadDashboard();
            })
            .error(err => console.log('❌ Echo error', err))
            .listen('.App\\Events\\MemberStatusChanged',(e)=>{
                loadDashboard();
            });


            Echo.private('payments')
                .listen('.App\\Events\\PaymentRecieved', (e) =>{
                 loadDashboard();
                 });

   });     
    
</script>
</body>
</html>

