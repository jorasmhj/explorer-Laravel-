<div class="info">
  @if (Session::has('info'))
    <div class="alert alert-warning" role="alert">
      {{ Session::get('info') }}
    </div>
    
    <script>
        //$('.alert').addClass('slideup');
      var info = "{{ Session::get('info') }}";
      var type ="{{ Session::get('type') }}";
      var title ="{{ Session::get('title') }}"; 
      swal(title, info, type);
    </script>
  @endif
  @if(count($errors))
    @foreach($errors->all() as $error)
      {{ $error }}
    @endforeach
  @endif
</div>
