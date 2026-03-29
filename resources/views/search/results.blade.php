<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Results</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f3f4f6;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 1300px;
            margin: 0 auto;
            padding: 30px 20px;
        }
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
        }
        .header h2 {
            margin: 0;
            font-size: 24px;
            color: #1f2937;
        }
        .back-button {
            display: inline-flex;
            align-items: center;
            padding: 8px 14px;
            background-color: #2e7d32;
            color: #fff;
            text-decoration: none;
            border-radius: 6px;
            font-size: 14px;
        }
        .back-button i {
            margin-right: 6px;
        }
        .back-button:hover {
            background-color: #256628;
        }
        .section-subtitle {
            text-align: center;
            font-size: 16px;
            color: #4d6b4f;
            margin-bottom: 30px;
            display: block;
        }
        .results-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 30px;
            margin-bottom: 40px;
        }
        .result-card {
            background: #fff;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 12px rgba(0,0,0,0.08);
            min-width: 280px;
        }
        .result-card img {
            width: 100%;
            height: 220px;
            object-fit: cover;
        }
        .result-card-content {
            padding: 18px;
            position: relative;
        }
        .result-card-content h4 {
            font-size: 20px;
            font-weight: 600;
            color: #274d27;
            margin-bottom: 10px;
        }
        .result-card-content p {
            font-size: 14px;
            color: #566d57;
            line-height: 1.5;
            margin-bottom: 12px;
        }
        .result-card-content span {
            display: inline-block;
            background: #e2f3e2;
            color: #2e5c30;
            font-size: 13px;
            padding: 5px 10px;
            border-radius: 20px;
            font-weight: 500;
            margin-top: 5px;
        }
        .btn-wrapper {
            display: flex;
            justify-content: flex-end;
            margin-top: 20px;
        }
        .btn {
            padding: 8px 18px;
            background: #2e7d32;
            color: white;
            text-decoration: none;
            font-size: 14px;
            border-radius: 6px;
            transition: background .3s;
        }
        .btn:hover {
            background: #256628;
        }
        .alert-box {
            background-color: #fff3cd;
            border: 1px solid #ffeeba;
            color: #856404;
            padding: 12px;
            border-radius: 6px;
            margin: 20px 0;
            font-weight: bold;
            text-align: center;
        }
    </style>
</head>
<body>

<div class="container">
    {{-- Header --}}
    <div class="header">
        <h2>
            Search Results for "{{ $query ?? 'All' }}"
            @if($region && strtolower($region) !== 'all') in {{ ucfirst($region) }} @endif
        </h2>
        <a href="{{ url('/home') }}" class="back-button"><i class="fas fa-home"></i> Back to Home</a>
    </div>

    {{-- Crops Section --}}
    @if($crops->count())
        <h3 class="section-subtitle">
            Showing crops {{ $region && strtolower($region) !== 'all' ? 'in ' . ucfirst($region) : 'for all regions' }}
        </h3>
        <div class="results-grid">
            @foreach($crops as $crop)
                <div class="result-card">
                    <img src="{{ asset('storage/' . $crop->image) }}" alt="{{ $crop->name }}">
                    <div class="result-card-content">
                        <h4>{{ $crop->name }}</h4>
                        <p>{{ Str::limit($crop->description, 100) }}</p>
                        <span>Best season: {{ ucfirst($crop->best_season) }}</span>
                        <span>Region: {{ ucfirst($crop->region) }}</span>
                        <div class="btn-wrapper">
                            <a href="{{ route('crops.show', $crop->id) }}" class="btn">View Details</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        @if($region && strtolower($region) !== 'all')
            <p>No crops available in {{ ucfirst($region) }}.</p>
        @endif
    @endif

    {{-- Diseases Section --}}
    @if($diseaseMessage)
        <div class="alert-box">
            <i class="fas fa-exclamation-triangle"></i> {{ $diseaseMessage }}
        </div>
    @endif

    @if($diseases->count())
        <h3 class="section-subtitle">
            Showing diseases {{ $region && strtolower($region) !== 'all' ? 'in ' . ucfirst($region) : 'for all regions' }}
        </h3>
        <div class="results-grid">
            @foreach($diseases as $disease)
                <div class="result-card">
                    @if($disease->image)
                        <img src="{{ asset('storage/' . $disease->image) }}" alt="{{ $disease->name }}">
                    @else
                        <img src="{{ asset('images/default-disease.jpg') }}" alt="No image available">
                    @endif
                    <div class="result-card-content">
                        <h4>{{ $disease->name }}</h4>
                        @if($disease->crop)
                            <p><strong>Affected Crop:</strong> {{ $disease->crop->name }}</p>
                        @endif
                        <p><strong>Symptoms:</strong> {{ Str::limit($disease->symptoms, 80) }}</p>
                        <div class="btn-wrapper">
                            <a href="{{ route('diseases.show', $disease->id) }}" class="btn">View Details</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif

    {{-- Unified "No results found" message --}}
    @if(!$crops->count() && !$diseases->count() && !$diseaseMessage)
        <div class="alert-box">
            <i class="fas fa-search"></i> No results found for your search.
        </div>
    @endif
</div>

</body>
</html>
