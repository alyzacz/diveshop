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
    
    @if (session('status'))
        <div class="alert-success">
            {{ session('status') }}
        </div>
    @endif

    <hr />
    <h2>New product</h2>
    <form action="{{ route('products.new') }}" method="POST">
        @csrf
        <input type="text" name="name" placeholder="name" /><br />
        <textarea name="description" placeholder="description"></textarea><br />
        <input type="text" name="tags" placeholder="tags" /><br />
        <button type="submit">Submit</button>
    </form>
</body>

</html>