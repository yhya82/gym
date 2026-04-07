@extends('layouts.app')
    @section('content')
        <div class="mt-10" >
            <p class="text-4xl lg:text-6xl font-serif">Renew Member </p>
        </div>
     <form id="form-data">
        @csrf
        <div class="flex flex-col mt-8 lg:mt-10">
        <label class="text-3xl lg:text-4xl">Name</label>
        <input type="text" name="name" id="name" class=" w-1/2 mt-2 lg:mt-4 lg:h-16" >
        </div>
        <div class="flex flex-col mt-4 lg:mt-6">
        <label class="text-3xl lg:text-4xl" >Phone</label>
        <input type="text" name="phone" id="phone" class=" w-1/2 mt-2 lg:mt-4 lg:h-16">
        </div>
        <div class="flex flex-col mt-4 lg:mt-6">
        <label class="text-3xl lg:text-4xl" >Gender</label>
        <input type="text" name="gender" id="gender" class=" w-1/2 mt-2 lg:mt-4 lg:h-16">
        </div>
        <div class="flex flex-col mt-4 lg:mt-6">
        <label class="text-3xl lg:text-4xl" >Join  date</label>
        <input type="date" name="join_date" id="join_date" class=" w-1/2 mt-2 lg:mt-4 lg:h-16">
        </div>
        <div class="flex flex-col mt-4 lg:mt-6">
            <label class="text-3xl lg:text-4xl">Plan</label>
        <select name="plan_id" id="plan_id" class="w-1/2">
            <option value="">Select Plan</option>
            @foreach($plans as $plan)
            <option value="{{$plan->id }}">
                {{$plan->name}}</option>
                @endforeach
        </select>
        </div>
        <div class="flex flex-col mt-4 lg:mt-6">
        <label class="text-3xl lg:text-4xl" >Amount</label>
        <input type="text" name="amount" id="amount" class=" w-1/2 mt-2 lg:mt-4 lg:h-16" >
        </div>
        <div class="flex flex-col mt-4 lg:mt-6">
        <label class="text-3xl lg:text-4xl" >Payment Method</label>
        <select name="payment_method" id="payment_method" class="w-1/2">
            <option value="">Select Payment Method</option>
            <option value="cash" >Cash</option>
            <option value="wave" >Wave</option>
            <option value="aps" >Aps</option>
        </select>
        </div>
        <div class="flex flex-col mt-4 lg:mt-6">
        <button type="submit" class="bg-blue-900 text-white text-2xl lg:text-4xl font-bold p-2 lg:p-4 rounded-2xl w-1/4 hover:bg-blue-500"> Renew Member</button>
        </div>
    </form>
    @endsection

    @section('scripts')
    <script>
    document.addEventListener('DOMContentLoaded', function() { 

        //grab the id from the urlto load the form
        const pathParts = window.location.pathname.split('/');
        const memberId = pathParts[2];


        function loadMember(id){
            fetch(`/api/members/${id}`)
            .then(res => res.json())
            .then( res => {
                    const member = res.data;
                document.getElementById('name').value = member.name;
                 document.getElementById('phone').value = member.phone;
                  document.getElementById('gender').value = member.gender;
                  document.getElementById('join_date').value = member.join_date;
                   document.getElementById('plan_id').value = member.plan_id;
                    document.getElementById('amount').value = member.payment.amount ||'';
                     document.getElementById('payment_method').value = member.payment.payment_method || '';
            })
            .catch(err=> console.error('Error loading member',(err)) );
        }

        
        loadMember(memberId);

        //handle the form submission
        document.getElementById('form-data').addEventListener('submit', function(e){
            e.preventDefault();

            const data  =  {
                        name: document.getElementById('name').value,
                         phone: document.getElementById('phone').value,
                         gender: document.getElementById('gender').value,
                        join_date: document.getElementById('join_date').value,
                        plan_id: document.getElementById('plan_id').value,
                         amount: document.getElementById('amount').value,
                        payment_method: document.getElementById('payment_method').value

                        }

            fetch(`/api/members`,{
                method:'POST',
                credentials:'include',
                headers:{
                    'Content-type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
                },
                body:JSON.stringify(data),
            })
            .then(res =>res.json())
            .then(res =>{
                alert(res.message || ' Member Renewed Successfully');

                window.location.href = '/members'; //redirect to index page
            })
            .catch(err=> console.error('Error updating member'))
        });


        });
        
    </script>
    @endsection

