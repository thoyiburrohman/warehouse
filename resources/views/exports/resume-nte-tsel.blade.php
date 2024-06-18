<div class="table-responsive">
    <table class="table table-hover" id="datatable">
        <thead>
            <tr>
                <th>Type</th>
                <th>Stock</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($assetNte as $item)
                @if (totalAssetNte($item->id) != 0)
                    <tr class="single-item">
                        <td class="text-uppercase">
                            {{ $item->name }}
                        </td>
                        <td class="text-uppercase">{{ totalAssetNteTsel($item->id) }}</td>
                    </tr>
                @endif
            @endforeach
        </tbody>
    </table>
</div>
