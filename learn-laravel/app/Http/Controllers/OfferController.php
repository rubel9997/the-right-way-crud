<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreOfferRequest;
use App\Models\Category;
use App\Models\Location;
use App\Models\Offer;
use App\Services\OfferService;
use Illuminate\Http\Request;

class OfferController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, OfferService $offerService)
    {
        $this->authorize('viewAny',Offer::class);

        //$query = Offer::with(['author','categories','locations']);

//        if($request->query('status')){
//           $query = $query->where('status',$request->query('status'));
//        }
//
//        if($request->query('category')){
//            $query = $query->whereHas('categories',function ($q) use($request){
//                $q->where('id',$request->query('category'));
//            });
//        }
//
//        if($request->query('location')){
//            $query = $query->whereHas('locations',function ($q) use($request){
//                $q->where('id',$request->query('location'));
//            });
//        }
//
//        if ($request->query('title')) {
//            $query = $query->where('title', 'LIKE', '%' . $request->query('title') . '%');
//        }

        //$offers = $query->paginate(5);

        $offers = $offerService->get($request->query());

        $categories = Category::orderBy('title')->get();
        $locations = Location::orderBy('title')->get();

        return view('offers.index',['offers'=>$offers,'categories'=>$categories,'locations'=>$locations]);
    }

    public function myOffers(Request $request, OfferService $offerService)
    {
        $this->authorize('viewMy',Offer::class);

        $offers = $offerService->getMine($request->query());

        $categories = Category::orderBy('title')->get();
        $locations = Location::orderBy('title')->get();

        return view('offers.index',['offers'=>$offers,'categories'=>$categories,'locations'=>$locations]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('create',Offer::class);

        $categories = Category::orderBy('title')->get();
        $locations = Location::orderBy('title')->get();

        return view('offers.create',['categories'=>$categories,'locations'=>$locations]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreOfferRequest $request, OfferService $offerService)
    {
        try {
            $this->authorize('create',Offer::class);

            $offerService->store($request->validated(),$request->hasFile('image') ? $request->file('image') : null);

            return back()->with('success','Offer created successfully');
        }catch (\Exception $exception){
            return back()->with('error',$exception->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Offer $offer)
    {
        return view('offers.show',['offer'=>$offer]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Offer $offer)
    {
        $this->authorize('update',$offer);

        $categories = Category::orderBy('title')->get();
        $locations = Location::orderBy('title')->get();

        return view('offers.edit',['offer'=>$offer,'categories'=>$categories,'locations'=>$locations]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreOfferRequest $request, Offer $offer, OfferService $offerService)
    {
        try {
            $this->authorize('create',$offer);

            $offerService->update($offer,$request->validated(),$request->hasFile('image') ? $request->file('image') : null);

            return back()->with('success','Offer created successfully');
        }catch (\Exception $exception){
            return back()->with('error',$exception->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Offer $offer, OfferService $offerService)
    {
        $offerService->destroy($offer);

        return response('offer deleted successfully');
    }
}
