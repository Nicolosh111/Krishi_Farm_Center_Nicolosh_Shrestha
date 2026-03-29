<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Disease Identification</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <style>
        /* Layout */
        html, body {
            height: 100%;
            margin: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f4f7f6;
        }

        body { display: flex; flex-direction: column; }

        main {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
            padding-top: 100px;
            box-sizing: border-box;
        }

        .container {
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 6px 15px rgba(0,0,0,0.1);
            padding: 2rem;
            width: 100%;
            max-width: 500px;
        }

        h1 { color: #2e7d32; font-size: 1.8rem; margin-bottom: 0.5rem; }
        p { color: #555; margin-bottom: 1.5rem; }

        form { display: flex; flex-direction: column; gap: 1rem; }
        form label { font-weight: 600; color: #333; margin-bottom: 0.3rem; }

        input[type="file"], select {
            border: 1px solid #ccc;
            border-radius: 6px;
            padding: 0.6rem;
            font-size: 0.95rem;
            cursor: pointer;
        }

        #preview { margin-top: 1rem; display: none; }
        #preview img {
            max-width: 100%;
            border-radius: 6px;
            border: 1px solid #ddd;
        }

        #remove-btn {
            margin-top: 0.5rem;
            background: #e53e3e;
            color: #fff;
            font-weight: 600;
            padding: 0.5rem 0.8rem;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            transition: background 0.3s ease;
        }
        #remove-btn:hover { background: #c53030; }

        button[type="submit"] {
            background: #2e7d32;
            color: #fff;
            font-weight: 600;
            padding: 0.8rem;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            transition: background 0.3s ease;
        }
        button[type="submit"]:hover { background: #276749; }
    </style>
</head>
<body>
    <main>
        <div class="container">
            <h1>Disease Identification</h1>
            <p>Upload a plant image to identify possible diseases.</p>

            @if(session('success'))
                <div id="flash-success">{{ session('success') }}</div>
            @endif

            <form method="POST" action="{{ route('disease.identification.process') }}" enctype="multipart/form-data">
                @csrf

                <!-- Plant Image -->
                <div>
                    <label for="plant_image">Plant Image</label>
                    <input type="file" name="plant_image" id="plant_image" accept="image/*" required>
                </div>

                <!-- Preview -->
                <div id="preview">
                    <img id="preview-img" src="" alt="Preview">
                    <button type="button" id="remove-btn">Remove Image</button>
                </div>

                <!-- Crop Dropdown -->
                <div>
                    <label for="crop_id">Select Crop</label>
                    <select name="crop_id" id="crop_id" required>
                        @foreach($crops as $crop)
                            <option value="{{ $crop->id }}">{{ $crop->name }}</option>
                        @endforeach
                    </select>
                </div>

                <button type="submit">Diagnose</button>
            </form>
        </div>
    </main>

    <script>
        const fileInput = document.getElementById('plant_image');
        const preview = document.getElementById('preview');
        const previewImg = document.getElementById('preview-img');
        const removeBtn = document.getElementById('remove-btn');

        // Show preview
        fileInput.addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(evt) {
                    previewImg.src = evt.target.result;
                    preview.style.display = 'block';
                };
                reader.readAsDataURL(file);
            }
        });

        // Remove preview
        removeBtn.addEventListener('click', function() {
            fileInput.value = ''; // clear file input
            previewImg.src = '';
            preview.style.display = 'none';
        });
    </script>
</body>
</html>
