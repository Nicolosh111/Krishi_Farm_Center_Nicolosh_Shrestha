<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{{ $crop->name }} Details</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: #f9fafb;
            margin: 0;
            padding: 0;
            color: #333;
        }
        .container {
            max-width: 900px;
            margin: 40px auto;
            padding: 20px;
        }
        .card {
            background: #fff;
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.05);
        }
        h1 {
            font-size: 28px;
            color: #2e7d32;
            margin-bottom: 10px;
        }
        h2 {
            font-size: 20px;
            color: #2e7d32;
            margin-bottom: 8px;
        }
        h3 {
            font-size: 18px;
            color: #444;
            margin-top: 20px;
            margin-bottom: 10px;
        }
        p, li {
            font-size: 15px;
            line-height: 1.6;
        }
        .crop-image {
            width: 100%;
            max-height: 300px;
            object-fit: cover;
            border-radius: 10px;
            margin-bottom: 15px;
        }
        .badges {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
            margin-bottom: 15px;
        }
        .badge {
            background: #e8f5e9;
            color: #2e7d32;
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 13px;
        }
        .resource-list {
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
        }
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

        .btn-wrapper {
            text-align: center;
            margin: 30px 0;
        }
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
    </style>
</head>
<body>
<div class="container">

    <!-- Crop Header -->
    <div class="card">
        @if($crop->image)
            <img src="{{ asset('storage/' . $crop->image) }}" alt="{{ $crop->name }}" class="crop-image">
        @endif
        <h1>{{ $crop->name }}</h1>
        <div class="badges">
            <span class="badge"><i class="fas fa-sun"></i> Season: {{ ucfirst($crop->best_season) }}</span>
            <span class="badge"><i class="fas fa-map-marker-alt"></i> Region: {{ ucfirst($crop->region) }}</span>
            @if($crop->soil_type)
                <span class="badge"><i class="fas fa-seedling"></i> Soil: {{ $crop->soil_type }}</span>
            @endif
        </div>
    </div>

    <!-- Description -->
    <div class="card">
        <h2>About</h2>
        <p>{{ $crop->description }}</p>
    </div>

    <!-- Cultivation Practices -->
    @if($crop->cultivation_practices)
    <div class="card">
        <h2>Cultivation Practices</h2>
        <ul>
            @foreach(explode("\n", $crop->cultivation_practices) as $practice)
                @if(trim($practice) !== '')
                    <li>{{ $practice }}</li>
                @endif
            @endforeach
        </ul>
    </div>
    @endif

    <!-- Yield Potential -->
    @if($crop->yield_potential)
    <div class="card">
        <h2>Yield Potential</h2>
        <p><i class="fas fa-chart-line"></i> {{ $crop->yield_potential }} tons/ha</p>
    </div>
    @endif

    <!-- Resources -->
    @if($crop->cropResources->count())
    <div class="card">
        <h2>Resources</h2>

        {{-- External Links --}}
        {{-- @if($crop->cropResources->where('type','link')->count())
            <h3>External Links</h3>
            <div class="resource-list">
                @foreach($crop->cropResources->where('type','link') as $resource)
                    <a href="{{ $resource->file }}" target="_blank" class="resource-btn">
                        <i class="fas fa-link"></i> {{ $resource->title }}
                    </a>
                @endforeach
            </div>
        @endif --}}

        {{-- External Links --}}
@if($crop->cropResources->where('type','link')->count())
    <h3>External Links</h3>
    <div class="resource-list">
        @foreach($crop->cropResources->where('type','link') as $resource)
            <a href="{{ $resource->link }}" target="_blank" class="resource-btn">
                <i class="fas fa-link"></i> {{ $resource->title }}
            </a>
        @endforeach
    </div>
@endif

        {{-- Documents & Images --}}
        @php
            $docs = $crop->cropResources->whereNotIn('type',['link'])->filter(fn($r) => !Str::startsWith($r->type,'video'));
        @endphp
        @if($docs->count())
            <h3>Documents & Images</h3>
            <div class="resource-list">
                @foreach($docs as $resource)
                    <a href="{{ asset('storage/' . $resource->file) }}" target="_blank" class="resource-btn">
                        <i class="fas fa-file"></i> {{ $resource->title }}
                    </a>
                @endforeach
            </div>
        @endif

        {{-- Videos --}}
        @php
            $videos = $crop->cropResources->filter(fn($r) => Str::startsWith($r->type,'video'));
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

    <!-- Back Button Centered -->
    <div class="btn-wrapper">
        <a href="{{ route('home') }}#crops" class="btn-back">
            <i class="fas fa-arrow-left"></i> Back to Crops
        </a>
    </div>

</div>
</body>
</html>
