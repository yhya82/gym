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
            <option value="{{$plan->id}}">
                {{$plan->name}}</option>
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
    document.addEventListener('DOMContentLoaded', function(){ 

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
                    document.getElementById('amount').value = member.amount;
                     document.getElementById('payment_method').value = member.payment_method;
            })
            .catch(err=> console.error('Error loading member',(err)) );
        }
        loadMember();
        });
        
    </script>
</body>
</html>