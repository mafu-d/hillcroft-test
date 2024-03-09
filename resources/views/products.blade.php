<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Hillcroft Test - Matt Dawkins</title>
    @vite('resources/css/app.css')
</head>

<body>
    <h1>Hillcroft Test - Matt Dawkins</h1>

    <div class="products">
        @foreach ($products as $product)
            <div class="product">
                <h2>{{ $product->name }}</h2>
                <p>{{ $product->code }}</p>
                <p>{{ $product->short_description }}</p>
                <p>
                    £{{ number_format($product->price_inc_vat, 2) }}
                    (£{{ number_format($product->price_ex_vat, 2) }} ex VAT)
                </p>
            </div>
        @endforeach
    </div>

    {{ $products->links('vendor.pagination.default') }}

</body>

</html>
