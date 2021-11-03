<x-layout>
    <div class="row">
        <div class="col-md-1"></div>
        <div class="col-md-10">
            <h2 class="headingTitle">Hi {{ Auth::user()->name}}, Welcome to CRUD application</h2>
            <p>Your world of magic.</p>
        </div>
        <div class="col-md-1"></div>
    </div>
</x-layout>