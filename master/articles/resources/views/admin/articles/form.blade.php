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
    <div class="row">
  		<!-- main form -->
  	  <div class="col-lg-6">
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
            	<label>Category</label>
            	<select name="category_id[]" data-placeholder="Choose a Category..." multiple class="chosen-select" tabindex="4">
                @foreach($categories as $category)
                <option {{ (bool)in_array($category->id, $data->category_id) ? 'selected' : '' }}  value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            	</select>
          		
          	</div>
          	<div class="form-group">
            	<label>Status</label> 
            	<div>
            		<input type="hidden" name="status" value="0">
          			<input type="checkbox" class="js-switch" name="status" value="1" {{ (bool)$data->status ?  'checked' : ''}} />
            	</div>
          	</div>
          </div>
  	    </div>
  	  </div>
  	  <!-- end main form -->

  	  <!-- meta form -->
  	  <div class="col-lg-6">
  	    <div class="ibox ">
  	      <div class="ibox-title">
  	        <h5>Metadata</h5>
  	      </div>
  	      <div class="ibox-content">
  	      	<div class="form-group">
            	<label>Meta Title</label> 
          		<input type="text" placeholder="Meta Title" name="meta[title]" value="{{ (bool)count((array)$data->meta) ? $data->meta['title'] : ''}}" class="form-control">
          	</div>
          	<div class="form-group">
            	<label>Meta Tag</label>
            	<div>
          			<input style="width: 100%" type="text" placeholder="Meta Tag" value="{{ (bool)count((array)$data->meta) ? $data->meta['tag'] : ''}}" name="meta[tag]" class="form-control tagsinput">
            	</div>
          	</div>
          	<div class="form-group">
            	<label>Meta Description</label>
            	<textarea class="form-control" rows="5" name="meta[description]">{{ (bool)count((array)$data->meta) ? $data->meta['description'] : ''}}</textarea>
          	</div>
  	      </div>
  	    </div>
  	  </div>
  	  <!-- end meta form -->
  	</div>
    <!-- Main & Meta End -->

    <!-- Image Upload -->
  	<div class="row">
  		<!-- image upload form -->
  		<div class="col-lg-12">
  			<div class="ibox ">
  	      <div class="ibox-title">
  	        <h5>Images</h5>
  	      </div>

  	      <div class="ibox-content">

            <div class="form-group">
              <label>Images</label>
              {!! Upload::setForm('images', 'master.articles', $data->images) !!}
            </div>

            <div class="row">
              <div class="col-lg-6">
      	      	<div class="form-group">
          				<label>Banners Desktop</label>
                    {!! Upload::setForm('banners', 'master.articles', $data->banners) !!}
          			</div>
              </div>

               <div class="col-lg-6">
                <div class="form-group">
                  <label>Banners Mobile</label>
                    {!! Upload::setForm('banners_mobile', 'master.articles', $data->banners_mobile) !!}
                </div>
              </div>
            </div>

  	      </div>
  	    </div>
  		</div>
  		<!-- image upload form end -->
  	</div>
    <!-- Image Upload -->

    <!-- Content -->
    <div class="row">
      <div class="col-lg-12">
        <div class="ibox ">
          <div class="ibox-title">
            <h5>Content</h5>
          </div>

          <div class="ibox-content">
            <div class="form-group">
              <label>Abstract</label>
              <textarea name="abstract" class="textarea form-control">{{ $data->abstract }}</textarea>
            </div>


            <div class="form-group">
              <label>Article</label>
              <textarea name="content" class="textarea form-control">{{ $data->content }}</textarea>
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
      </div>
    </div>
    <!-- Content End -->
  </form>
</div>
@stop


@section('script')
@parent
<script src="{{ asset('template/admin') }}/js/plugins/switchery/switchery.js"></script>

<script type="text/javascript">

  var elem = document.querySelector('.js-switch');
  var switchery = new Switchery(elem, { color: '#1AB394' });



  $('.textarea').summernote({
    tabsize: 2,
    height: 300,
    callbacks: {
      onImageUpload: function(files) {
        sendFile(files[0], $(this), "{{ url(env('ADMIN_URL', 'admin').'/upload/'.'master.articles/'.date('Y/m/d').'/articles/file') }}");
      }
    }
  });

  $(document).ready(function(){
    $('#title').on('keyup', function(){
      var title = $(this).val();
      var slug = slugify(title);
      $('#slug').val(slug);
    });
  });


</script>


@stop