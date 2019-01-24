<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Card;
use App\Task;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function lists()
    {
        $lists = [];
        $result = DB::table('cards')
        ->select(DB::raw('*, cards.id as card_id'))
        ->leftJoin('tasks', 'cards.id', '=', 'tasks.card_id')->where('user_id', Auth::id())
        ->get();

        $i = 0;
        $a = -1;
        $titleAnterior = "";
        foreach($result as $task){

            if($a == -1 || $titleAnterior != $task->title){
                $titleAnterior = $task->title;
                $a++;
                $i = 0;
            }

            $lists[$a]["id"] = $task->card_id;
            $lists[$a]["title"] = $task->title;
            $lists[$a]["itens"][$i]["id"] = $task->id;
            $lists[$a]["itens"][$i]["description"] = $task->description;
            $lists[$a]["itens"][$i]["check"] = $task->check;

            $i++;
        }

       // dd($lists);

        return response()->json($lists);
    }

    public function addCard(Request $request)
    {
        $card = $request->all();

        if($card['id'] != -1)
        {

            $cardModel = Card::find($card['id']);
        }else{

            $cardModel = new Card();
            $cardModel->user_id = Auth::id();
        }

        $cardModel->title = $card['title'];
        $cardModel->save();
        
        return $cardModel->id;

    }

    public function cards()
    {

        return response()->json(Card::all());
    }

    public function removeCard($id)
    {

        Task::where('card_id', $id)->delete();
        Card::find($id)->delete();
    }

    public function removeItem($id)
    {

        Task::find($id)->delete();
    }

    public function saveItem($cardId, Request $request)
    {

        $item = $request->all();

        if(isset($item['id']) && $item['id'] != -1)
        {

            $taskModel = Task::find($item['id']);
        }else{

            $taskModel = new Task();
            $taskModel->card_id = $cardId;
            $taskModel->check = 0;
        }

        $taskModel->description = $item['description'];
        $taskModel->save();
        
        return $taskModel->id;
    }
}
