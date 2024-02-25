<div class="btn-group btn-group-sm">
    @isset($edit)
        <button type="button" id="editButton" class="btn btn-warning" data-id="{{ $edit['id'] }}"
            data-name="{{ $edit['name'] }}" data-description="{{ $edit['description'] }}" data-image="{{ $edit['image'] }}"
            data-status="{{ $edit['status'] }}" data-is_favorite="{{ $edit['is_favorite'] }}"
            data-price="{{ $edit['price'] }}" data-stock="{{ $edit['stock'] }}" data-category_id="{{ $edit['category_id'] }}">
            <i class="bi bi-pencil"></i>
        </button>
    @endisset
    @isset($del_url)
        <button type="button" class="btn btn-danger delete" data-url="{{ $del_url }}"
            data-table="{{ $table }}"><i class="bi bi-trash"></i></button>
    @endisset
</div>
