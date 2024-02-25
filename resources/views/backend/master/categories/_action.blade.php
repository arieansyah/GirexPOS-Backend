<div class="btn-group btn-group-sm">
    @isset($edit)
        <button type="button" id="editButton" class="btn btn-warning" data-id="{{ $edit['id'] }}"
            data-name="{{ $edit['name'] }}" data-description="{{ $edit['description'] }}" data-image="{{ $edit['image'] }}">
            <i class="bi bi-pencil"></i>
        </button>
    @endisset
    @isset($del_url)
        <button type="button" class="btn btn-danger delete" id="deleteButton" data-url="{{ $del_url }}"
            data-table="{{ $table }}"><i class="bi bi-trash"></i></button>
    @endisset
</div>
