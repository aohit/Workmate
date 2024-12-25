<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\InputType;
use App\Models\QueForm;
use App\Models\QueFormInput;
use App\Models\QueFormMultipleInput;
use App\Models\QueFormSection;
use App\Models\RatingScale;
use App\Models\TempInputType;
use App\Models\TempMultipleInputOption;
use Carbon\Carbon;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;

class QueFormController extends Controller
{
   
    public function index(): View
    {
        $data['title'] = 'Manage Questionnaires';
        $data['sub_title'] = 'Questionnaires';
        return view('admin.queform.index',$data);
    }

    public function list(Request $request)
    {
        
        if ($request->ajax()) {

            
                $data = QueForm::get(); 

            return DataTables::of($data)
                    ->addIndexColumn()
                    ->addColumn('title', function($row){
                        $title =  $row->title;
                        return $title;
                    })
                    ->addColumn('status', function($row){
                            if($row->status == 1){
                                $status =  '<button type="button"  class="btn-sm btn btn-success  waves-effect waves-light">Active</button>';
                            }else{
                                $status =  '<button type="button" class="btn-sm btn btn-outline-danger waves-effect waves-light">Inactive</button>';
                            }
                             
                            return $status;
                    })
                    ->addColumn('action', function($row){ 
                        $deleteUrl = route('admin.questionnaire-delete');
                        $statusUrl = route('admin.questionnaire-status'); 
                        $replicationUrl = route('admin.questionnaire-duplication'); 
                        $showQuestionnaire = route('admin.questionnaire-show',['id' => encrypt($row->id)]);
                        $editurl = route('admin.questionnaire-edit',['id' => encrypt($row->id)]);
                        
                        $action =  '<button type="button" onclick="deleteRow(this,\''.$row->id.'\',\''.$deleteUrl.'\')" class="btn-sm btn btn-outline-danger waves-effect waves-light">Delete</button>';
                        $show =  '<a href="'.$showQuestionnaire.'" class="btn-sm btn btn-outline-info waves-effect waves-light">Show</a>';
                        $edit =  '<a href="'.$editurl.'" class="btn-sm btn btn-outline-dark waves-effect waves-light">Edit</a>';
                    
                        if($row->status == 1){
                            $status =  '<button type="button" onclick="changeStatus(this,\''.$row->id.'\',\''.$statusUrl.'\',0)" class="btn-sm btn btn-outline-danger waves-effect waves-light">Inactive</button>';
                        } else {
                            $status =  '<button type="button" onclick="changeStatus(this,\''.$row->id.'\',\''.$statusUrl.'\',1)" class="btn-sm btn btn-outline-success waves-effect waves-light">Active</button>';
                        }
                    
                        $replication = '<button type="button" onclick="replica(this,\''.$row->id.'\',\''.$replicationUrl.'\')" class="btn-sm btn btn-outline-secondary waves-effect waves-light mb-0">Copy</button>';
                        
                        // Wrap all actions in a div
                        return '<div class="flexblockclass gap-1">' . $action . ' ' . $show . ' ' . $edit . ' ' . $status . ' ' . $replication . '</div>';
                    })
                    ->rawColumns(['title','status','action'])
                    ->make(true);
        }
    }

    public function status(Request $request)
    {
       
        $data = QueForm::find($request->id); 
        $data->status = $request->status;
        $data->save(); 
        return response()->json([
            'success'=> 1,
            'message'=>"Status changed successfully."
        ]);
     
      
    }

   
    public function create()
    {
        $data['title'] = 'Questionnaires';
        $data['sub_title'] = 'Questionnaires';
        return view('admin.queform.create',$data);
    }

    public function AddInput(Request $request)
    {
        // $types = InputType::get();
        $types = InputType::whereBetween('id', [1, 9])->get();
        $time = $request->time;
        $formHeading = $request->formHeading;
        $formSection = $request->formSection;
        $ratings = RatingScale::with('ratingScaleOption')->get();
        // echo "<pre>"; print_r($rating->toArray()); die;
        return view('admin.queform.addInput', compact('types','time','formSection','formHeading','ratings'));
    }


   
    public function storeInput(Request $request)
    {
        // echo "<pre>"; print_r($request->toArray()); die;
            if($request->id){
              
                request()->validate([
                    'inputlabel' => 'required', 
                    'type' => 'required', 
                    // 'placeholder' => 'required', 
                    ]);
                    $data = TempInputType::find($request->id); 
                        $data->update([
                            'label' => $request->inputlabel,    
                            'type' => $request->type,
                            'placeholder' => $request->placeholder,
                        ]);
                    
               
    
                return response()->json([
                    'success'=> 1,
                    'message'=>"Input updated successfully."
                ]);
               
            }else{
        // echo "<pre>"; print_r($request->all()); die;
                    request()->validate([
                        'inputlabel' => 'required', 
                        'type' => 'required', 
                        // 'placeholder' => 'required',
                        ]);
                        $inputData= InputType::find($request->type);
                        $slug = Str::slug($request->formHeading.' '. $inputData->slug);
                        $slug = $slug.'-'.time();
                        $data = TempInputType::create([
                            'label' => $request->inputlabel,    
                            'input_type_id' => $request->type,
                            'placeholder' => $request->placeholder,
                            'input_name' =>$slug,
                            'rating_id'=>$request->rating,
                        ]);
                        
                        if($request->type == 6 || $request->type == 7 ||$request->type == 8)
                        {
                            if($request->type == 6){
                                $type = 'radio';
                            }elseif($request->type == 7){
                                $type = 'checkbox';
                            }elseif($request->type == 8){
                                $type = 'select';
                            }
                            if(!empty($request->radioName[0]))
                            {
                                $multipleInputs = $request->radioName;
                            }elseif(!empty($request->checkboxName[0])){
                                $multipleInputs = $request->checkboxName;
                            }elseif(!empty($request->options[0])){
                                $multipleInputs = $request->options;
                            }

                            foreach($multipleInputs as $radio)
                            {
                               
                               TempMultipleInputOption::create([
                                    'label'=> $radio,
                                    'type' =>$type,
                                    'temp_input_id'=>$data->id
                                ]);
                            }


                        }

                     
                        $time =$request->time;
                        $tempInputs = TempInputType::with(['inputType','multipleinput','RatingsData','RatingsData.ratingScaleOption'])->find($data->id);


                $htmlData = view('admin.queform.showInput',compact('tempInputs','time'))->render();

        
                    return response()->json([
                        'success'=> 1,
                        'message'=>"Input insert successfully.",
                        'htmlData' => $htmlData,
                        'time'=>$time
                    ]);
            }
       
    }

    public function store(Request $request)
    {
        if($request->formId){
        //  echo "<pre>"; print_r($request->all()); 
         $formData =  QueForm::find($request->formId);
         $formData->title =$request->formheading;
         $formData->save();
        // echo "<pre>"; print_r($request->toArray()); 
           foreach($request->section as $key => $section){
            $formSection =  QueFormSection::where('que_form_id',$request->formId)->where('sec_id',$key)->first();
            $formSection->title = $section;
            $formSection->save();
           
           }
           return response()->json([
            'success'=> 1,
        ]);
     

        }else{
          
            if(!empty($request->section)){
                $inputidDel=[];
                $multipleinputDel =[];
                foreach($request->section as $key => $sections ){
                    
                    if($key == 0){
                      $formID =  QueForm::create([
                            'title'=>$sections
                        ]);
                    }
                  
                    if($key == 1){
                        foreach($sections as $secValueKey => $secValue)
                        {
                                $formSectionID =  QueFormSection::create([
                                    'que_form_id'=>$formID->id,
                                    'sec_id'=>$secValueKey,
                                    'title'=>$secValue[0]
                                ]);
                           
                                
                                foreach($secValue as $secValueDataKey => $secValueData)
                                {
                                   
                                    if($secValueDataKey > 0){
        
                                        $tempInputs = TempInputType::with('inputType')->find($secValueData);
                                        $temMultipleInputs = TempMultipleInputOption::where('temp_input_id', $tempInputs->id)->get();
    
                                      
    
                                        $formInput =  QueFormInput::create([
                                            'que_form_id'=> $formID->id,
                                            'que_form_section_id'=> $formSectionID->id,
                                            'label'=> $tempInputs->label,
                                            'placeholder'=> $tempInputs->placeholder,
                                            'input_type_id'=> $tempInputs->input_type_id,
                                            'input_name'=> $tempInputs->input_name,
                                            'rating_id'=> $tempInputs->rating_id,
                                        ]);
                                        $inputidDel[] =$secValueData;
                                      
                                        if(!empty($temMultipleInputs)){
    
                                            foreach($temMultipleInputs as $key => $multipleInputs){
                                                
                                                QueFormMultipleInput::create([
                                                    'que_form_id'=> $formID->id,
                                                    'label' => $multipleInputs->label,
                                                    'type' => $multipleInputs->type,
                                                    'temp_input_id' => $formInput->id,
                                                ]);
                                                $multipleinputDel[] =  $multipleInputs->id;
                                            }
    
                                        }
    
                                       
                                      
                                    }
                                 
                                }
                                
                            }
                        }
                }
    
                TempMultipleInputOption::whereIn('id',$multipleinputDel)->delete();
                TempInputType::WhereIn('id',$inputidDel)->delete();
    
                return response()->json([
                    'success'=> 1,
                ]);
            
            }else{
                return response()->json([
                    'success'=> 2,
                ]);
            }
        }
        
    }

  
  
    public function destroy(Request $request)
    {
        QueForm::where('id',$request->id)->delete(); 
        QueFormSection::where('que_form_id',$request->id)->delete(); 
        QueFormInput::where('que_form_id',$request->id)->delete();
        QueFormMultipleInput::where('que_form_id',$request->id)->delete();
    }
    
        public function show(Request $request,$id)
    {
        $data['title'] = 'Self-Review';
        $data['sub_title'] = 'Self-Review'; 
        $data['appraisal_id']=$id = decrypt($id); 
        $data['todayDate'] = Carbon::today()->format("Y-m-d");
        $data['user']  =  Auth::guard('admin')->user()->id;
        // $data['questionnaires'] = $queData =  Appraisal::with(['User:id,name','Manager:id,name','QuestionnairesData','QuestionnairesData.InputsData','QuestionnairesData.InputsData.InputType','QuestionnairesData.InputsData.FormMultipleInput','FormQue','FormQue.FormSection','FormQue.FormSection.FormInput','FormQue.FormSection.FormInput.InputType','FormQue.FormSection.FormInput.FormMultipleInput'])->find($id);
        //  $data['questionnaires'] = $queData =  Appraisal::with(['User:id,name','Manager:id,name','FormQue','FormQue.FormSection','FormQue.FormSection.FormInput','FormQue.FormSection.FormInput.RatingsData','FormQue.FormSection.FormInput.RatingsData.ratingScaleOption','FormQue.FormSection.FormInput.InputType','FormQue.FormSection.FormInput.questionnairesData','FormQue.FormSection.FormInput.FormMultipleInput'])->find($id);
        $data['questionnaires']  = $queData =  QueForm::with('FormSection','FormSection.FormInput','FormSection.FormInput.InputType','FormSection.FormInput.FormMultipleInput','FormSection.FormInput.RatingsData')->find($id);
        // echo "<pre>"; print_r($queData->toArray()); die;

        return view('admin.queform.showForm',$data);
    }

    public function duplication(Request $request)
    {
        $questionsData =  QueForm::with('FormSection.FormInput','FormSection.FormInput.FormMultipleInput')->find($request->id);
        if(!empty($questionsData)){
            $formData = QueForm::create([
                'title'=>$questionsData->title,
                'status'=>$questionsData->status,
            ]);

            if(!empty($questionsData->FormSection)){

                foreach($questionsData->FormSection as $formSections){
                    $formsection = QueFormSection::create([
                        'title'=>$formSections->title,
                        'status'=>$formSections->status,
                        'sec_id'=>$formSections->sec_id,
                        'status'=>$formSections->status,
                        'que_form_id'=>$formData->id,
                    ]);

                if(!empty($formSections->FormInput)){
                    foreach($formSections->FormInput as $formInuts){
                        $forminputs = QueFormInput::create([
                            'que_form_id'=>$formData->id,
                            'que_form_section_id'=>$formsection->id,
                            'label'=>$formInuts->label,
                            'placeholder'=>$formInuts->placeholder,
                            'input_type_id'=>$formInuts->input_type_id,
                            'input_name'=>$formInuts->input_name,
                            'rating_id'=>$formInuts->rating_id,
                        ]);
                            if(!empty($formInuts->FormMultipleInput)){

                                foreach($formInuts->FormMultipleInput as $formMultipleInputs){

                                    $formmultipleinput = QueFormMultipleInput::create([
                                        'que_form_id'=>$formData->id,
                                        'label'=>$formMultipleInputs->label,
                                        'type'=>$formMultipleInputs->type,
                                        'temp_input_id'=>$forminputs->id,
                                    ]);
                                }
                            }
                        }
                    }
                }
                return response()->json([
                    'success'=> 1,
                    'message'=>"Copy successfully."
                ]);
            }    
        }
    }

    public function Edit($id){
        $data['title'] = 'Self-Review';
        $data['sub_title'] = 'Self-Review'; 
        $data['appraisal_id'] =$id = decrypt($id); 
        $data['todayDate'] = Carbon::today()->format("Y-m-d");
        $data['questionnaires']  = $queData =  QueForm::with('FormSection.FormInput.InputType','FormSection.FormInput.FormMultipleInput','FormSection.FormInput.RatingsData')->find($id);
        // echo "<pre>"; print_r($queData->toArray()); die;
        return view('admin.queform.edit.editques',$data);
    }

    public function EditInputs(Request $request){
        $types = InputType::whereBetween('id', [1, 9])->get();
        // $types = InputType::get();
        $ratings = RatingScale::with('ratingScaleOption')->get();
        $InputData = QueFormInput::with('FormMultipleInput','RatingsData')->find($request->id);
        // echo "<pre>"; print_r($InputData->toArray()); die;
        return view('admin.queform.edit.editinput', compact('types','ratings','InputData'));
    }

    public function EditInputStore(Request $request){
        // echo "<pre>"; print_r($request->toArray()); die;
        $inputDate =  QueFormInput::find($request->id);
        $inputDate->label = $request->inputlabel;
        $inputDate->input_type_id = $request->type;
        $inputDate->placeholder = $request->placeholder;
        if($request->type != 6){
            $inputDate->rating_id = $request->rating;
            }else{
                $inputDate->rating_id = null;
            }
        $inputDate->save();

        QueFormMultipleInput::where('temp_input_id',$inputDate->id)->delete();
        
        if(!empty($request->radioName[0]) && $request->type == '6'){
            foreach($request->radioName as $formMultipleInputs){

                $formmultipleinput = QueFormMultipleInput::create([
                    'que_form_id'=>$inputDate->que_form_id,
                    'label'=>$formMultipleInputs,
                    'type'=>$request->inputlabel,
                    'temp_input_id'=>$inputDate->id,
                ]);
            }
        }

        if(!empty($request->checkboxName[0]) &&  $request->type == "7"){
            foreach($request->checkboxName as $formMultipleInputs){
               
                $formmultipleinput = QueFormMultipleInput::create([
                    'que_form_id'=>$inputDate->que_form_id,
                    'label'=>$formMultipleInputs,
                    'type'=>$request->inputlabel,
                    'temp_input_id'=>$inputDate->id,
                ]);

            }
        }

        if(!empty($request->options[0]) &&  $request->type == '8'){
            foreach($request->options as $formMultipleInputs){
               
                $formmultipleinput = QueFormMultipleInput::create([
                    'que_form_id'=>$inputDate->que_form_id,
                    'label'=>$formMultipleInputs,
                    'type'=>$request->inputlabel,
                    'temp_input_id'=>$inputDate->id,
                ]);

            }
        }
    
        return response()->json([
            'success'=> 1,
        ]);
    }

    public function DeleteInput(Request $request){
        // echo "<pre>"; print_r($request->all());
        $formInput =  QueFormInput::find($request->id);
        $formInput->delete();
        QueFormMultipleInput::where('temp_input_id',$request->id)->delete();
        return response()->json([
            'success'=> 1,
            'message'=> 'Input deleted successfully',
        ]);
    }

    public function DeleteSection(Request $request){
        $formSection  =  QueFormSection::find($request->id);
        $formSection->delete();
        $formInputs =  QueFormInput::where('que_form_section_id',$request->id)->get();
        foreach($formInputs as $inputData){
            QueFormMultipleInput::where('temp_input_id',$inputData->id)->delete();
        }
        $formInputs->each->delete();
        return response()->json([
            'success'=> 1,
            'message'=> 'Section deleted successfully',
        ]);
    }

    public function AddSections(Request $request){
        if(!empty($request->id)){
            QueFormSection::create([
                'que_form_id'=>$request->id,
                'title'=>$request->categoory,
                'sec_id'=>'sec'.time(),
            ]);
            return response()->json([
                'success'=> 1,
                'message'=> 'Section addedd successfully',
            ]);
        }
       
    }

    public function AddSectionInput(Request $request){
        $types = InputType::get();
        $sectionId = $request->sectionId;
        $formId = $request->formId;
        $ratings = RatingScale::with('ratingScaleOption')->get();
        // echo "<pre>"; print_r($rating->toArray()); die;
        return view('admin.queform.edit.addInput', compact('types','sectionId','formId','ratings'));
    }

    public function AddSectionInputStore(Request $request){

        $inputDate =  QueFormInput::create([
            'label'=>$request->inputlabel,
            'input_type_id'=>$request->type,
            'placeholder'=>$request->placeholder,
            'que_form_section_id'=>$request->sectionId,
            'que_form_id'=>$request->formId,
            'rating_id'=>$request->rating,
        ]);

        if(!empty($request->radioName[0]) && $request->type == '6'){
            foreach($request->radioName as $formMultipleInputs){

                $formmultipleinput = QueFormMultipleInput::create([
                    'que_form_id'=>$inputDate->que_form_id,
                    'label'=>$formMultipleInputs,
                    'type'=>$request->inputlabel,
                    'temp_input_id'=>$inputDate->id,
                ]);
            }
        }

        if(!empty($request->checkboxName[0]) &&  $request->type == "7"){
            foreach($request->checkboxName as $formMultipleInputs){
               
                $formmultipleinput = QueFormMultipleInput::create([
                    'que_form_id'=>$inputDate->que_form_id,
                    'label'=>$formMultipleInputs,
                    'type'=>$request->inputlabel,
                    'temp_input_id'=>$inputDate->id,
                ]);

            }
        }

        if(!empty($request->options[0]) &&  $request->type == '8'){
            foreach($request->options as $formMultipleInputs){
               
                $formmultipleinput = QueFormMultipleInput::create([
                    'que_form_id'=>$inputDate->que_form_id,
                    'label'=>$formMultipleInputs,
                    'type'=>$request->inputlabel,
                    'temp_input_id'=>$inputDate->id,
                ]);

            }
        }

        return response()->json([
            'success'=> 1,
            'message'=> 'Input added successfully',
            'formId'=>$request->formId,
        ]);

    }
    
}
