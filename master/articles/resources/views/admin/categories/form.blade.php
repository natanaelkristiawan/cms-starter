@extends('theme.admin.layouts.blank')

@section('style')
@parent


@stop

@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
  <div class="col-sm-4">
    <h2>{!! Meta::get('title') !!}</h2>
    @if($method == 'create')
    {{ Breadcrumbs::render('articles.create') }}
    @else
    {{ Breadcrumbs::render('articles.edit') }}
    @endif

  </div>
  <div class="col-sm-8">
    <div class="title-action">
      <a href="{{ route('admin.articles') }}" class="btn btn-primary">Back</a>
    </div>
  </div>
</div>

<div class="wrapper wrapper-content animated fadeInRight"> 
  <form role="form" method="POST" action="" data-toggle="validator" role="form" data-disable="false">
    @csrf
    <!-- Main & Meta -->
    <div class="ibox ">
      <div class="ibox-title">
        <h5>Main</h5>
      </div>

      <div class="ibox-content">
      	<div class="form-group">
        	<label>Title <span class="required">*</span></label> 
      		<input required="" data-error="Please enter title" type="text" value="{{ $data->title }}" placeholder="Title" id="title" name="title" class="form-control">
          <div class="help-block with-errors error"></div>
      	</div>
      	<div class="form-group">
        	<label>Slug <span class="required">*</span></label> 
      		<input required="" data-error="Please enter slug" type="text" value="{{ $data->slug }}" placeholder="Slug" id="slug" name="slug" class="form-control">
          <div class="help-block with-errors error"></div>
      	</div>
        <div class="form-group">
          <label>Order <span class="required">*</span></label> 
          <input required="" type="number" data-error="Please enter order"  placeholder="Order" value="{{ $data->order }}" name="order" class="form-control">
          <div class="help-block with-errors error"></div>
        </div>
      	<div class="form-group">
        	<label>Status</label> 
        	<div>
        		<input type="hidden" name="status" value="0">
      			<input type="checkbox" class="js-switch" name="status" value="1" {{ (bool)$data->status ?  'checked' : ''}} />
        	</div>
      	</div>
        <div class="hr-line-dashed"></div>
          <div class="form-group row">
            <div class="col-sm-4 col-sm-offset-2">
              <button class="btn btn-primary btn-sm" name="submit" value="submit" type="submit">Save</button>
              <button class="btn btn-primary btn-sm" name="submit" value="submit_exit" type="submit">Save & Exit</button>
              <a href="{{ route('admin.articles') }}" class="btn btn-danger btn-sm" >Cancel</a>
            </div>
          </div>
      </div>
    </div>
    <!-- end main form -->	
  </form>
</div>
@stop


@section('script')
@parent
<script src="{{ asset('template/admin') }}/js/plugins/switchery/switchery.js"></script>
<script type="text/javascript">

  var elem = document.querySelector('.js-switch');
  var switchery = new Switchery(elem, { color: '#1AB394' });

  $(document).ready(function(){
    $('#title').on('keyup', function(){
      var title = $(this).val();
      var slug = slugify(title);
      $('#slug').val(slug);
    });
  });


</script>


@stop