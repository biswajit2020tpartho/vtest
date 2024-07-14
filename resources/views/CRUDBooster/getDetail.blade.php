@extends('crudbooster::admin_template')

@section('content')

    <div>
        <p><a title="Return" href="{{ $_GET['return_url'] }}"><i class="fa fa-chevron-circle-left "></i>
            &nbsp; Back To {{ CRUDBooster::getCurrentModule()->name }} Listing</a>
        </p>
        <div class="panel panel-default">
            <div class="panel-heading">
                <strong><i class="fa fa-flag-o"></i> {{ $page_title }}</strong>
            </div>
            <div class="panel-body" style="padding:20px 0px 0px 0px">
                <div class="box-body" id="parent-form-area">
                    <div class="table-responsive">
                        <table id="table-detail" class="table table-striped">
                            <tbody>

                                @foreach($details as $key => $data)
                                    @if(!empty($data['data']))
                                        <tr>
                                            <td>
                                                {{ $data['field_name'] }}
                                            </td>
                                            @if($data['field_name'] == 'Image')
                                                <td>
                                                    <a data-lightbox='roadtrip' href='{{ asset($data["data"]) }}'>
                                                        <img style='max-width:150px' title="Image For Banner Image" src='{{ asset($data["data"]) }}'/>
                                                    </a>
                                                </td>
                                            @else
                                                <td>
                                                    {!! $data['data'] !!}
                                                </td>
                                            @endif
                                        </tr>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- /.box-body -->
                <div class="box-footer" style="background: #F5F5F5">
                    <div class="form-group">
                        <label class="control-label col-sm-2"></label>
                        <div class="col-sm-10">
                        </div>
                    </div>
                </div>
                <!-- /.box-footer-->
            </div>
        </div>
    </div>
@endsection
