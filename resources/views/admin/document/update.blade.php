<div class="modal-header">
    <h4 class="modal-title" id="myLargeModalLabel">{{$sub_title}}</h4>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<form id="formSubmit" onsubmit="formSubmit(this);return false;">
    @csrf
    <input type="hidden" name="id" value="{{ $uinfo->id }}">
<div class=" modal-body">
    <div class="container-fluid"> 
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body"> 
                        <div class="row">
                            <div class="mb-3 col-lg-6">
                                <label for="validationCustom01" class="form-label">Document Name</label>
                                <input type="text" class="form-control" id="validationCustom01"
                                    placeholder="Document Name" name="doc_name"  value="{{ $uinfo->doc_name }}"/> 
                                  </div>
                                    <div class="mb-3 col-lg-6">
                                        <label for="validationCustom02" class="form-label">Document Category</label>
                                        <select class="form-select" name="documentCategory">
                                            <option value="">--Choose--</option>
                                            @foreach ($document_category as $documentCategory)
                                            <option @if($documentCategory->id == $uinfo->category_id){{ 'selected' }} @endif value="{{ $documentCategory->id }}">{{ $documentCategory->title}}</option>
                                            @endforeach
                                          
                                        </select>
                                    </div>
                                        <div class="mb-3 col-lg-6">
                                            <label for="validationCustom02" class="form-label">Status</label>
                                            <select class="form-select" name="status">
                                                <option value="1" @if($uinfo->status == 1) selected @endif>Active</option>
                                                <option value="0" @if($uinfo->status == 0) selected @endif>In-Active</option> 
                                            </select>
                                        </div>
                                        <div class="mb-3 col-lg-6">
                                        <label for="validationCustom02" class="form-label">Document</label>
                                            <input type="hidden" name="cif_documents_attached_path" value="upload/documents_attached">   
                                            <input type="hidden" name="cif_documents_attached_name" value="cif_documents_attached"> 
                                            <input type="file" class="custom-file form-control" name="cif_documents_attached" onchange="upload_cif_document($(form),'{{ route('admin.document.upload') }}','cif_documents_attached','cif_documents_attached')">
                                            <input  type="hidden" id="cif_documents_attached" name="file" value="{{ $uinfo->file }}">
                                        </div>
                        </div>
                      
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
        <button class="btn btn-primary" type="submit">Update<i
            class="st_loader fa-btn-loader fa fa-refresh fa-spin fa-1x fa-fw"
            style="display:none;"></i></button>
    </div>
</form>
<script src="{{asset('assets/js/pages/form-pickers.init.js')}}"></script>