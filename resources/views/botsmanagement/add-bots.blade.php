@extends('layouts.app')

@section('template_title')
  {{ trans('Add New Bot') }}
@endsection

@section('template_fastload_css')
@endsection

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-12 col-xl-10 offset-xl-1">
                <div class="card">

                    <div class="card-header">
                        <div class="float-left">
                            {{ trans('Add New Bot') }}
                        </div>
                        <div class="float-right">
                            <a href="{{ url('/bots/') }}" class="btn btn-light btn-sm float-right" data-toggle="tooltip" data-placement="left" title="@lang('back to bots lists')">
                                <i class="fa fa-fw fa-mail-reply" aria-hidden="true"></i>
                                @lang('back to bots lists')
                            </a>
                        </div>
                    </div>


                    {!! Form::open(array('action' => 'BotsManagementController@store', 'method' => 'POST', 'role' => 'form')) !!}

                        {!! csrf_field() !!}

                        <div class="card-body">

                            <!--
                            <div class="form-group has-feedback row {{ $errors->has('status') ? ' has-error ' : '' }}">
                                {!! Form::label('status', trans('status') , array('class' => 'col-md-3 control-label')); !!}
                                <div class="col-md-9">
                                    <label class="switch checked" for="status">
                                        <span class="active"><i class="fa fa-toggle-on fa-2x"></i> {{ trans('Enabled') }}</span>
                                        <span class="inactive"><i class="fa fa-toggle-on fa-2x fa-rotate-180"></i> {{ trans('Disabled') }}</span>
                                        <input type="radio" name="status" value="1" checked>
                                        <input type="radio" name="status" value="0">
                                    </label>

                                    @if ($errors->has('status'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('status') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            -->

                            <div class="form-group has-feedback row {{ $errors->has('name') ? ' has-error ' : '' }}">
                                {!! Form::label('page_name', trans('Facebook Page Name'), array('class' => 'col-md-3 control-label')); !!}
                                <div class="col-md-9">
                                    <div class="input-group">
                                        {!! Form::text('page_name', null, array('id' => 'page_name', 'class' => 'form-control', 'placeholder' => trans('Facebook Page Name'))) !!}
                                        <div class="input-group-append">
                                            <label for="name" class="input-group-text">
                                                <i class="fa fa-fw fa-pencil" aria-hidden="true"></i>
                                            </label>
                                        </div>
                                    </div>
                                    @if ($errors->has('page_name'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('page_name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group has-feedback row {{ $errors->has('link') ? ' has-error ' : '' }}">
                                {!! Form::label('page_key_id', trans('Facebook Page Id'), array('class' => 'col-md-3 control-label')); !!}
                                <div class="col-md-9">
                                    <div class="input-group">
                                        {!! Form::text('page_key_id', null, array('id' => 'page_key_id', 'class' => 'form-control', 'placeholder' => trans('Facebook Page Id'))) !!}
                                        <div class="input-group-append">
                                            <label for="link" class="input-group-text">
                                                <i class="fa fa-fw fa-link fa-rotate-90" aria-hidden="true"></i>
                                            </label>
                                        </div>
                                    </div>
                                    @if ($errors->has('page_key_id'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('page_key_id') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group has-feedback row {{ $errors->has('link') ? ' has-error ' : '' }}">
                                {!! Form::label('token', trans('Facebook Page Token'), array('class' => 'col-md-3 control-label')); !!}
                                <div class="col-md-9">
                                    <div class="input-group">
                                        {!! Form::text('token', null, array('id' => 'token', 'class' => 'form-control', 'placeholder' => trans('Facebook Page Token'))) !!}
                                        <div class="input-group-append">
                                            <label for="link" class="input-group-text">
                                                <i class="fa fa-fw fa-link fa-rotate-90" aria-hidden="true"></i>
                                            </label>
                                        </div>
                                    </div>
                                    @if ($errors->has('token'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('token') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>


                            <div class="form-group has-feedback row {{ $errors->has('link') ? ' has-error ' : '' }}">
                                {!! Form::label('greeting_text', trans('Welcome Message'), array('class' => 'col-md-3 control-label')); !!}
                                <div class="col-md-9">
                                    <div class="input-group">
                                        {!! Form::text('greeting_text', null, array('id' => 'greeting_text', 'class' => 'form-control', 'placeholder' => trans('Welcome Message'))) !!}
                                        <div class="input-group-append">
                                            <label for="link" class="input-group-text">
                                                <i class="fa fa-fw fa-link fa-rotate-90" aria-hidden="true"></i>
                                            </label>
                                        </div>
                                    </div>
                                    @if ($errors->has('greeting_text'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('greeting_text') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <!--
                            <div class="form-group has-feedback row {{ $errors->has('notes') ? ' has-error ' : '' }}">
                                {!! Form::label('notes', trans('bots.notesLabel') , array('class' => 'col-md-3 control-label')); !!}
                                <div class="col-md-9">
                                    <div class="input-group">
                                        {!! Form::textarea('notes', old('notes'), array('id' => 'notes', 'class' => 'form-control', 'placeholder' => trans('bots.notesPlaceholder'))) !!}
                                        <div class="input-group-append">
                                            <label for="notes" class="input-group-text">
                                                <i class="fa fa-fw fa-pencil" aria-hidden="true"></i>
                                            </label>
                                        </div>
                                    </div>
                                    @if ($errors->has('notes'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('notes') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            -->

                        </div>

                        <div class="card-footer">
                            <div class="row">
                                <div class="col-sm-6 offset-sm-6">
                                    {!! Form::button('<i class="fa fa-plus" aria-hidden="true"></i>&nbsp;' . trans('Add New Bot'), array('class' => 'btn btn-success btn-block mb-0','type' => 'submit', )) !!}
                                </div>
                            </div>
                        </div>

                    {!! Form::close() !!}

                </div>
            </div>
        </div>
    </div>

@endsection

@section('footer_scripts')

  @include('scripts.toggleStatus')

@endsection
