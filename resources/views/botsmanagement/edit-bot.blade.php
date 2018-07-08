@extends('layouts.app')

@section('template_title')
    {{ trans('bot.botTitle', ['name' => $bot->name]) }}
@endsection

@section('template_fastload_css')

@endsection

@php
    $botActive = [
        'checked' => '',
        'value' => 0,
        'true'  => '',
        'false' => 'checked'
    ];
    if($bot->status == 1) {
        $botActive = [
            'checked' => 'checked',
            'value' => 1,
            'true'  => 'checked',
            'false' => ''
        ];
    }
@endphp

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-12 col-xl-10 offset-xl-1">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <img class='logo' src="{{asset('/images/facebook_mas_logo.png')}}">
                        <!-- <strong>{{ trans('Edit Bot') }}</strong> {{ $bot->name }}-->
                        </div>

                        <div class="float-right">
                            <a href="{{ url('/bots/') }}" class="btn btn-light btn-sm float-right" data-toggle="tooltip" data-placement="left" title="@lang('Back to bot list')">
                                <i class="fa fa-fw fa-mail-reply" aria-hidden="true"></i>
                                @lang('Back to bot list')
                            </a>
                        </div>
                    </div>

                    {!! Form::model($bot, array('action' => array('BotsManagementController@update', $bot->id), 'method' => 'PUT')) !!}

                        {!! csrf_field() !!}

                    <div class="card-body">

                        <div class="text">
                            <ol>
                                <li>
                                    Click on the option in the left menu and <strong>switch on</strong> Options
                                    for Install
                                    <strong>Facebook Messenger</strong>.
                                    In this page that opens, enter the following
                                    information:
                                    <ul>
                                        <li><strong>Verify Token</strong> - This can be any string and is solely for
                                            your purposes
                                        </li>
                                        <li><strong>Page Access Token</strong> - Enter the token generated in the
                                            Facebook
                                            Developer Console
                                        </li>
                                    </ul>
                                </li>
                                <li>
                                    <p>copy Callback URL and pase to your facebook app</p>
                                </li>
                                <li>
                                    <p>Click the <strong>Start</strong> button.</p>
                                </li>
                            </ol>
                        </div>

                        <div class="form-group has-feedback row {{ $errors->has('link') ? ' has-error ' : '' }}">
                            {!! Form::label('token', trans('Callback URL (click for copy)'), array('class' => 'col-md-3 control-label')); !!}
                            <div class="col-md-9" style="cursor: pointer">
                                <a href="#" id="copy-url">
                                    <div class="input-group">
                                        <input type="text" value="{{$callbackUrl}}" id="verify_token" class="form-control" disabled>
                                        <div class="input-group-append">
                                            <label for="link" class="input-group-text">
                                                <i class="fa fa-fw fa-link fa-rotate-90" aria-hidden="true"></i>
                                            </label>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>

                        <div class="form-group has-feedback row {{ $errors->has('link') ? ' has-error ' : '' }}">
                            {!! Form::label('token', trans('Verify Token'), array('class' => 'col-md-3 control-label')); !!}
                            <div class="col-md-9">
                                <div class="input-group">
                                    {!! Form::text('verify_token', $bot->verify_token, array('id' => 'verify_token', 'class' => 'form-control', 'placeholder' => trans('Verify Token'))) !!}
                                    <div class="input-group-append">
                                        <label for="link" class="input-group-text">
                                            <i class="fa fa-fw fa-pencil" aria-hidden="true"></i>
                                        </label>
                                    </div>
                                </div>
                                @if ($errors->has('token'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('verify_token') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group has-feedback row {{ $errors->has('link') ? ' has-error ' : '' }}">
                            {!! Form::label('token', trans('Page Access Token'), array('class' => 'col-md-3 control-label')); !!}
                            <div class="col-md-9">
                                <div class="input-group">
                                    {!! Form::text('token', $bot->token, array('id' => 'token', 'class' => 'form-control', 'placeholder' => trans('Page Access Token'))) !!}
                                    <div class="input-group-append">
                                        <label for="link" class="input-group-text">
                                            <i class="fa fa-fw fa-pencil" aria-hidden="true"></i>
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

                        <hr>

                        <div class="form-group has-feedback row {{ $errors->has('link') ? ' has-error ' : '' }}">
                            {!! Form::label('greeting_text', trans('Welcome Message'), array('class' => 'col-md-3 control-label')); !!}
                            <div class="col-md-9">
                                <div class="input-group">
                                    {!! Form::text('greeting_text', $bot->greeting_text, array('id' => 'greeting_text', 'class' => 'form-control', 'placeholder' => trans('Welcome Message'))) !!}
                                    <div class="input-group-append">
                                        <label for="link" class="input-group-text">
                                            <i class="fa fa-fw fa-pencil" aria-hidden="true"></i>
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

                    </div>

                        <div class="card-footer">
                            <div class="row">
                                <div class="col-sm-6">
                                    {!! Form::button('<i class="fa fa-fw fa-save" aria-hidden="true"></i> ' . trans('Update'), array('class' => 'btn btn-success btn-block mb-0 btn-save','type' => 'button', 'data-toggle' => 'modal', 'data-target' => '#confirmSave', 'data-title' => Lang::get('modals.edit_user__modal_text_confirm_title'), 'data-message' => Lang::get('modals.edit_user__modal_text_confirm_message'))) !!}
                                </div>
                            </div>
                        </div>

                    {!! Form::close() !!}

                </div>
            </div>
        </div>
    </div>

    @include('modals.modal-save')
    @include('modals.modal-delete')

@endsection

@section('footer_scripts')

    @include('scripts.delete-modal-script')
    @include('scripts.save-modal-script')
    @include('scripts.check-changed')
    @include('scripts.toggleStatus')

@endsection
