<div class="btn-group btn-group-sm">
    @isset($edit_url)
        <a href="{{ $edit_url }}" class="btn btn-warning link-edit" data-model="{{ $model }}"><i class="bi bi-pencil"></i></a>
    @endisset
    @isset($del_url)
        <button type="button" class="btn btn-danger delete" @if(!$status) disabled @endif data-url="{{ $del_url }}" data-table="{{ $table }}"><i class="bi bi-trash"></i></button>
    @endisset
</div>
