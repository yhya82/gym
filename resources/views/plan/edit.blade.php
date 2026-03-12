<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
     <form action="{{route('plans.update',$plan->id)}}" method="POST">
        @csrf
        @method('PUT')
        <label >Plan name</label>
        <input type="text" name="name" value={{$plan->name}} >
         <label >Price</label>
        <input type="text" name="price" value={{$plan->price}} >
         <label >Duration</label>
        <input type="text" name="duration" value={{$plan->duration}} >
        <button type="submit" > update plan</button>
    </form>
</body>
</html>