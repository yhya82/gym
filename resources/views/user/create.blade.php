<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="{{route('users.store')}}" method="POST">
        @csrf
        <a href="{{route('users.index')}}">view user</a><br>
        <label>Name</label>
        <input type="text" name="name" placeholder="Enter name" required>
        <label>Email</label>
        <input type="email" name="email" placeholder="Enter email" required>
        @error('email')
        <p style="color:red">{{$message}}</p>
        @enderror
        <label>Password</label>
        <input type="password" name="password" placeholder="Enter passoword" required>
        <select name="role" >
            <option value="">Select Role</option>
            <option value="owner"> Owner</option>
            <option value="admin">admin</option>
        </select>
        <label>Phone</label>
        <input type="text" name="phone" placeholder="Enter " required>
        <button type="submit">Add user</button>
    </form>
</body>
</html>