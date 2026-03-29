<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
    @forelse($experts as $expert)
        <div class="bg-white shadow rounded p-6 hover:shadow-lg transition relative">
            <!-- Booked Badge -->
            @if(in_array($expert->id, $bookedExpertIds))
               <span class="absolute top-3 right-3 bg-green-100 text-green-700 px-3 py-1 rounded-full text-xs font-medium flex items-center gap-1">
                <i class="fas fa-check text-green-700"></i>
                Booked
            </span>
            @endif

            <!-- Profile Image -->
            @if($expert->expertProfile?->profile_image)
                <img src="{{ asset('storage/' . $expert->expertProfile->profile_image) }}"
                     class="w-24 h-24 rounded-full object-cover mb-4 mx-auto">
            @else
                <div class="w-24 h-24 rounded-full bg-gray-200 flex items-center justify-center text-gray-500 text-2xl mb-4 mx-auto">
                    {{ strtoupper(substr($expert->name, 0, 1)) }}
                </div>
            @endif

            <!-- Info -->
            <h3 class="text-lg font-semibold text-center mb-3">{{ $expert->name }}</h3>
            <div class="space-y-2 text-sm text-gray-700">
                <div class="flex justify-between border-b pb-1">
                    <span class="font-medium text-gray-600">Specialization:</span>
                    <span>{{ $expert->expertProfile->specialization ?? 'N/A' }}</span>
                </div>
                <div class="flex justify-between border-b pb-1">
                    <span class="font-medium text-gray-600">Experience:</span>
                    <span>{{ $expert->expertProfile->experience_years ? $expert->expertProfile->experience_years . ' years' : 'N/A' }}</span>
                </div>
                <div class="flex justify-between border-b pb-1">
                    <span class="font-medium text-gray-600">Qualification:</span>
                    <span>{{ $expert->expertProfile->qualification ?? 'N/A' }}</span>
                </div>
                <div class="flex justify-between pt-2">
                    <span class="font-medium text-gray-600">Consultation Fee:</span>
                    <span class="text-green-700 font-semibold">
                        {{ $expert->expertProfile->consultation_fee ? 'Rs. ' . $expert->expertProfile->consultation_fee : 'Fee N/A' }}
                    </span>
                </div>
            </div>

            <!-- Actions -->
            <div class="mt-4 flex justify-center gap-2">
                <button class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600 view-profile-btn"
                        data-expert="{{ $expert->id }}">
                    View Profile
                </button>
                <a href="{{ route('consultation.book', $expert->id) }}"
                   class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600">
                    Book
                </a>
            </div>
        </div>
    @empty
        <p class="text-gray-500">No experts available at the moment.</p>
    @endforelse
</div>

<div class="mt-6">
    {{ $experts->links() }}
</div>
