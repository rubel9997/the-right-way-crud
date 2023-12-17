@extends('layouts.custom-app')

@section('content')
    <div class="row align-items-center justify-content-center">
        <div class="col-md-6">
            <div class="card mt-5 mx-auto bg-light rounded-4" style="width: 35rem;">
                <div class="card-body ">
                    <h5 class="card-title text-center my-4">Offer Create</h5>
                    <form method="POST" action="{{ route('offers.update',$offer->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <!-- Title Input -->
                        <div class="mb-3">
                            <label for="title" class="form-label">Title <span data-bs-toggle="tooltip" data-bs-placement="top" title="Title filed is required" style="color: red;">*</span></label>
                            <input type="text" class="form-control" value="{{old('title',$offer->title)}}" id="title" name="title" placeholder="Title">
                            @error('title')
                            <p class="p-2" style="color: red">{{$message}}</p>
                            @enderror
                        </div>

                        <!-- Price Input -->
                        <div class="mb-3">
                            <label for="price" class="form-label">Price <span data-bs-toggle="tooltip" data-bs-placement="top" title="Price filed is required" style="color: red;">*</span></label>
                            <input type="number" class="form-control" value="{{old('price',$offer->price)}}" id="price" name="price" placeholder="Price">
                            @error('price')
                            <p class="p-2" style="color: red">{{$message}}</p>
                            @enderror
                        </div>
                        <!-- Categories Select -->
                        <div class="mb-3">
                            <label for="select-category" class="form-label">Category <span data-bs-toggle="tooltip" data-bs-placement="top" title="Category filed is required" style="color: red;">*</span></label>
                            <select class="form-select" id="select-category" multiple name="categories[]" >
                                <option value="">Select categories......</option>
                                @foreach($categories as $category)
                                    <option {{ in_array($category->id,old('categories',$offer->categories->pluck('id')->toArray())) ? 'selected':''  }} value="{{$category->id}}">{{$category->title}}</option>
                                @endforeach
                            </select>
                            @error('categories')
                            <p class="p-2" style="color: red">{{$message}}</p>
                            @enderror
                        </div>

                        <!-- Location Select -->
                        <div class="mb-3">
                            <label for="select-location" class="form-label">Location <span data-bs-toggle="tooltip" data-bs-placement="top" title="Location filed is required" style="color: red;">*</span></label>
                            <select class="form-select" id="select-location" multiple name="locations[]" >
                                <option value="">Select locations......</option>
                                @foreach($locations as $location)
                                    <option {{ in_array($location->id,old('locations',$offer->locations->pluck('id')->toArray())) ? 'selected':''  }} value="{{$location->id}}">{{$location->title}}</option>
                                @endforeach
                            </select>
                            @error('locations')
                            <p class="p-2" style="color: red">{{$message}}</p>
                            @enderror
                        </div>

                        <!-- Image Input -->
                        <div class="mb-3 image-preview">
                            <label for="image" class="form-label">Image:</label>
                            <div class="">
                                <img class="px-5 py-2 object-fit-cover rounded-4" width="100%" src="{{ asset($offer->image_url) }}" alt="placeholder">
                            </div>
                            <input type="file"  class="form-control image-upload-input" id="image" name="image" accept="image/*">
                            @error('image')
                            <p class="p-2" style="color: red">{{$message}}</p>
                            @enderror
                        </div>

                        <!-- Description Input -->
                        <div class="mb-3">
                            <label for="description" class="form-label">Description <span data-bs-toggle="tooltip" data-bs-placement="top" title="Description filed is required" style="color: red;">*</span></label>
                            <textarea class="form-control"  id="description" name="description" rows="4" placeholder="Description">{{old('description',$offer->description)}}</textarea>
                            @error('description')
                            <p class="p-2" style="color: red">{{$message}}</p>
                            @enderror
                        </div>



                        <!-- Submit Button -->
                        <div class="mb-3 d-flex justify-content-between">
                            <a href="{{ auth()->user()->isAdmin() ? route('offers.index') : route('offers.my') }}"> <button type="button" class="btn btn-warning">Cancel</button></a>
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    @include('layouts.scripts.image-upload-preview-script')

    <script>
        $(document).ready(function() {
            new TomSelect("#select-category",{
                plugins: ['remove_button'],
                maxItems: 5,
                onItemAdd:function(){
                    this.setTextboxValue('');
                },
            });

            new TomSelect("#select-location",{
                plugins: ['remove_button'],
                maxItems: 5,
                onItemAdd:function(){
                    this.setTextboxValue('');
                },
            });
        });
    </script>
@endsection
