<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\MarketingMaterial;
use Inertia\Inertia;

class MarketingMaterialController extends Controller
{
    /**
     * Display marketing materials.
     */
    public function index()
    {
        $materials = MarketingMaterial::active()
            ->orderBy('type')
            ->orderBy('title')
            ->get()
            ->groupBy('type');

        return Inertia::render('affiliate/materials', [
            'materials' => $materials,
        ]);
    }
}