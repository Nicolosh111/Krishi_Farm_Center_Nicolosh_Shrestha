{{-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Prediction Result</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center">
    <div class="bg-white shadow-lg rounded-lg p-8 w-full max-w-2xl">
        <h1 class="text-2xl font-bold text-green-700 mb-6">Prediction Result</h1>

        <!-- Uploaded Image -->
        <div class="mb-6">
            <p class="font-semibold text-gray-700 mb-2">Uploaded Image:</p>
            <img src="{{ asset('storage/' . $plantImage->file_path) }}"
                 alt="{{ $plantImage->original_name }}"
                 class="rounded-lg border border-gray-300 shadow-sm max-h-64 object-cover">
        </div>

        <!-- Possible Diseases -->
        <div class="mb-6">
            <h2 class="text-xl font-semibold text-black mb-3">Possible Diseases</h2>
            @if($possibleDiseases->isEmpty())
                <p class="text-gray-500 italic">No diseases found for this crop.</p>
            @else
                <ul class="list-disc list-inside space-y-2 text-gray-700">
                    @foreach($possibleDiseases as $disease)
                        <li>
                            <span class="font-semibold">{{ $disease->name }}</span>
                            <span class="text-sm text-gray-500"> — Symptoms: {{ $disease->symptoms }}</span>
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>

        <div class="mb-6">
            <h2 class="text-xl font-semibold text-black mb-3">Expert Diagnoses</h2>

            @if($expertDiagnoses->isEmpty())
                <p class="text-gray-500 italic">No expert has confirmed a diagnosis yet.</p>
            @else
                <ul>
                    @foreach($expertDiagnoses as $diagnosis)
                        <li>
                            Confirmed: {{ $diagnosis->disease->name }}
                            <span class="text-sm text-gray-600">
                                by {{ $diagnosis->expert->name ?? $diagnosis->expert->username ?? 'Unknown Expert' }}
                            </span>
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>

        <!-- Back to Homepage Button -->
        <div class="mt-6 text-center">
            <a href="{{ route('home') }}"
               class="inline-block bg-green-600 text-white px-4 py-2 rounded-md hover:bg-green-700">
               ← Back to Homepage
            </a>
        </div>
    </div>
</body>
</html> --}}

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Prediction Result</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center">
    <div class="bg-white shadow-lg rounded-lg p-8 w-full max-w-2xl">
        <h1 class="text-2xl font-bold text-green-700 mb-6">Prediction Result</h1>

        <!-- Uploaded Image -->
        <div class="mb-6">
            <p class="font-semibold text-gray-700 mb-2">Uploaded Image:</p>
            <img src="{{ asset('storage/' . $plantImage->file_path) }}"
                 alt="{{ $plantImage->original_name }}"
                 class="rounded-lg border border-gray-300 shadow-sm max-h-64 object-cover">
        </div>

        <!-- Possible Diseases -->
        <div class="mb-6">
            <h2 class="text-xl font-semibold text-black mb-3">Possible Diseases</h2>
            @if($possibleDiseases->isEmpty())
                <p class="text-gray-500 italic">No diseases found for this crop.</p>
            @else
                <ul class="list-disc list-inside space-y-2 text-gray-700">
                    @foreach($possibleDiseases as $disease)
                        <li>
                            <span class="font-semibold">{{ $disease->name }}</span>
                            <span class="text-sm text-gray-500"> — Symptoms: {{ $disease->symptoms }}</span>
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>

        <!-- Expert Diagnoses -->
        <div class="mb-6">
            <h2 class="text-xl font-semibold text-black mb-3">Expert Diagnoses</h2>
            <ul id="expert-diagnoses"></ul>
        </div>

        <!-- Back to Homepage Button -->
        <div class="mt-6 text-center">
            <a href="{{ route('home') }}"
               class="inline-block bg-green-600 text-white px-4 py-2 rounded-md hover:bg-green-700">
               ← Back to Homepage
            </a>
        </div>
    </div>

    <script>
        function refreshExpertDiagnoses(plantImageId) {
            fetch(`/prediction/${plantImageId}/diagnoses`)
                .then(res => res.json())
                .then(data => {
                    const container = document.getElementById('expert-diagnoses');
                    container.innerHTML = '';

                    if (data.length === 0) {
                        container.innerHTML = '<p class="text-gray-500 italic">No expert has confirmed a diagnosis yet.</p>';
                    } else {
                        data.forEach(diagnosis => {
                            container.innerHTML += `
                                <li>
                                    Confirmed: <span class="font-semibold text-green-800">${diagnosis.disease_name}</span>
                                    <span class="text-sm text-gray-600"> by ${diagnosis.expert_name}</span>
                                </li>`;
                        });
                    }
                });
        }

        // Run once on page load
        refreshExpertDiagnoses({{ $plantImage->id }});

        // Poll every 5 seconds
        setInterval(() => refreshExpertDiagnoses({{ $plantImage->id }}), 5000);
    </script>
</body>
</html>
