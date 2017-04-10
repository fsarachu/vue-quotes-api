<?php

namespace App\Http\Controllers;

use App\Quote;
use Illuminate\Http\Request;

class QuoteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(['quotes' => Quote::all()], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'content' => 'required|string|max:255',
        ]);

        $quote = Quote::create($request->only(['content']));

        if ($quote) {
            return response()->json(['quote' => $quote], 201);
        }

        return response()->json(['message' => "Quote not created"], 500);
    }

    /**
     * Return the specified resource.
     *
     * @param  \App\Quote $quote
     * @return \Illuminate\Http\Response
     */
    public function show(Quote $quote)
    {
        if (!$quote) {
            return response()->json(['message' => 'Quote not found'], 404);
        }

        return response()->json(['quote' => $quote], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Quote $quote
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Quote $quote)
    {
        if (!$quote) {
            return response()->json(['message' => 'Quote not found'], 404);
        }

        $this->validate($request, [
            'content' => 'required|string|max:255',
        ]);

        $quote->update($request->only(['content']));

        return response()->json(['quote' => $quote], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Quote $quote
     * @return \Illuminate\Http\Response
     */
    public function destroy(Quote $quote)
    {
        if (!$quote) {
            return response()->json(['message' => 'Quote not found'], 404);
        }

        $quote->delete();

        return response()->json(['message' => 'Quote successfully deleted'], 200);
    }
}
