<section id="knowledge-hub">
    <h2>Knowledge Hub</h2>
    <p class="subtitle">Browse guides, PDFs, and training videos uploaded by experts</p>

    <!-- Filters -->
    <form method="GET" class="filters">
        <select name="crop_id">
            <option value="">All Crops</option>
            @foreach($crops as $crop)
                <option value="{{ $crop->id }}">{{ $crop->name }}</option>
            @endforeach
        </select>

        <select name="type">
            <option value="">All Types</option>
            <option value="pdf">PDF</option>
            <option value="video">Video</option>
            <option value="link">Link</option>
        </select>

        <button type="submit">Filter</button>
    </form>

            <!-- Resource list -->
        <div class="resource-grid">
            @forelse($resources as $resource)
                <div class="resource-card">
                    <h3>{{ $resource->title }}</h3>
                    <p>Crop: {{ $resource->crop->name ?? 'General' }}</p>

                    @if($resource->type === 'link' && !empty($resource->link))
                        <a href="{{ $resource->link }}" target="_blank" class="btn-action">Open Link</a>
                    @elseif(!empty($resource->file))
                        <a href="{{ asset('storage/' . $resource->file) }}" target="_blank" class="btn-action">Download</a>
                    @else
                        <span class="text-gray-500 italic">No resource available</span>
                    @endif
                </div>
            @empty
                <p class="text-center text-gray-500 italic">No resources found for your filters.</p>
            @endforelse
        </div>

    <!-- Pagination -->
    <div class="pagination">
        {{ $resources->links() }}
    </div>

    <!-- Back Button -->
    <div class="back-btn">
        <a href="{{ route('home') }}">← Back</a>
    </div>
</section>

<!-- Inline CSS -->
<style>
#knowledge-hub {
    background: #fff;
    border-radius: 8px;
    padding: 24px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    margin-top: 20px;
}

#knowledge-hub h2 {
    font-size: 1.8rem;
    color: #166534;
    margin-bottom: 8px;
}

#knowledge-hub .subtitle {
    color: #555;
    margin-bottom: 20px;
}

.filters {
    display: flex;
    gap: 12px;
    margin-bottom: 24px;
}

.filters select, .filters button {
    padding: 8px 12px;
    border-radius: 6px;
    border: 1px solid #ccc;
    font-size: 0.95rem;
}

.filters button {
    background: #16a34a;
    color: #fff;
    border: none;
    cursor: pointer;
    transition: background 0.2s ease;
}

.filters button:hover {
    background: #15803d;
}

.resource-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
    gap: 16px;
}

.resource-card {
    border: 1px solid #e5e7eb;
    border-radius: 8px;
    padding: 16px;
    background: #fafafa;
    transition: box-shadow 0.2s ease;
}

.resource-card:hover {
    box-shadow: 0 4px 12px rgba(0,0,0,0.1);
}

.resource-card h3 {
    font-size: 1.1rem;
    color: #166534;
    margin-bottom: 6px;
}

.resource-card p {
    font-size: 0.9rem;
    color: #666;
    margin-bottom: 10px;
}

/* Styled action buttons (Download / Open Link) */
.btn-action {
    display: inline-block;
    padding: 8px 14px;
    background: #16a34a;
    color: #fff;
    border-radius: 6px;
    text-decoration: none;
    font-weight: 500;
    transition: background 0.2s ease;
}

.btn-action:hover {
    background: #15803d;
}

.pagination {
    margin-top: 20px;
    text-align: center;
}

.back-btn {
    margin-top: 20px;
    text-align: left;
}

.back-btn a {
    display: inline-block;
    padding: 8px 16px;
    background: #e5e7eb;
    color: #333;
    border-radius: 6px;
    text-decoration: none;
    transition: background 0.2s ease;
}

.back-btn a:hover {
    background: #d1d5db;
}
</style>
