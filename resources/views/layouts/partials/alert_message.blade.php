{{-- Session alert message Start --}}
{{-- redirect()->with() will work here too --}}
@if (session('warning'))
    <div style="font-size: 125%" class="alert bg-warning alert-dismissible mb-2" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        {!! session('warning') !!}
    </div>
@endif

@if (session('error'))
    <div style="font-size: 125%" class="alert bg-danger alert-dismissible mb-2" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        {!! session('error') !!}
    </div>
@endif

@if (session('success'))
    <div style="font-size: 125%" class="alert bg-success alert-dismissible mb-2" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        {!! session('success') !!}
    </div>
@endif

@if (session('success-modal'))
    <div style="font-size: 125%" class="alert bg-success alert-dismissible mb-2" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        {!! session('success-modal') !!}

    </div>
    <button hidden type="button" id="sessionModalTrigger" class="btn btn-primary" data-toggle="modal"
            data-target="#sessionModal">
        Launch demo modal
    </button>

    <div class="modal" tabindex="-1" role="dialog" id="sessionModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Modal body text goes here.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $(document).ready(function () {
            $('#sessionModalTrigger').click();
            $('#sessionModal').trigger('sessionModal');
            console.log('worked');
        });
    </script>
@endif

@if (session('message'))
    <div style="font-size: 125% " class="alert bg-info alert-dismissible mb-2" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        {!! session('message') !!}
    </div>
@endif

{{-- Session alert message End --}}

{{-- View with alert message start --}}

@if (!empty($warning))
    <div style="font-size: 125%" class="alert bg-warning alert-dismissible mb-2" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        {!! $warning !!}
    </div>
@endif

@if(!empty($error))
    <div style="font-size: 125%" class="alert bg-danger alert-dismissible mb-2" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        {!! $error !!}
    </div>
@endif

@if(!empty($success))
    <div style="font-size: 125%" class="alert bg-success alert-dismissible mb-2" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        {!! $success !!}
    </div>
@endif

@if (!empty($message))
    <div style="font-size: 125%" class="alert bg-info alert-dismissible mb-2" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        {!! $message !!}
    </div>
@endif
<div id="form-messages" class="alert success" role="alert" style="display: none;"></div>
{{-- View with alert message end --}}
