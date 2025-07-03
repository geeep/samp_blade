<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1>Create Product</h1>
    <div>@if($errors->any())
        <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
        </ul>
        @endif
    </div>
    <form action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('post')
        <div>
            <label for="name">Name:</label>
            <input type="string" id="name" name="name" placeholder="Your Name Here" />
        </div>
        <div>
            <label for="description">Description:</label>
            <input type="text" id="description" name="description" placeholder="Input Description"/>
        </div>
        <div>
            <label for="price">Price:</label>
            <input type="decimal" id="price" name="price" placeholder="0.00" />
        </div>
        <div>
            <label for="stock">Stock:</label>
            <input type="integer" id="stock" name="stock" placeholder="0" />
        </div>
        <div>
            <label for="category">Category:</label>
            <input type="string" id="category" name="category" placeholder="Input category" />
        </div>
        <div>
            <label for="image">Image:</label>
            <input type="file" id="image" name="image" accept="image" />
        </div>
        <div>
            <input type="submit" value = Create Product />
        </div>

    </form>
</body>
</html>
