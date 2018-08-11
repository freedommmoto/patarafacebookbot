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
                            <img class='logo' src="{{asset('/images/facebook_mas_logo.png')}}">
                        <!--{{ trans('Add New Bot') }}-->
                        </div>
                        <div class="float-right">
                            <a href="{{ url('/bots/') }}" class="btn btn-light btn-sm float-right" data-toggle="tooltip"
                               data-placement="left" title="@lang('Cancel')">
                                <i class="fa fa-fw fa-mail-reply" aria-hidden="true"></i>
                                @lang('Cancel')
                            </a>
                        </div>
                    </div>


                    {!! Form::open(array('action' => 'BotsManagementController@store', 'method' => 'POST', 'role' => 'form')) !!}

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
                                        <input type="text" value="{{$callbackUrl}}" class="form-control" disabled>
                                        <input type="text" value="{{$callbackUrl}}" id="verify_token_hide">
                                        <input type="hidden" value="{{$internal_token}}" id="internal_token" name="internal_token">

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
                                    {!! Form::text('verify_token', null, array('id' => 'verify_token', 'class' => 'form-control', 'placeholder' => trans('Verify Token'))) !!}
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
                                    {!! Form::text('token', null, array('id' => 'token', 'class' => 'form-control', 'placeholder' => trans('Page Access Token'))) !!}
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
                                    {!! Form::text('greeting_text', "I am chatbot how can I help you?", array('id' => 'greeting_text', 'class' => 'form-control', 'placeholder' => trans('Welcome Message'))) !!}
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
                            <div class="col-sm-6 offset-sm-6">
                                {!! Form::button('<i class="fa fa-plus" aria-hidden="true"></i>&nbsp;' . trans('START'), array('class' => 'btn btn-success btn-block mb-0','type' => 'submit', )) !!}
                            </div>
                        </div>
                    </div>

                    <template>
                        <div class="hello">
                            <picture-input
                                    ref="pictureInput"
                                    width="600"
                                    height="600"
                                    margin="16"
                                    accept="image/jpeg,image/png"
                                    size="10"
                                    button-class="btn"
                                    :custom-strings="{
                                        upload: '<h1>Bummer!</h1>',
                                        drag: 'Drag a 😺 GIF or GTFO'
                                      }"
                                    @change="onChange">
                            </picture-input>
                        </div>
                    </template>

                    {!! Form::close() !!}

                </div>
            </div>
        </div>
    </div>

@endsection

@section('footer_scripts')

    @include('scripts.toggleStatus')

    <script>
        import PictureInput from 'vue-picture-input'

        export default {
            name: 'app',
            data () {
                return {
                }
            },
            components: {
                PictureInput
            },
            methods: {
                onChange (image) {
                    console.log('New picture selected!')
                    if (image) {
                        console.log('Picture loaded.')
                        this.image = image
                    } else {
                        console.log('FileReader API not supported: use the <form>, Luke!')
                    }
                }
            }
        }
    </script>

@endsection
