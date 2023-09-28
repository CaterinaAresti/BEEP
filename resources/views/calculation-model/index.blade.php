@extends('layouts.app')

@section('page-title') {{ __('crud.management', ['item'=>__('beep.CalculationModel')]) }}
@endsection

@section('content')
    @component('components/box')
        @slot('title')
            {{ __('crud.overview', ['item'=>__('beep.CalculationModel')]) }}
        @endslot

        @slot('action')
            @permission('role-create')
                <a href="{{ route('calculation-model.create') }}" class="btn btn-primary">
                    <i class="fa fa-plus" aria-hidden="true"></i> {{ __('crud.add', ['item'=>__('beep.CalculationModel')]) }}
                </a>
            @endpermission
        @endslot

        @slot('bodyClass')
        @endslot

        @slot('body')

        <script type="text/javascript">
            $(document).ready(function() {
                $("#table-calculation-model").DataTable(
                    {
                    "language": 
                        @php
                            echo File::get(public_path('js/datatables/i18n/'.LaravelLocalization::getCurrentLocaleName().'.lang'));
                        @endphp
                    ,
                    "order": 
                    [
                        [ 1, "asc" ]
                    ],
                });
            });
        </script>


        <table id="table-calculation-model" class="table table-responsive table-striped">
            <thead>
                <tr>
                    <th>#</th><th>Name</th><th>Measurement Id</th><th>Data Measurement Id</th><th>Data Interval</th><th>Data Relative Interval</th><th>Data Interval Index</th><th>Data Api Url</th><th>Data Api Http Request</th><th>Actions</th>
                </tr>
            </thead>
            <tbody>
            @foreach($calculationmodel as $item)
                <tr>
                    <td>{{ $loop->iteration or $item->id }}</td>
                    <td>{{ $item->name }}</td><td>{{ $item->measurement_id }}</td><td>{{ $item->data_measurement_id }}</td><td>{{ $item->data_interval }}</td><td>{{ $item->data_relative_interval }}</td><td>{{ $item->data_interval_index }}</td><td>{{ $item->data_api_url }}</td><td>{{ $item->data_api_http_request }}</td>
                    <td col-sm-1>
                        <a href="{{ route('calculation-model.show', $item->id) }}" title="{{ __('crud.show') }}"><button class="btn btn-default"><i class="fa fa-eye" aria-hidden="true"></i></button></a>

                        <a href="{{ route('calculation-model.edit', $item->id) }}" title="{{ __('crud.edit') }}"><button class="btn btn-primary"><i class="fa fa-pencil" aria-hidden="true"></i></button></a>

                        <form method="POST" action="{{ route('calculation-model.destroy', $item->id) }}" accept-charset="UTF-8" style="display:inline">
                            {{ method_field('DELETE') }}
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-danger pull-right" title="Delete" onclick="return confirm('{{ __('crud.sure',['item'=>'CalculationModel','name'=>'']) }}')">
                                <i class="fa fa-trash-o" aria-hidden="true"></i>
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

        <div class="pagination-wrapper"> {!! $calculationmodel->render() !!} </div>

        @endslot
    @endcomponent
@endsection
