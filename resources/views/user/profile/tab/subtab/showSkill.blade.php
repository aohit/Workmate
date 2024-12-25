@foreach ($skills as $key => $skill)
@if ($key <= 7)
    <div class="col">
        <div class="border border-success p-2 text-center box ">
            {{ $skill->skills }}
            <span class="delete"><a href="javascript:void(0)" onclick="deleteSkillRow({{$skill->id}});return;false;"><i
                class="fa fa-trash text-dark" aria-hidden="true"></i> </a></span>
        </div>
    </div>
@endif          
@endforeach