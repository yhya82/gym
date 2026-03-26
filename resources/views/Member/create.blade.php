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
     <a href="{{route('members.index')}}">view members</a>
    <form id="form-data">
        @csrf
      

        <label>Name</label>
        <input type="text" name="name" required>
        <label >Phone</label>
        <input type="text" name="phone" required>
        <label >Gender</label>
        <input type="text" name="gender" required>
        <label >Join  date</label>
        <input type="date" name="join_date" required>
        
        <select name="plan_id" required >
            <option value="">Select Plan</option>
            @foreach($plans as $plan)
            <option value="{{$plan->id}}">{{$plan->name}}</option>
            @endforeach
        </select>
        <label >Amount</label>
        <input type="text" name="amount" required>
        <label >Payment Method</label>
        <select name="payment_method" >
            <option value="">Select Payment Method</option>
            <option value="cash">Cash</option>
            <option value="wave">Wave</option>
            <option value="aps">Aps</option>
        </select>

        <button type="submit"> add Memeber</button>

    </form>


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
</body>
</html>