@if($queries->count())
    @foreach($queries as $query)
        <div class="border-b py-5">
              <!-- Status Badge -->
            <span class="inline-block px-2 py-1 text-xs rounded mb-2
                {{ $query->status === 'answered' ? 'bg-green-100 text-green-700' : 'bg-yellow-100 text-yellow-700' }}">
                {{ ucfirst($query->status) }}
            </span>

            <!-- Question -->
            <p class="font-medium text-gray-900">{{ $query->question }}</p>

            <!-- Asked by -->
            <small class="block text-gray-700 mt-1">
                Asked by <span class="font-semibold">{{ $query->user->name }}</span>
            </small>

            <!-- Crop/Disease -->
            @if($query->crop)
                <small class="block text-gray-500 mt-1">Crop: {{ $query->crop->name }}</small>
            @endif
            @if($query->disease)
                <small class="block text-gray-500 mt-1">Disease: {{ $query->disease->name }}</small>
            @endif

            <!-- Date -->
            <small class="block text-gray-500 mt-1">
                {{ $query->created_at->format('d M Y') }}
            </small>

            <!-- Replies -->
            <div class="mt-3 pl-4 border-l-4 border-green-200">
                @forelse($query->replies as $reply)
                    <p class="text-sm text-gray-700">{{ $reply->reply }}</p>
                    <small class="text-gray-500">
                        By <span class="font-semibold">{{ $reply->expert->name }}</span>
                        • {{ $reply->created_at->format('d M Y') }}
                    </small>
                @empty
                    <p class="text-sm text-gray-500 italic">No replies yet.</p>
                @endforelse
            </div>

            <!-- Reply Form -->
            <form action="{{ route('queries.reply', $query->id) }}" method="POST" class="mt-4">
                @csrf
                <label class="block text-sm font-medium text-gray-700 mb-2">Write your reply:</label>
                <textarea name="reply" rows="3"
                          class="w-full border rounded-lg p-3 mb-3 focus:ring-2 focus:ring-green-400 focus:outline-none"
                          placeholder="Type your helpful answer..."></textarea>
                <button type="submit"
                        class="bg-green-600 text-white px-5 py-2 rounded-lg hover:bg-green-700 transition font-semibold">
                    Submit Reply
                </button>
            </form>
        </div>
    @endforeach
@else
    <p class="text-gray-500">No queries yet.</p>
@endif
