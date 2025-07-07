<form id="reorderForm" action="{{ route('cart.add') }}" method="POST">
    @csrf
</form>
<script>
    document.getElementById('reorderForm').submit();
</script>