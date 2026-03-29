<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{{ $disease->name }} Details</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <style>
        body { font-family: 'Poppins', sans-serif; background: #f9fafb; margin: 0; padding: 0; color: #333; }
        .container { max-width: 900px; margin: 40px auto; padding: 20px; }
        .card { background: #fff; border-radius: 10px; padding: 20px; margin-bottom: 20px; box-shadow: 0 4px 10px rgba(0,0,0,0.05); }
        h1 { font-size: 28px; color: #c62828; margin-bottom: 10px; }
        h2 { font-size: 20px; color: #2e7d32; margin-bottom: 8px; }
        h3 { font-size: 18px; color: #444; margin-top: 20px; margin-bottom: 10px; }
        p, li { font-size: 15px; line-height: 1.6; }
        .disease-image { width: 100%; max-height: 300px; object-fit: cover; border-radius: 10px; margin-bottom: 15px; }
        .badges { display: flex; gap: 10px; flex-wrap: wrap; margin-bottom: 15px; }
        .badge { background: #fdecea; color: #c62828; padding: 6px 12px; border-radius: 20px; font-size: 13px; }

        .resource-list { display: flex; flex-wrap: wrap; gap: 12px; }

        .resource-btn {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 10px 16px;
            background: #2e7d32;
            color: #fff;
            border-radius: 6px;
            text-decoration: none;
            font-size: 14px;
            transition: background .3s;
        }
        .resource-btn:hover { background: #256628; }

        .btn-wrapper { text-align: center; margin: 30px 0; }
        .btn-back {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 12px 22px;
            background: #555;
            color: #fff;
            border-radius: 6px;
            text-decoration: none;
            font-size: 15px;
            transition: background .3s;
        }
        .btn-back:hover { background: #333; }

        /* Video styling */
        .video-wrapper {
            text-align: center;
            flex: 1 1 100%;
            margin: 20px 0;
        }
        .video-wrapper video {
            max-width: 80%;
            border-radius: 8px;
            box-shadow: 0 3px 8px rgba(0,0,0,0.15);
        }
        .video-wrapper p {
            margin-top: 8px;
            font-weight: 600;
        }

        .treatment-gallery {
    display: flex;
    flex-wrap: wrap;
    gap: 20px;
    justify-content: center;
}

.treatment-card {
    width: 160px; /* fixed width for consistency */
    text-align: center;
}

.treatment-card img {
    width: 100%;
    height: 150px;
    object-fit: cover;
    border-radius: 8px;
    border: 1px solid #ddd;
    box-shadow: 0 2px 6px rgba(0,0,0,0.1);
}

.treatment-card a {
    display: inline-block;
    margin-top: 8px;
    padding: 8px 12px;
    background: #2e7d32; /* green */
    color: #fff;
    border-radius: 6px;
    text-decoration: none;
    font-size: 14px;
    transition: background 0.3s;
}

.treatment-card a:hover {
    background: #256628;
}
    </style>
</head>
<body>
<div class="container">

    <!-- Disease Header -->
    <div class="card">
        @if($disease->image)
            <img src="{{ asset('storage/' . $disease->image) }}" alt="{{ $disease->name }}" class="disease-image">
        @endif
        <h1>{{ $disease->name }}</h1>
        <div class="badges">
            <span class="badge">Type: {{ $disease->type ?? 'N/A' }}</span>
            <span class="badge">Severity: {{ ucfirst($disease->severity) }}</span>
        </div>
        <p><i class="fas fa-seedling"></i> Affected Crop: {{ $disease->crop->name }}</p>
    </div>

    <!-- Symptoms -->
    @if($disease->symptoms)
    <div class="card">
        <h2>Symptoms</h2>
        <ul>
            @foreach(explode("\n", $disease->symptoms) as $symptom)
                @if(trim($symptom) !== '')
                    <li>{{ $symptom }}</li>
                @endif
            @endforeach
        </ul>
    </div>
    @endif

    <!-- Causes -->
    @if($disease->cause)
    <div class="card">
        <h2>Causes</h2>
        <p>{{ $disease->cause }}</p>
    </div>
    @endif

    <!-- Prevention -->
    @if($disease->prevention)
    <div class="card">
        <h2>Prevention</h2>
        <ul>
            @foreach(explode("\n", $disease->prevention) as $prevent)
                @if(trim($prevent) !== '')
                    <li>{{ $prevent }}</li>
                @endif
            @endforeach
        </ul>
    </div>
    @endif

    <!-- Treatment -->
    @if($disease->treatment)
    <div class="card">
        <h2>Treatment</h2>
        <ul>
            @foreach(explode("\n", $disease->treatment) as $treat)
                @if(trim($treat) !== '')
                    <li>{{ $treat }}</li>
                @endif
            @endforeach
        </ul>
    </div>
    @endif

    @if($disease->treatmentImages->count())
    <div class="card">
        <h2>Treatment Images</h2>
        <div class="treatment-gallery">
            @foreach($disease->treatmentImages as $image)
                <div class="treatment-card">
                    {{-- <img src="{{ asset('storage/' . $image->file) }}" alt="Treatment Image"> --}}

<img src="{{ asset('storage/' . $image->file) }}"
     alt="Treatment Image"
     style="cursor:pointer"
     onclick="openModal(this.src)">
                    @if($image->title)
                        <p class="mt-2 text-sm font-semibold text-gray-700">{{ $image->title }}</p>
                    @endif

                    <a href="{{ asset('storage/' . $image->file) }}" download
                    class="mt-2 inline-block bg-green-600 text-white px-4 py-1 rounded hover:bg-green-700 transition">
                        <i class="fas fa-download mr-1"></i> Download
                    </a>
                </div>
            @endforeach
        </div>
    </div>
    @endif

    <!-- Resources -->
    @if($disease->resources && $disease->resources->count())
    <div class="card">
        <h2>Resources</h2>

        {{-- External Links --}}
        @if($disease->resources->where('type','link')->count())
            <h3>External Links</h3>
            <div class="resource-list">
                @foreach($disease->resources->where('type','link') as $resource)
                    <a href="{{ $resource->file }}" target="_blank" class="resource-btn">
                        <i class="fas fa-link"></i> {{ $resource->title }}
                    </a>
                @endforeach
            </div>
        @endif

        {{-- Documents & Images --}}
        @php
            $docs = $disease->resources->whereNotIn('type',['link'])->filter(fn($r) => !Str::startsWith($r->type,'video'));
        @endphp
        @if($docs->count())
            <h3>Documents & Images</h3>
            <div class="resource-list">
                @foreach($docs as $resource)
                    <a href="{{ asset('storage/' . $resource->file) }}" target="_blank" class="resource-btn">
                        <i class="fas fa-file-alt"></i> {{ $resource->title }}
                    </a>
                @endforeach
            </div>
        @endif

        {{-- Videos --}}
        @php
            $videos = $disease->resources->filter(fn($r) => Str::startsWith($r->type,'video'));
        @endphp
        @if($videos->count())
            <h3>Videos</h3>
            @foreach($videos as $resource)
                <div class="video-wrapper">
                    <video controls>
                        <source src="{{ asset('storage/' . $resource->file) }}" type="{{ $resource->type }}">
                        Your browser does not support the video tag.
                    </video>
                    <p>{{ $resource->title }}</p>
                </div>
            @endforeach
        @endif
    </div>
    @endif

    <!-- Back Button -->
    <div class="btn-wrapper">
        <a href="{{ route('home') }}#diseases" class="btn-back">
            <i class="fas fa-arrow-left"></i> Back to Diseases
        </a>
    </div>


    <!-- IMAGE MODAL -->
<div id="imageModal" style="
    display:none;
    position:fixed;
    top:0;
    left:0;
    width:100%;
    height:100%;
    background:rgba(0,0,0,0.85);
    justify-content:center;
    align-items:center;
    z-index:9999;
">

    <!-- Close Button -->
    <span onclick="closeModal()" style="
        position:absolute;
        top:20px;
        right:30px;
        font-size:35px;
        color:white;
        cursor:pointer;
    ">&times;</span>

    <!-- Image -->
    <img id="modalImage" style="
        max-width:90%;
        max-height:90%;
        border-radius:10px;
    ">
</div>

    <script>
function openModal(src) {
    document.getElementById("imageModal").style.display = "flex";
    document.getElementById("modalImage").src = src;
}

function closeModal() {
    document.getElementById("imageModal").style.display = "none";
}

// close when clicking outside
document.getElementById("imageModal").addEventListener("click", function(e) {
    if (e.target.id === "imageModal") {
        closeModal();
    }
});
</script>

</div>
</body>
</html>
