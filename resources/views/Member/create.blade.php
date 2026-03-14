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
        <input type="text" name="name" required>
        <label >Phone</label>
        <input type="text" name="phone" required>
        <label >Gender</label>
        <input type="text" name="gender" required>
        <label >Join  date</label>
        <input type="date" name="join_date" required>
        @foreach($plans as $plan)
        <select name="plan_id" >
            <option value="">Select Plan</option>
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

        <button type="submit" > add Memeber</button>

    </form>


    <script>

        const form = document.getElementById('form-data');
            form.addEventListener('submit', function(e) {
            e.preventDefault();
            
            const form= e.target;
            const data = Object.fromEntries(new FormData(form));

            fetch(`/api/members`,{
             method:'POST',
             headers:{'Accept':'Application/json',
                        'content-type': 'Application/json'
             },
             
             body:JSON.stringify(data),
             
            })
            .then(res => res.json())
            .then(res =>{
                console.log(res);

            })
            .catch(err => console.log(err));
        })
    </script>
</body>
</html>