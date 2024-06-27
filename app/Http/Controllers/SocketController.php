<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\JsonResponse;
use App\Events\TestingEvent;

class SocketController extends Controller{
    function __construct(){

    }

    public function __invoke(Request $request): JsonResponse
    {
        TestingEvent::dispatch('Hello world!');

        return response()->json(['success' => true]);
    }

    function socket(){
        event(new TestingEvent(request("drop1")));
        return response()->json(['success' => true]);
    }
    
} 

