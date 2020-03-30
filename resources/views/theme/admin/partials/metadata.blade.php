<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>{!! Meta::get('title') !!} | YES CMS</title>

<link href="{{ asset('template/admin') }}/css/bootstrap.min.css" rel="stylesheet">
<link href="{{ asset('template/admin') }}/font-awesome/css/font-awesome.css" rel="stylesheet">

<!-- Morris -->
<link href="{{ asset('template/admin') }}/css/plugins/morris/morris-0.4.3.min.css" rel="stylesheet">


<link href="{{ asset('template/admin') }}/css/plugins/bootstrap-tagsinput/bootstrap-tagsinput.css" rel="stylesheet">
<link href="{{ asset('template/admin') }}/css/plugins/chosen/bootstrap-chosen.css" rel="stylesheet">

<link href="{{ asset('template/admin') }}/css/plugins/dataTables/datatables.min.css" rel="stylesheet">
<link href="{{ asset('template/admin') }}/css/plugins/switchery/switchery.css" rel="stylesheet">

<link href="{{ asset('template/admin') }}/css/plugins/datapicker/datepicker3.css" rel="stylesheet">

<link href="{{ asset('template/admin') }}/css/plugins/dropzone/basic.css" rel="stylesheet">
<link href="{{ asset('template/admin') }}/css/plugins/dropzone/dropzone.css" rel="stylesheet">

<link href="{{ asset('template/admin') }}/css/plugins/toastr/toastr.min.css" rel="stylesheet">


<link href="{{ asset('template/admin') }}/css/plugins/summernote/summernote-bs4.css" rel="stylesheet">


<link href="{{ asset('template/admin') }}/css/animate.css" rel="stylesheet">
<link href="{{ asset('template/admin') }}/css/style.css" rel="stylesheet">

<link rel="stylesheet" href="{{ asset('template/admin') }}/additional/style/additional.css">

<style type="text/css">
    .mini-navbar .nav-second-level .nav-label {
        display: block !important;
    }
    .nav-second-level i {
        display: none !important; 
    }
    .breadcrumb-item.active {
        font-weight: bold;
    }

    span.required {
        color: #e74c3c
    }

    .form-group > label {
        font-weight: bold;
    }

    .bootstrap-tagsinput {
        width: 100% !important;
    }
</style>
<script type="text/javascript">
    var TOKEN = {'_token' : "{{ csrf_token() }}"};
</script>

@section('style')
@show