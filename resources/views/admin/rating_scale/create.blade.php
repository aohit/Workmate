<div class="modal-header">
    <h4 class="modal-title" id="myLargeModalLabel">{{ $sub_title }}</h4>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<form id="formSubmit" action="{{ route('admin.rating-scales.store')}}" method="post" onsubmit="formSubmit(this);return false;">
    @csrf
    <div class="modal-body">
        <div class="container-fluid">

            <div class="row">
                <div class="col-lg-12">
                    {{-- <div class="card"> --}}
                        {{-- <div class="card-body px-sm-3 px-0"> --}}
                            <table class="table table-sm align-middle table-borderless" id="ratingScale">
                                <thead>
                                    <tr>
                                        <th style="max-width:75px !important;">Rating Scale Label  :</th>
                                        <td colspan="2">
                                            <input type="text" name="ratingScaleLabel" class="form-control"
                                                placeholder="Enter a Rating Scale label...">
                                        </td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th>1</th>
                                        <td><input type="text" name="ratingLabel[]" class="form-control"
                                                placeholder="Enter a label..." oninput="rowValue()"></td>
                                        <td>
                                            <button type="button" class="btn btn-outline p-0"
                                                onclick="deleteRow(this)">
                                                <span class="mdi mdi-delete fs-3"></span>
                                            </button>
                                            <button type="button" class="btn btn-outline p-0" onclick="addRow(this)">
                                                <span class="mdi mdi-plus fs-3"></span>
                                            </button>
                                        </td>
                                    </tr>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>N/A</th>
                                        <td colspan="2">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="include_na"
                                                    value="1" id="include-na" onchange="rowValue()">
                                                <label class="form-check-label" for="include-na">
                                                    Include N/A Option
                                                </label>
                                            </div>
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>

                            <div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="option_view_type"
                                        id="option-view-type1" value="0" checked onchange="rowValue()">
                                    <label class="form-check-label" for="option-view-type1">
                                        Respondents will see numbered options
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="option_view_type"
                                        id="option-view-type2" value="1" onchange="rowValue()">
                                    <label class="form-check-label" for="option-view-type2">
                                        Respondents will see options with star icons
                                    </label>
                                </div>
                                <div class="border m-3 p-2">
                                    <h3 class="text-center text-secondary">Preview</h3>
                                    <div class="row justify-content-center" id="ratingPreview">
                                        <div class="col-auto text-center">
                                            <h5 class="text-wrap"></h5>
                                            <div>
                                                <span class="border rounded-circle rating-circle">1</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        {{-- </div> --}}
                    {{-- </div> --}}
                </div>
            </div>

        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
        <button class="btn btn-primary" type="submit">Save<i
                class="st_loader fa-btn-loader fa fa-refresh fa-spin fa-1x fa-fw" style="display:none;"></i></button>
    </div>
</form>
<script>
    function rowValue() {
        let rowCount = $('#ratingScale').find('tbody tr').length;
        $('#ratingPreview').html('');
        let optionType = $('input[name="option_view_type"]:checked').val();

        for (var i = 0; i < rowCount; i++) {
            let rowNo = i + 1;
            if(optionType == '1'){
                rowNo = '<i class="mdi mdi-star fs-3"></i>';
            } 
            let row = $('#ratingScale').find('tbody tr').eq(i);
            row.find('th').first().text(i + 1);

            $('#ratingPreview').append(
                '<div class="col-sm-2 text-center d-flex flex-column justify-content-between"><h5 class="text-wrap">' +
                row.find('input').val() +
                '</h5><div><span class="mx-auto border rounded-circle rating-circle  text-primary">' + rowNo +
                '</span></div></div>');
        }
        if ($('input[name="include_na"]:checked').length > 0) {
            $('#ratingPreview').append(
                '<div class="col-2 text-center d-flex flex-column justify-content-between"><h5 class="text-wrap">Not applicable</h5><div><span class="mx-auto border rounded-circle rating-circle  text-primary ">N/A</span></div></div>');
        }

    }

    function addRow(e) {
        let row = $(e).parents('tr');

        $(row).after('<tr>' + row.html() + '</tr>');
        rowValue();
    }

    function deleteRow(e) {
        let rowCount = $('#ratingScale').find('tbody tr').length;
        if (rowCount != 1) {
            if (confirm("Are you sure you want to delete this row?")) {
                $(e).parents('tr').remove();
                rowValue();
            }
        } else {
            alert('You can not delete this row.');
        }
    }
</script>

