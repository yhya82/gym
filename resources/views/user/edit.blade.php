<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="{{route('users.update',$user->id)}}" method="POST">
        @csrf
        @method('PUT')
        <label>Name</label>
        <input type="text" name="name" value="{{$user->name}}">
        <label>Email</label>
        <input type="email" name="email" value="{{$user->email}}" >
        <label>Password</label>
        <input type="password" name="password" placeholder="Enter new password" >
        <select name="role" >
            <option value="">Select Role</option>
            <option value="owner"  {{$user->role == 'owner' ? 'selected' : '' }}> Owner</option>
            <option value="admin" {{$user->role =='admin' ? 'selected' : '' }} >admin</option>
        </select>
        <label>Phone</label>
        <input type="text" name="phone" value="{{$user->phone}}">
        <button type="submit">update user</button>
    </form>
</body>
</html>