@extends('layouts.master')
@section('title', trans('user-management.permission_list_title'))
@section('content')
    <section id="permission-list">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">{{trans('user-management.permission_list_title')}}</h4>
                        <a class="heading-elements-toggle"><i class="la la-ellipsis-h font-medium-3"></i></a>
                        <div class="heading-elements">
                            <a href="{{url('/user/permission/create')}}" class="btn btn-primary btn-sm"><i
                                    class="ft-plus white"></i> {{trans('user-management.permission_create_button')}}</a>
                            <a href="{{url('/user/permission/create')}}" class="btn btn-warning btn-sm"> <i
                                    class="ft-download white"></i></a>
                        </div>
                    </div>
                    <div class="card-content collapse show">
                        <div class="card-body card-dashboard">
                            <table class="table table-striped table-bordered alt-pagination">
                                <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>Name</th>
                                    <th>Model Name</th>
                                    <th>Description</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $index = 1; ?>
                                @foreach($permissions as $permission)
                                    <tr>
                                        <td>{{$loop->index + 1}}</td>
                                        <td>{{$permission->model_name. '::'. $permission->name}}</td>
                                        <td>{{$permission->model_name}}</td>
                                        <td>{{$permission->description}}</td>
                                        <td>
                                            <span class="dropdown">
                                            <button id="btnSearchDrop2" type="button" data-toggle="dropdown" aria-haspopup="true"
                                                    aria-expanded="false" class="btn btn-info btn-sm dropdown-toggle"><i class="la la-cog"></i></button>
                                              <span aria-labelledby="btnSearchDrop2" class="dropdown-menu mt-1 dropdown-menu-right">
                                                  {!! Form::open([
                                                      'method'=>'DELETE',
                                                      'url' => [ '/user/permission', $permission->id],
                                                      'style' => 'display:inline'
                                                      ]) !!}
                                                  {!! Form::button('<i class="ft-trash"></i> Delete ', array(
                                                  'type' => 'submit',
                                                  'class' => 'dropdown-item',
                                                  'title' => 'Delete the permission',
                                                  'onclick'=>'return confirm("Confirm delete?")',
                                                  )) !!}
                                                  {!! Form::close() !!}
                                              </span>
                                            </span>
                                        </td>
                                    </tr>
                                    <?php $index++; ?>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
