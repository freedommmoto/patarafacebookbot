@extends('layouts.app')

@section('template_title')
    Showing bots
@endsection

@section('template_linked_css')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css">
    <style type="text/css" media="screen">
        .bots-table {
            border: 0;
        }

        .bots-table tr td:first-child {
            padding-left: 15px;
        }

        .bots-table tr td:last-child {
            padding-right: 15px;
        }

        .bots-table.table-responsive,
        .bots-table.table-responsive table {
            margin-bottom: 0;
        }

    </style>
@endsection

@section('content')
    <div class="container">
        <div class="row">

            <ol>
                <li>
                    Click on the <strong>Add New Bot</strong> in the left menu for start install bot.
                </li>
                <li>
                    <p>Copy Call back Url and save it in Webhooks your app for start useding bot
                </li>
            </ol>

            <div class="col-12">

                {{ trans('Totel Bot:') }} <strong>{{ count($bots) }}</strong> {{ trans('') }}

                <a href="/bots/create" class="btn btn-outline-secondary btn-sm pull-right mb-2">
                    <i class="fa fa-fw fa-plus" aria-hidden="true"></i>
                    {{ trans('Add New Bot') }}
                </a>

                <div class="table-responsive bots-table">
                    <table class="table table-striped table-sm data-table">
                        <thead class="thead-dark">
                        <tr>
                            {{-- <th>ID</th> --}}
                            <th>{{ trans('No.') }}</th>
                            <th>{{ trans('Page Page ID') }}</th>
                            <th>{{ trans('Bot for Page Name') }}</th>
                            <th>{{ trans('welcome text') }}</th>
                            <th class="hidden-xs hidden-sm hidden-md">{{ trans('botsLink') }}</th>
                            <th>{{ trans('Actions') }}</th>
                            <!--<th></th>-->
                            <th></th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($bots as $key => $abot)
                            @php
                                $themeStatus = [
                                    'name'  => trans('Disabled'),
                                    'class' => 'danger'
                                ];
                                if($abot->status == 1) {
                                    $themeStatus = [
                                        'name'  => trans('Enabled'),
                                        'class' => 'success'
                                    ];
                                }
                            @endphp
                            <tr>
                                <td>{{$key+1}}</td>
                            <!--
                                    <td>
                                        <span class="label label-{{ $themeStatus['class'] }}">
                                            {{ $themeStatus['name'] }}
                                    </span>
                                </td>
-->

                                <td>
                                        <span class="label " style="margin-left: 6px">
                                            {{ $abot->page_key_id }}
                                        </span>
                                </td>
                                <td>{{$abot->page_name}}</td>
                                <td>{{$abot->greeting_text}}</td>

                            <!--
                                    <td>
                                        <a class="btn btn-sm btn-success btn-block" href="{{ URL::to('bots/' . $abot->id) }}" data-toggle="tooltip" title="{{ trans('BtnShow') }}">
                                            <i class="fa fa-eye fa-fw" aria-hidden="true"></i>
                                            <span class="sr-only">{{ trans('BtnShow') }}</span>
                                        </a>
                                    </td>
                                    -->

                                <td>
                                    <a class="btn btn-sm btn-info btn-block"
                                       href="{{ URL::to('bots/' . $abot->id . '/edit') }}" data-toggle="tooltip"
                                       title="{{ trans('BtnEdit') }}">
                                        <i class="fa fa-pencil fa-fw" aria-hidden="true"></i>
                                        <span class="sr-only">{{ trans('BtnEdit') }}</span>
                                    </a>
                                </td>

                                <td>
                                    {!! Form::open(array('url' => 'bots/' . $abot->id, 'class' => '', 'data-toggle' => 'tooltip', 'title' => 'Delete bot')) !!}
                                    {!! Form::hidden('_method', 'DELETE') !!}
                                    {!! Form::button('<i class="fa fa-trash-o fa-fw" aria-hidden="true"></i> <span class="sr-only">Delete bot</span>', array('class' => 'btn btn-danger btn-sm','type' => 'button', 'style' =>'width: 100%;' ,'data-toggle' => 'modal', 'data-target' => '#confirmDelete', 'data-title' => trans('Confirm Delete This Bot'), 'data-message' => trans('Confirm Delete'))) !!}
                                    {!! Form::close() !!}
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>

    @include('modals.modal-delete')

@endsection

@section('footer_scripts')

    @if (count($bots) > 50)
        @include('scripts.datatables')
    @endif
    @include('scripts.delete-modal-script')
    @include('scripts.save-modal-script')
    @include('scripts.tooltips')

@endsection
