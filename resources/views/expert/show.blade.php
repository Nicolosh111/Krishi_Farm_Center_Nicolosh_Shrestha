@if(session('success'))
    <div id="successAlert" class="max-w-2xl mx-auto mb-6">
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg shadow-md">
            <strong class="font-bold">Success!</strong>
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    </div>
@endif

<div class="max-w-3xl mx-auto p-6 bg-white rounded-lg shadow">
    <!-- Profile Header -->
    <div class="flex items-center gap-6 mb-6">
        @if($expert->expertProfile?->profile_image)
            <img src="{{ asset('storage/' . $expert->expertProfile->profile_image) }}"
                 class="w-32 h-32 rounded-full object-cover shadow">
        @else
            <div class="w-32 h-32 rounded-full bg-gray-200 flex items-center justify-center text-gray-500 text-4xl">
                {{ strtoupper(substr($expert->name, 0, 1)) }}
            </div>
        @endif

        {{-- <div>
            <h1 class="text-2xl font-bold text-green-700">{{ $expert->name }}</h1>
            <p class="text-gray-600">{{ $expert->expertProfile->specialization ?? 'General Agriculture' }}</p>
            <p class="text-gray-500">Qualification: {{ $expert->expertProfile->qualification ?? 'N/A' }}</p>
        </div> --}}
        <div>
    <h1 class="text-2xl font-bold text-green-700 mb-2">{{ $expert->name }}</h1>

    <p class="text-gray-600">
        <span class="font-medium text-gray-700">Specialization:</span>
        {{ $expert->expertProfile->specialization ?? 'General Agriculture' }}
    </p>

    <p class="text-gray-500">
        <span class="font-medium text-gray-700">Qualification:</span>
        {{ $expert->expertProfile->qualification ?? 'N/A' }}
    </p>
</div>
    </div>

    <!-- Profile Details -->
    <div class="space-y-2">
        <p><strong>Experience:</strong>
            {{ $expert->expertProfile->experience_years ? $expert->expertProfile->experience_years . ' years' : 'N/A' }}
        </p>
        <p><strong>Consultation Fee:</strong>
            {{ $expert->expertProfile->consultation_fee ? 'Rs. ' . $expert->expertProfile->consultation_fee : 'N/A' }}
        </p>
        <p><strong>Phone:</strong> {{ $expert->expertProfile->phone ?? 'N/A' }}</p>
        <p><strong>Email:</strong> {{ $expert->email }}</p>
        <p><strong>Bio:</strong></p>
        <p class="text-gray-700 leading-relaxed">
            {{ $expert->expertProfile->bio ?? 'No bio available.' }}
        </p>
    </div>

    <!-- Actions -->
    <div class="mt-6 flex gap-4">
        <!-- Book Consultation -->
        {{-- <form action="{{ route('consult.pay') }}" method="POST" class="inline-block">
            @csrf
            <input type="hidden" name="expert_id" value="{{ $expert->id }}">
            <button type="submit"
                    class="bg-yellow-500 text-white px-6 py-2 rounded hover:bg-yellow-600">
                Book Consultation
            </button>
        </form> --}}

        <a href="{{ route('consultation.book', ['expert' => $expert->id]) }}"
    class="bg-yellow-500 text-white px-6 py-2 rounded hover:bg-yellow-600 inline-block">
    Book Consultation
    </a>

        <!-- Close Modal -->
        <button type="button" id="closeModalInside"
                class="bg-gray-300 text-gray-800 px-6 py-2 rounded hover:bg-gray-400">
            Close
        </button>
    </div>
</div>

<script src="{{asset('js/admin-dash.js')}}"></script>
