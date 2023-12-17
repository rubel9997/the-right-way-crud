@extends('layouts.custom-app')

@section('content')
    <div class="row align-items-center justify-content-center">
        <div class="col-md-10">
            <div class="card mt-5 mx-auto bg-light rounded-4">
                <div class="card-body ">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ auth()->user()->isAdmin() ? route('offers.index') : route('offers.my') }}" method="get">
                                <div class="row justify-items-center align-items-center">
                                    <div class="col-md-10 text-center">
                                        <div class="row justify-content-center align-items-center">
                                            <div class="col-md-2">
                                                <select name="status" class="form-select status" id="">
                                                    <option value="" selected>Select status...</option>
                                                    @foreach(\App\Constants\Status::LIST as $status)
                                                        <option
                                                            {{ request()->query('status') === $status ? 'selected' : '' }}
                                                            value="{{ $status }}"
                                                        >{{ $status }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-2">
                                                <select
                                                    class="form-select location"
                                                    name="location"
                                                >
                                                    <option disabled selected>Select location...</option>
                                                    @foreach($locations as $location)
                                                        <option
                                                            {{ request()->query('location') == $location->id ? 'selected' : '' }}
                                                            value="{{ $location->id }}">{{ $location->title }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-2">
                                                <select
                                                    class="form-select category"
                                                    name="category"
                                                >
                                                    <option disabled selected>Select category...</option>
                                                    @foreach($categories as $category)
                                                        <option
                                                            {{ request()->query('category') == $category->id ? 'selected' : '' }}
                                                            value="{{ $category->id }}">{{ $category->title }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-2">
                                                <input type="text" class="form-control mb-2 mr-sm-2" id="title" name="title" placeholder="Search by title">
                                            </div>
                                            <div class="col-md-2 text-center">
                                                <button type="submit" class="btn btn-primary mb-2">Search</button>
                                            </div>
                                            <div class="col-md-2 ">
                                                <a href="{{url()->current()}}"><button type="button" class="btn btn-primary mb-2">Clear Filter</button></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <h5 class="card-title text-center my-4">Offers</h5>
                    <div class="">
                           @if(count($offers) <= 0)
                                <div class="text-center">
                                    <img src="{{asset('images/no-result.png')}}" alt="">
                                    <h3>No data found</h3>
                                </div>
                            @else
                            <table class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    @foreach(['Created By','Title','Price','Categories','Locations','Status'] as $title)
                                        <th>{{$title}}</th>
                                    @endforeach
                                    <th>Action</th>
                                </tr>
                                </thead>
                               <tbody>
                                   @foreach($offers as $offer)
                                      <tr>
                                          <td>
                                              <div class="">
                                                  <img src="{{asset('images/profile_thumbnail.png')}}" class="rounded-full" alt="">
                                                  <sapn>{{$offer->author->name}}</sapn>
                                              </div>

                                          </td>
                                          <td><a href="{{route('offers.show',$offer->id)}}" class="text-decoration-none text-black">{{$offer->title}}</a></td>
                                          <td>{{$offer->price}}</td>
                                          <td>{{getTitles($offer->categories)}}</td>
                                          <td>{{getTitles($offer->locations)}}</td>
                                          <td>
                                              <div>
                                                  @if($offer->status === \App\Constants\Status::DRAFT)
                                                      <span class="text-white bg-dark p-1 rounded-3 align-items-center">{{ $offer->status }}</span>
                                                  @else
                                                      <span class="text-white bg-success p-1 rounded-3 align-items-center">{{ $offer->status }}</span>
                                                  @endif
                                              </div>
                                          </td>
                                          <td>
                                              <div class="d-flex">
                                                  <a href="{{ route('offers.edit', $offer->id) }}" class="btn btn-primary btn-sm">Edit</a>
                                                  <button data-delete-route="{{ route('offers.destroy',$offer->id) }}" class="delete-item-btn btn btn-danger btn-sm ms-2">Delete</button>
                                              </div>
                                          </td>
                                      </tr>
                                   @endforeach
                               </tbody>
                            </table>
                               <div class="py-3 float-end">
                                   {{ $offers->links() }}
                               </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    @include('layouts.scripts.delete-script')

    <script>
        // $(document).ready(function() {
        //     new TomSelect(".category",{});
        //
        //     new TomSelect(".location",{});
        //
        //     new TomSelect(".status",{});
        // });
     </script>
@endsection
