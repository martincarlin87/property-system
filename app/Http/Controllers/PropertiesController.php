<?php

namespace App\Http\Controllers;

use App\Http\Resources\PropertyCollection;
use App\Models\Property;
use Illuminate\Http\Request;

class PropertiesController extends Controller
{
    public function index(Request $request)
    {
        $properties = Property::orderBy('town', 'asc')
            ->when(!empty($request->search), function ($q) use ($request) {
                return $q->where('country', 'like', '%' . $request->search . '%')
                    ->orWhere('county', 'like', '%' . $request->search . '%')
                    ->orWhere('town', 'like', '%' . $request->search . '%')
                    ->orWhere('address', 'like', '%' . $request->search . '%');
            })
            ->take(20)
            ->get();

        return new PropertyCollection($properties);
    }
}
