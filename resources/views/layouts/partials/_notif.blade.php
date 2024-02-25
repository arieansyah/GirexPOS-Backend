<div class="toast-container position-fixed top-0 end-0 p-3">
    <div id="liveToast" class="toast align-items-center text-white border-0" role="alert" aria-live="assertive"
        aria-atomic="true">
        <div class="d-flex">
            <div class="toast-body">
            </div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"
                aria-label="Close"></button>
        </div>
    </div>
</div>

@push('scripts')
    <script type="module">
        const el = $("#liveToast");
        @if (session()->has('success'))
            success("{{ session()->get('success') }}")
        @endif

        @if (session()->has('info'))
            el.addClass("bg-info");
            $("#liveToast .toast-body").text("{{ session()->get('info') }}");
            bootstrap.Toast.getOrCreateInstance(el).show()
        @endif

        @if (session()->has('warning'))
            el.addClass("bg-warning");
            $("#liveToast .toast-body").text("{{ session()->get('warning') }}");
            bootstrap.Toast.getOrCreateInstance(el).show()
        @endif

        @if (session()->has('error'))
            el.addClass("bg-danger");
            $("#liveToast .toast-body").text("{{ session()->get('error') }}");
            bootstrap.Toast.getOrCreateInstance(el).show()
        @endif

        @if (!empty($errors->all()))
            el.addClass("bg-danger");

            let errorMessage = "Error Validation";
            @foreach ($errors->all() as $error)
                errorMessage += "<li>{{ $error }}</li>";
            @endforeach

            $("#liveToast .toast-body").html(errorMessage);
            bootstrap.Toast.getOrCreateInstance(el).show()
        @endif

        function success(message) {
            el.addClass("bg-success");
            $("#liveToast .toast-body").text(message);
            bootstrap.Toast.getOrCreateInstance(el).show();
        }
    </script>
@endpush
