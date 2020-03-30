<!-- Mainly scripts -->
<script src="{{ asset('template/admin') }}/js/jquery-3.1.1.min.js"></script>
<script src="{{ asset('template/admin') }}/js/popper.min.js"></script>
<script src="{{ asset('template/admin') }}/js/bootstrap.js"></script>
<script src="{{ asset('template/admin') }}/js/plugins/metisMenu/jquery.metisMenu.js"></script>
<script src="{{ asset('template/admin') }}/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>


<script src="{{ asset('template/admin') }}/js/plugins/dataTables/datatables.min.js"></script>
<script src="{{ asset('template/admin') }}/js/plugins/dataTables/dataTables.bootstrap4.min.js"></script>

<!-- mustache -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mustache.js/3.0.1/mustache.min.js"></script>

<script src="{{ asset('template/admin') }}/js/plugins/chosen/chosen.jquery.js"></script>

<script src="{{ asset('template/admin') }}/js/plugins/datapicker/bootstrap-datepicker.js"></script>

<script src="{{ asset('template/admin') }}/js/plugins/bootstrap-tagsinput/bootstrap-tagsinput.js"></script>

<script src="{{ asset('template/admin') }}/js/plugins/dropzone/dropzone.js"></script>

<script src="{{ asset('template/admin') }}/additional/sortable/Sortable.min.js"></script>
<script src="{{ asset('template/admin') }}/additional/sortable/jquery-sortable.js"></script>

<script src="{{ asset('template/admin') }}/js/plugins/toastr/toastr.min.js"></script>

<script src="{{ asset('template/admin') }}/js/plugins/summernote/summernote-bs4.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/1000hz-bootstrap-validator/0.11.5/validator.min.js"></script>


<!-- Custom and plugin javascript -->
<script src="{{ asset('template/admin') }}/js/inspinia.js"></script>
<script src="{{ asset('template/admin') }}/js/plugins/pace/pace.min.js"></script>
<script type="text/javascript">
    var toogleMinimalize = (window.localStorage.getItem('minimize') == 'true' ? true : false)  ;
    $(document).ready(function(){
        $('.navbar-minimalize').on('click', function(){
            toogleMinimalize = !Boolean(toogleMinimalize);
            window.localStorage.setItem('minimize', toogleMinimalize);
        });
        if (toogleMinimalize) {
            $('body').addClass('mini-navbar');
        }


        $('.chosen-select').chosen({width: "100%"});

        var mem = $('.datepicker').datepicker({
            todayBtn: "linked",
            keyboardNavigation: false,
            forceParse: false,
            calendarWeeks: true,
            autoclose: true,
            format: "yyyy-mm-dd"
        });

        $('.tagsinput').tagsinput({
            tagClass: 'label label-primary'
        });
    });


    function sendFile(file, editor, uploadUrl) {
      
      data = new FormData();
      data.append("file", file);
      data.append("_token", $('meta[name="csrf-token"]').attr('content'));
      $.ajax({
          data: data,
          type: "POST",
          url: uploadUrl,
          cache: false,
          beforeSend: function() {
            ajax_start();
          },
          dataType: 'json',
          contentType: false,
          processData: false,
          success: function(url) {
            var image = $('<img>').attr('src',url.url);
            editor.summernote("insertNode", image[0]);
          },
          complete: function(){
            ajax_stop();
          }
      });
    }


    ajax_running = false;
    function ajax_start() {
      ajax_running = true;
    }
    function ajax_stop() {
      ajax_running = false;
    }
    function slugify(text)
    {
      return text.toString().toLowerCase()
        .replace(/\s+/g, '-')           // Replace spaces with -
        .replace(/[^\w\-]+/g, '')       // Remove all non-word chars
        .replace(/\-\-+/g, '-')         // Replace multiple - with single -
        .replace(/^-+/, '')             // Trim - from start of text
        .replace(/-+$/, '');            // Trim - from end of text
    }
</script>

@section('script')
@show