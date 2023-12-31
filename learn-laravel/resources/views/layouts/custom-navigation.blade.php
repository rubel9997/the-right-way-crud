<nav class="navbar navbar-expand navbar-dark bg-dark">
    <a class="navbar-brand" href="#">Dashboard</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample02" aria-controls="navbarsExample02" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarsExample02">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="{{route('dashboard')}}">Home</a>
            </li>
            @if(auth()->user()->isAdmin())
                <li class="nav-item">
                    <a class="nav-link" href="{{route('offers.index')}}">Offers</a>
                </li>
            @else
                <li class="nav-item">
                    <a class="nav-link" href="{{route('offers.my')}}">My Offers</a>
                </li>
            @endif
            <li class="nav-item">
                <a class="nav-link" href="{{route('offers.create')}}">Offer Create</a>
            </li>
        </ul>
    </div>
</nav>
