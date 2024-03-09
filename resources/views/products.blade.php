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

    <form action="{{ route('upload') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <p>
            <label for="file">Upload XML file:</label>
            <input type="file" name="file" id="file">
            @if ($errors->has('file'))
                <span class="error">{{ $errors->first('file') }}</span>
            @endif
        </p>
        <p><button>Upload</button></p>

        @if (session('success'))
            <p class="success">{{ session('success') }}</p>
        @endif
    </form>

    <hr>

    <div class="products">
        @foreach ($products as $product)
            <div class="product">
                <h2>{{ $product->name }}</h2>
                <p>Code: {{ $product->code }}</p>
                <p>Category: {{ $product->category->name }}</p>
                <p>Stock: {{ $product->stock }}</p>
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
