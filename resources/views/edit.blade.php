<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Edit Products</title>
    <style>
        .alert-success {
            color: green;
        }

    </style>
</head>

<body>
    <h2>Edit Product</h2>
    <form action="{{ route('product.update', $product->id) }}" method="POST">
        @csrf
        <input type="text" name="name" placeholder="name" value="{{ $product->name }}" /><br />
        <textarea name="description" placeholder="description" value="{{ $product->description }}">{{ $product->description }}</textarea><br />
        <button type="submit">Submit</button>
    </form>
    <form action="/products" method="GET">
        @csrf
        <input id="create" type="hidden" name="id"/>
        <button type="submit">home</button>
    </form>

</body>

</html>