<table class="w-full border-collapse">
    <thead>
        <tr class="bg-gray-100 text-left">
            <th class="p-2">Crop</th>
            <th class="p-2">Unit</th>
            <th class="p-2">Min Price</th>
            <th class="p-2">Max Price</th>
            <th class="p-2">Average Price</th>
            <th class="p-2">Date</th>
        </tr>
    </thead>
    <tbody>
        @forelse($prices as $price)
            <tr class="border-b">
                <td class="p-2">{{ $price->crop_name }}</td>
                <td class="p-2">{{ $price->unit }}</td>
                <td class="p-2">{{ number_format($price->min_price, 2) }}</td>
                <td class="p-2">{{ number_format($price->max_price, 2) }}</td>
                <td class="p-2">{{ number_format($price->price, 2) }}</td>
                <td class="p-2">{{ $price->date }}</td>
            </tr>
        @empty
            <tr>
                <td colspan="6" class="p-4 text-center text-gray-500">
                    No prices available.
                </td>
            </tr>
        @endforelse
    </tbody>
</table>

<div class="mt-4">
    {{-- {{ $prices->links() }} --}}
    {{ $prices->appends(request()->except('prices_page'))->links() }}

</div>
