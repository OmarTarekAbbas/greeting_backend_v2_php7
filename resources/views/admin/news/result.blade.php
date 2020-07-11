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
{!! $news->appends(Request::all())->render() !!}
