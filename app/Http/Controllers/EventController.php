<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;


class EventController extends Controller
{
    public function index() {
    $semua_event = Event::all();
    return view('admin.event.index', compact('semua_event'));
}

public function store(Request $request) {
    Event::create($request->all());
    return redirect()->route('event.index')->with('success', 'Event ditambahkan!');
}

public function update(Request $request, $id) {
    Event::findOrFail($id)->update($request->all());
    return redirect()->route('event.index')->with('success', 'Event diperbarui!');
}

public function destroy($id) {
    Event::findOrFail($id)->delete();
    return redirect()->route('event.index')->with('success', 'Event dihapus!');
}

    // Untuk list publik
public function eventPublik() {
    $semua_event = Event::all();
    return view('frontend.event', compact('semua_event'));
}


}
