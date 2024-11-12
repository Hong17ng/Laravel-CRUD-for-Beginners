<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit Product</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">Edit Product</h1>

        <!-- Error messages -->
        <div>
            @if($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>

        <!-- Form start -->
        <form method="post" action="{{ route('product.update', ['product' => $product]) }}" class="bg-light p-4 rounded shadow-sm">
            @csrf 
            @method('put')
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Enter product name" value="{{ $product->name }}" />
            </div>

            <div class="mb-3">
                <label for="qty" class="form-label">Quantity</label>
                <input type="text" class="form-control" id="qty" name="qty" placeholder="Enter quantity" value="{{ $product->qty }}" />
            </div>

            <div class="mb-3">
                <label for="price" class="form-label">Price</label>
                <input type="text" class="form-control" id="price" name="price" placeholder="Enter price" value="{{ $product->price }}" />
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" id="description" name="description" placeholder="Enter description">{{ $product->description }}</textarea>
            </div>

            <div class="mb-3">
                <label for="attachment" class="form-label">Attachment</label>
                <input type="file" class="form-control" id="attachment" name="attachment" />
            </div>

            <!-- <div id="drop-area" class="border p-4 rounded text-center mb-3" style="border: 2px dashed #ced4da;">
                <p>Drag & Drop file here or click to upload</p>
            </div> -->

            <div class="text-center">
                <button type="submit" class="btn btn-primary">Update Product</button>
            </div>
        </form>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
    <script>
    document.addEventListener("DOMContentLoaded", function() {
        const dropArea = document.getElementById("drop-area");
        const fileInput = document.getElementById("attachment");

        dropArea.addEventListener("click", () => fileInput.click());

        // Prevent default behaviors
        ["dragenter", "dragover", "dragleave", "drop"].forEach(event => {
            dropArea.addEventListener(event, (e) => e.preventDefault());
        });

        // Highlight drop area on drag
        ["dragenter", "dragover"].forEach(event => {
            dropArea.addEventListener(event, () => dropArea.classList.add("bg-light"));
        });

        ["dragleave", "drop"].forEach(event => {
            dropArea.addEventListener(event, () => dropArea.classList.remove("bg-light"));
        });

        // Handle file drop
        dropArea.addEventListener("drop", (e) => {
            const files = e.dataTransfer.files;
            fileInput.files = files;
        });
    });
    </script>
</body>
</html>
