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
                @if (totalAssetNteGudang($item->id) != 0)
                    <tr class="single-item">
                        <td class="text-uppercase">
                            {{ $item->name }}
                        </td>
                        <td class="text-uppercase">{{ totalItemAssetNteEbisGudang($item->id, warehouseId()) }}</td>
                    </tr>
                @endif
            @endforeach
        </tbody>
    </table>
</div>
