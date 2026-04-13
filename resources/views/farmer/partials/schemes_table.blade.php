<table class="w-full border-collapse">
    <thead>
        <tr class="bg-gray-100 text-left">
            <th class="p-2">Title</th>
            <th class="p-2">Description</th>
            <th class="p-2">Link</th>
        </tr>
    </thead>
    <tbody>
        @forelse($schemes as $scheme)
            <tr class="border-b">
                <td class="p-2">{{ $scheme->title }}</td>
                <td class="p-2">{{ $scheme->description }}</td>
                <td class="p-2">
                    <a href="{{ $scheme->link }}" target="_blank"
                        class="bg-green-600 hover:bg-green-700 text-white text-sm font-semibold px-3 py-1 rounded inline-block">
                        View Notice
                    </a>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="3" class="p-4 text-center text-gray-500">
                    No schemes available.
                </td>
            </tr>
        @endforelse
    </tbody>
</table>

<div class="mt-4">
    {{-- {{ $schemes->links() }} --}}
    {{ $schemes->appends(request()->except('schemes_page'))->links() }}
</div>
