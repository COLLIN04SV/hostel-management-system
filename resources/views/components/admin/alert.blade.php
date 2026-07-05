@if(session('success'))

<div id="alert"
     class="mb-6 bg-green-100 border border-green-300 text-green-700 px-5 py-4 rounded-xl flex items-center">

    <i class="bi bi-check-circle-fill me-3 text-xl"></i>

    {{ session('success') }}

</div>

@endif

@if(session('error'))

<div id="alert"
     class="mb-6 bg-red-100 border border-red-300 text-red-700 px-5 py-4 rounded-xl flex items-center">

    <i class="bi bi-exclamation-circle-fill me-3 text-xl"></i>

    {{ session('error') }}

</div>

@endif

<script>
setTimeout(function () {

    let alert = document.getElementById('alert');

    if (alert) {

        alert.style.transition = "0.5s";
        alert.style.opacity = "0";

        setTimeout(() => {

            alert.remove();

        },500);

    }

},3000);
</script>