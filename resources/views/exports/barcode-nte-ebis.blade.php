<div class="table-responsive">
    <table class="table table-hover" id="datatable">
        <thead>
            <tr>
                <th>Serial Number</th>
                <th>Type</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($nte as $item)
                <tr class="single-item">
                    <td class="text-uppercase">
                        {{ $item->serial_number }}
                    </td>
                    <td class="text-uppercase">
                        {{ $item->assetNte->name }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
