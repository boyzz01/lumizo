@if (session('error'))
    <div class="alert alert-danger alert-block">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <strong> {{ session('error') }}</strong>
    </div>
@endif


<script>
    window.setTimeout(function() {
        $(".alert").fadeTo(2000, 0).slideUp(1000, function() {
            $(this).remove();
        });
    }, 1000);
</script>
