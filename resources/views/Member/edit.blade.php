<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
     <form id="form-data">
        @csrf
        <label>Name</label>
        <input type="text" name="name" id="name" >
        <label >Phone</label>
        <input type="text" name="phone" id="phone" >
        <label >Gender</label>
        <input type="text" name="gender" id="gender" >
        <label >Join  date</label>
        <input type="date" name="join_date" id="join_date" >
        
        <select name="plan_id" id="plan_id">
            <option value="">Select Plan</option>
            @foreach($plans as $plan)
            <option value="{{$plan->id }}">
                {{$plan->name}}</option>
                @endforeach
        </select>
        <label >Amount</label>
        <input type="text" name="amount" id="amount" >
        <label >Payment Method</label>
        <select name="payment_method" id="payment_method">
            <option value="">Select Payment Method</option>
            <option value="cash" >Cash</option>
            <option value="wave" >Wave</option>
            <option value="aps" >Aps</option>
        </select>

        <button type="submit" > Update Memeber</button>

    </form>

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

            fetch(`/api/members/${memberId}`,{
                method:'PUT',
                headers:{
                    'Content-type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
                },
                body:JSON.stringify(data),
            })
            .then(res =>res.json())
            .then(res =>{
                alert(res.message || ' Member updated Successfully');

                window.location.href = '/members'; //redirect to index page
            })
            .catch(err=> console.error('Error updating member'))
        });


        });
        
    </script>
</body>
</html>