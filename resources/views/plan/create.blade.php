<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <a href="{{route('plans.index')}}">view plans</a>
    <form action="{{route('plans.store')}}" method="POST">
        @csrf
        <label >Plan name</label>
        <input type="text" name="name" placeholder="Enter  name" required>
         <label >Price</label>
        <input type="text" name="price" placeholder="Enter  price" required>
         <label >Duration</label>
        <input type="text" name="duration" placeholder="Enter duration" required>
        <button type="submit" > add plan</button>
    </form>
</body>
</html>