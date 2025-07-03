<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1>Users</h1>
    <div>
        <table border="1" cellpadding="10" cellspacing="0">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Password</th>
                    <th>Category</th>
                    <th>Image</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->price }}</td>
                    <td>{{ $user->password }}</td>
                    <td>{{ $user->category }}</td>
                    <td><img src="{{ asset('storage/' . $user->image) }}" alt="{{ $user->name }}" width="100"></td>
                    {{-- <td>
                        <form action="{{  route('user.edit', ['user' => $user]) }}" method="GET" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Edit</button>
                        </form>
                        {{-- {{-- <form action="{{ route('user.show', $user->id) }}" method="GET" style="display:inline;">
                            @csrf
                            <button type="submit">Show</button> --}}
                        {{-- <form action="{{  route('user.destroy', ['user' => $user]) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Delete</button>
                        </form> --}}
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>
