<?php

namespace App\Http\Controllers;

use App\Messages;
use App\Tickets;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class TicketController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    public function listTicket()
    {
        $tickets = Tickets::all(); //Fetch all Tickets
        return view('ticket/listTickets')->with('tickets', $tickets);
    }
    public function addTicket()
    {
        return view('ticket/addTicket');
    }
    public function createTicket(Request $request)
    {
        $params = $request->except(['_token']); // Fetch all Forms parmas witout _token

        $date = new \DateTime();
        $ticket = new Tickets();
        $ticket->creator_id = Auth::user()->id;
        $ticket->subject = $params['subject'];
        $ticket->status = $params['status'];
        $ticket->content = $params['content'];
        $ticket->slug = Str::slug($params['subject'] . $date->format('dmYhis')) ;

        $ticket->save(); // Insert BDD
        return redirect()->route('listTicket')->with('success', 'Ticket was added');
    }
    public function showTicket($slug)
    {
        $ticket = Tickets::where('slug', '=', $slug)->first(); //Fetch ticket by slug
        $messages = Messages::where('ticket_id', '=', $ticket->id)->get();
        return view('ticket/showTicket')->with('ticket', $ticket)->with('messages', $messages);
    }
    public function deleteTicket($slug)
    {
        $ticket = Tickets::where('slug', '=', $slug)->first();
        $ticket->delete();
        return redirect()->route('listTicket')->with('success', 'item was removed');
    }

    public function updateTicket(Request $request, $slug){
        $ticket = Tickets::where('slug', '=', $slug)->first();
        if ($request->isMethod('post'))
        {
            $params = $request->except(['_token']);  // Fetch all Forms parmas witout _token

            $date = new \DateTime();
            $ticket = Tickets::where('slug', '=', $slug)->first(); //Fetch ticket by slug
            $ticket->creator_id = Auth::user()->id;
            $ticket->subject = $params['subject'];
            $ticket->status = $params['status'];
            $ticket->content = $params['content'];
            $ticket->slug = Str::slug($params['subject'] . $date->format('dmYhis')) ;

            $ticket->save(); // Update ticket by slug
            return redirect()->route('listTicket')->with('success', 'item was added');
        }
        return view('ticket/addTicket')->with('ticket', $ticket);
    }




}
