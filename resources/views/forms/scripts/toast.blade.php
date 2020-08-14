@switch($valida)
	@case(1)
		@section('script')
			<script type="text/javascript">
				// Toast Notification	
				setTimeout(function () {
			        M.toast({ html: "Registro exitoso" });
			    }, 2000);	
			</script>
		@endsection
		@break

	@case(2)
		@section('script')
			<script type="text/javascript">
				// Toast Notification
				setTimeout(function () {
			        M.toast({ html: "Registro actualizado" });
			    }, 2000);	
			</script>
		@endsection
		@break

	@case(3)
		@section('script')
			<script type="text/javascript">
				// Toast Notification
				setTimeout(function () {
			        M.toast({ html: "Registro eliminado" });
			    }, 2000);	
			</script>
		@endsection
		@break
@endswitch



