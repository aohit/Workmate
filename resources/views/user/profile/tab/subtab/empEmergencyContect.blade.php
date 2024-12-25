<table id="datatable" class="table table-bordered table-hover">
    <thead>
        <tr>
            <th>Contact Person</th>
            <th>Relationship</th>
            <th>Contact Number</th>
            <th>Action</th>

        </tr>
    </thead>
    <tbody>
        @if (count($employee) > 0)
            @php
                $no = 1;
            @endphp
            @foreach ($employee as $detail)
                <tr>
                    {{-- <td class="py-1"> {{ $no }}</td> --}}
                    <td class="py-1 tabledata{{ $detail->id }} ">{{ $detail->name }}</td>
                    <td class="py-1 tabledataedit{{ $detail->id }} d-none ">
                        <input type="text" class="form-control" id="name{{ $detail->id }}"
                            placeholder="Name" name="name" value="{{ $detail->name }}" />
                    </td>
                    <td class="py-1 tabledata{{ $detail->id }} ">{{ $detail->relation }}</td>
                    <td class="py-1 tabledataedit{{ $detail->id }} d-none ">
                        <select class="form-select" name="emergency_contact_relaton"
                            id="relation{{ $detail->id }}">
                            <option value="">Select Relation </option>
                            @foreach (App\Enums\EmergencyContectPersonEnum::cases() as $key => $value)
                                <option value="{{ $value }}" @selected($detail->relation == $value->value)>
                                    {{ $value }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td class="py-1 tabledata{{ $detail->id }} ">{{ $detail->number }}</td>
                    <td class="py-1 tabledataedit{{ $detail->id }} d-none ">
                        <input type="text" class="form-control" id="contact{{ $detail->id }}"
                            placeholder="Emergency Contact" name="contact_number"
                            value="{{ $detail->number }}" />
                    </td>
                    <td class="py-1 tabledata{{ $detail->id }} ">
                        {{-- <a href="javascript:void(0);" onclick="editrow({{ $detail->id }}); "> <i
                                class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                        <a href="javascript:void(0);" onclick="deleterow({{ $detail->id }}); "> <i
                                class="fa fa-trash" aria-hidden="true"></i></a> --}}
                                <button class="btn btn-primary" onclick="editrow({{ $detail->id }}); ">Edit</button>
                                <button class="btn btn-info" onclick="deleterow({{ $detail->id }}); "> Delete</a>

                    </td>
                    <td class="py-1 tabledataedit{{ $detail->id }} d-none">
                        <button class="btn btn-primary" onclick="saveEditRow({{ $detail->id }});">Update<i
                                class="st_loader loder{{ $detail->id }} fa-btn-loader fa fa-refresh fa-spin fa-1x fa-fw"
                                style="display:none;"></i></button>

                        <button class="btn btn-info" onclick="deleterow({{ $detail->id }}); "> <i
                                class="fa fa-trash" aria-hidden="true"></i></button>
                        <button class="btn btn-danger" onclick="cancelevent({{ $detail->id }}); "> <i
                                class="fa fa-times" aria-hidden="true"></i></button>
                    </td>
                </tr>
                @php
                    $no++;
                @endphp
            @endforeach
        @else
            <tr class="text-center">
                <td colspan="5" style="text-align: center !important;">
                    <b>No data found</b>
                </td>
            <tr>
        @endif

    </tbody>
</table>