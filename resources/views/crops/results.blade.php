<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Crop Recommendations</title>
    <style>
        /* Results Section */
        .crop-results-section {
            padding: 60px 20px;
            background: #ffffff; /* plain white background */
            font-family: 'Poppins', sans-serif;
        }

        /* Heading */
        .crop-results-section .section-title {
            text-align: center;
            font-size: 32px;
            color: #2b5f2e;
            margin-bottom: 10px;
            font-weight: 700;
        }

        .crop-results-section .section-subtitle {
            text-align: center;
            font-size: 16px;
            color: #4d6b4f;
            margin-bottom: 40px;
            display: block;
        }

        /* Back Button */
        .back-btn {
            display: inline-block;
            background-color: #2e7d32;
            color: #fff;
            font-weight: 600;
            padding: 10px 20px;
            border-radius: 6px;
            text-decoration: none;
            box-shadow: 0 2px 6px rgba(0,0,0,0.2);
            transition: background-color 0.2s ease;
            margin-bottom: 20px;
        }
        .back-btn:hover {
            background-color: #256029;
        }

        /* Card Grid */
        .results-card-container {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 30px;
            max-width: 1100px;
            margin: auto;
            padding: 0 10px;
        }

        @media (max-width: 1024px) {
            .results-card-container {
                grid-template-columns: repeat(2, 1fr);
            }
        }
        @media (max-width: 640px) {
            .results-card-container {
                grid-template-columns: 1fr;
            }
        }

        /* Card */
        .crop-card {
            background: #fff;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 12px rgba(0,0,0,0.08);
            min-width: 280px;
        }

        /* Image */
        .crop-card .crop-img {
            width: 100%;
            height: 180px;
            object-fit: cover;
        }

        /* Info */
        .crop-info {
            padding: 18px;
        }
        .crop-info h3 {
            font-size: 20px;
            font-weight: 600;
            color: #274d27;
            margin-bottom: 8px;
        }
        .crop-info p {
            font-size: 14px;
            color: #566d57;
            line-height: 1.5;
            margin-bottom: 6px;
        }
        .crop-info .desc {
            margin-top: 10px;
            font-size: 13px;
            color: #4d6b4f;
        }

        /* No Results */
        .no-results {
            text-align: center;
            font-size: 16px;
            color: #4d6b4f;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <section class="crop-results-section">

        <div style="text-align:left;">
            <a href="{{ route('home') }}#crop-recommendation-section" class="back-btn">Back to Crop Recommendation</a>
        </div>

        <h2 class="section-title">Recommended Crops</h2>
        <span class="section-subtitle">Based on your region, soil type, and season</span>

        <div class="results-card-container">
            @forelse($crops as $crop)
                <div class="crop-card">
                    <!-- Crop Image -->
                    @if($crop->image)
                        <img src="{{ asset('storage/' . $crop->image) }}" alt="{{ $crop->name }}" class="crop-img">
                    @else
                        <img src="{{ asset('images/default-crop.jpg') }}" alt="Default Crop" class="crop-img">
                    @endif

                    <!-- Crop Info -->
                    <div class="crop-info">
                        <h3>{{ $crop->name }}</h3>
                        <p><strong>Region:</strong> {{ $crop->region }}</p>
                        <p><strong>Soil Type:</strong> {{ $crop->soil_type }}</p>
                        <p><strong>Season:</strong> {{ $crop->best_season }}</p>
                        <p class="desc">{{ $crop->description }}</p>
                    </div>
                </div>
            @empty
                <p class="no-results">No crops found for your selection. Try different inputs.</p>
            @endforelse
        </div>
    </section>
</body>
</html>
