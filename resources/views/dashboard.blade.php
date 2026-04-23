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

     <div class="flex flex-col mt-12 bg-gray-100  rounded-xl px-2">
            <p class="text-4xl lg:text-6xl font-serif p-3 lg:p-5 ">Welcome <span>{{auth()->user()->name}},</span></p>
            <h2 id="now" class="text-xl lg:text-2xl p-2 lg:p-4"></h2>
        </div>

    <div class="grid grid-cols-2 lg:grid-cols-3 gap-4 lg:gap-6 mt-8 lg:mt-10 px-2">
       
        <div class="flex flex-col items-center p-2 lg:p-4 bg-blue-600 rounded-xl">
            <p class="text-2xl md:text-3xl lg:text-4xl text-white font-bold">Total Revenue</p>
            <p id="total_revenue" class="text-2xl lg:text-3xl text-white mt-2 lg:mt-4"></p>
        </div>
        <div class='flex flex-col items-center p-2 lg:p-4 bg-gray-100 rounded-xl'>
            <p class="text-2xl md:text-3xl lg:text-4xl font-bold">Monthly Revenue</p>
            <p id ='monthly_revenue' class="text-2xl lg:text-3xl mt-2 lg:mt-4"></p>
        </div>
        <div class='flex flex-col items-center p-2 lg:p-4 bg-gray-100 rounded-xl' >
            <p class="text-2xl md:text-3xl lg:text-4xl font-bold">Total Members</p>
            <p id='total_members' class="text-2xl lg:text-3xl mt-2 lg:mt-4"></p>
        </div>
        <div class='flex flex-col items-center p-2 lg:p-4 bg-gray-100 rounded-xl'>
            <p class="text-2xl md:text-3xl lg:text-4xl text-green-700 font-thin">Active Members</p>
            <p id="active_members" class="text-2xl lg:text-3xl  mt-2 lg:mt-4"></p>
        </div>
        <div class='flex flex-col items-center p-2 lg:p-4 bg-gray-100 rounded-xl'>
            <p class="text-2xl md:text-3xl lg:text-4xl text-red-700 font-thin">Expired Members</p>
            <p id="expired_members"  class="text-2xl lg:text-3xl  mt-2 lg:mt-4"></p>
        </div>
    </div>

    <!--for charts-->
    <div class="flex flex-col-reverse lg:flex-row gap-2 lg:gap-5">
        <div class="flex flex-col lg:w-3/4 h-48">
                 <p class="text-4xl lg:text-5xl font-serif mt-10 lg:mt-16">Revenue</p>

            <div class="flex flex-col   mt-4 bg-gray-100 p-4 lg:p-6 rounded-xl px-2">
        
                <canvas id="revenueChart" class="  h-64 mt-4 lg:mt-6 px-2"></canvas>
            </div> 

        </div>
        <!--quick actions-->
        <div class="flex flex-col lg:w-1/4 ">
            <p class="text-4xl lg:text-4xl font-serif mt-10 lg:mt-16">Quick Actions</p>
            <div class="flex flex-col gap-2 lg:gap-4 mt-4 lg:mt-16">
                <button class="bg-blue-800 p-2 lg:p-4 text-2xl md:text-3xl lg:text-4xl hover:bg-blue-500 rounded-xl text-white font-sembold "> <a href="{{route('members.web.create')}}">Add Member</a></button>
                <button class="bg-yellow-600 p-2 lg:p-4 text-2xl md:text-3xl lg:text-4xl hover:bg-yellow-500 rounded-xl text-white font-sembold "> <a href="{{route('members.web.index')}}">View Members</a></button>
                <button class="bg-purple-600 p-2 lg:p-4 text-2xl md:text-3xl lg:text-4xl hover:bg-purple-500 rounded-xl text-white font-sembold "> <a href="{{route('plans.create')}}">Add Plan</a></button>
            </div>
        </div>

    </div>
   

@endsection
@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function(){

         const ctx = document.getElementById('revenueChart').getContext('2d');

    // Initialize Revenue Chart
        const revenueChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: [], //start empty then load after the api fetch
            datasets: [{
                label: 'Revenue',
                data: [], // start empty then load after the api fetch
                backgroundColor: ['#3b82f6','#10b981'] // blue & green
            }]
        },
        options: {
            responsive: true,
            plugins: { legend: { display: false } },
            scales: { y: { beginAtZero: true } }
        }
    });
        //function to loaddashboard
        function loadDashboard(){   
        fetch(`/api/dashboard`)
        .then(res => res.json())
        .then(data => {

            document.getElementById('total_revenue').innerText ='D' + data.total_revenue;
            document.getElementById('monthly_revenue').innerText ='D' + data.monthly_revenue;
            document.getElementById('total_members').innerText = data.total_members;
            document.getElementById('active_members').innerText = data.active_members;
            document.getElementById('expired_members').innerText = data.expired_members;
            document.getElementById('now').innerText = data.now;

             // Update chart
             revenueChart.data.labels = data.labels;
            revenueChart.data.datasets[0].data = data.data;
            revenueChart.update();

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
            .listen('.member.expired',(e)=>{
                loadDashboard();
            });


            Echo.private('payments')
                .listen('.payment.received', (e) =>{
                 loadDashboard();
                 });

   });     
    
</script>

@endsection

