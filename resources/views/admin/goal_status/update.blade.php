<div class="modal-header">
    <h4 class="modal-title" id="myLargeModalLabel">{{ $sub_title }}</h4>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<form id="formSubmit" onsubmit="formSubmit(this);return false;">
    @csrf
    <div class="modal-body">
        <div class="container-fluid">
            <input type="hidden" name="id" value="{{ $goalstatus->id }}">
            <div class="row">
                <div class="col-lg-12">
                    {{-- <div class="card"> --}}
                        {{-- <div class="card-body px-sm-3 px-0"> --}}
                            <div class="row">
                                <div class="mb-3 col-lg-6">
                                    <label for="validationCustom01" class="form-label">Title</label>
                                    <input type="text" class="form-control" id="validationCustom01"
                                        placeholder="Title" name="title" value="{{ $goalstatus->title }}" />
                                </div>
                                <div class="mb-3 col-lg-6">
                                    <label for="validationCustom02" class="form-label">Status</label>
                                    <select class="form-select" name="status">
                                        <option value="1" @if ($goalstatus->status == 1) selected @endif>Active
                                        </option>
                                        <option value="0" @if ($goalstatus->status == 0) selected @endif>
                                            In-Active</option>
                                    </select>
                                </div>
                                <div class="mb-3 col-lg-6">
                                    <label class="form-label ">Background Color<sup class="text-danger">*</sup></label>
                                    <div class="d-flex align-item-center ">
                                        <input type="color" id="colorpicker" name="background_color"
                                            pattern="^#+([a-fA-F0-9]{6}|[a-fA-F0-9]{3})$" class="mx-2" value="{{ $goalstatus->background_color }}">
                                        <input type="text" pattern="^#+([a-fA-F0-9]{6}|[a-fA-F0-9]{3})$"
                                            name="background_color" id="hexcolor"
                                            value="{{ $goalstatus->background_color }}">
                                    </div>
                                </div>
                                <div class="mb-3 col-lg-6">
                                    <label class="form-label ">Lable Color<sup class="text-danger">*</sup></label>
                                    <div class="d-flex align-item-center ">
                                        <input type="color" id="colorpicker2" name="label_color"
                                            pattern="^#+([a-fA-F0-9]{6}|[a-fA-F0-9]{3})$" class="mx-2" value="{{ $goalstatus->label_color }}">
                                        <input type="text" pattern="^#+([a-fA-F0-9]{6}|[a-fA-F0-9]{3})$"
                                            name="label_color" id="hexcolor2" value="{{ $goalstatus->label_color }}">
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

<script src="{{ asset('assets/js/pages/form-pickers.init.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-colorpicker/3.4.0/js/bootstrap-colorpicker.min.js">
</script>
<script>
    $('#colorpicker').on('input', function() {
        $('#hexcolor').val(this.value);
    });
    $('#hexcolor').on('input', function() {
        $('#colorpicker').val(this.value);
    });

    $('#colorpicker2').on('input', function() {
        $('#hexcolor2').val(this.value);
    });
    $('#hexcolor2').on('input', function() {
        $('#colorpicker2').val(this.value);
    });
</script>
