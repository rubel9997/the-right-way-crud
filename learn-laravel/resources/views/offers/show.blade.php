@extends('layouts.custom-app')

@section('content')
    <div class="row align-items-center justify-content-center">
        <div class="col-md-6">
            <div class="card mt-5 mx-auto bg-light rounded-4" style="width: 35rem;">
                <div class="card-body ">
                    <h5 class="card-title text-center my-4">Dashboard</h5>
                    <div class="p-4 md:p-8 text-base leading-6 space-y-4 text-gray-700 sm:text-lg sm:leading-7">
                        <div class="flex items-center justify-center p-4">
                            <img width="100%" class=" object-cover rounded-3xl" src="{{ asset($offer->image_url) }}" alt="">
                        </div>
                        <div class="flex flex-col">
                            <label class="leading-loose text-sm font-bold">Title</label>
                            <p>
                                {{ $offer->title }}
                            </p>
                        </div>
                        <div class="flex flex-col">
                            <label class="leading-loose text-sm font-bold">Price</label>
                            <div>
                                {{ $offer->price }}
                            </div>
                        </div>
                        <div class="flex flex-col">
                            <label class="leading-loose text-sm font-bold">Created by</label>
                            <div>
                                {{ $offer->author->name }}
                            </div>
                        </div>
                        <div class="flex flex-col">
                            <label class="leading-loose text-sm font-bold">Category</label>
                            <div>
                                {{ getTitles($offer->categories) }}
                            </div>
                        </div>
                        <div class="flex flex-col">
                            <label class="leading-loose text-sm font-bold">Location</label>
                            <div>
                                {{ getTitles($offer->locations) }}
                            </div>
                        </div>
                        <div class="flex flex-col">
                            <label class="leading-loose text-sm font-bold">Description</label>
                            <div>
                                {{ ($offer->description) }}
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
