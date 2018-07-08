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
                    After you copy <strong>Callback URL</strong> go to your facebook app.
                </li>
                <li>Click the <strong>Setup Webhooks</strong> button under the <strong>Webhooks</strong> section and
                    enter
                    the following information:
                    <ul>
                        <li><strong>Callback URL</strong> - This is the URL provided on the Facebook Messenger
                            integration page
                        </li>
                        <li><strong>Verify Token</strong> - This is the token you created</li>
                        <li>Check the <strong>messages</strong> and <strong>messaging_postbacks</strong> options under
                            <strong>Subscription Fields</strong></li>
                    </ul>
                </li>
                <li><p>Click the <strong>Verify and Save</strong> button.</p>
                    <!--
                    <p><img src="https://dialogflow.com/docs/images/integrations/facebook/004-facebook.png" alt=""
                            class="screenshot"></p></li>
                            -->
            </ol>


            <div class="col-12">

                {{ trans('Totel Bot:') }} <strong>{{ count($bots) }}</strong> {{ trans('') }}

                <a href="/bots/create" class="btn btn-success btn-sm pull-right mb-2">
                    <i class="fa fa-fw fa-plus" aria-hidden="true"></i>
                    {{ trans('Add New Bot') }}
                </a>

                <div class="table-responsive bots-table">
                    <table class="table table-striped table-sm data-table">
                        <thead class="thead-dark">
                        <tr>
                            <th>{{ trans('No.') }}</th>
                            <th>{{ trans('Page Page ID') }}</th>
                        <!--<th>{{ trans('Facebook Page Name') }}</th>-->
                            <th>{{ trans('Url Token') }}</th>
                            <th>{{ trans('welcome text') }}</th>
                            <!--<th></th>-->
                            <th></th>
                            <th>{{ trans('Actions') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($bots as $key => $abot)
                            @php
                                if(empty($abot->page_key_id)) $abot->page_key_id = ' - ';
                                if(empty($abot->page_name)) $abot->page_name = ' - ';
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
                                <td>
                                        <span class="label " style="margin-left: 6px">
                                            {{ $abot->page_key_id }}
                                        </span>
                                </td>
                                <td>{{$abot->internal_token}}</td>
                            <!--<td>{{$abot->page_name}}</td>-->
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
                                    <a class="btn btn-sm btn-info btn-block btn_edit"
                                       href="{{ URL::to('bots/' . $abot->id . '/edit') }}" data-toggle="tooltip"
                                       title="{{ trans('Edit') }}"
                                    >
                                        <i class="fa fa-pencil fa-fw" aria-hidden="true"></i>
                                        <span class="sr-only">{{ trans('Edit') }}</span>
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
