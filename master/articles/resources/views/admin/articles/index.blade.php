@extends('theme.admin.layouts.blank')

@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
  <div class="col-sm-4">
    <h2>{!! Meta::get('title') !!}</h2>
    {{ Breadcrumbs::render('articles') }}
  </div>
  <div class="col-sm-8">
    <div class="title-action">
      <a href="{{ route('admin.articles.create') }}" class="btn btn-primary">Add Data</a>
    </div>
  </div>
</div>

<div class="wrapper wrapper-content animated fadeInRight"> 
@include('articles::admin.articles.partials.filter')
@include('articles::admin.articles.partials.table')
</div>
@stop


@section('script')
@parent

<script type="text/javascript">
var oTable;
var page = 1;
$(document).ready(function() {
  oTable = $('#datatable').dataTable({
    pageLength: 10,
    responsive: true,
    dom: 'lTtpi',
    order: [[ 0, "asc" ]],
    columnDefs: [
      { orderable: false, targets: 3 },
    ],
    processing: true,
    serverSide: true,
    ajax: {
      url: "{{ route('admin.articles') }}",
      dataType: "json",
      type: "GET",
      data: function ( d ) {
        oSearch = {};
        $('.filter-field').each( function () {
          key = $(this).attr('name');
          val = $(this).val();
          oSearch[key] = val;
        });
        return $.extend(false, TOKEN, {page : page}, oSearch, d);
      }
    },
    preDrawCallback: function( settings ) {
      var api = this.api();
      page = parseInt(api.rows().page()) + 1;
    },
    columns: [
      {data : 'title'},
      {data : 'abstract'},
      {data : 'status'},
      {data : 'action'},
    ],
  });

  $('.filter-btn').on('click', function(){
    oTable.api().draw();
  });
});

</script>

@stop


