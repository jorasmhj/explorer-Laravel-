@extends('layout.master')
@section('title')
  {{ ucfirst($user->first_name) }}
@endsection
@section('content')
  @include('includes.cover')

<div class="row about grid">
  @if($user->info)
    <div class="col-md-6 grid-item1">
      <div class="panel panel-default">
        <div class="panel-heading panel-heading-gray">
          <a class="btn btn-white btn-xs pull-right edit-info"><i class="fa fa-pencil"></i></a>
          <i class="fa fa-fw fa-info-circle"></i> About
        </div>
        <div class="panel-body">
          <ul class="list-unstyled profile-about margin-none">
            <li class="padding-v-5">
              <div class="row">
                <div class="col-sm-4"><span class="text-muted">Date of Birth</span></div>
                <div class="col-sm-8">{{ $user->info->dob }}</div>
              </div>
            </li>
            <li class="padding-v-5">
              <div class="row">
                <div class="col-sm-4"><span class="text-muted">Gender</span></div>
                <div class="col-sm-8">{{ ucfirst($user->info->gender) }}</div>
              </div>
            </li>
            <li class="padding-v-5">
              <div class="row">
                <div class="col-sm-4"><span class="text-muted">Lives in</span></div>
                <div class="col-sm-8">{{ ucfirst($user->info->location) }}</div>
              </div>
            </li>
          </ul>
        </div>
      </div>
    </div>
  @else
    <div class="col-md-6 grid-item1">
      <div class="panel panel-default">
        <div class="panel-heading panel-heading-gray">
          About
        </div>
        <div class="panel-body">
          No information yet.
          @if( $user->id == Auth::user()->id )
            <div class="pull-right">
              <a class="btn btn-primary btn-xs update-info" >Add <i class="fa fa-plus"></i></a>
            </div>
          @endif
        </div>
      </div>
    </div>
  @endif
  <div class="col-md-6 grid-item1">
    <div class="panel panel-default">
      <div class="panel-heading panel-heading-gray">
        <div class="pull-right">
          <a href="#" class="btn btn-primary btn-xs">Add <i class="fa fa-plus"></i></a>
        </div>
        <i class="icon-user-1"></i> Friends
      </div>
      <div class="panel-body">
        <ul class="img-grid">No Friends Yet.</ul>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" tabindex="-1" role="dialog" id="edit-info">
<div class="modal-dialog" role="document">
  <div class="modal-content">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      <h4 class="modal-title">Edit Info</h4>
    </div>
    <div class="modal-body">
      <ul class="list-unstyled profile-about margin-none"><li class="padding-v-5">
        <li>
          <div class="row">
            <div class="col-sm-4"><span class="text-muted">Date of Birth</span></div>
            <div class="col-sm-8">
              <select class="form-control" id="year">
                <option value="">Year</option>
                @for($n=date('Y'); $n>=1885; $n--)
                  <option value="{{ $n }}">{{ $n }}</option>
                @endfor
              </select>
              <span>/</span>
              <select class="form-control" id="month">
                <option value="">Month</option>
                <option value="01">Jan</option>
                <option value="02">Feb</option>
                <option value="03">Mar</option>
                <option value="04">April</option>
                <option value="05">May</option>
                <option value="06">Jun</option>
                <option value="07">Jul</option>
                <option value="08">Aug</option>
                <option value="09">Sep</option>
                <option value="10">Oct</option>
                <option value="11">Nov</option>
                <option value="12">Dec</option>
              </select>
               <span>/</span>
              <select class="form-control" id="day">
                <option value="">Day</option>
                @for($n=1; $n<=31; $n++)
                  <option value="{{ $n }}">{{ $n }}</option>
                @endfor
              </select>
            </div>
          </div>
        </li>
        <li class="padding-v-5">
          <div class="row">
            <div class="col-sm-4"><span class="text-muted">Gender</span></div>
            <div class="col-sm-8">
              <input type="radio" name="sex" value="male" style="display:inline;margin-top:10px" id="male"> Male
              <input type="radio" name="sex" value="female" style="display:inline" id="female"> Female</div>
          </div>
        </li>
        <li class="padding-v-5">
          <div class="row">
            <div class="col-sm-4"><span class="text-muted">Lives in</span></div>
            <div class="col-sm-8"><input type="text" required="" class="address" value="{{ $user->info ? $user->info->location : '' }}"></div>
          </div>
        </li>
      </ul>
    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      <button type="button" class="btn btn-primary" id="info-save">Save changes</button>
    </div>
  </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
</div><!-- /.modal -->
@endsection
<script type="text/javascript">
  var urladdfriend="{{ route('add.friend') }}";
  var token="{{ Session::token() }}";
  var urlinfo = "{{ route('info.save') }}";
  var urlaccept = "{{ route('accept.friend') }}";
  var urlchangepic = "{{ route('change.profilepic') }}";
</script>
