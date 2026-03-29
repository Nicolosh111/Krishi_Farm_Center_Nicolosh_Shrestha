{{-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Consultation</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center">

    <!-- Card -->
    <div class="max-w-md w-full bg-white shadow-xl rounded-xl p-8 border border-gray-200">
        <h2 class="text-2xl font-bold mb-6 text-center text-green-700">
            Book Consultation with {{ $expert->name }}
        </h2>

        <form method="POST" action="{{ route('consultation.store', ['expert' => $expert->id]) }}" class="space-y-5">
            @csrf

            <!-- Date -->
            <div>
                <label class="block text-gray-700 font-medium mb-1">Date</label>
                <input type="date" name="date"
                       class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-green-400 focus:outline-none"
                       required>
            </div>

            <!-- Time -->
            <div>
                <label class="block text-gray-700 font-medium mb-1">Time</label>
                <input type="time" name="time"
                       class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-green-400 focus:outline-none"
                       required>
            </div>

            <!-- Notes -->
            <div>
                <label class="block text-gray-700 font-medium mb-1">Notes (optional)</label>
                <textarea name="notes"
                          class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-green-400 focus:outline-none"
                          rows="3"></textarea>
            </div>

            <!-- Submit Button -->
            <button type="submit"
                    class="w-full bg-green-500 text-white font-semibold px-4 py-2 rounded-lg hover:bg-green-600 transition">
                Confirm Booking
            </button>
        </form>
    </div>

</body>
</html> --}}


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Book Consultation</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center">

    <div class="max-w-md w-full bg-white shadow-xl rounded-xl p-8 border border-gray-200">
        <h2 class="text-2xl font-bold mb-6 text-center text-green-700">
            Book Consultation with {{ $expert->name }}
        </h2>

        <!-- Booking Form -->
        <form action="{{ route('payment.initiate', $expert->id) }}" method="POST" class="space-y-5">
            @csrf

            <!-- Date -->
            <div>
                <label class="block text-gray-700 font-medium mb-1">Date</label>
                <input type="date" name="date" required
                       class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-green-400 focus:outline-none">
            </div>

            <!-- Time -->
            <div>
                <label class="block text-gray-700 font-medium mb-1">Time</label>
                <input type="time" name="time" required
                       class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-green-400 focus:outline-none">
            </div>

            <!-- Notes -->
            <div>
                <label class="block text-gray-700 font-medium mb-1">Notes (optional)</label>
                <textarea name="notes"
                          class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-green-400 focus:outline-none"
                          rows="3"></textarea>
            </div>

            <!-- Fee -->
            <input type="hidden" name="fee" value="{{ $expert->expertProfile->consultation_fee ?? 0 }}">

            <!-- Submit -->
            <button type="submit"
                    class="w-full bg-green-500 text-white font-semibold px-4 py-2 rounded-lg hover:bg-green-600 transition">
                Pay & Confirm Booking
            </button>
        </form>
    </div>

</body>
</html>
