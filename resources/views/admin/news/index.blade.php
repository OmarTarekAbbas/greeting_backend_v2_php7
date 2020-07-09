@extends('admin.master')
@section('title')
    News
@endsection
@section('PageTitle')
    @if(isset($occasion) && $occasion) {{$occasion->title}} @else News @endif
@endsection
@section('PageDesc')
    You can add and delete News
@endsection
@section('breadcrumb')
    <li class="active">News</li>
@endsection
@section('PageContent')

    <div class="row">
        <div class="right">
            <a href="{{ url('admin/news/create') }}"><button class="btn btn-labeled btn-info"><i class="glyphicon glyphicon-plus"></i></span>Add New</button></a>
        </div>
        <div class="col-xs-12">
            <div class="box">
                <div class="box-body table-responsive no-padding">
                  {{-- <input type="text" id="myInput" class="search_input_occasion" placeholder="Search for names.." title="Type in a name"> --}}
                  <div id="tag_container">
                    <table class="table table-hover table-striped dataTable">
                      <thead>
                      <tr>
                          <th>ID</th>
                          <th>Image</th>
                          <th>News title</th>
                          <th>Occasion</th>
                          <th>Published Date</th>
                          <th>Actions</th>
                      </tr>
                      </thead>
                      <tbody>

                      @foreach($news as $item)
                          <tr>
                              <td>{{ $item->id }}</td>
                              <td>
                                <img src="{{$item->image}}" width="100" height="100" alt="$item->title ">
                              </td>
                              <td>{{ $item->title }}</td>
                              <td>{{ $item->occasion->title }}</td>
                              <td>{{ $item->published_date }}</td>
                              <td>
                                  @if(Auth::user()->admin == true)
                                    {!! Form::open(array('class' => 'form-inline col-lg-1','method' => 'GET', 'action' => array('NewsController@edit', $item))) !!}
                                    <button class="btn btn-info btn-sm" type="submit" data-toggle="tooltip" data-placement="bottom" title="Edit">
                                        <i class="fa fa-edit  "></i>
                                    </button>
                                    {!! Form::close() !!}
                                    @if(get_settings('enable_parent'))
                                    {!! Form::open(array('class' => 'form-inline col-lg-1','method' => 'DELETE', 'action' => array('NewsController@destroy', $item))) !!}
                                    <button class="btn btn-danger btn-sm" type="submit" data-toggle="tooltip" data-placement="bottom" title="Delete" onclick="return confirm('Are you sure you want to delete {{ $item->title }}')">
                                        <i class="fa fa-trash-o "></i>
                                    </button>
                                    {!! Form::close() !!}
                                    @endif
                                  @endif
                              </td>
                          </tr>
                      @endforeach

                      </tbody>
                  </table>
                  </div>
                </div>
            </div>
        </div>
    </div>


    <div class="row">
        <span class="divider"></span>
    </div>


@endsection
@section('script')
<script>
   $('.datatable').DataTable()
</script>
@stop
