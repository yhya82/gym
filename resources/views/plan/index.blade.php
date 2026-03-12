<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
   <h2>Plan List</h2> 
   <a href="{{route('plans.create')}}">add new plan</a>
   <table>
    <tr>
        <th>Plan Name</th>
        <th>Price</th>
        <th>Duration(days)</th>
        <th>Actions</th>
    </tr>

    <tbody>
        @foreach($plans as $plan)
        <tr>
            <td>{{$plan->name}}</td>
            <td>{{$plan->price}}</td>
            <td>{{$plan->duration}}</td>
            <td>
                <a href="{{route('plans.edit',$plan->id)}}">Edit</a>
                <form action="{{route('plans.destroy',$plan->id)}}" method="POST" style='display:inline'>
                    @csrf
                    @method('DELETE')
                    <button type="submit">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
   </table>
</body>
</html>