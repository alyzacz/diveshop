<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Products</title>

    <style>
        .alert-success {
            color: green;
        }
        #create , #update, #delete {
        display:inline-block;
        }
        .float-child{
            float: left;
            margin: 3px;
        }
        div{
            margin: 5px;
        }
    </style>
    <script src="https://code.jquery.com/jquery-3.6.3.min.js"></script>

</head>
<body>

    <h1>Current Products</h1>
    
    <div>
        {{ Form::label('product', 'Product :')}}
        {!! Form::select('product', $products, null, ['placeholder' => 'Dive Equipments']) !!}
        </br>
    </div>
        
    <div>
        <span>{{ Form::label('product_name', 'Product Name:')}}</span><span>{{ Form::text('product_name', null, null, ['placeholder' => 'Dive Equipments']) }}</span></br>
        <span>{{ Form::label('product_description', 'Product Description:')}}</span><span>{{ Form::text('product_description', null, null, ['placeholder' => 'Dive Equipments']) }}</span>
        </br>
    </div>


    <div>
        <form class="float-child" action="/products/create" method="GET">
            @csrf
            <input id="create" type="hidden" name="id"/>
            <button type="submit">create</button>
        </form>

        <form class="float-child" action="/products/edit" method="GET">
            @csrf
            <input id="update" type="hidden" name="id" value=""/>
            <button type="submit">update</button>
        </form>

        <form class="float-child" action="/product/delete" method="POST">
            @csrf
            <input id="delete" type="hidden" name="id" value=""/>
            <button type="submit">delete</button>
        </form>
    </div>
    @if ($products->count() == 0)
        <p><em>No products have been created yet.</em></p>
    @endif

</body>
<script>
    $(document).ready(function() {
        $("#product").on("change", function() {
            var id = $(this).val();
            var name = "";
            var desc = "";
            $("input#delete").attr("value", id);
            $("input#update").attr("value", id);

            $.ajax({ 
                url: "product/get", 
                data: {
                    'id': id
                },
                success: function(result){
                    if (result.name === undefined && result.description === undefined) {
                        name = "";
                        desc = "";
                    } else {
                        name = result.name;
                        desc = result.description;
                    }
                    $("input#product_name").attr("value", name);
                    $("input#product_description").attr("value", desc);
                }
            });
        });
    });
</script>

</html>
