<div class="row match-height">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title" id="basic-layout-form">Role Edit</h4>
                <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                <div class="heading-elements">
                    <ul class="list-inline mb-0">
                        <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                        <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                        <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                        {{--<li><a data-action="close"><i class="ft-x"></i></a></li>--}}
                    </ul>
                </div>
            </div>
            <div class="card-content collapse show">
                <div class="card-body">
                    {!! Form::open(['url' => [ '/user/role', $role->id], 'method' => 'put', 'files' => true]) !!}
                    <div class="form-body">
                        <h4 class="form-section"><i class="ft-user"></i> User Role Edit Form</h4>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name" class="form-label">Role Name</label>
                                    <input name="name" type="text" id="name" value="{{ $role->name }}" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}"
                                           placeholder="eg. ROLE_ADMIN" required>
                                    @if ($errors->has('name'))
                                        <span class="invalid-feedback">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
                                </div>

                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="description" class="form-label">Description</label>
                                    <input name="description" type="text" value="{{ $role->description }}" id="description" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="permissions" class="form-label">Select permissions</label>
                                    {{ Form::select("permissions", $permissions, $role->permissions, ["class"=>"form-control select2", "id"=>"permissions",
                                     'multiple' => 'multiple', 'name'=>'permissions[]', 'required'=>true]) }}
                                    @if ($errors->has('permissions'))
                                        <span class="invalid-feedback">
                                            <strong>{{ $errors->first('permissions') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="form-actions">
                            <button type="submit" class="btn btn-primary">
                                <i class="la la-check-square-o"></i> Update
                            </button>
                            <a class="btn btn-warning mr-1" role="button" href="{{url('/user/role')}}">
                                <i class="ft-x"></i> Cancel
                            </a>
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>

            </div>
        </div>
    </div>
</div>
