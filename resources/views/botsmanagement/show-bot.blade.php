@extends('layouts.app')

@section('template_title')
    {{ trans('bot.showHeadTitle') . ' '  }}
@endsection

@section('template_fastload_css')

    .list-group-responsive span:not(.badge) {
        display: block;
        overflow-y: auto;
    }
    .list-group-responsive span.badge {
        margin-left: 7.25em;
    }

    .bot-details-list strong {
        width: 5.5em;
        display: inline-block;
        position: absolute;
    }

    .bot-details-list span {
        margin-left: 5.5em;
    }

@endsection

@php
    $botStatus = [
        'name'  => trans('bot.statusDisabled'),
        'class' => 'danger'
    ];
    if($bot->status == 1) {
        $botStatus = [
            'name'  => trans('bot.statusEnabled'),
            'class' => 'success'
        ];
    }
@endphp

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-10 offset-md-1">
            <div class="card">
                <div class="card-header">
                    {{ trans('bot.showTitle') }}
                    <a href="/bot/" class="btn btn-primary btn-sm pull-right">
                      <i class="fa fa-fw fa-mail-reply" aria-hidden="true"></i>
                      {{ trans('bot.showBackBtn') }}
                    </a>
                </div>
                <div class="card-body">

                    <h1 class="text-center">
                        {{ $bot->name }}
                    </h1>

                    <ul class="list-group list-group-responsive bot-details-list margin-bottom-3">

                        <li class="list-group-item">
                            <strong>{{ trans('bot.showStatus') }}</strong>
                            <span class="badge badge-{{ $botStatus['class'] }}">
                                {{ $botStatus['name'] }}
                            </span>
                        </li>

                        <li class="list-group-item"><strong>Id</strong> <span>{{ $bot->id }}</span></li>

                        @if($bot->link != null)
                            <li class="list-group-item"><strong>{{ trans('bot.showLink') }}</strong> <span> <a href="{{$bot->link}}" target="_blank" data-toggle="tooltip" title="Go to Link">{{$bot->link}}</a></span></li>
                        @endif

                        @if($bot->notes != null)
                            <li class="list-group-item"><strong>{{ trans('bot.showNotes') }}</strong> <span>{{ $bot->notes }}</span></li>
                        @endif

                        <li class="list-group-item"><strong>{{ trans('bot.showAdded') }}</strong> <span>{{ $bot->created_at }}</span></li>
                        <li class="list-group-item"><strong>{{ trans('bot.showUpdated') }}</strong> <span>{{ $bot->updated_at }}</span></li>
                    </ul>



                </div>
                <div class="card-footer">
                    <div class="row pt-2">
                        <div class="col-sm-6 mb-2">
                            <a href="/bot/{{$bot->id}}/edit" class="btn btn-small btn-info btn-block">
                                <i class="fa fa-pencil fa-fw" aria-hidden="true"></i> Edit<span class="hidden-sm"> this</span><span class="hidden-sm"> Theme</span>
                            </a>
                        </div>
                        {!! Form::open(array('url' => 'bot/' . $bot->id, 'class' => 'col-sm-6 mb-2')) !!}
                            {!! Form::hidden('_method', 'DELETE') !!}
                            {!! Form::button('<i class="fa fa-trash-o fa-fw" aria-hidden="true"></i> Delete<span class="hidden-sm"> this</span><span class="hidden-sm"> Theme</span>', array('class' => 'btn btn-danger btn-block btn-flat','type' => 'button', 'data-toggle' => 'modal', 'data-target' => '#confirmDelete', 'data-title' => trans('bot.confirmDeleteHdr'), 'data-message' => trans('bot.confirmDelete'))) !!}
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@include('modals.modal-delete')

@endsection

@section('footer_scripts')

    @include('scripts.delete-modal-script')
    @include('scripts.tooltips')

@endsection
