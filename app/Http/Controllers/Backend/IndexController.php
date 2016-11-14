<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class IndexController extends Controller
{


	
    public function index()
    {
        $tasks = [
            [
                'name' => 'liyachen',
                'progress' => '87',
                'color' => 'danger'
            ],
            [
                'name' => 'gaoshanshan',
                'progress' => '76',
                'color' => 'warning'
            ],
            [
                'name' => 'wangyixuan',
                'progress' => '32',
                'color' => 'success'
            ],
            [
                'name' => 'zoujian',
                'progress' => '56',
                'color' => 'info'
            ],
            [
                'name' => 'xiaoluoli',
                'progress' => '10',
                'color' => 'success'
            ]
        ];
        return view('backend.index.index',compact('tasks'));
    }


}
