<html>
<head>
    <meta charset="utf-8">
    <title>Image PDF</title>
    <style>
        body {
            margin: 0;
            padding: 0;
        }
        .image-container {
            width: 100%;
            height: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        img {
            max-width: 100%;
            max-height: 100%;
        }
    </style>
</head>
<body>
    <div class="image-container">
        <img src="{{ $img->encode('data-url') }}" alt="Image">
    </div>
</body>
</html>
